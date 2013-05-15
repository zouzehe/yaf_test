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
	@ param string 			$message		������ʾ��Ϣ
	@ param string|array 	$context		��������
	@ param string $name		��������
	@ param string $message		�����ļ�����
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
