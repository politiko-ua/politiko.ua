<?

class comments_rate_action extends frontend_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		load::model('comments');
		if ( $comment = comments_peer::instance()->get_item( request::get_int('id') ) )
		{
			if ( !comments_peer::instance()->has_rated($comment['id'], session::get_user_id()) )
			{
				comments_peer::instance()->update( array(
					'id' => $comment['id'],
					'rate' => $comment['rate'] + ( request::get_int('positive') ? 1 : -1 )
				) );

				comments_peer::instance()->rate($comment['id'], session::get_user_id());
			}
		}

		$this->set_renderer('ajax');
		$this->json = array();
	}
}