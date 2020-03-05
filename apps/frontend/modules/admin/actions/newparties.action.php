<?

load::app('modules/admin/controller');
class admin_newparties_action extends admin_controller
{
	public function execute()
	{
		load::model('parties/parties');
		load::model('user/user_data');
		load::view_helper('party');
		
		if ( $this->party_key = request::get('key') )
		{
			$this->party = parties_peer::instance()->get_item($this->party_key);
		}

		if ( $this->party && request::get('state') )
		{
			parties_peer::instance()->update( array(
				'id' => $this->party['id'],
				'state' => request::get('state')
			));
		}
		
		$this->parties = array();
		foreach ( parties_peer::instance()->get_not_approved() as $party_key )
		{
			$party = parties_peer::instance()->get_item($party_key);
			$party['user'] = user_data_peer::instance()->get_item($party['user_id']);
			$this->parties[] = $party;
		}
	}
}
