<?

load::app('modules/parties/controller');
class parties_delete_news_action extends parties_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		if ( $news = parties_news_peer::instance()->get_item(request::get_int('id')) )
		{
			if ( parties_peer::instance()->is_moderator($news['party_id'], session::get_user_id()) )
			{
				parties_news_peer::instance()->delete_item(request::get_int('id'));
			}
		}

		$this->set_renderer('ajax');
		$this->json = array();
	}
}