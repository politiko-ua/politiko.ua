<?

load::app('modules/groups/controller');
class groups_join_action extends groups_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->set_renderer('ajax');
		$this->json = array();

		if ( !$this->group = groups_peer::instance()->get_item(request::get_int('id')) )
		{
			return;
		}

		if ( $this->group['privacy'] == groups_peer::PRIVACY_PUBLIC )
		{
			groups_members_peer::instance()->add( request::get_int('id'), session::get_user_id() );
			groups_peer::instance()->update_rate( request::get_int('id'), 1, session::get_user_id() );
		}
		else if ( $this->group['privacy'] == groups_peer::PRIVACY_PRIVATE )
		{
			load::model('groups/applicants');
			groups_applicants_peer::instance()->add( request::get_int('id'), session::get_user_id() );
		}
	}
}