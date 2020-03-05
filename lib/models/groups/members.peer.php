<?

class groups_members_peer extends db_peer_postgre
{
	protected $table_name = 'groups_members';
	protected $primary_key = null;

	/**
	 * @return groups_members_peer
	 */
	public static function instance()
	{
		return parent::instance( 'groups_members_peer' );
	}

	public function add( $group_id, $user_id )
	{
		$this->insert(array('group_id' => $group_id, 'user_id' => $user_id));
	}

	public function remove( $group_id, $user_id )
	{
		$sql = 'DELETE FROM ' . $this->table_name . ' WHERE group_id = :group_id AND user_id = :user_id';
		return db::exec($sql, array('group_id' => $group_id, 'user_id' => $user_id), $this->connection_name);
	}

	public function get_members( $group_id )
	{
		$sql = 'SELECT user_id FROM ' . $this->table_name . ' WHERE group_id = :group_id';
		return db::get_cols($sql, array('group_id' => $group_id), $this->connection_name);
	}

	public function is_member( $group_id, $user_id )
	{
		return in_array($user_id, $this->get_members($group_id));
	}

	public function get_groups( $user_id )
	{
		$sql = 'SELECT group_id FROM ' . $this->table_name . ' WHERE user_id = :user_id';
		return db::get_cols($sql, array('user_id' => $user_id), $this->connection_name);
	}
}