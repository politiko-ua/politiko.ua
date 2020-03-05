<?

load::app('modules/polls/controller');
class polls_view_action extends polls_controller
{
	protected $authorized_access = true;

	public function execute()
	{
		$this->poll_id = request::get_int('id');
		if ( !$this->poll = polls_peer::instance()->get_item(request::get_int('id')) )
		{
			$this->redirect('/polls');
		}

		if ( $this->poll['is_custom'] )
		{
			$this->custom_list = polls_custom_peer::instance()->get_by_poll( $this->poll_id );
		}

		load::model('polls/comments');
		$this->comments = polls_comments_peer::instance()->get_by_poll( $this->poll_id );

		client_helper::set_title($this->poll['question']);
	}
}