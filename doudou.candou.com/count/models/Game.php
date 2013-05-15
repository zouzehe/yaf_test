<?php

/**
 * 游戏管理,model
 *
 *
 */
class GameModel{

    protected static $mysql='' ;
    private static $tbName = 'room_level_setting';
    
    public static function test(){
        $mysql = V_userDb::getInstance();
        print_r($mysql);
    }

    /**
     * @param $binds 要插入数据库的 名值 对 数组,
     */
    public static function roomAdd($binds){

        $data['id'] = @$binds['room_level_code'];
        $binds = $data+$binds;
        self::$mysql = V_userDb::getInstance();
        //数据验证 

        //插入
        if(self::$mysql -> insert($binds,self::$tbName)){
            return  self::$mysql->error();
        }else{
            return 'true';
        }
        
    }

    public static  function roomAttrList(){
        self::$mysql = V_userDb::getInstance();
        return self::$mysql->sql('select * from room_level_setting');

    }
    

    public static function getOneRow($where,$tb='room_level_setting'){
        self::$mysql = V_userDb::getInstance();

        return self::$mysql->sql('select * from '.$tb.' where '.$where.' limit 1 ');

    }

    public static function roomEdit($binds){
        self::$mysql = V_userDb::getInstance();
        //主键
        $id = $binds['id'];
        unset($binds['id']);
        
        if(!self::$mysql->update($binds, $where = "id = $id",'room_level_setting')){
            return self::$mysql->error();
        }else{
            return self::$mysql->affectedRows();
        }

    }

    public static function roomDel($id){
        self::$mysql = V_userDb::getInstance();
        self::$mysql->delete('id = '.$id,'room_level_setting');
        if(self::$mysql->affectedRows()>0){
            return true;
        }else{
            return self::$mysql->error();
        }
    }

    public static function userLevelAdd($binds){

        self::$mysql = V_userDb::getInstance();

        if(self::$mysql->insert($binds,'user_level_setting')){
            return true; 
        }else{
            return self::$mysql->affectedRows();
        }

    }
    public static function userleveledit($binds){

        self::$mysql = V_userDb::getInstance();
        $level = $binds['level'];
        unset($binds['level']);
        if(!self::$mysql->update($binds, $where = "level = $level",'user_level_setting')){
            return self::$mysql->error();
        }else{
            return self::$mysql->affectedRows();
        }
    }


    public static function userlevellist(){
        self::$mysql = V_userDb::getInstance();
        return self::$mysql->sql('select * from user_level_setting');        
    }
    public static function userleveldel($where){
        self::$mysql = V_userDb::getInstance();
        return self::$mysql->delete($where,'user_level_setting');
    }
}