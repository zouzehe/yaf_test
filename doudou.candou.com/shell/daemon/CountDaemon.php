<?php
include dirname(__DIR__)."/daemon.ini.php";
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-01-06
 * Time: 上午10
 *
 */
class CountDaemon extends Daemon
{
    protected $_options = array(
        'limitMemory' => -1,
        'maxTimes' => 0
    );

    public function main(){
        try {
            CountModel::cur_account();
        } catch (Exception  $e) {
            $this->log('支付方式统计失败:' . $e->getMessage() . "\n");
        }

        try {
            CountnModel::seperateAcccount();
        } catch (Exception  $e) {
            $this->log('分成额统计失败:' . $e->getMessage() . "\n");
        }



           // $sleepTime = strtotime("+1 hours",strtotime(date('Y-m-d:H:i:s')));
          //sleep(3600);
    }
}

$daemon = new CountDaemon();
//$daemon->run();
$daemon-> main();




