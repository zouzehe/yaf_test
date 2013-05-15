<?php
    class UdateDictModel{

        public function updateDict(){

            $tmpPath = "/tmp/niuniu/Dict/";

            if(!file_exists($tmpPath)){
                mkdir($tmpPath,true,755);
            }

            $svnCmd = "svn checkout --password=wyg461 svn://wyg@114.112.70.142/niuniu/server/protocol/code/php/ {$tmpPath}";

            exec($svnCmd);
            
            $arr = scandir($tmpPath);

            foreach($arr as $v){
                if($v != '.' || $v != '..' ){
                    include_once($v);
                }
            }
        }
    }