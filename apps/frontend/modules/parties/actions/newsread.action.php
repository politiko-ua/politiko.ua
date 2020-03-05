<?

load::app('modules/parties/controller');
class parties_newsread_action extends parties_controller
{
	public function execute()
	{
		$this->item = parties_news_peer::instance()->get_item(request::get_int('id'));
		if ( !$this->item ) $this->redirect('/');

		$this->party = parties_peer::instance()->get_item( $this->item['party_id'] );

		client_helper::set_title( $this->party['title'] . ' | ' . conf::get('project_name') );
	}
}
