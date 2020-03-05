<?

load::app('modules/parties/controller');
class parties_add_moderator_action extends parties_controller
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

		if ( preg_match('/profile-([0-9]+)/', request::get('id'), $matches) )
		{
			$this->moderator_id = $matches[1];
		}
		else
		{
			$this->moderator_id = request::get_int('id');
		}
		
		if ( user_data_peer::instance()->get_item($this->moderator_id) )
		{
			parties_peer::instance()->add_moderator($this->party['id'], $this->moderator_id);
		}
		else
		{
			exit;
		}
	}
}