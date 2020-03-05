<?php 
     define('_SAPE_USER', 'cbf5e6ddfc54df6dbc1a3f31742764b3');
     require_once($_SERVER['DOCUMENT_ROOT'].'/'._SAPE_USER.'/sape.php'); 
     $sape_articles = new SAPE_articles();
     echo $sape_articles->process_request();
?>
