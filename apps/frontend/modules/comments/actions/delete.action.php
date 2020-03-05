<?

load::app('modules/blogs/controller');
class comments_delete_action extends frontend_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		load::model('comments');

		$this->set_renderer('ajax');
		$this->json = array();

		if ( $comment_id = request::get_int('id') )
		{
			$comment = comments_peer::instance()->get_item($comment_id);

			if ( !session::has_credential('moderator') )
			{
				if ( $comment['user_id'] != session::get_user_id() )
				{
						return;
				}
			}

			comments_peer::instance()->delete_item( request::get_int('id') );
		}
	}
}