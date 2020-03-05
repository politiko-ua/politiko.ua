<?

class friends_accept_action extends frontend_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->set_renderer('ajax');
		$this->json = array();

		load::model('friends/pending');
		if ( friends_pending_peer::instance()->is_pending(session::get_user_id(), request::get_int('user_id')) )
		{
			friends_pending_peer::instance()->delete(session::get_user_id(), request::get_int('user_id'));

			load::model('friends/friends');
			friends_peer::instance()->insert(array(
				'user_id' => session::get_user_id(),
				'friend_id' => request::get_int('user_id')
			));

			friends_peer::instance()->insert(array(
				'friend_id' => session::get_user_id(),
				'user_id' => request::get_int('user_id')
			));
		}
	}
}