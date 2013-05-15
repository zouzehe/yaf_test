<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 14-3-13
 * Time: 下午3:20
 *
 */
class UserModel
{
    private static $count;
    public static $coopers = array();
    
    /**
     * 用户列表
     *
     * @param string $username
     * @return array(二维)
     */
    public static function userList($offset){
        $mysql = V_userDb::getInstance();   
        $sql = "select user_id,nickname,join_time,coins,chips,safebox_chips,type,cooperation_id from user  where user_id > ".$offset." limit 10";         
        $mysql->query($sql);
        return $mysql->fetchAll();  
    }
    
    /**
     * 用户列表  统计用户数   *
     *
     * @param string $username
     * @return string
     */
    public static function countUser($searchArr=null){
        $mysql = V_userDb::getInstance();        
        if(self::$count){
            return self::$count;
        }
        if(!$searchArr){
            self::$count = $mysql->count(true,'user');
            return self::$count;       
        }else{
            $default =array(
                "startTime" => false,
                "endTime" => false,
                "cooperation_id" => false,
                "platform_id" => false,
                "vip_type" => false,
                "level" => false,
                "client" => false,
                "can_speak" => 1,
                );
            $arr = $searchArr + $default;
            $start = !is_bool($arr['startTime'])?$arr['startTime']:date('Y-m').'-01';
            $end   = !is_bool($arr['endTime'])?$arr['endTime']:date('Y-m-d');
            $can_speak  = is_bool($arr['can_speak'])?1:$arr['can_speak'];                                             
            $where = "join_time >= '{$start}' and join_time <= DATE_ADD('{$end}',INTERVAL 1 DAY)";
            $where .= " and can_speak = {$can_speak} ";                                          
            if($arr['cooperation_id']){
                $where .= " and cooperation_id = '{$arr["cooperation_id"]}'";   
            }
            if($arr["platform_id"]){
                $where .= " and platform_id = '{$arr["platform_id"]}'";   
            }
            if($arr["vip_type"]){
                $where .= " and vip_type = '{$arr["vip_type"]}'";   
            }
            if($arr["level"]){
                $where .= " and level = '{$arr["level"]}'";   
            }
            if($arr["client"]){
                $where .= " and client = '{$arr["client"]}'";   
            }
            if($arr["can_speak"]){
                $where .= " and can_speak = '{$arr["can_speak"]}'";   
            }       
            self::$count = $mysql->count($where,'user'); 
            return self::$count;
        }
    }
   
     /**
     *   查询用户
     *
     * @param string $id
     * @return array 
     */
    public static function selectUserById($id){
        $mysql = V_userDb::getInstance();        
        if(!$id){
            return null;
        }
        $sql = "select * from user where user_id = ".$id;         
        $mysql->query($sql);
        $arr = $mysql->fetch();
        $extraArr = self::selectUserByType($arr['type'],$arr['user_id']);
        if(!is_array($extraArr)){
            $extraArr = array();
        }
        $rstArr = array_merge($arr,$extraArr);
        return $rstArr;
    }
    
    /**
     *  根据用户类型 查询用户信息
     *
     * @param string $type
     * @return array 
     */
    public static function selectUserByType($type,$id){
        $mysql = V_userDb::getInstance();        
        switch ($type) {
             case 'guest':
                $sql = "select * from user_guest where user_id = ".$id;
                break;

             case 'platform_id':
                $sql = "select * from user_platform_id where user_id = ".$id;
                break;

             default:
                $sql = "select * from user_guest where user_id = ".$id;    
                break;
         }
        $mysql->query($sql);  
        return $mysql->fetch();
    }
   
    /**
     * 用户管理   按渠道汇总  *
     *
     * @param  array $arr
     * @return array
     */
    public static function countUserByChannel($arr){
        $mysql = V_userDb::getInstance();
        $start = !empty($arr['startTime'])?$arr['startTime']:date('Y-m').'-01';
        $end   = !empty($arr['endTime'])?$arr['endTime']:date('Y-m-d');              
        $where = " where join_time >= '{$start}' and join_time <= DATE_ADD('{$end}',INTERVAL 1 DAY) group by cooperation_id";
        $sql = "select cooperation_id,count(*) as reg_count from user".$where;                
        $mysql->query($sql); 
        $arr = $mysql->fetchAll();
        //根据渠道ID得到渠道名字
        return self::getCooperationName($arr,self::cooperation());
    }
   
