<?

load::app('modules/parties/controller');
class parties_new_action extends parties_controller
{
	public function execute()
	{
		$this->list = parties_peer::instance()->get_new();

		$this->pager = pager_helper::get_pager($this->list, request::get_int('page'), 10);
		$this->list = $this->pager->get_list();
	}
}