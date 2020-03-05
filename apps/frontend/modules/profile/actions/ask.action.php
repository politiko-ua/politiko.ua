<?

class profile_ask_action extends frontend_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->set_renderer('ajax');
		$this->json = array();

		if ( trim(request::get_string('text')) && request::get_int('profile_id') )
		{
			load::model('user/questions');
			$this->id = user_questions_peer::instance()->insert(array(
				'user_id' => session::get_user_id(),
				'profile_id' => request::get_int('profile_id'),
				'text' => trim(request::get_string('text'))
			));

			user_questions_peer::instance()->rate($this->id, session::get_user_id());

			load::action_helper('user_email', false);
			user_email_helper::send(
				request::get_int('profile_id'),
				session::get_user_id(),
				array(
					'subject' => t('Вам задали вопрос'),
					'body' =>
						'%receiver%,' . "\n\n" .
						'%sender% ' . t('задает Вам вопрос') . ":\n" .
						trim(request::get_string('text')) . "\n\n" .
					    t('Для того, что-бы ответить, посетите страничку с вопросами') . ":\n" .
						'https://' . context::get('host') . '/profile/questions?id=' . request::get_int('profile_id')
				)
			);
		}
	}
}