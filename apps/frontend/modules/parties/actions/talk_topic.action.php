<?

load::app('modules/parties/controller');
class parties_talk_topic_action extends parties_controller
{
	public function execute()
	{
		if ( !$this->topic = parties_topics_peer::instance()->get_item(request::get_int('id')) )
		{
			$this->redirect('/parties');
		}

		$this->party = parties_peer::instance()->get_item($this->topic['party_id']);
		$this->list = parties_topics_messages_peer::instance()->get_by_topic($this->topic['id']);

		$this->pager = pager_helper::get_pager($this->list, request::get_int('page'), 10);
		if ( request::get('last') && ( $this->pager->get_page() < $this->pager->get_pages() ) )
		{
			$this->redirect('talk_topic?id=' . $this->topic['id'] . '&page=' . $this->pager->get_pages());
		}

		$this->list = $this->pager->get_list();

		client_helper::register_variable('l_confirm', t('Вы уверены?'));
	}
}