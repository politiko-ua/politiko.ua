<?

load::app('modules/bookmarks/controller');
class bookmarks_index_action extends bookmarks_controller
{
	public function execute()
	{
		$this->list = bookmarks_peer::instance()->get_by_user(session::get_user_id());
	}
}