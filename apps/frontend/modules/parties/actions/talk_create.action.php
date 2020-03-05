<?

load::app('modules/parties/controller');
class parties_talk_create_action extends parties_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->party = parties_peer::instance()->get_item(request::get_int('id'));

		if ( ( $topic = trim(request::get('topic')) ) && ( $text = trim(request::get('text')) ) )
		{
			$id = parties_topics_peer::instance()->insert(array(
				'party_id' => $this->party['id'],
				'topic' => $topic,
				'created_ts' => time(),
				'messages_count' => 1,
				'last_user_id' => session::get_user_id(),
				'updated_ts' => time()
			));

			parties_topics_messages_peer::instance()->insert(array(
				'topic_id' => $id,
				'user_id' => session::get_user_id(),
				'created_ts' => time(),
				'text' => $text
			));

			load::model('feed/feed');
			load::view_helper('tag', true);
			load::view_helper('party');

			$party = $this->party;
			ob_start();
			include dirname(__FILE__) . '/../../feed/views/partials/items/party_forum_post.php';
			$feed_html = ob_get_clean();

			load::model('parties/members');
			$readers = parties_members_peer::instance()->get_by_party($this->party['id']);
			$readers = array_diff($readers, array(session::get_user_id()));
			feed_peer::instance()->add(session::get_user_id(), $readers, array(
				'actor' => session::get_user_id(),
				'text' => $feed_html,
				'action' => feed_peer::ACTION_PARTY_FORUM_POST,
				'section' => feed_peer::SECTION_PERSONAL,
			));
		}

		$this->set_renderer('ajax');
		$this->json = array('id' => $id);
	}
}