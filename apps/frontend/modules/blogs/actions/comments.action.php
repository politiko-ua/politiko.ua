<?

load::app('modules/blogs/controller');
class blogs_comments_action extends blogs_controller
{
	public function execute()
	{
		load::view_helper('tag', true);

		tag_helper::$rss = 'https://' . context::get('host') . '/blogs/rss?type=comments';

		$this->list = blogs_comments_peer::instance()->get_list(array(), array(), array('id DESC'), 500);

		$this->pager = pager_helper::get_pager($this->list, request::get_int('page'), 10);
		$this->list = $this->pager->get_list();
	}
}
