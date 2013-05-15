<?php
include dirname(__DIR__)."/daemon.ini.php";
/*
 * 本文件为每天只执行一次
 *  CreatTableModel::tables();  创建新的表
 * */
class CreatTableDaemon extends Daemon
{
    protected $_options = array(
        'limitMemory' => -1,
        'maxTimes' => 0
    );
    public function main()
    {
        //创建新的库
        try {
            CreatTableModel::tables();
        } catch (Exception  $e) {
            $this->log('创建统计表失败:' . $e->getMessage() . "\n");
        }

        //每天执行一次
        $sleepTime=strtotime("+1 days",strtotime(date('Y-m-d'))) - time()+3600;
        sleep($sleepTime);

    }
}

$daemon = new CreatTableDaemon();
$daemon->run();
