<?

class user_data_peer extends db_peer_postgre
{
	protected $table_name = 'user_data';
	protected $primary_key = 'user_id';

	/**
	 * @return user_data_peer
	 */
	public static function instance()
	{
		return parent::instance( 'user_data_peer' );
	}

	public static function get_contact_types()
	{
		return array(
			1 => 'Вконтакте.ru',
			2 => 'Однокласники.ru',
			3 => 'Facebook.com',
			4 => 'Twitter.com',
			5 => 'Linkedin.com',
			6 => 'Блог',
			7 => 'ICQ',
			8 => 'Skype',
			9 => 'Profeo',
			10 => 'Connect.ua',
		);
	}

	public static function get_contact_type( $id )
	{
		$list = self::get_contact_types();
		return $list[$id];
	}

	public function regenerate_photo_salt( $id )
	{
		$salt = substr(md5(microtime(true)), 0, 8);

		$this->update(array('photo_salt' => $salt, 'user_id' => $id));
		return $salt;
	}

	public function has_trusted( $profile_id, $user_id )
	{
		return db_key::i()->exists('profile_trust:' . $profile_id . ':' . $user_id);
	}

	public function my_trust( $profile_id, $user_id )
	{
		return db_key::i()->get('profile_trust:' . $profile_id . ':' . $user_id) == 1;
	}

	public function trust( $profile_id, $user_id, $trust = true )
	{
		db_key::i()->set('profile_trust:' . $profile_id . ':' . $user_id, $trust);
	}

	public function get_views_cloud()
	{
		$sql = 'SELECT political_views, count(user_id) as total FROM ' . $this->table_name . ' GROUP BY political_views LIMIT 10';
		$list = db::get_rows($sql, array(), $this->connection_name);
		return tags_helper::normalize($list, 'total');
	}

	public function update_rate( $owner_id, $value, $user_id = null )
	{
		if ( !$data = $this->get_item($owner_id) )
		{
			return;
		}

		if ( $user_id )
		{
			$value = $value * $this->get_rate_multiplier($user_id);
		}

		$this->update(array(
			'user_id' => $owner_id,
			'rate' => $data['rate'] + $value
		));
	}

	public function get_rate_multiplier( $user_id )
	{
		$actor_data = $this->get_item($user_id);

		if ( $actor_data['rate'] < 10 )
		{
			$multiplier = 0.01;
		}
		else if ( $actor_data['rate'] < 100 )
		{
			$multiplier = 0.3;
		}
		else if ( $actor_data['rate'] < 300 )
		{
			$multiplier = 0.5;
		}
		else
		{
			$multiplier = 1;
		}

		return $multiplier;
	}

	public function search( $keyword, $limit = 5 )
	{
		$keyword = str_replace(' ', ' & ', $keyword);
		$sql = 'SELECT ' . $this->primary_key . ' FROM ' . $this->table_name . ' WHERE fti @@ to_tsquery(\'russian\', :keyword) LIMIT :limit;';
		return db::get_cols($sql, array('keyword' => $keyword, 'limit' => $limit), $this->connection_name);
	}

	public function get_by_name( $keyword, $limit = 10 )
	{
		$keyword = mb_strtolower($keyword);

		$sql = 'SELECT ' . $this->primary_key . ' FROM ' . $this->table_name . '
				WHERE lower(first_name) LIKE :keyword OR lower(last_name) LIKE :keyword
				LIMIT :limit';

		return db::get_cols($sql, array('keyword' => $keyword . '%', 'limit' => $limit), $this->connection_name);
	}

	public function reindex( $id )
	{
		$index_columns = array('first_name', 'last_name');
		$index_expr = 'coalesce(' . implode(',\'\') ||\' \'|| coalesce(', $index_columns) . ',\'\')';

		db::exec(
			'UPDATE ' . $this->table_name . ' SET fti = to_tsvector(\'russian\', ' . $index_expr . ') WHERE ' . $this->primary_key . ' = :id',
			array('id' => $id)
		);
	}

	public function update( $data, $keys = null )
	{
		parent::update($data, $keys);
		$this->reindex($data[$this->primary_key]);
	}

	public function insert($data, $ignore_duplicate = false)
	{
		$id = parent::insert($data, $ignore_duplicate);
		$this->reindex($id);

		return $id;
	}
}
