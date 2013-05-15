<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\MongoDBHandler;
class Log {

    public static function file( $name,$fileName="" ) {
		$logConfig=Y::config()->log->file;
        $log=new Monolog\Logger($name);
		//调试模式下  在浏览器输出错误
		if(YDEBUG){
			$log->pushHandler(new FirePHPHandler());
		}else{
			$logName=date("YmdH").$fileName.'.log';
			$log->pushHandler(new StreamHandler($logConfig->path."/{$logName}", Logger::DEBUG));
		}
		return $log;
    }
	public static function mongo($name,$collection){
		$logConfig=Y::config()->log;
		$log=new Monolog\Logger($name);
		$mongodb = new MongoDBHandler(new Mongo("mongodb://{$logConfig->host}"), $logConfig->database, $collection);
		$log->pushHandler($mongodb);
		return $log;
	}

}
