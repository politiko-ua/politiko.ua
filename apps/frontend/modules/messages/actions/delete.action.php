<?

load::app('modules/messages/controller');
class messages_delete_action extends messages_controller
{
	public function execute()
	{
		$this->thread = messages_threads_peer::instance()->get_item(request::get_int('id'));
		if ( ( $this->thread['sender_id'] != session::get_user_id() ) && ( $this->thread['receiver_id'] != session::get_user_id() ) )
		{
			$this->redirect('/messages');
		}

		messages_peer::instance()->delete_by_thread($this->thread['id'], session::get_user_id());

		if ( request::get('spam') )
		{
			load::system('email/email');

			$email = new email();
			$email->setReceiver(conf::get('debug_email_address'));

			$spammer = $this->thread['sender_id'] == session::get_user_id() ? $this->thread['receiver_id'] : $this->thread['sender_id'];

			$body = 'Поток: ' . print_r($this->thread, 1) . "\n\n";
			$body .= 'Пожаловался(лась): ' . user_helper::full_name(session::get_user_id(), false) . "\n";
			$body .= 'https://' . context::get('host') . '/profile-' . session::get_user_id() . "\n\n";
			$body .= 'Спамил: ' . user_helper::full_name($spammer, false) . "\n";
			$body .= 'https://' . context::get('host') . '/profile-' . $spammer . "\n\n";

			$email->setBody($body);
			$email->setSubject( date('d/m/Y H:i') . ' - жалоба на спам на Politiko.com.ua');

			$email->send();
		}

		$this->redirect('/messages');
	}
}