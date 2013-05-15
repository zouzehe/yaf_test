<?php
//-------------------------------------------
$yaf = new Yaf_Application( dirname( __DIR__ ).'/config/home.ini', 'dev' );
//-------------------------------------------

$config = Y::config();
Y::set( "config", $config );
//define( "YDEBUG", $config->debug );
define( "YDEBUG", 0 );
//------------------------------------------
if(YDEBUG){
    ini_set('display_errors' ,"on");
    error_reporting(E_ALL);
}
//-------------------------------
//不显示视图
Y::disableView();
//设置内存限制
ini_set("memory_limit","-1");
