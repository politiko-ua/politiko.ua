<?

load::app('modules/parties/controller');
class parties_leave_action extends parties_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		if ( $this->party = parties_peer::instance()->get_item(request::get_int('id')) )
		{
			if ( request::get_int('process') )
			{
				parties_members_peer::instance()->remove(session::get_user_id());
				user_data_peer::instance()->update_rate(session::get_user_id(), -10);
				parties_peer::instance()->update_rate( $this->party['id'], -5, session::get_user_id() );

				$this->redirect('/party' . $this->party['id']);
			}
			else
			{
				$this->disable_layout();
			}
		}
	}
}