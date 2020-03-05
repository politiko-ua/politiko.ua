<?

load::app('modules/admin/controller');
class admin_mfeed_action extends admin_controller
{
	public function execute()
	{
		$this->page = max((int)$_GET['page'], 1);

		load::model('admin_feed');
		$this->feed = admin_feed_peer::instance()->get($this->page);

		$this->types = array(
			admin_feed_peer::TYPE_BLOG_COMMENT => 'Комментарий к блогу',
			admin_feed_peer::TYPE_BLOG_POST => 'Пост в блоге',
			admin_feed_peer::TYPE_DEBATE_COMMENT => 'Комментарий к дебатам',
			admin_feed_peer::TYPE_DEBATE => 'Дебаты',
		);
	}
}
