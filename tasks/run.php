<?

$conf_dir = realpath( dirname(__FILE__) . '/../conf');

if ( !$server_config = @file_get_contents($conf_dir . '/lighttpd_dev.conf') )
{
	$server_config = file_get_contents($conf_dir . '/lighttpd.conf');
    $env = 'production';
}

if ( !$server_config )
{
	die('Cannot find server configuration file (lighttpd.conf in project conf directory)');
}

if ( !$env )
{
    preg_match('/var.environment = "([^"]+)"/', $server_config, $env_match);
    if ( !$env = $env_match[1] )
    {
        die('Cannot find environment under server config (var.environment = "environment-name")');
    }
}

preg_match('/var.framework_root = "([^"]+)"/', $server_config, $framework_match);
if ( !$framework_path = $framework_match[1] )
{
	$framework_path = dirname(__FILE__) . '/../framework';
	if ( !is_dir($framework_path) )
	{
		die('Cannot find framework path under server config (var.framework_root = "path") or in framework subfolder');
	}
}

putenv( 'FRAMEWORK_PATH=' . $framework_path );
putenv( 'ENVIRONMENT=' . $env );

require_once getenv('FRAMEWORK_PATH') . '/library/kernel/load.php';
load::system('kernel/conf');

conf::set('project_root', realpath(dirname(__FILE__) . '/..'));

require_once dirname(__FILE__) . '/../conf/' . getenv('ENVIRONMENT') . '.php';

load::system('kernel/application');
load::system('shell/task');

load::system('db/db_peer_postgre');

shell_task::run();