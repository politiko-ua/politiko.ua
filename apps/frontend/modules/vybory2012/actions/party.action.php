<?

load::app('modules/vybory2012/controller');
class vybory2012_party_action extends vybory2012_controller
{

	public function execute()
	{
            
                if (strpos($_SERVER['REMOTE_ADDR'],'87.240.1')===false && strpos($_SERVER['HTTP_USER_AGENT'],'acebookexternalhit')==false  ) $this->redirect('/vybory2012');
		$this->disable_layout();
                
		$this->party = parties_peer::instance()->get_item(request::get_int('id'));
	}
}
