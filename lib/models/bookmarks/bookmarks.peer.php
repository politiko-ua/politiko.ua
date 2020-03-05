<?

class bookmarks_peer extends db_peer_postgre
{
	protected $table_name = 'bookmarks';

	const TYPE_BLOG_POST = 1;

	/**
	 * @return bookmarks_peer
	 */
	public static function instance()
	{
		return parent::instance( 'bookmarks_peer' );
	}

	public function add( $user_id, $type, $oid )
	{
		$this->insert(array(
			'user_id' => $user_id,
			'type' => $type,
			'oid' => $oid
		));

		mem_cache::i()->delete('user_bookmarks:' . $user_id);
	}

	public function get_by_user( $user_id )
	{
		$sql = 'SELECT type, oid, id FROM ' . $this->table_name . ' WHERE user_id = :user_id ORDER BY id DESC';
		return db::get_rows($sql, array('user_id' => $user_id), $this->connection_name, 'user_bookmarks:' . $user_id);
	}

	public function is_bookmarked( $user_id, $type, $oid )
	{
		if ( $list = $this->get_by_user($user_id) )
		{
			foreach ( $list as $row )
			{
				if ( ($row['type'] == $type) && ($row['oid'] == $oid) )
				{
					return true;
				}
			}
		}

		return false;
	}

	public function get_by_object( $type, $id )
	{
		$sql = 'SELECT user_id FROM ' . $this->table_name . ' WHERE type = :type AND oid = :oid';
		return db::get_cols($sql, array('type' => $type, 'oid' => $id), $this->connection_name);
	}

	public function delete_item( $id )
	{
		$data = $this->get_item($id);
		mem_cache::i()->delete('user_bookmarks:' . $data['user_id']);

		parent::delete_item($id);
	}
}