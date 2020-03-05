<?

load::app('modules/admin/controller');
class admin_save_user_action extends admin_controller
{
	public function execute()
	{
		user_auth_peer::instance()->update(array(
			'id' => request::get_int('user_id'),
			'credentials' => implode(',', (array)request::get('credentials'))
		));

		$this->redirect($_SERVER['HTTP_REFERER']);
	}
}