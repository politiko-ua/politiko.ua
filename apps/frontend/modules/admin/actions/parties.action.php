<?

load::app('modules/admin/controller');
class admin_parties_action extends admin_controller
{
	public function execute()
	{
		load::model('parties/parties');
		load::view_helper('party');

		if ( $this->party_key = request::get('key') )
		{
			$this->party = parties_peer::instance()->get_item($this->party_key);
		}

		if ( $this->party && request::get('submit') )
		{
			parties_peer::instance()->update( array(
				'id' => $this->party['id'],
				'rate' => request::get('rate')
			));

			$this->party = parties_peer::instance()->get_item($this->party['id']);
			$this->saved = true;
		}
	}
}
