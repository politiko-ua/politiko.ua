<?

load::app('modules/parties/controller');
class parties_index_action extends parties_controller
{
	public function execute()
	{
		$this->sort = request::get('sort');
		if ( $this->sort != 'rating' )
		{
			$this->sort = 'popularity';
		}

		if ( $this->direction = trim(request::get('direction')) )
		{
			$this->list = parties_peer::instance()->get_by_direction($this->direction, $this->sort);
		}
		else
		{
			$this->list = parties_peer::instance()->get_sorted_list($this->sort);
		}

		$this->pager = pager_helper::get_pager($this->list, request::get_int('page'), 10);
		$this->list = $this->pager->get_list();

                load::model('parties/news');

                $parties_news = parties_news_peer::instance()->get_new();
                $this->news = array_slice($parties_news, 0, 5);
	}
}
