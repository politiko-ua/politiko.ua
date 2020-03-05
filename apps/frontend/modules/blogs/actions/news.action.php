<?

load::app('modules/blogs/controller');
class blogs_news_action extends blogs_controller
{
	public function execute()
	{
		load::view_helper('tag', true);

		$this->list = blogs_posts_peer::instance()->get_newest( blogs_posts_peer::TYPE_NEWS_POST );
		tag_helper::$rss = 'https://' . context::get('host') . '/blogs/rss?type=news';

		$this->pager = pager_helper::get_pager($this->list, request::get_int('page'), 8);
		$this->list = $this->pager->get_list();
	}
}
