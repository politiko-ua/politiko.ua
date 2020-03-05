<?

load::app('modules/blogs/controller');
class blogs_valuable_action extends blogs_controller
{
	protected $authorized_access = true;
	protected $credentials = array('moderator');

	public function execute()
	{
		if ( request::get_int('id') )
		{
			$this->post_data = blogs_posts_peer::instance()->get_item( request::get_int('id') );

			blogs_posts_peer::instance()->update(array(
				'id' => $this->post_data['id'],
				'public' => true
			));

			if ( session::has_credential('moderator') && request::get('promote') )
				blogs_posts_peer::instance()->promote($this->post_data['id']);

			$this->redirect('/blogs');
		}
	}
}
