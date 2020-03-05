<?

load::app('modules/messages/controller');
class messages_index_action extends messages_controller
{
	public function execute()
	{
		$this->list = (array)messages_peer::instance()->get_by_user( session::get_user_id() );

		load::action_helper('pager', true);
		$this->pager = pager_helper::get_pager($this->list, request::get_int('page'), 10);
		$this->list = $this->pager->get_list();
	}
}