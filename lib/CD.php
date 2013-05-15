<?php
/**
 * canDou Framework extends YAF.
 *
 * @author GUAnG cdFrameWork@gmail.com
 * @package CD
 * @version 0.10
 */
class CD {
  /**
   * Get Config
   *
   * @param string  $name
   * @param mixed   $default
   * @param mixed   $delimiter
   * @return mixed
   */
  public static function mysql( $param = 'default' ) {
    $config = Yaf_Registry::get( 'config' )->mysql->$param;
    return DB::factory( $config );
  }
  public static function ms( $param = 'masterslave' ) {
    $config = Yaf_Registry::get( 'config' )->mysql->$param;
    return DB::factory( $config );
  }
  public static function doc( $docid = 'index' ) {
    $doc = include 'inc/candou.doc.php';
    return $doc[$docid];
  }
  /* 
	@ param string 			$message		错误提示信息
	@ param string|array 	$context		错误内容
	@ param string $name		错误名称
	@ param string $message		保存文件名称
	@ return	
  */
  public static function log($message = 'M',$context=array(),$name="",$fileName="" ) {
    $config = Yaf_Registry::get('config')->log;
	if(!is_array($context)){
		$context=array($context);
	}
    Log::file($name,$fileName)->err($message,$context);
	
	
  }
  public static function cache($adapter = '') {
    if ($adapter == '') $config = Yaf_Registry::get( 'config' )->cache->adapter;
    $class = 'Cache_' . ucfirst( $config );
    return new $class();
  }
}
