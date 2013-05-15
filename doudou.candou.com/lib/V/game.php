<?php
class V_game extends Y_C
{
  /*
$verify=array(
"username" => array(
         'required' => true if required , false for not
         'type'     => var type, should be in ('email', 'url', 'ip', 'date', 'number', 'int', 'string')
         'regex'    => regex code to match
         'func'     => validate function, use the var as arg
         'max'      => max number or max length
         'min'      => min number or min length
         'range'    => range number or range length
         'msg'      => error message,can be as an array
     )
 */
  private  $verify=array(
    //order start
    'number'=>array(
        'required'=>true,
        'type'    =>'string',
        'msg'     =>'number'
    ),
    'cooperation_id' => array(
      'required'=>true,
      'type'   =>'string',
      'msg'   =>'cooperation_id'
    ),
    'payment_id' => array(
      'required'=>true,
      'type'   =>'string',
      'msg'   =>'payment_id'
    ),
    'orderid' => array(
      'required'=>true,
      'type'   =>'int',
      'msg'   =>'orderid'
    ),
    'userid' => array(
      'required'=>true,
      'type'   =>'int',
      'msg'   =>'userid'
    ),
    'username' => array(
      'required'=>true,
      'type'   =>'string',
      'msg'   =>'username'
    ),
    'nickname' => array(
      'required'=>true,
      'type'   =>'string',
      'msg'   =>'nickname'
    ),
    'action'  =>array(
        'required'=>true,
        'type'    =>'string',
        'msg'     =>'action'  
    ),
    //order end
    'id' => array(
      'required'=>true,
      'type'   =>'int',
      'msg'   =>'id'
    ),
    //开始时间
    'startTime' => array(
      'required'=>true,
      'type'   =>'date',
      'msg'   =>'startTime'
    ),
    //结束时间
    'endTime' => array(
      'required'=>true,
      'type'   =>'date',
      'msg'   =>'endTime'
    ),
    //渠道
    'cooperation' => array(
      'required'=>true,
      'type'   =>'string',
      'msg'   =>'cooperation'
    ),
    //帐号平台
     'platform' => array(
      'required'=>true,
      'type'   =>'string',
      'msg'   =>'platform'
    ),
     //vip类型
     'vip_type' => array(
      'required'=>true,
      'type'   =>'string',
      'msg'   =>'vip_type'
    ),
     //等级
     'level' => array(
      'required'=>true,
      'type'   =>'string',
      'msg'   =>'level'
    ),
     //客户端
     'client' => array(
      'required'=>true,
      'type'   =>'string',
      'msg'   =>'client'
    ),
     //是否发言
     'can_speak' => array(
      'required'=>true,
      'type'   =>'int',
      'msg'   =>'can_speak'
    ),
     //游戏次数
    'game_times' => array(
      'required'=>true,
      'type'   =>'int',
      'msg'   =>'game_times'
    ),
    //sort
    'sort' => array(
      'required'=>true,
      'type'   =>'string',
      'msg'   =>'sort'
    ),
    //金币
    'coins' => array(
      'required'=>true,
      'type'   =>'int',
      'msg'   =>'coins'
    ),
    //游戏币
    'chips' => array(
      'required'=>true,
      'type'   =>'int',
      'msg'   =>'chips'
    ),
    //保险箱
    'safebox_chips' => array(
      'required'=>true,
      'type'   =>'int',
      'msg'   =>'safebox_chips'
    ),
    //能否发言
    'can_speak' => array(
      'required'=>true,
      'type'   =>'int',
      'msg'   =>'can_speak'
    ),
    //能否登录
    'can_login' => array(
      'required'=>true,
      'type'   =>'int',
      'msg'   =>'can_login'
    ),
    //经验
    'exp' => array(
      'required'=>true,
      'type'   =>'int',
      'msg'   =>'exp'
    ),
    //类型
     'type' => array(
      'required'=>true,
      'type'   =>'string',
      'msg'   =>'type'
    ),
     //时间
     'expire' => array(
      'required'=>true,
      'type'   =>'int',
      'msg'   =>'expire'
    ),
     //原因
     'reason' => array(
      'required'=>true,
      'type'   =>'string',
      'msg'   =>'reason'
    ),
    'page' => array(
      'required'=>true,
      'type'   =>'int',
      'msg'   =>'page'
    )
  );
  public function  v ($key){
    return parent::verify($key,$this->verify);
  }
  public  $error=array();
  //��ȡget��postֵ
  //@param string $key
  //@return string || array
}
