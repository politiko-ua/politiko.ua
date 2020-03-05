<?

class sign_up_action extends frontend_controller
{
    public function execute()
    {
		/*if ( mem_cache::i()->get('sign-up-ip' . $_SERVER['REMOTE_ADDR']) )
			throw new public_exception( t('С этого IP адреса уже был зарегистрирован аккаунт') );*/

		load::model('political_views');

		$this->set_layout('public');

		$this->email = trim(request::get('email'));
		
		if ( request::get('name') )
		{
			$this->name = explode(' ', trim(request::get('name')));
		}

		client_helper::register_variable('politicalViewsSub', political_views_peer::get_sub_list());
		client_helper::register_variable('politicalViewsOther', political_views_peer::get_other_list());

		if ( request::get('submit') )
        {
			$this->set_renderer('ajax');

			load::form('sign/signup');
			$form = new signup_form();
			$form->load_from_request();

			if ( !$form->is_valid() )
			{
				$this->json = array('errors' => $form->get_errors());
			}
			/*else if ( !user_auth_peer::instance()->code_exists(request::get('code')) )
			{
				$this->json = array('errors' => array('code' => array(t('Неверный код приглашения'))));
			}*/
			else
			{
				$id = user_auth_peer::instance()->insert(
					$form->get_value('email'),
					$form->get_value('password'),
					$form->get_value('type')
				);
				$user = user_auth_peer::instance()->get_item($id);

				load::model('user/user_data');
				user_data_peer::instance()->insert(array(
					'user_id' => $user['id'],
					'first_name' => request::get('first_name'),
					'last_name' => request::get('last_name'),
					'political_views' => request::get_string('political_views'),
					'political_views_sub' => request::get_int('political_views_sub'),
					'political_views_custom' => request::get('political_views_custom'),
					'gender' => request::get('gender', 'm')
				));

				if ( $inviter_id = request::get_int('inviter_id') )
				{
					load::model('friends/friends');
					friends_peer::instance()->insert(array(
						'user_id' => $id,
						'friend_id' => $inviter_id
					));

					friends_peer::instance()->insert(array(
						'friend_id' => $id,
						'user_id' => $inviter_id
					));
				}

				load::system('email/email');

				$email = new email();
				$email->setReceiver(request::get('email'));

				$body =
				request::get('first_name') . ', ' . t('добро пожаловать на') . ' Politiko!' . "\n" .
				"\n" .
			    t('Ваши данные для входа на сайт:') . "\n" .
				'Email: ' . $form->get_value('email')  . "\n" .
			    t('Пароль: ') . $form->get_value('password')  . "\n" .
				"\n" .
			    t('Для активации аккаунта нажмите на ссылку ниже: ') . "\n" .
				'https://' . context::get('host') . '/sign/activate?c=' . $user['security_code'] . "\n" .
				"\n" .
				'Politiko.com.ua';

				$email->setBody($body);
				$email->setSubject( t('Активация аккаунта на') . ' Politiko.com.ua');

				$email->send();
				
				
				$this->json = array();
			}
        }
    }
}
