<?

class blogs_mentions_peer extends db_peer_postgre
{
	protected $primary_key = null;
	protected $table_name = 'blogs_mentions';

	/**
	 * @return blogs_mentions_peer
	 */
	public static function instance()
	{
		return parent::instance( 'blogs_mentions_peer' );
	}

	public function get_by_post( $id )
	{
		$sql = 'SELECT user_id FROM ' . $this->table_name . ' WHERE post_id = :post_id';
		return db::get_cols($sql, array('post_id' => $id), $this->connection_name);
	}

	public function save_mentions( $post_id, array $users )
	{
		$sql = 'DELETE FROM ' . $this->table_name . ' WHERE post_id = :post_id';
		db::exec($sql, array('post_id' => $post_id), $this->connection_name);

		foreach ( $users as $user_id )
		{
			$this->insert(array('post_id' => $post_id, 'user_id' => $user_id));
		}
	}

	public function get_hot()
	{
		$sql = 'SELECT b.user_id, count(b.post_id) AS total
				FROM ' . $this->table_name . ' AS b
				JOIN ' . blogs_posts_peer::instance()->get_table_name() . ' AS p ON (b.post_id = p.id AND p.created_ts > :ts)
				GROUP BY b.user_id
				ORDER BY total DESC
				LIMIT 3';

		return db::get_rows($sql, array('ts' => time() - 60*60*24*30), $this->connection_name, array('hot-mentions', 60*60*12) );
	}

	public function get_history( $user_id )
	{
		$sql = 'SELECT count(b.post_id) AS total, MAX(p.created_ts) AS created_ts, DATE(TIMESTAMP \'epoch\' + created_ts * INTERVAL \'1 second\') as doy
				FROM ' . $this->table_name . ' AS b
				JOIN ' . blogs_posts_peer::instance()->get_table_name() . ' AS p ON (b.post_id = p.id )
				WHERE b.user_id = :user_id
				GROUP BY doy
				ORDER BY created_ts DESC
				LIMIT 30';

		return db::get_rows($sql, array('user_id' => $user_id), $this->connection_name, array('mention-history' . $user_id, 60*60*12) );
	}
}
