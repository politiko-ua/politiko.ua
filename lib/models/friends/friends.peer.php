<?

class friends_peer extends db_peer_postgre
{
	protected $table_name = 'friends';

	/**
	 * @return friends_peer
	 */
	public static function instance()
	{
		return parent::instance( 'friends_peer' );
	}

	public function get_by_user( $user_id )
	{
		$sql = 'SELECT friend_id FROM ' . $this->table_name . ' WHERE user_id = :user_id';
		return db::get_cols($sql, array('user_id' => $user_id), $this->connection_name);
	}

	public function delete( $user_id, $friend_id )
	{
		$sql = 'DELETE FROM ' . $this->table_name . '
				WHERE (user_id = :user_id AND friend_id = :friend_id) OR
					  (user_id = :friend_id AND friend_id = :user_id)';
		db::exec($sql, array('user_id' => $user_id, 'friend_id' => $friend_id), $this->connection_name);
	}

	public function is_friend( $user_id, $friend_id )
	{
		$list = $this->get_by_user($user_id);
		return in_array($friend_id, $list);
	}

	public function delete_by_user( $user_id )
	{
		$sql = 'DELETE FROM ' . $this->table_name . '
				WHERE user_id = :user_id OR friend_id = :user_id';
		
		db::exec($sql, array('user_id' => $user_id), $this->connection_name);
	}
}