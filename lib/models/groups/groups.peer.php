<?

class groups_peer extends db_peer_postgre
{
	const PRIVACY_PUBLIC = 1;
	const PRIVACY_PRIVATE = 2;

	protected $table_name = 'groups';

	/**
	 * @return groups_peer
	 */
	public static function instance()
	{
		return parent::instance( 'groups_peer' );
	}

	public static function get_types()
	{
		return array(
			1 => t('Общественная организация'),
			2 => t('Молодежная организация'),
			3 => t('Профсоюз'),
			4 => t('Благотворительная организация'),
			5 => t('Фонд'),
			6 => t('Группа по интересам')
		);
	}

	public static function get_type( $id )
	{
		$types = self::get_types();
		return $types[$id];
	}

	public static function get_teritories()
	{
		return array(
			1 => t('Всеукраинская'),
			2 => t('Обласная'),
			3 => t('Районная в области'),
			4 => t('Городская'),
			5 => t('Районная в городе'),
			6 => t('Сельская')
		);
	}

	public static function get_teritory( $id )
	{
		$teritories = self::get_teritories();
		return $teritories[$id];
	}

	public function regenerate_photo_salt( $id )
	{
		$salt = substr(md5(microtime(true)), 0, 8);

		$this->update(array('photo_salt' => $salt, 'id' => $id));
		return $salt;
	}

	public function get_new( $limit = 500 )
	{
		return $this->get_list(array(), array(), array('ID DESC'), $limit);
	}

	public function get_hot( $type = null, $teritory = null, $limit = 500 )
	{
		$where = array();
		if ( $type )
		{
			$where['type'] = $type;
		}

		if ( $teritory )
		{
			$where['teritory'] = $teritory;
		}

		return $this->get_list($where, array(), array('rate DESC'), $limit);
	}

	public function update_rate( $id, $value, $user_id = null )
	{
		if ( !$data = $this->get_item($id) )
		{
			return;
		}

		if ( $user_id )
		{
			$value = $value * user_data_peer::instance()->get_rate_multiplier($user_id);
		}

		$this->update(array(
			'id' => $id,
			'rate' => $data['rate'] + $value
		));
	}

	public function search( $keyword, $limit = 5 )
	{
		$keyword = str_replace(' ', ' | ', $keyword);
		$sql = 'SELECT id FROM ' . $this->table_name . ' WHERE fti @@ to_tsquery(\'russian\', :keyword) LIMIT :limit;';
		return db::get_cols($sql, array('keyword' => $keyword, 'limit' => $limit), $this->connection_name);
	}

	public function reindex( $id )
	{
		$index_columns = array('title');
		$index_expr = 'coalesce(' . implode(',\'\') ||\' \'|| coalesce(', $index_columns) . ',\'\')';

		db::exec(
			'UPDATE ' . $this->table_name . ' SET fti = to_tsvector(\'russian\', ' . $index_expr . ') WHERE id = :id',
			array('id' => $id)
		);
	}

	public function update( $data, $keys = null )
	{
		
                parent::update($data, $keys);
		if (in_array('title', array_keys($data))) $this->reindex($data[$this->primary_key]);
	}

	public function insert($data, $ignore_duplicate = false)
	{
		$id = parent::insert($data, $ignore_duplicate);
		$this->reindex($id);

		return $id;
	}

	public function get_moderators( $id )
	{
		return db_key::i()->exists('groups_moderators:' . $id) ? unserialize(db_key::i()->get('groups_moderators:' . $id)) : array();
	}

	public function is_moderator( $id, $user_id )
	{
		if ( session::has_credential('admin') )
		{
			return true;
		}

		$data = $this->get_item($id);
		if ( $data['user_id'] == $user_id )
		{
			return true;
		}

		return in_array($user_id, $this->get_moderators($id));
	}

	public function add_moderator( $id, $user_id )
	{
		$moderators = $this->get_moderators($id);
		$moderators[] = $user_id;
		$moderators = array_unique($moderators);

		db_key::i()->set('groups_moderators:' . $id, serialize($moderators));
	}

	public function delete_moderator( $id, $user_id )
	{
		$moderators = $this->get_moderators($id);
		$moderators = array_diff($moderators, array($user_id));

		db_key::i()->set('groups_moderators:' . $id, serialize($moderators));
	}

	public function get_select_list()
	{
		$list = $this->get_list();
		$select = array();
		foreach ( $list as $id )
		{
			$data = $this->get_item($id);
			$select[$id] = $data['title'];
		}
		return $select;
	}
}