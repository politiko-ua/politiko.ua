<?

class blogs_comments_peer extends db_peer_postgre
{
	protected $table_name = 'blogs_comments';

	/**
	 * @return blogs_comments_peer
	 */
	public static function instance()
	{
		return parent::instance( 'blogs_comments_peer' );
	}

	public function insert($data)
	{
		$id = parent::insert($data);

		$c = 'blog_post_comments_' . $data['post_id'];
		mem_cache::i()->delete($c);

		# Todo: increment
		$c = 'blog_post_comments_count_' . $data['post_id'];
		mem_cache::i()->delete($c);

		$this->count_comment( $data['post_id'], $data['user_id'] );

		return $id;
	}

	public function is_allowed( $post_id, $user_id )
	{
		$c = 'blog_post_comments_user_limit_' . $post_id . $user_id;
		return mem_cache::i()->get($c) < 3;
	}

	public function count_comment( $post_id, $user_id )
	{
		$c = 'blog_post_comments_user_limit_' . $post_id . $user_id;
		mem_cache::i()->set($c, mem_cache::i()->get($c) + 1, 60*60);
	}

	public function get_count_by_post( $post_id )
	{
			$c = 'blog_post_comments_count_' . $post_id;

			if ( !mem_cache::i()->exists($c) )
			{
				$data = db::get_scalar('SELECT count(id) FROM ' . $this->table_name . ' WHERE post_id = :id', array('id' => $post_id));
				mem_cache::i()->set($c, $data);

			}
			else
			{
				$data = mem_cache::i()->get($c);
			}

			return $data;
	}


	public function get_by_post( $post_id )
	{
		$c = 'blog_post_comments_' . $post_id;

		if ( !mem_cache::i()->exists($c) )
		{
			$data = $this->get_list(array('post_id' => $post_id, 'parent_id' => 0), array(), array('ID ASC'));
			mem_cache::i()->set($c, $data);

		}
		else
		{
			$data = mem_cache::i()->get($c);
		}

		return $data;
	}

	public function has_rated( $comment_id, $user_id )
	{
		return db_key::i()->exists('blog_comment_rate:' . $comment_id . ':' . $user_id);
	}

	public function rate( $comment_id, $user_id )
	{
		db_key::i()->set('blog_comment_rate:' . $comment_id . ':' . $user_id, true);
	}

	public function delete_item($id)
	{
		$data = $this->get_item($id);
		parent::delete_item($id);
		mem_cache::i()->delete('blog_post_comments_' . $data['post_id']);
		parent::reset_item($id);
	}
}
