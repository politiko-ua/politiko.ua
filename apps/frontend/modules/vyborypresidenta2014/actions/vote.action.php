<?

load::app('modules/vyborypresidenta2014/controller');
class vyborypresidenta2014_vote_action extends vyborypresidenta2014_controller
{
	#protected $authorized_access = true;

	public function execute()
	{
		$this->disable_layout();

		$this->id = request::get_int('id');
		$this->user = user_data_peer::instance()->get_item($this->id);

                
	}        
}
