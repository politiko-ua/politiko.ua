<?

load::app('modules/ideas/controller');
class ideas_create_action extends ideas_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->user_data = user_data_peer::instance()->get_item( session::get_user_id() );
		$this->allow_create = ( $this->user_data['rate'] >= 5 ) || session::has_credential('editor');

		if ( request::get('submit') && trim(request::get('text')) && trim(request::get('title')) )
		{
			$data = array(
				'created_ts' => time(),
				'user_id' => session::get_user_id(),
				'text' => trim(request::get('text')),
				'title' => trim(request::get('title')),
				'segment' => request::get_int('segment')
			);
			
			$idea_id = ideas_peer::instance()->insert($data);

			load::model('feed/feed');
			load::view_helper('tag', true);

			ob_start();
			include dirname(__FILE__) . '/../../feed/views/partials/items/idea.php';
			$feed_html = ob_get_clean();

			$readers = friends_peer::instance()->get_by_user(session::get_user_id());
			feed_peer::instance()->add(session::get_user_id(), $readers, array(
				'actor' => session::get_user_id(),
				'text' => $feed_html,
				'action' => feed_peer::ACTION_IDEA,
				'section' => feed_peer::SECTION_PERSONAL,
			));

			$this->set_renderer('ajax');
			$this->json = array();
		}
	}
}