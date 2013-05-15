<?php
include dirname( __DIR__ )."/daemon.ini.php";
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-11-30
 * Time: 上午10:46
 *
 */
class AnalysisDaemon extends Daemon
{
    protected $_options = array(
        'limitMemory' => -1,
        'maxTimes' => 0
    );

    public function main() {
$data=1365350400;
        try {
            $time=AnalysisUpdateModel::entrance($data);
        } catch ( Exception  $e ) {

            $this->log( '统计失败:'.date( "Y-m-d H:i:s" ).":" . $e->getMessage() . "\n" );
        }

        try {
            AnalysisUpdateModel::setDayData($data);
        } catch ( Exception  $e ) {

            $this->log( '统计当天总数失败:'.date( "Y-m-d H:i:s" ).":" . $e->getMessage() . "\n" );
        }
        try {
            AnalysisUpdateModel::setHourdate($data);
        } catch ( Exception  $e ) {

            $this->log( '统计每小时总数失败:'.date( "Y-m-d H:i:s" ).":" . $e->getMessage() . "\n" );
        }

       /* $sleep=ceil( 50-( $time/2 ) );
        if ( $sleep >0 ) {
            sleep( $sleep );
        }*/

    }

}

$daemon = new AnalysisDaemon();
//$daemon->run();
$daemon->main();
