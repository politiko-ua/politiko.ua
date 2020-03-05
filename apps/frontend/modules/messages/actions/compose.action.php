<?

load::app('modules/messages/controller');
class messages_compose_action extends messages_controller
{
	public function execute()
	{
		$friends = friends_peer::instance()->get_by_user( session::get_user_id() );
		foreach ( $friends as $friend_id )
		{
			$this->friends[$friend_id] = user_helper::full_name($friend_id, false);
			$this->friends_names[user_helper::full_name($friend_id, false)] = $friend_id;
		}

		client_helper::register_variable('friends', $this->friends);
		client_helper::register_variable('friendsNames', $this->friends_names);

		if ( $this->user = user_data_peer::instance()->get_item(request::get_int('user_id')) )
		{
			client_helper::register_variable('receiverName', $this->user['first_name'] . ' ' . $this->user['last_name']);
		}


		if ( request::get('submit') )
		{
			if ( request::get_int('receiver_id') && trim(request::get('body')) )
			{
				$id = messages_peer::instance()->add(array(
					'sender_id' => session::get_user_id(),
					'receiver_id' => request::get_int('receiver_id'),
					'body' => trim(request::get('body'))
				));

				load::action_helper('user_email', false);
				user_email_helper::send(
					request::get_int('receiver_id'),
					session::get_user_id(),
					array(
						'subject' => '%sender%:' . t('Новое сообщение'),
						'body' => '%sender% ' . t('пишет') . ':' . "\n\n" . trim(request::get('body')) . "\n\n" .
								  t('Что-бы ответить, перейдите по ссылке:') . "\n" .
								  'https://' . context::get('host') . '/messages/view?id=' . $id
					)
				);
			}

			$this->set_renderer('ajax');
			$this->json = array();
		}
	}
}