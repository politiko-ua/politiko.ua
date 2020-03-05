<?php
//die('Извините. Осуществляются технические работы. Попробуйте зайти немного позже.');

date_default_timezone_set("Europe/Kiev");
define('APP_START_TS', microtime(true));

require_once getenv('FRAMEWORK_PATH') . '/library/kernel/load.php';
load::system('kernel/conf');

conf::set('project_root', realpath(dirname(__FILE__) . '/..'));

require_once '../conf/' . getenv('ENVIRONMENT') . '.php';
load::system('kernel/application');
require_once '../apps/application.php';

  if (!defined('_SAPE_USER')){
        define('_SAPE_USER', 'cbf5e6ddfc54df6dbc1a3f31742764b3');
     }
     require_once(realpath($_SERVER['DOCUMENT_ROOT'].'/'._SAPE_USER.'/sape.php'));
     $sape = new SAPE_client(array('charset'=>'UTF-8'));

$app = new project_application();
$app->execute( 'frontend' );
