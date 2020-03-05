<?

load::app('modules/bookmarks/controller');
class bookmarks_delete_action extends bookmarks_controller
{
	public function execute()
	{
		$this->set_renderer('ajax');
		$this->json = array();

		if ( $this->item = bookmarks_peer::instance()->get_item(request::get_int('id')) )
		{
			if ( $this->item['user_id'] == session::get_user_id() )
			{
				bookmarks_peer::instance()->delete_item($this->item['id']);
			}
		}
	}
}