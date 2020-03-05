<?

class people_index_action extends frontend_controller
{
	public function execute()
	{
		$this->cur_type = request::get_int('type', 4);

		if ( $this->cur_type == user_auth_peer::TYPE_POLITIC )
		{
			$this->sort = request::get('sort');
			if ( $this->sort != 'rating' )
			{
				$order = 'u.trust DESC';
				$this->sort = 'popularity';
			}
			else
			{
				$order = 'u.rate DESC';
			}
		}

		$this->list = user_auth_peer::instance()->get_by_type( $this->cur_type, $order );

		load::action_helper('pager');
		$this->pager = pager_helper::get_pager($this->list, request::get_int('page'), 10);
		$this->list = $this->pager->get_list();

		load::model('parties/members');
		load::model('parties/parties');

		$this->selected_menu = '/people';

		client_helper::set_title( t('Люди') . ' | ' . conf::get('project_name') );
	}
}