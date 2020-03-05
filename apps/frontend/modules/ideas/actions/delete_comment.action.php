<?

load::app('modules/ideas/controller');
class ideas_delete_comment_action extends ideas_controller
{
	protected $authorized_access = true;
	protected $credentials = array('moderator');

	public function execute()
	{
		$this->set_renderer('ajax');
		$this->json = array();

		if ( request::get_int('id') )
		{
			ideas_comments_peer::instance()->delete_item( request::get_int('id') );
		}
	}
}