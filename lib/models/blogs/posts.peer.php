<?

load::lib('purifier/HTMLPurifier.auto');
load::lib('text/names.extractor');

class blogs_posts_peer extends db_peer_postgre
{
    const TYPE_BLOG_POST   = 1;
    const TYPE_NEWS_POST   = 2;
    const TYPE_HUMOR_POST  = 3;
    const TYPE_COPIED_POST = 4;
    protected $table_name = 'blogs_posts';

    /**
     * @return blogs_posts_peer
     */
    public static function instance()
    {
        return parent::instance('blogs_posts_peer');
    }

    public function get_by_user($id)
    {
        return parent::get_list(['user_id' => $id]);
    }

    public function get_casted()
    {
        $sql = sprintf(
            'SELECT id FROM %s WHERE type != :type AND visible = true AND (("for" >= 7 AND type = :blog_type) OR ("for" >= 30 AND type = :humor_type) OR ("for" >= 20 AND type = :copied_type) OR public = true) ORDER BY sort_ts DESC',
            $this->table_name
        );

        return db::get_cols(
            $sql,
            [
                'type'        => self::TYPE_NEWS_POST,
                'blog_type'   => self::TYPE_BLOG_POST,
                'humor_type'  => self::TYPE_HUMOR_POST,
                'copied_type' => self::TYPE_COPIED_POST,
            ],
            $this->connection_name,
            [
                'posts_casted',
                60 * 10,
            ]
        );
    }

    public function get_by_tag($tag_id)
    {
        $sql = '
		SELECT p.id
		FROM '.$this->table_name.' p
		JOIN '.blogs_posts_tags_peer::instance()->get_table_name().' pt ON (pt.post_id = p.id)
		WHERE pt.tag_id = :tag_id AND p.visible = true
		GROUP BY p.id
		ORDER BY id DESC
		LIMIT 50';

        return db::get_cols($sql, ['tag_id' => $tag_id], $this->connection_name, ['posts_by_tag'.$tag_id, 60 * 60 * 3]);
    }

    public function get_similar($id, $limit = 5)
    {
        $sql = '
		SELECT p.post_id
		FROM '.blogs_posts_tags_peer::instance()->get_table_name().' p
		WHERE p.tag_id IN ( SELECT tag_id FROM '.blogs_posts_tags_peer::instance()->get_table_name().' pt WHERE pt.post_id = :id )
		GROUP BY p.post_id
		ORDER BY p.post_id DESC
		LIMIT :limit';

        return db::get_cols(
            $sql,
            ['id' => $id, 'limit' => $limit],
            $this->connection_name,
            ['posts_similar'.$id, 60 * 60 * 24]
        );
    }

    public function get_newest($type = null)
    {
        if (!$type) {
            $type = self::TYPE_BLOG_POST;
        }

        if ($type == self::TYPE_BLOG_POST) {
            $sql = 'SELECT id FROM '.$this->table_name.'
				WHERE type != :type AND visible = true ORDER BY id DESC LIMIT 40';

            return db::get_cols(
                $sql,
                ['type' => self::TYPE_NEWS_POST],
                $this->connection_name,
                ['posts_newest'.$type, 60 * 10]
            );
        } else {
            $sql = 'SELECT id FROM '.$this->table_name.'
				WHERE type = :type AND visible = true ORDER BY id DESC LIMIT 40';

            return db::get_cols($sql, ['type' => $type], $this->connection_name, ['posts_newest'.$type, 60 * 10]);
        }
    }

    public function get_favorites()
    {
        $sql = 'SELECT id FROM '.$this->table_name.' WHERE favorite = true AND visible = true ORDER BY id DESC LIMIT 32';

        return db::get_cols($sql, [], $this->connection_name, ['posts_favorites', 60 * 60]);
    }

