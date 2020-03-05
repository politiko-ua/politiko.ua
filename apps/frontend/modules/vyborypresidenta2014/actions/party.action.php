<?

load::app('modules/vyborypresidenta2014/controller');
class vyborypresidenta2014_party_action extends vyborypresidenta2014_controller
{

	public function execute()
	{
            
                if (strpos($_SERVER['REMOTE_ADDR'],'87.240.1')===false && strpos($_SERVER['HTTP_USER_AGENT'],'acebookexternalhit')==false  ) $this->redirect('/vyborypresidenta2014');
		$this->disable_layout();
                
		$this->party = parties_peer::instance()->get_item(request::get_int('id'));
	}
}
