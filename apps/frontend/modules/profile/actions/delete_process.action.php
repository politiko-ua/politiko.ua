<?

class profile_delete_process_action extends frontend_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		if ( session::get('delete_hash') == request::get('hash') )
		{
			user_auth_peer::instance()->delete_item(session::get_user_id());
			user_data_peer::instance()->delete_item(session::get_user_id());
			friends_peer::instance()->delete_by_user(session::get_user_id());
			session::unset_user();
		}
		
		$this->redirect('/');
	}
}