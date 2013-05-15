<?php
include dirname(__DIR__)."/daemon.ini.php";
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-01-06
 * Time: 上午10
 *
 */
class RedisDownDaemon extends Daemon
{
    protected $_options = array(
        'limitMemory' => -1,
        'maxTimes' => 0
    );

    public function main(){
        try {
            RedisDownModel::update_ipad();
        } catch (Exception  $e) {
            $this->log('更新ipad下载数失败:' . $e->getMessage() . "\n");
        }

        try {
            RedisDownModel::update_iphone();
        } catch (Exception  $e) {
            $this->log('更新iphone下载数失败:' . $e->getMessage() . "\n");
        }



           // $sleepTime = strtotime("+1 hours",strtotime(date('Y-m-d:H:i:s')));
          sleep(3600);
    }
}

$daemon = new RedisDownDaemon();
$daemon->run();
//$daemon-> main();




