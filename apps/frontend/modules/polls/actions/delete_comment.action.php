<?

load::app('modules/polls/controller');
class polls_delete_comment_action extends polls_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->set_renderer('ajax');
		$this->json = array();

		if ( $comment_id = request::get_int('id') )
		{
			load::model('polls/comments');

			if ( !session::has_credential('moderator') )
			{
				$comment = polls_comments_peer::instance()->get_item($comment_id);
				if ( $comment['user_id'] != session::get_user_id() )
				{
					return;
				}
			}

			polls_comments_peer::instance()->delete_item( request::get_int('id') );
		}
	}
}