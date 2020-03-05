<?

class redis_task extends shell_task
{
	public function execute()
	{
		load::system('db/key/db_key');
		db_key::i()->get('all');

		require_once '/var/www/test/redis.php';
		$redis = new PRedis('localhost', 6378);

		for ( $i = 99000; $i < 130000; $i++ )
		{
			$d = $redis->get('politiko:user_blacklist' . $i);
			$d = unserialize($d);

			if ( $d )
			{
				db_key::i()->set('user_blacklist' . $i, serialize($d));
				echo '.';
			}
		}
	}
}
