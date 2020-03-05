<?

load::app('modules/parties/controller');
class parties_talk_action extends parties_controller
{
	public function execute()
	{
		$this->party = parties_peer::instance()->get_item(request::get_int('id'));
		$this->filter = request::get('filter');

		client_helper::set_title( t('Обсуждения партии') . ' ' . $this->party['title'] . ' | ' . conf::get('project_name'));

		$sort = array('id DESC');
		if ( $this->filter == 'hot' )
		{
			$sort = array('messages_count DESC');
		}

		$this->list = parties_topics_peer::instance()->get_by_party($this->party['id'], $sort);

		$this->pager = pager_helper::get_pager($this->list, request::get_int('page'), 10);
		$this->list = $this->pager->get_list();
	}
}