<?

include dirname(__FILE__) . '/parent.php';

conf::set_from_array( array(
	'enable_log' => true,
	'disable_banners' => false,
	'enable_web_debug' => true,
	'error_handler' => 'debug', // debug | html
    'javascript_debug' => true,
	'debug_emails' => true,

	'server' => 'stage.politiko.com.ua',

	'databases' => array(
		'master' => array(
			'driver' => 'pgsql',
			'host' => '127.0.0.1',
			'user' => 'postgres',
			'password' => 'postgres'
		)
	),
) );
