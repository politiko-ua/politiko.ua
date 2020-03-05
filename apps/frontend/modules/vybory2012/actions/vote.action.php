<?

load::app('modules/vybory2012/controller');
class vybory2012_vote_action extends vybory2012_controller
{
	#protected $authorized_access = true;

	public function execute()
	{
		$this->disable_layout();

		$this->id = request::get_int('id');
		$this->party = parties_peer::instance()->get_item($this->id);

                
	}        
}
