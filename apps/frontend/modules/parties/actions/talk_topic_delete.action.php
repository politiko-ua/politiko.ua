<?

load::app('modules/parties/controller');
class parties_talk_topic_delete_action extends parties_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		if ( !$this->topic = parties_topics_peer::instance()->get_item(request::get_int('id')) )
		{
			exit;
		}

		if ( ( $this->topic['user_id'] != session::get_user_id() ) && !parties_peer::instance()->is_moderator($this->topic['party_id'], session::get_user_id()) )
		{
			exit;
		}

		parties_topics_peer::instance()->delete_item($this->topic['id']);

		$this->redirect('/parties/talk?id=' . $this->topic['party_id']);
	}
}