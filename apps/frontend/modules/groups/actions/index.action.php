<?

load::app('modules/groups/controller');
class groups_index_action extends groups_controller
{
	public function execute()
	{
		$this->hot = groups_peer::instance()->get_hot(
			$this->cur_type = request::get_int('type'),
			$this->cur_teritory = request::get_int('teritory')
		);

		load::action_helper('pager');
		$this->pager = pager_helper::get_pager($this->hot, request::get_int('page'), 10);
		$this->hot = $this->pager->get_list();
	}
}