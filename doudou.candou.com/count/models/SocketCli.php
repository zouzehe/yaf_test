<?php

/**
 * 
 * 
 */
class SocketCliModel{
    public static $sock = '';               //用于存储 sock资源
    public static $_lastError  = '';        //存储上一次错误信息


    /**
     * 建立socket,并与服务器建立链接
     * @param string $addr 通信地址,当$domain 为 AF_INET时为ip地址 
     * @param int $port 
     * @param string $domain  网络通信协议类型 
     * @param string $type    套接字类型           
     * @param string $protocol 网络通信协议下的具体类型
     * @return resouce  socket链接 
     *         bool     失败
     */
    public static function createSock($addr,$port=0,$domain=AF_INET, $type=SOCK_STREAM, $protocol=SOL_TCP){

        if(is_string($protocol)){
            $protocol = getprotobyname($protocol);
        }

        self::$sock = socket_create($domain, $type, $protocol);

        $flag  = socket_connect(self::$sock, $addr,$port);

        if(!self::$sock || !$flag){
            self::$_lastError = "socket create error on $domin \nwith type $type\n by protocol ".getprotobynumber($protocol).'\n';
            return false;
        }
        return self::$sock;
    }

    /**
     * 拼接请求信息长度,发送请求
     * @param  string $msg 向服务器发送的请求信息
     * @return bool true   send success
     *         bool false  fail
     */
    public static function sockWrite($msg){
        //将包长度拼接在字符串之前
        $req = pack('n',strlen($msg)).$msg;

        if(socket_write(self::$sock, $req)===false){
            self::ifError(self::$sock);
            return false;
        }
        return true;
    }

    /**
     * 读取服务器返回信息,以1024 为chunkSize
     *  int $type = PHP_BINARY_READ
     * 读取方法,为读完即截掉 
     * @param $length 服务器端 返回的 数据流 分段长度,默认为1024
     * @return array 每个元素是一个包的全部内容.
     */
    public static function sockRead($length=1024){
 
        $pkgs = Array();
        $msg = 0;
        $count = 1;

        $msg = socket_read(self::$sock, $length);
        
        // echo "<hr>"; var_dump($msg);

        do{
            $cur_pkg_len = self::pkgLen(substr($msg, 0,2));

            $msg =substr($msg, 2);

            //如果包的长度很大||如果链接终端,会成为死循环> 解决?
            $maxRead =(int)ceil(65536/$length);
            $readCount =0 ;

            while($cur_pkg_len>strlen($msg)&&$readCount<=$maxRead){
                $msg .= socket_read(self::$sock, $length);
                $readCount++;
            }
       
            $pkgs[$count++]=substr($msg,0,$cur_pkg_len);

            $msg = substr($msg,$cur_pkg_len);

        }while(strlen($msg));

        return $pkgs; 
    }
    

    /**
     * 解析服务器响应中的包长度
     * @param string $msg 服务器响应信息
     * @return int 传入的相应信息第一个包的长度
     */ 
    public static function pkgLen($msg){
        $t =unpack('nlen', $msg);
        return (int)$t['len'];
    }

    /**
     * 异常处理
     * @param resource $sock 产生异常的对象,
     * @return string  错误信息
     * 
     */
    protected static function ifError($sock){

        if(is_resource($sock)){
            return socket_strerror(socket_last_error($sock));
        }else{
            return 'Param passed is no a resource\n';
        }
    }
    
    /**
     * 关闭socket 
     */
    public static function sockClose(){
        socket_close(self::$sock);
    }
}