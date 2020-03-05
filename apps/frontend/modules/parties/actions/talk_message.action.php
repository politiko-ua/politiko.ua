<?

load::app('modules/parties/controller');
class parties_talk_message_action extends parties_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		if ( !$this->topic = parties_topics_peer::instance()->get_item(request::get_int('id')) )
		{
			exit;
		}

		if ( $text = trim(request::get('text')) )
		{
			parties_topics_messages_peer::instance()->insert(array(
				'topic_id' => $this->topic['id'],
				'user_id' => session::get_user_id(),
				'created_ts' => time(),
				'text' => $text
			));

			parties_topics_peer::instance()->update(array(
				'id' => $this->topic['id'],
				'messages_count' => $this->topic['messages_count'] + 1,
				'last_user_id' => session::get_user_id(),
				'updated_ts' => time()
			));
		}

		$this->set_renderer('ajax');
		$this->json = array('id' => $this->topic['id']);
	}
}