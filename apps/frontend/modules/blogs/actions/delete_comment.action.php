<?

load::app('modules/blogs/controller');
class blogs_delete_comment_action extends blogs_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->set_renderer('ajax');
		$this->json = array();

		if ( $comment_id = request::get_int('id') )
		{
			$comment = blogs_comments_peer::instance()->get_item($comment_id);

			if ( !session::has_credential('moderator') )
			{
				$post = blogs_posts_peer::instance()->get_item($comment['post_id']);

				if ( session::has_credential('selfmoderator') )
				{
						if ( $post['user_id'] != session::get_user_id() ) return;
				}
				else if ( $comment['user_id'] != session::get_user_id() )
				{
						return;
				}
			}

			blogs_comments_peer::instance()->delete_item( request::get_int('id') );

			if ( session::has_credential('moderator') )
			{
				load::model('admin_feed');
				$text = htmlspecialchars($comment['text']) . '<br /><br /> Автор: ' .
						user_helper::full_name($comment['user_id']) . '<br /><br />' .
						'<a href="/blogpost' . $comment['post_id'] . '">Перейти к посту' . '</a>';

				admin_feed_peer::instance()->add(session::get_user_id(), admin_feed_peer::TYPE_BLOG_COMMENT, $text);
			}
		}
	}
}