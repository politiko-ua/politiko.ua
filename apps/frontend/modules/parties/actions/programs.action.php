<?

load::app('modules/parties/controller');
class parties_programs_action extends parties_controller
{
	public function execute()
	{
		if ( $this->segment = trim(request::get('segment')) )
		{
			$this->list = parties_program_peer::instance()->get_by_segment($this->segment);

			$this->pager = pager_helper::get_pager($this->list, request::get_int('page'), 5);
			$this->list = $this->pager->get_list();
		}
	}
}