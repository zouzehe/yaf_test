<?php
class Redis {
    private static $connection = null;
    public static function server( $serverName ) {
        if ( @self::$connection->$serverName ) return self::$connection->$serverName;
        $server =  Y::get( 'config' )->redis->$serverName->toArray() ;
        @self::$connection->$serverName = new Predis\Client( $server["parameters"], $server["options"] );
        return self::$connection->$serverName;
    }
    public static function quit( $serverName ) {
        return self::$connection->$serverName->quit();
    }
}
