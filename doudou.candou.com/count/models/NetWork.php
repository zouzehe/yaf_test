<?php
/**
 * 统一接口 查询类 ,
 * Model 层 
 */

class NetWorkModel{

    /**
     *  检查 svn 更新Dict到/game/plugins/utils/,更新后实例化 Dict;
     *  两个文件message.php   protocol_utils.php
     */
    public static function updateDict(){
        $path =  dirname(dirname(__FILE__));
        $path .= "/plugins/";
        return exec("svn update svn://114.112.70.142/niuniu/server/protocol/code/php {$path}");

    }

    /**
     * @param object $queryObj 查询请求对象,(已设置好查询参数)
     * @return array $pkgs 查询返回的结果,数组.
     */
    public static function query($queryObj){

        //plugins/utils/protocol_utils.php 中 的函数,字符串与对象的映射关系
        $route = get_route_by_body($queryObj);

        $request = new Message();
        $request -> set_route($route);
        $request -> set_body($queryObj->SerializeToString());

        $queryObj->SerializeToString();
        
        $requestStr = $request->SerializeToString();
       
        if(!SocketCliModel::createSock('192.168.0.15',9100)){
            var_dump(SocketCliModel::$_lastError);
            return false;
        }

        if(!SocketCliModel::sockWrite($requestStr)){
            var_dump(SocketCliModel::$_lastError);
            return false;
        }

        //读取服务器相应
        $pkgs = SocketCliModel::sockRead();

        //解析服务器响应
        $response = new Message();               //实例化Messag类,用于解析服务器响应

        if(count($pkgs)==1){

            $response -> parseFromString($pkgs[1]);  //第一层解析,需要遍历$pkg 数组,下标从1开始
            $route = $response->route();             //获取响应信息类型.
            $body = get_body_by_route($route);       //获取响应信息对象
            $body->parseFromString($response->body());  //第二次解析

            return $body->toArray();

        }elseif(count($pkgs)>1){
            $arr = array();
            foreach($pkgs as $key => $pkg){
                $response -> parseFromString($pkg);
                $route = $response->route();
                $body =get_body_by_route($route);
                $body ->parseFromString($response->body());
                $arr[] = $body->toArray();
            }
            return  $arr;
        }
        SocketCliModel::sockClose();
    }//end of function query

}// end of class