    /**
     * 用户管理   按日期搜索  *
     *
     * @param  array $arr
     * @return array
     */
    public static function countUserByDate($arr){
        $mysql = V_userDb::getInstance();
        $start = !empty($arr['startTime'])?$arr['startTime']:date('Y-m').'-01';
        $end   = !empty($arr['endTime'])?$arr['endTime']:date('Y-m-d');        
        $where = " where join_time >= '{$start}' and join_time <= DATE_ADD('{$end}',INTERVAL 1 DAY)";
        if($arr['cooperation_id']){
            $where .= " and cooperation_id = '{$arr['cooperation_id']}'";   
        }
        if($arr['platform_id']){
            $where .= " and platform_id = '{$arr['platform_id']}'";   
        }     
        $group = " group by DATE(join_time)";
        $sql = "select join_time,count(*) as reg_count from user".$where.$group;        
        $mysql->query($sql); 
        return $mysql->fetchAll();
    }
    
     /**
     * 用户管理   按条件搜索用户  *
     *
     * @param  array $arr
     * @return array
     */
    public static function search($searchArr,$limit){
        $mysql = V_userDb::getInstance();
        $default =array(
            "startTime" => false,
            "endTime" => false,
            "cooperation_id" => false,
            "platform_id" => false,
            "vip_type" => false,
            "level" => false,
            "client" => false,
            "can_speak" => 1,
            "sort" => 1
        );
        $arr = $searchArr + $default;
        $start = !is_bool($arr['startTime'])?$arr['startTime']:date('Y-m').'-01';
        $end   = !is_bool($arr['endTime'])?$arr['endTime']:date('Y-m-d');
        $can_speak  = is_bool($arr['can_speak'])?1:$arr['can_speak'];
        $sort = is_bool($arr['sort'])?'join_time':$arr['sort'];
        $order =" order by ".$sort ." desc ";          
        $where = " where join_time >= '{$start}' and join_time <= DATE_ADD('{$end}',INTERVAL 1 DAY)";
        $where .= " and can_speak = {$can_speak} "; 
        if($arr['cooperation_id']){
            $where .= " and cooperation_id = '{$arr["cooperation_id"]}'";   
        }
        if($arr["platform_id"]){
            $where .= " and platform_id = '{$arr["platform_id"]}'";   
        }
        if($arr["vip_type"]){
            $where .= " and vip_type = '{$arr["vip_type"]}'";   
        }
        if($arr["level"]){
            $where .= " and level = '{$arr["level"]}'";   
        }
        if($arr["client"]){
            $where .= " and client = '{$arr["client"]}'";   
        }
        $sql = "select user_id,nickname,join_time,coins,chips,safebox_chips,type,cooperation_id from user".$where.$order.$limit;                              
        $mysql->query($sql); 
        return $mysql->fetchAll();
    }
   
     /**
     *   合作渠道
     *
     * @param string or array $id
     * @return array 
     */
    public static function cooperation(){
        $mysql = V_userDb::getInstance();     
        if (!self::$coopers) {
            $sql = "select id,name from cooperation";         
            $mysql->query($sql);
            $arr = $mysql->fetchAll();
            foreach ($arr as $value) {
                $tmp[$value["id"]] = $value['name'];
            }
            self::$coopers = $tmp;
        }
        return self::$coopers;
    }
   
     /**
     *   帐号平台
     *
     * @return array 
     */
    public static function platform(){
        $mysql = V_userDb::getInstance();                 
        $sql = "select id,name from platform";         
        $mysql->query($sql);
        return $mysql->fetchAll();     
    }
   
     /**
     * 根据关联ID获取渠道名字
     * @param array $oneArr
     * @param array $twoArr
     * @return array 
     */
    public static function getCooperationName($oneArr,$twoArr){
        foreach($oneArr as $value){
            $value['cooperation_name'] = $twoArr[$value['cooperation_id']];
            $tmpArr[] = $value;  
        }
        return $tmpArr;
    }
   
