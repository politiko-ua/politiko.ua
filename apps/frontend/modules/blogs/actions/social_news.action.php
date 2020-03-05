<?

load::app('modules/blogs/controller');
class blogs_social_news_action extends blogs_controller
{
	public function execute()
	{
		$list = $this->load_news();

		$this->pager = pager_helper::get_pager($list, request::get_int('page'), 8);
		$this->list = $this->pager->get_list();
	}

	protected function load_news()
	{
		load::model('parties/parties');
		load::model('parties/news');

		$parties_news = parties_news_peer::instance()->get_new();
		$parties_news = array_slice($parties_news, 0, 50);

		$list = array();
		foreach ( $parties_news as $id )
		{
			$data = parties_news_peer::instance()->get_item( $id );
			$list[$data['created_ts']] = $data;
		}

		load::model('groups/groups');
		load::model('groups/news');

		$groups_news = groups_news_peer::instance()->get_new();
		$groups_news = array_slice($groups_news, 0, 50);

		foreach ( $groups_news as $id )
		{
			$data = groups_news_peer::instance()->get_item( $id );
			$list[$data['created_ts']] = $data;
		}

		krsort($list);

		return $list;
	}
}
