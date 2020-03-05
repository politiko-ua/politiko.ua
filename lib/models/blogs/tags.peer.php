<?

load::model('tags');

class blogs_tags_peer extends tags_peer
{
	protected $table_name = 'blogs_tags';

	/**
	 * @return blogs_tags_peer
	 */
	public static function instance()
	{
		return parent::instance( 'blogs_tags_peer' );
	}

	public function get_top()
	{
		$sql = '
		SELECT
			pt.tag_id as id, count(pt.post_id) as posts
		FROM
		' . blogs_posts_peer::instance()->get_table_name() . ' p
		JOIN
		' . blogs_posts_tags_peer::instance()->get_table_name() . ' pt ON (pt.post_id = p.id)
		WHERE
			p.created_ts > :offset
		GROUP BY
			pt.tag_id
		ORDER BY
			posts DESC
		LIMIT 15
		';

		$list = db::get_rows($sql, array('offset' => time() - 60*60*24*14), $this->connection_name, array('blog_top_tags', 60*60*2));

		return tags_helper::normalize($list, 'posts');
	}
}
