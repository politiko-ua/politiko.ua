<?

abstract class parties_controller extends frontend_controller
{
	public function init()
	{
		parent::init();

		load::model('parties/parties');
		load::model('parties/members');
		load::model('parties/program');
		load::model('parties/news');
		load::model('parties/topics');
		load::model('parties/topics_messages');

		load::model('political_views');
		load::model('ideas/ideas');

		load::action_helper('pager', true);
		load::view_helper('party');

		$this->set_slot('context', 'partials/about');

		client_helper::set_title( t('Партии') . ' | ' . conf::get('project_name') );
	}

	public function post_action()
	{
		parent::post_action();

		$this->directions = parties_peer::instance()->get_directions_cloud();

		$this->selected_menu = '/parties';
	}
}
