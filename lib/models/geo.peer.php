<?

class geo_peer extends db_peer_postgre
{
	protected $table_name = 'cities';

	/**
	 * @return geo_peer
	 */
	public static function instance()
	{
		return parent::instance( 'geo_peer' );
	}

	public function insert_region($data)
	{
		foreach ( $data as $key => $value )
		{
			$values_sql[] = "\"{$key}\"";
			$insert_sql[] = "'{$value}'";
		}

		return db::get_scalar('INSERT INTO regions(' . implode(',', $values_sql) . ') VALUES(' . implode(',', $insert_sql) . ') RETURNING id');
	}

	public function get_region( $id )
	{
		$cache_key = 'region.' . $id;
		if ( !mem_cache::i()->exists($cache_key) )
		{
			$sql = 'SELECT * FROM regions WHERE id = :id LIMIT 1';
			$bind = array('id' => $id);
			$data = db::get_row( $sql, $bind, $this->connection_name );
			mem_cache::i()->set($cache_key, $data);
		}
		else
		{
			$data = mem_cache::i()->get($cache_key);
		}

		return $data;
	}

	public function get_city( $id )
	{
		$city = geo_peer::instance()->get_item($id);
		$region = geo_peer::instance()->get_region($city['region_id']);

		$city['region_name_ru'] = $region['name_ru'];
		$city['region_name_ua'] = $region['name_ua'];

		return $city;
	}

	public function insert_city($data)
	{
		parent::insert($data);
	}

	public function get_by_key( $key )
	{
		$sql = 'SELECT DISTINCT id FROM ' . $this->table_name . ' WHERE name_ru ILIKE :key OR name_ua ILIKE :key LIMIT 10';
		return db::get_cols($sql, array('key' => $key . '%'), $this->connection_name);
	}
}