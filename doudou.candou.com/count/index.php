<?php
date_default_timezone_set('Asia/Chongqing');
//-------------------------------------------
$yaf = new Yaf_Application( dirname( __DIR__ ).'/config/count.ini', 'dev' );
//-------------------------------------------
$config = Y::config();
Y::set( "config", $config );
define( "YDEBUG", $config->debug );
//------------------------------------------
if(YDEBUG){
ini_set('display_errors' ,"on");
error_reporting(E_ALL);
}
//-------------------------------------------
if ( ( $config->xhprof )&&YDEBUG ) {
  xhprof_enable( XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY );
}
//-------------------------------------------
if ( $config->disableView ) {
  Y::disableView();
}
//-------------------------------------------
$response =$yaf->bootstrap()->getDispatcher()->returnResponse( TRUE )->getApplication()->run();
//-------------------------------------------
if ( ( $config->xhprof )&& YDEBUG ) {
  $xhprof_data = xhprof_disable();
  $xhprof_runs = new XHProf();
  $run_id = $xhprof_runs->save_run( $xhprof_data, "www" );
  $xhprof_data = array( 'graphivz'=>"http://dev.home.com/xhprof_html/callgraph.php?source=www&run=".$run_id, 'xhprof' )+$xhprof_data;
  FB::info( $xhprof_data, 'xhprof' );
}
//-------------------------------------------
$response->response();

