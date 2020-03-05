<?php

class db_key
{
	private static $instance;

	/**
	 *
	 * @var Redis
	 */
	private $redis;
	private $space = '';
	private $inner_cache = array();

	private function __construct()
	{
		$config = conf::get('redis');
		$this->connect($config['host'], $config['port']);
		$this->space = $config['space'];
	}

	public function connect( $host, $port )
	{
		$log_id = ( conf::get('enable_log') ) ? logger::start($key, 'Redis connection', logger::LEVEL_NORMAL) : null;
		$this->redis = new Redis();
		$this->redis->connect($host, $port);
		conf::get('enable_log') ? logger::commit($log_id) : null;
	}

	public function get_key( $key )
	{
		return $this->space . ':' . $key;
	}

	public function get( $key )
	{
		$key = $this->get_key($key);

		$log_id = ( conf::get('enable_log') ) ? logger::start($key, 'Redis:GET', logger::LEVEL_NORMAL) : null;

		if ( array_key_exists($key, $this->inner_cache) )
		{
			return $this->inner_cache[$key];
		}

		$data = $this->redis->get( $key );
		conf::get('enable_log') ? logger::commit($log_id) : null;

		return $data;
	}

	public function increment( $key, $amount = 1 )
	{
		$key = $this->get_key($key);

		$log_id = ( conf::get('enable_log') ) ? logger::start($key, 'Redis:INC', logger::LEVEL_NORMAL) : null;

		$data = $this->redis->incr( $key, $amount );
		
		conf::get('enable_log') ? logger::commit($log_id) : null;

		return $data;
	}

	public function exists( $key )
	{
		$key = $this->get_key( $key );
		return (bool) $this->redis->exists( $key );
	}

	public function set( $key, $value )
	{
		$key = $this->get_key($key);

		$log_id = ( conf::get('enable_log') ) ? logger::start($key, 'Redis:SET', logger::LEVEL_NORMAL) : null;

		$this->redis->set($key, $value);
		$this->inner_cache[$key] = $value;

		conf::get('enable_log') ? logger::commit($log_id) : null;
	}

	public function push( $key, $value )
	{
		$key = $this->get_key($key);
		$this->redis->push($key, $value, false);

		$log_id = ( conf::get('enable_log') ) ? logger::start($key, 'Redis:PUSH', logger::LEVEL_NORMAL) : null;

		$this->redis->set($key, $value);
		$this->inner_cache[$key] = $value;

		conf::get('enable_log') ? logger::commit($log_id) : null;
	}

	public function get_range( $key, $limit = 100, $offset = 0 )
	{
		$key = $this->get_key($key);
		$log_id = ( conf::get('enable_log') ) ? logger::start($key, 'Redis:GET_RANGE', logger::LEVEL_NORMAL) : null;

		if ( array_key_exists($key, $this->inner_cache) )
		{
			return $this->inner_cache[$key];
		}

		$data = $this->redis->lrange( $key, $offset, $limit + $offset );
		conf::get('enable_log') ? logger::commit($log_id) : null;

		return $data;
	}

	public function delete( $key )
	{
		$key = $this->get_key($key);
		return $this->redis->delete( $key );
	}

	/**
	 * @return db_key
	 */
	public static function i()
	{
		if ( !self::$instance )
		{
			self::$instance = new self;
		}

		return self::$instance;
	}
}
