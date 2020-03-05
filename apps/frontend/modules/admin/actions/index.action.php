<?

load::app('modules/admin/controller');
class admin_index_action extends admin_controller
{
	public function execute()
	{
		$this->stats = array(
			'Пользователей' => db::get_scalar('SELECT count(id) FROM user_auth'),
			# 'Личных сообщений' => db::get_scalar('SELECT count(id) FROM messages'),
			'Постов в блогах' => db::get_scalar('SELECT count(id) FROM blogs_posts'),
			'Дебатов' => db::get_scalar('SELECT count(id) FROM debates'),
			'Опросов' => db::get_scalar('SELECT count(id) FROM polls'),
			'Идей' => db::get_scalar('SELECT count(id) FROM ideas'),
			'Партий' => db::get_scalar('SELECT count(id) FROM parties'),
			'Группы' => db::get_scalar('SELECT count(id) FROM groups'),
			# 'Обновлений' => db::get_scalar('SELECT count(id) FROM feed'),
		);
		$this->subStats = array(
			'Партий' => db::get_scalar("SELECT count(id) FROM parties WHERE state = 'new'"),
		);
	}
}
