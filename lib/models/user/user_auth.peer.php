<?

class user_auth_peer extends db_peer_postgre
{
	const TYPE_POLITIC = 4;
	const TYPE_PERSON = 1;

	protected $table_name = 'user_auth';

	public static $activate_types = array(1, 3, 4, 5, 6, 7);
	public static $register_types = array(1, 3, 4, 5, 6, 7);

	/**
	 * @return user_auth_peer
	 */
	public static function instance()
	{
		return parent::instance( 'user_auth_peer' );
	}

	public static function get_types()
	{
		return array(
			1 => t('Избиратель'),
			2 => t('Эксперт'),
			3 => t('Политолог'),
			4 => t('Политик'),
			5 => t('Журналист'),
			6 => t('Госслужащий'),
			7 => t('Гражданский деятель')
		);
	}

	public static function get_type( $id )
	{
		$list = self::get_types();
		return $list[$id];
	}

	public function insert( $email, $password, $type, $active = false )
	{
		$data = array(
			'email' => $email,
			'password' => md5($password),
			'security_code' => $this->generate_security_code(),
			'active' => $active,
			'type' => $type,
			'created_ts' => time(),
			'ip' => $_SERVER['REMOTE_ADDR']
		);

		mem_cache::i()->set('sign-up-ip' . $_SERVER['REMOTE_ADDR'], true, 60*60*24*7);
		
		return parent::insert($data);
	}

	public function generate_security_code()
	{
		return md5(microtime(true)) . md5(rand(100, 999));
	}

	public function get_by_email( $value )
	{
		return db::get_row('SELECT * FROM ' . $this->table_name . ' WHERE email = :value LIMIT 1', array('value' => strtolower($value)));
	}

	public function get_by_security_code( $value )
	{
		return db::get_row('SELECT * FROM ' . $this->table_name . ' WHERE security_code = :value LIMIT 1', array('value' => $value));
	}

	public function activate( $user_id )
	{
		$this->update(array('id' => $user_id, 'active' => 1, 'security_code' => $this->generate_security_code()));
	}

	public function regenerate_security_code( $id )
	{
		$this->update(
			array(
				'id' => $id,
				'security_code' => $this->generate_security_code()
			)
		);
	}

	public function get_by_type( $type, $order = null )
	{
		if ( !$order ) $order = 'u.rate DESC';

		$sql = '
			SELECT user_id
			FROM ' . $this->table_name . ' a
			JOIN ' . user_data_peer::instance()->get_table_name() . ' u ON (u.user_id = a.id)
			WHERE type = :type AND active = true
			ORDER BY ' . $order . '
			LIMIT 500
		';

		return db::get_cols($sql, array('type' => $type), $this->connection_name);
	}

	public function code_exists( $code )
        {
                return db_key::i()->exists('invite-code:' . $code);
        }

        public function code_create()
        {
		$code = substr(md5(microtime(true) . rand(11, 99)), 0, 8);
                db_key::i()->set('invite-code:' . $code, true);
		return $code;
        }
}
