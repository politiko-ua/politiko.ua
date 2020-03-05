<?

class sign_recover_action extends frontend_controller
{
	public function execute()
	{
		if ( session::is_authenticated() )
		{
			$this->redirect('/profile');
		}

		if ( request::get('email') )
		{
			$this->set_renderer('ajax');
			$this->json = array();

			if ( !$user = user_auth_peer::instance()->get_by_email(request::get('email')) )
			{
				$this->json = array('errors' => array('email' => array('Такой email не зарегистрирован') ));
			}
			else
			{
				user_auth_peer::instance()->regenerate_security_code( $user['id'] );
				$user = user_auth_peer::instance()->get_item( $user['id'] );

				load::system('email/email');
				$email = new email();
				$email->setReceiver(request::get('email'));

				$body =
				    t('Здравствуйте,') . "\n" .
				    t('Ваша ссылка для восстановления пароля: ')  .
					'https://' . context::get('host') . '/sign/password?c=' . $user['security_code'] . "\n" .
					''  . "\n\n" .
					'Politiko.com.ua';

				$email->setBody($body);
				$email->setSubject( t('Восстановление пароля на') . ' Politiko.com.ua');

				$email->send();
				$this->json = array();
			}
		}
	}
}
