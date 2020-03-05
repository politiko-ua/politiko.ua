<?

load::app('modules/groups/controller');
class groups_approve_applicant_action extends groups_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->set_renderer('ajax');
		$this->json = array();

		$this->group = groups_peer::instance()->get_item(request::get_int('group_id'));
		if ( $this->group['user_id'] != session::get_user_id() )
		{
			exit;
		}

		load::model('groups/applicants');
		groups_applicants_peer::instance()->remove($this->group['id'], request::get_int('id'));
		groups_members_peer::instance()->add( $this->group['id'], request::get_int('id') );
		groups_peer::instance()->update_rate( $this->group['id'], 1, request::get_int('id') );

		load::action_helper('user_email', false);
		user_email_helper::send(
			request::get_int('id'),
			null,
			array(
				'subject' => t('Вас приняли в группу'),
				'body' =>
					'%receiver%,' . "\n\n" .
					t('Вас приняли в группу') .
					' "' . $this->group['title'] . '"' . "\n\n" .
				    t('Посетите страничку этой группы') . ":\n" .
					'https://' . context::get('host') . '/group' . $this->group['id']
			)
		);
	}
}