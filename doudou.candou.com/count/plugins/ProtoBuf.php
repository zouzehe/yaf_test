<?php

class ProtoBufPlugin extends Yaf_Plugin_Abstract{


    public function __construct(){
        $dirPath = dirname(dirname(__FILE__));

        set_include_path( get_include_path()
                 .PATH_SEPARATOR.$dirPath.'/plugins/utils/message/'
                 .PATH_SEPARATOR.$dirPath.'/plugins/utils/parser/'
                 .PATH_SEPARATOR.$dirPath.'/plugins/utils/'   
                 );
        require_once('pb_message.php');
        require_once('pb_parser.php');
        require_once('protocol_utils.php');
        require_once('message.php');        
        // require_once($dirPath).'/utils/message.php';
        // require_once($dirPath).'/utils/protocol_utils.php';
        // require_once($dirPath).'/utils/parse/pb_parser.php';
        // require_once($dirPath).'/utils/message/pb_message.php';

    }

}