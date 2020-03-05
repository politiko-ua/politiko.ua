<?

load::app('modules/parties/controller');
class parties_delete_leader_action extends parties_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->disable_layout();

		$this->party = parties_peer::instance()->get_item(request::get_int('party_id'));
		if ( !parties_peer::instance()->is_moderator($this->party['id'], session::get_user_id()) )
		{
			exit;
		}

		$this->leader_id = request::get_int('id');
		parties_peer::instance()->delete_leader($this->party['id'], $this->leader_id);

		$this->set_renderer('ajax');
		$this->json = array();
	}
}