    /**
     * 编辑用户
     * @param array $twoArr
     * @return bool 
     */
    public static function setUser($arr){
        Y::registerPlugin('ProtoBuf');
        $user =  get_body_by_route('manage.user_set_detail');
        $user->set_nickname($arr['nickname']);
        $user->set_user_id($arr['uid']);
        $user->set_coins($arr['coins']);
        $user->set_chips($arr['chips']);
        $user->set_safebox_chips($arr['safebox_chips']);
        $user->set_exp($arr['exp']);
        $user->set_can_login($arr['can_login']);    
        $user->set_can_speak($arr['can_speak']);
        $rst = NetWorkModel::query($user);
        return $rst;
    }
  
    /**
     * 用户管理 -- 踢人
     * @param int $uid
     * @return bool 
     */
    public static function kick($arr){
        Y::registerPlugin('ProtoBuf');
        $kick =  get_body_by_route('manage.user_kick');
        $kick->set_user_id($arr['uid']);
        $kick->set_kick_type($arr['type']);
        $kick->set_reason($arr['reason']);
        $kick->set_expire($arr['expire']);
        $rst = NetWorkModel::query($kick);
        return $rst;
    }
   
    /**
     * 用户管理 -- 禁言
     * @param int $uid
     * @return bool 
     */
    public static function slient($arr){
        Y::registerPlugin('ProtoBuf');
        $kick =  get_body_by_route('manage.user_silent');
        $kick->set_user_id($arr['uid']);
        $kick->set_reason($arr['reason']);
        $kick->set_expire($arr['expire']);
        $rst = NetWorkModel::query($kick);
        return $rst;
    }
 
    /**
     *   根据用户ID 获取VIP类型
     * @param int  $id
     * @return array 
     */
    public static function selectVipById($id){
        $mysql = V_userDb::getInstance();
        if(!$id){
            return null;
        }                 
        $sql = "select vip_type,remains from user_vip where user_id = {$id}";         
        $mysql->query($sql);
        return self::vipName($mysql->fetchAll());    
    }
  
    /**
     * 根据用户ID 邮件列表
     * @param int  $id
     * @return array 
     */
    public static function selectEmailById($id){
        $mysql = V_userDb::getInstance();
        if(!$id) return null;
        $sql = "select id,sender_name,is_read,send_time,attachment,content from message where user_id = {$id}";         
        $mysql->query($sql);
        return $mysql->fetchAll();    
    }
   
    /**
     * 根据vip_type 获取名称
     * @param array  $data
     * @return array 
     */
    public static function vipName($data){
        $vipArr =array(
            "普通VIP" => "VIPTYPE_NORMAL",
            "银卡" => "VIPTYPE_SILVER",
            "金卡" => "VIPTYPE_GOLD",
            "钻石卡" => "VIPTYPE_DIAMON",
            "精英卡" => "VIPTYPE_ELITE",
            "至尊卡" => "VIPTYPE_EXTREME"
            );   
        foreach($data as $key => $value){
            $data[$key]['vip'] = array_search($value['vip_type'], $vipArr);
        }
        return $data;
    }

    /**
     *   好友列表
     * @param  int $id 
     * @return array 
     */
    public static function friends($id){
        $mysql = V_userDb::getInstance();                 
        if(!$id) return null;
        $sql = "select friend_id,friend_nickname from friend where user_id = ".$id;         
        $mysql->query($sql);
        return $mysql->fetchAll();
    }

    /**
     * vip使用记录
     * @param  int $id 
     * @return array 
     */
    public static function records($id){
        $mysql = V_userDb::getInstance();                 
        if(!$id) return null;
        $sql = "select vip_type,add_time,use_time from user_vip_history where user_id = ".$id;         
        $mysql->query($sql);
        return self::vipName($mysql->fetchAll());
    }

    /**
     * 道具列表
     * @param  int $id 
     * @return array 
     */
    public static function property($id){
        $mysql = V_userDb::getInstance();                 
        if(!$id) return null;
        $sql = "select property_name,add_time,expire_time,count from user_property where user_id = ".$id;         
        $mysql->query($sql);
        return $mysql->fetchAll();
    }

     

}
