<?

load::app('modules/parties/controller');
class parties_talk_message_delete_action extends parties_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		if ( !$this->message = parties_topics_messages_peer::instance()->get_item(request::get_int('id')) )
		{
			exit;
		}

		if ( $this->message['user_id'] != session::get_user_id() )
		{
			if ( !$this->topic = parties_topics_peer::instance()->get_item($this->message['topic_id']) )
			{
				exit;
			}
			
			if ( !parties_peer::instance()->is_moderator($this->topic['party_id'], session::get_user_id()) )
			{
				exit;
			}
		}

		parties_topics_messages_peer::instance()->delete_item($this->message['id']);

		$this->set_renderer('ajax');
		$this->json = array();
	}
}