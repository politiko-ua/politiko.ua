<?

class user_log_peer extends db_peer_postgre
{
	protected $table_name = 'user_log';
	protected $primary_key = null;

	/**
	 * @return user_log_peer
	 */
	public static function instance()
	{
		return parent::instance( 'user_log_peer' );
	}

	public function get_by_user( $user_id )
	{
		return db::get_cols( 'SELECT ip FROM ' . $this->table_name . ' WHERE user_id = :user_id ORDER BY ts DESC ', array('user_id' => $user_id), $this->connection_name );
	}
}
