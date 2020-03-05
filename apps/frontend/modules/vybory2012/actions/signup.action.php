<?

load::app('modules/m2010/controller');
class m2010_signup_action extends m2010_controller
{
	protected $authorized_access = false;

	public function execute()
	{
		$this->disable_layout();

		load::model('political_views');

		$this->candidate_id = request::get_int('id');

		if ( request::get('submit') )
		{
			$this->set_renderer('ajax');
			$this->json = array();

			load::form('sign/signup');
			$form = new signup_form();
			$form->load_from_request();

			if ( !$form->is_valid() )
			{
				$this->json = array('errors' => $form->get_errors());
			}
			else
			{
				$id = user_auth_peer::instance()->insert(
					$form->get_value('email'),
					$form->get_value('password'),
					user_auth_peer::TYPE_PERSON
				);
				$user = user_auth_peer::instance()->get_item($id);

				load::model('user/user_data');
				user_data_peer::instance()->insert(array(
					'user_id' => $user['id'],
					'first_name' => 'Аноним',
					'last_name' => '',
					'political_views' => request::get_string('political_views'),
					'political_views_sub' => 0,
					'political_views_custom' => '',
					'gender' => request::get('gender', 'm')
				));

				load::system('email/email');

				$email = new email();
				$email->setReceiver(request::get('email'));

				$body =
				request::get('first_name') . ', ' . t('добро пожаловать на') . ' Politiko!' . "\n" .
				"\n" .
				 t('Вы приняли участие в онлайн голосовании, и Вам необходимо подтвердить свой голос.') .
				 "\n" .
			    t('Для подтверждения нажмите на ссылку ниже: ') . "\n" .
				'https://' . context::get('server') . '/sign/activate?v=' . $this->candidate_id . '&c=' . $user['security_code'] . "\n" .
				"\n" .
				'Politiko.com.ua';

				$email->setBody($body);
				$email->setSubject( t('Подтверждение голоса на') . ' Politiko.com.ua');

				$email->send();
			}
		}
	}
}
