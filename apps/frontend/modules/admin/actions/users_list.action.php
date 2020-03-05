<?

load::app('modules/admin/controller');
class admin_users_list_action extends admin_controller
{
	public function execute()
	{
		$where = array();
		if ( request::get('ip') )
		{
			$where['ip'] = request::get('ip');
		}

		$this->list = user_auth_peer::instance()->get_list($where, array(), array('id DESC'), 2500);

		load::action_helper('pager');
		$this->pager = pager_helper::get_pager($this->list, request::get_int('page'), 25);
		$this->list = $this->pager->get_list();
	}
}
