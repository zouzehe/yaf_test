<?php
include dirname( __DIR__ )."/daemon.ini.php";
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-11-30
 * Time: 上午10:46
 *
 */
class LimitedCountDaemon extends Daemon
{
    protected $_options = array(
        'limitMemory' => -1,
        'maxTimes' => 0
    );
    protected static $position = false;

    public function main() {
        //限制每天零点后执行程序
        if ( self::$position ) {
            self::$position=false;
            try {
                LimitedCountModel::iphone();
            } catch ( Exception  $e ) {

                $this->log( '限时免费:'.date( "Y-m-d H:i:s" ).":" . $e->getMessage() . "\n" );
            }
            try {
                LimitedCountModel::ipad();
            } catch ( Exception  $e ) {

                $this->log( '限时免费:'.date( "Y-m-d H:i:s" ).":" . $e->getMessage() . "\n" );
            }
        }
        //每天执行一次
        $sleepTime=strtotime( "+1 days", strtotime( date( 'Y-m-d' ) ) ) - time();
        sleep( $sleepTime );
        self::$position=true;

    }

}

$daemon = new LimitedCountDaemon();
$daemon->run();
//$daemon->main();

