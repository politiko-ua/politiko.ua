<?

class help_bug_action extends frontend_controller
{
	public function execute()
	{
		if ( request::get('submit') )
		{
			$this->set_renderer('ajax');
			$this->json = array();

			load::system('email/email');

			$email = new email();
			$email->setReceiver(conf::get('support_email_address'));

			$body = request::get('text') . "\n" . "\n";

			if ( session::is_authenticated() )
			{
				$body .= 'Пользователь: ' . user_helper::full_name(session::get_user_id(), false) . "\n";
				$body .= 'https://' . context::get('host') . '/profile-' . session::get_user_id() . "\n\n";
			}
			else
			{
				$body .= 'От: ' . request::get('email') . "\n\n";
			}

			$body .= '---Доп. инфо---' . "\n";
			$body .= print_r($_SERVER, true);

			$email->setBody($body);
			$email->setSubject( date('d/m/Y H:i') . ' - Сообщение с формы обратной связи на Politiko.com.ua');

			$email->send();
		}
	}
}
