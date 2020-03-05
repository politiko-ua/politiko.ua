<?

class friends_index_action extends frontend_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->friends = friends_peer::instance()->get_by_user( session::get_user_id() );

		client_helper::register_variable('l_are_you_sure', t('Вы уверены?') );
	}
}