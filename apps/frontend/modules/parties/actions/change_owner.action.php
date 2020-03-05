<?

load::app('modules/parties/controller');
class parties_change_owner_action extends parties_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->set_renderer('ajax');
		$this->json = array();

		$this->party = parties_peer::instance()->get_item(request::get_int('party_id'));
		if ( $this->party['user_id'] != session::get_user_id() )
		{
			exit;
		}

		if ( $this->moderator_id = request::get_int('id') )
		{
			parties_peer::instance()->update(array(
				'id' => $this->party['id'],
				'user_id' => $this->moderator_id
			));
		}
	}
}