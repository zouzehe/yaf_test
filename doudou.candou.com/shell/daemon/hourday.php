<?php
include dirname(__DIR__)."/daemon.ini.php";
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-01-06
 * Time: 上午10
 *
 */
class hourdayDaemon extends Daemon
{
    protected $_options = array(
        'limitMemory' => -1,
        'maxTimes' => 0
    );

    public function main(){
        try {
            EditcountModel::bidui();
        } catch (Exception  $e) {
            $this->log('更新小时表到天表数失败:' . $e->getMessage() . "\n");
        }
    }
}

$daemon = new hourdayDaemon();
//$daemon->run();
$daemon->main();




