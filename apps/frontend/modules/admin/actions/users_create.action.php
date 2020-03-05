<?

load::app('modules/admin/controller');
class admin_users_create_action extends admin_controller
{
	public function execute()
	{
		if ( request::get('submit') )
		{
			$first_name = trim(request::get('first_name'));
			$last_name = trim(request::get('last_name'));
			$type = request::get_int('type');
			$email = trim(request::get('email'));
			$password = trim(request::get('password'), substr(md5(microtime(true)), 0, 8));

			if ( $type && $first_name && $last_name )
			{
				$id = user_auth_peer::instance()->insert(
					$email,
					$password,
					$type,
					true
				);
				$user = user_auth_peer::instance()->get_item($id);

				load::model('user/user_data');
				user_data_peer::instance()->insert(array(
					'user_id' => $user['id'],
					'first_name' => $first_name,
					'last_name' => $last_name,
					'political_views' => 6,
					'gender' => request::get('gender', 'm')
				));

				$this->redirect('/admin/users?key=' . $user['id']);
			}
		}
	}
}
