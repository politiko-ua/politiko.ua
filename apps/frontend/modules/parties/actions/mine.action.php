<?

load::app('modules/parties/controller');
class parties_mine_action extends parties_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		if ( $party = parties_members_peer::instance()->get(session::get_user_id()) )
		{
			$this->redirect('/party' . $party);
		}

		$this->user_data = user_data_peer::instance()->get_item(session::get_user_id());
	}
}