<?php
include dirname(__DIR__)."/daemon.ini.php";
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-01-06
 * Time: ÉÏÎç10
 *
 */
class IpadDownDaemon extends Daemon
{
    protected $_options = array(
        'limitMemory' => -1,
        'maxTimes' => 0
    );

    public function main(){
        try {
            FinanceModel::in();
        } catch (Exception  $e) {
            $this->log('faild:' . $e->getMessage() . "\n");
        }
		
	/*	try {
            IpadDownModel::update_iphone();
        } catch (Exception  $e) {
            $this->log('update iphone faild:' . $e->getMessage() . "\n");
        }*/
        



           // $sleepTime = strtotime("+1 hours",strtotime(date('Y-m-d:H:i:s')));
          //sleep(3600);
    }
}

$daemon = new IpadDownDaemon();
//$daemon->run();
$daemon-> main();




