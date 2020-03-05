<?

load::app('modules/groups/controller');
class groups_newsread_action extends groups_controller
{
	public function execute()
	{
		$this->item = groups_news_peer::instance()->get_item(request::get_int('id'));
		if ( !$this->item ) $this->redirect('/');

		$this->group = groups_peer::instance()->get_item( $this->item['group_id'] );
	}
}