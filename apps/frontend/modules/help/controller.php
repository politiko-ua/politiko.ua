<?

abstract class ideas_controller extends frontend_controller
{
	public function init()
	{
		parent::init();
		
		load::model('ideas/ideas');

		load::action_helper('pager', true);
	}

	public function post_action()
	{
		parent::post_action();

		$this->selected_menu = '/ideas';

		$this->segments = ideas_peer::instance()->get_segments_cloud();

		$this->new = ideas_peer::instance()->get_new();

		load::model('user/user_data');
		load::view_helper('user');
	}
}
