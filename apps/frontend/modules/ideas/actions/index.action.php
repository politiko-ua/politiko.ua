<?

load::app('modules/ideas/controller');
class ideas_index_action extends ideas_controller
{
	public function execute()
	{
		if ( $this->segment = trim(request::get('segment')) )
		{
			$this->list = ideas_peer::instance()->get_by_segment($this->segment);
		}
		else
		{
			$this->list = ideas_peer::instance()->get_new();
		}

		$this->pager = pager_helper::get_pager($this->list, request::get_int('page'), 10);
		$this->list = $this->pager->get_list();
	}
}