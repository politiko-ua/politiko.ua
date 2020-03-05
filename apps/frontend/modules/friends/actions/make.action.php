<?

class friends_make_action extends frontend_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->disable_layout();
		$this->user = user_auth_peer::instance()->get_item(request::get_int('id'));

		load::model('friends/pending');
		if ( !friends_pending_peer::instance()->is_pending($this->user['id'], session::get_user_id()) )
		{
			friends_pending_peer::instance()->add($this->user['id'], session::get_user_id());

			$user = user_data_peer::instance()->get_item( session::get_user_id() );

			load::action_helper('user_email', false);
			user_email_helper::send(
				$this->user['id'],
				session::get_user_id(),
				array(
					'subject' => '%sender% ' . t('приглашает Вас в друзья'),
					'body' =>
						'%receiver%,' . "\n\n" .
						'%sender% ' . t('приглашает Вас в друзья') . "\n\n" .
					    t('Для одобрения или отклонения приглашения, перейдите по ссылке ') . ":\n" .
						'https://' . context::get('host') . '/friends'
				)
			);
		}
	}
}