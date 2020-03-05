<?

load::app('modules/m2010/controller');
class m2010_index_action extends m2010_controller
{
	public function execute()
	{
		$this->list = candidates_peer::instance()->get_list();
	}
}
