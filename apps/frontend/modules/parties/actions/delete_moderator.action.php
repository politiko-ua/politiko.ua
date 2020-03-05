<?

load::app('modules/parties/controller');
class parties_delete_moderator_action extends parties_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->disable_layout();

		$this->party = parties_peer::instance()->get_item(request::get_int('party_id'));
		if ( $this->party['user_id'] != session::get_user_id() )
		{
			exit;
		}

		$this->moderator_id = request::get_int('id');
		parties_peer::instance()->delete_moderator($this->party['id'], $this->moderator_id);

		$this->set_renderer('ajax');
		$this->json = array();
	}
}