    public function get_discussed()
    {
        /*$sql =
            'SELECT b.id FROM ' . $this->table_name . ' b ' .
            'JOIN ' . blogs_comments_peer::instance()->get_table_name() . ' bc ON (bc.post_id = b.id) ' .
            'WHERE visible = true AND b.created_ts > 1331467300
            GROUP BY b.id
            ORDER BY count(bc.id) DESC LIMIT 100';
        return db::get_cols($sql, array('time' => time() - 60*60*24*14), $this->connection_name, array('posts_discussed', 60*10));
                 */

        $last_blogs_posts_sql = 'SELECT id FROM blogs_posts WHERE visible = true AND created_ts > :time';
        $last_blogs_posts     = db::get_cols(
            $last_blogs_posts_sql,
            ['time' => time() - 60 * 60 * 24 * 14],
            $this->connection_name,
            ['last_blogs_posts', 60 * 60 * 12]
        );

        $sql =
            'SELECT b.id FROM '.$this->table_name.' b '.
            'JOIN '.blogs_comments_peer::instance()->get_table_name().' bc ON (bc.post_id = b.id) '.
            'WHERE b.id in ('.implode(',', $last_blogs_posts).')
			GROUP BY b.id
			ORDER BY count(bc.id) DESC LIMIT 32';

        return db::get_cols($sql, [], $this->connection_name, ['posts_discussed', 60 * 60]);

    }

    public function has_rated($post_id, $user_id)
    {
        return db_key::i()->exists('blog_post_rate:'.$post_id.':'.$user_id);
    }

    public function rate($post_id, $user_id)
    {
        db_key::i()->set('blog_post_rate:'.$post_id.':'.$user_id, true);
    }

    public function delete_item($id)
    {
        blogs_posts_tags_peer::instance()->delete_by_post($id);
        parent::delete_item($id);
    }

    public function search($keyword, $limit = 5)
    {
        $keyword = str_replace(' ', ' | ', $keyword);
        $sql     = 'SELECT id FROM '.$this->table_name.' WHERE fti @@ to_tsquery(\'russian\', :keyword) LIMIT :limit;';

        return db::get_cols($sql, ['keyword' => $keyword, 'limit' => $limit], $this->connection_name);
    }

    public function update($data, $keys = null)
    {
        parent::update($data, $keys);

        if (in_array('title', array_keys($data)) ||
            in_array('body', array_keys($data)) ||
            in_array('tags_text', array_keys($data))) {
            $this->reindex($data[$this->primary_key]);
        }
    }

    public function reindex($id)
    {
        $index_columns = ['title', 'body', 'tags_text'];
        $index_expr    = 'coalesce('.implode(',\'\') ||\' \'|| coalesce(', $index_columns).',\'\')';

        db::exec(
            'UPDATE '.$this->table_name.' SET fti = to_tsvector(\'russian\', '.$index_expr.') WHERE id = :id',
            ['id' => $id]
        );
    }

    public function insert($data, $ignore_duplicate = false)
    {
        $id = parent::insert($data, $ignore_duplicate);
        $this->reindex($id);

        return $id;
    }

    public function promote($id)
    {
        parent::update(['sort_ts' => time(), 'public' => true, 'id' => $id]);
        mem_cache::i()->delete('posts_casted');
    }

    public function clean_text($text)
    {
        $pattern_mso     = "/<!--\[if !mso\]>.*<!\[endif\]-->/sU";
        $pattern_gte_mso = "/<!--\[if gte mso.*<!\[endif\]-->/sU";
        @preg_replace($pattern_mso, '', $text, -1, $count);
        @preg_replace($pattern_gte_mso, '', $text, -1, $count);

        $config = HTMLPurifier_Config::createDefault();
        $config->set("HTML", "SafeEmbed", true);
        $config->set("HTML", "SafeObject", true);
        $config->set(
            'HTML',
            'Allowed',
            'a[href|title|target],br,p[style|align],span[style],em,i,b,u,ul,ol,li,strong,table,tr,td,img[src|width|height|style|align],embed,object[type|width|height|data],param[name|value]'
        );
        $HTMLpurifier = new HTMLPurifier($config);

        return $HTMLpurifier->purify($text, $config);
    }

    public function namize_text($text, &$users)
    {
        return names_extractor::process($text, $users);
    }
}
