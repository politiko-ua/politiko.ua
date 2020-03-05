<?

load::app('modules/ideas/controller');
class ideas_view_action extends ideas_controller
{
	public function execute()
	{
		if ( !$this->idea = ideas_peer::instance()->get_item(request::get_int('id')) )
		{
			$this->redirect('/ideas');
		}

		$this->comments = ideas_comments_peer::instance()->get_by_idea( $this->idea['id'] );
	}
}