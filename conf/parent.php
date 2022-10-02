<?

conf::set_from_array( array(
	// Debugging
	'enable_log' => true,
	'enable_web_debug' => false,
	'error_handler' => 'html', // debug | html
	'error_handler_module' => 'ooops', // only for html_error handler
        'javascript_debug' => false, // only if web debug is available
        'debug_email_address' => 'andimov@gmail.com',
	'debug_emails' => false, // Send emails to debug storage also

	// Static servers
	'static_servers' => 1,

	'server' => 'politiko.ua',

	// i18n
	'i18n' => array(
		'enabled' => true,
		'default_lang' => 'ru'
	),

	// Banners
	'banners' => array(
		'default' => 'home',
		'categories' => array(
			'blogs', 'debates', 'groups', 'home',
			'ideas', 'news', 'parties', 'polls'
		)
	),

	// Images server
	'image_types' => array(
			'p' => array('size' => '200', 'crop' => false),
			'm' => array('size' => '160x200', 'crop' => false),
			'mm' => array('size' => '200x200', 'crop' => true),
			'mp' => array('size' => '300x300', 'crop' => true, 'exact' => true),
			'ma' => array('size' => '160x160', 'crop' => true),
			't' => array('size' => '75x75', 'crop' => true),
			's' => array('size' => '50x50', 'crop' => true),
			'f' => array('size' => '640', 'crop' => false),
		),

	// File storage
	'file_storage_path' => realpath(dirname(__FILE__) . '/../data/storage'),

	// Database settings
	'database_default_connection' => 'master',
	'databases' => array(
		'master' => array(
			'driver' => 'pgsql',
			'host' => '127.0.0.1',
			'user' => 'postgres',
			'password' => 'g28XN5[V85'
		)
	),

	// Memcached
	'mamcached' => array(
		'host' => '127.0.0.1',
		'port' => 11211,
		'expiration' => 60*60*24
	),

	'redis' => array(
		'host' => '127.0.0.1',
		'port' => 6379,
		'space' => 'politiko'
	),

	// Image magick
	'imagemagick' => array(
		'convert' => 'convert',
	),

	// Client side settings
	'static_hash' => 146,
	

    // Emails
    'default_email' => 'info@politiko.com.ua',
    'contuct_us_email' => 'info@politiko.com.ua',

	// Project specific settings
	'project_name' => 'Politiko',
	'default_module' => 'sign',
	'sms_secret' => '2348nc9434d'
) );
