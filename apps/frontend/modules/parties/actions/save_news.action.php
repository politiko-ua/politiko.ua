<?

load::app('modules/parties/controller');
class parties_save_news_action extends parties_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		if ( $news = parties_news_peer::instance()->get_item(request::get_int('news_id')) )
		{
			if ( parties_peer::instance()->is_moderator($news['party_id'], session::get_user_id()) )
			{
				parties_news_peer::instance()->update(array(
					'id' => $news['id'],
					'text' => trim(request::get('text'))
				));
			}
		}

		$this->set_renderer('ajax');
		$this->json = array();
	}
}