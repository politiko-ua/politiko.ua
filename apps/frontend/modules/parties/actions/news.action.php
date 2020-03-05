<?

load::app('modules/parties/controller');
class parties_news_action extends parties_controller
{
	public function execute()
	{
		$this->party = parties_peer::instance()->get_item(request::get_int('id'));
		$this->list = parties_news_peer::instance()->get_by_party($this->party['id']);

		client_helper::set_title( t('Новости партии') . ' ' . $this->party['title'] . ' | ' . conf::get('project_name'));

		$this->pager = pager_helper::get_pager($this->list, request::get_int('page'), 10);
		$this->list = $this->pager->get_list();
	}
}