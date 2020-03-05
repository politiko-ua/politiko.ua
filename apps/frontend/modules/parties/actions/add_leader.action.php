<?

load::app('modules/parties/controller');
class parties_add_leader_action extends parties_controller
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

		if ( preg_match('/profile-([0-9]+)/', request::get('id'), $matches) )
		{
			$this->leader_id = $matches[1];
		}
		else
		{
			$this->leader_id = request::get_int('id');
		}

		if ( user_data_peer::instance()->get_item($this->leader_id) )
		{
			parties_peer::instance()->add_leader($this->party['id'], $this->leader_id);
		}
		else
		{
			exit;
		}
	}
}