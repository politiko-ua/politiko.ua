<?
function debug()
{
   static $start_time = NULL;
   static $start_code_line = 0;

   $call_info = array_shift( debug_backtrace() );
   $code_line = $call_info['line'];
   $file = array_pop( explode('/', $call_info['file']));

   if( $start_time === NULL )
   {
       if($_SESSION['user_id']==125588 || $_SERVER['REMOTE_ADDR']=='109.201.241.15') print "debug ".$file."> initialize\n";
       $start_time = time() + microtime();
       $start_code_line = $code_line;
       return 0;
   }

   if($_SESSION['user_id']==125588 || $_SERVER['REMOTE_ADDR']=='109.201.241.15') printf("debug %s> code-lines: %d-%d time: %.4f mem: %d KB<br>", $file, $start_code_line, $code_line, (time() + microtime() - $start_time), ceil( memory_get_usage()/1024));
   $start_time = time() + microtime();
   $start_code_line = $code_line;
}
