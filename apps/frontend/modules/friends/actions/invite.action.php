<?

class friends_invite_action extends frontend_controller
{
	protected $authorized_access = true;

	public function execute()
	{
	   
        load::lib('auth/lib/openinviter/openinviter');
        
		$inviter = new openinviter();
		$this->invite_services = $inviter->getPlugins();
        
        	$to_invite = request::get('invite');
		$to_friend = request::get('friend');

		if ( $to_friend || $to_invite )
		{
			if ( $to_friend ) foreach ( $to_friend as $friend_id => $flag )
                        friends_peer::instance()->insert(array(
                          'user_id' => session::get_user_id(),
                          'friend_id' => $friend_id   
                        ) );

			load::system('email/email');
			$profile = user_data_peer::instance()->get_item(session::get_user_id());
			if ( $to_invite ) foreach ( $to_invite as $email => $flag )
			{
				$body = t('Поздравляем') . "!\n\n" .
						 $profile['first_name'] .' '. $profile['last_name'] . t('приглашает вас присоединится к сообществу') . " Politiko.ua \n\n" .
						t('Для продолжения нажмите ссылку') . ": \n" .
						'https://politiko.ua/sign/up?i=' .session::get_user_id();
				
				$m = new email($email, $profile['first_name'] . ' ' . t('приглашает вас на'). ' Politiko.ua', $body);
				$m->send( array('photo' => user_helper::photo(session::get_user_id(), 'm')) );
			}

			$this->invited=1;
		}
		elseif (request::get('service'))
		{

			$inviter->startPlugin(request::get('service'));
			$internal = $inviter->getInternalError();

			if ( conf::get('enable_web_debug') )
			{
				$contacts = array(
					'andimov@gmail.com' => 'Andrew Dimov',
					'design@artwap.ru' => 'Andrew'
				);
			}
			else
			{
				if ( $internal )
				{
					$this->error = true;
				}
				else if ( !$inviter->login($_POST['email'],$_POST['password']) )
				{
					$internal = $inviter->getInternalError();
					$this->error = true;
				}
				elseif ( false === $contacts=$inviter->getMyContacts() )
				{
					$this->error = true;
				}
				else
				{
					$this->oi_session_id = $inviter->plugin->getSessionID();
					$inviter->showContacts();
				}
			}

			if ( $contacts )
			{
				foreach ( $contacts as $email => $name )
					if ( $user = user_auth_peer::instance()->get_by_email($email) )
					{
						if ( $user['id'] == session::get_user_id()) continue;
						if (in_array($user['id'],friends_peer::instance()->get_by_user(session::get_user_id())) ) continue;
						
						$this->users[] = $user;
					}
					else $this->contacts[$email] = $name;
			}
		}



        /*
		if ( $email = trim($_POST['email']) )
		{
			$this->set_renderer('ajax');
			$this->json = array();

			$key = 'invitation-' . $email;
			if ( db_key::i()->get($key) ) return;

			$name = trim($_POST['name']);
			$message = $_POST['message'];

			load::system('email/email');

			$mail = new email();
			$mail->setReceiver( $email );

			$body =
			'Доброго дня, ' . $name . '! Запрошую Вас приєднатися до політичної соціальної мережі Politiko.com.ua!' . "\n" .
			"\n" .
			( $message ? $message . "\n\n" : '' ) .
			'Ведіть блог, приймайте участь у дебатах, оцінюйте партії і політиків, читайте новини громадських організацій, створюйте групи, шукайте однодумців  і ще багато цікавих можливостей на сайті.' . "\n" .
			"\n" .
			'Для реєстрації, перейдіть за посиланням' . ":\n" .
			'https://' . context::get('host') . '/sign/up?email=' . $email . '&name=' . $name . '&i=' . session::get_user_id() . "\n" .
			"\n" . 'Politiko.com.ua';

			$mail->setBody($body);
			$mail->setSubject('Запрошення на Politiko.com.ua');
			$mail->send();

			error_log('invitation sent from: ' . session::get_user_id() . ' to ' . $email);
			db_key::i()->set($key, true);
		}
        */
	}
}
