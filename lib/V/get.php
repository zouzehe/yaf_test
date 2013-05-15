<?php
class V_get extends Y_C{
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
  protected static $verify=array(
    "orderid"=>array(                  
      'required' => true,
      'regex'     => "int",
      'msg'      => "orderid"
    ),
    "u_id"=>array(                   
      'required' => true,
      'regex'     => "int",
      'msg'      => "uid"
    ),
    "u_name"=>array(                   
      'required' => true,
      'regex'     => "string",
      'msg'      => "uname"
    ),

    "quality"=>array(                   //图片质量
      'required' => true,
      'regex'     => "/^((high)|(plain))$/",
      'msg'      => "quality_false"
    ),
    "page"=>array(                   //分页
      'required' => true,
      'type'     => "int",
      'msg'      => "page"
    ),
    "limit"=>array(                   //分页
      'required' => true,
      'type'     => "int",
      'msg'      => "limit"
    ),
    "userid"=>array(           //用户名
      'required' => true,
      'type'     =>"int",
      'msg'      => "userid"
    ),
    "search"=>array(                 //搜索关键词
      'required' => true,
      'type'     =>"string",
      'msg'      => "pwd"
    ),

    "starttime"=>array(             //数据开始时间
      'required' => true,
      'type'     =>"date",
      'msg'      => "startTime"
    ),
    "endtime"=>array(               //数据结束时间
      'required' => true,
      'type'     =>"date",
      'msg'      => "endTime"
    ),
    "day"=>array(                   //查看多少天
      'required' => true,
      'type'     =>"int",
      'msg'      => "day"
    ),
    "categoryname"=>array(         //创建的分类名
      'required'=>true,
      'msg'     =>'categoryname'
    ),
    "categoryurl"=>array(    //创建的分类地址
      'required'=>true,
      'msg'     =>'categoryurl'
    ),
    "status"     =>array(               //分类状态
      'required'=>true,
      'type'    =>"int",
      'msg'     =>'status'
    ),
    "fid"     =>array(                  //分类id
      'required'=>true,
      'type'    =>"int",
      'msg'     =>'fid'
    ),
    "category_id"=>array(
      'rquired'=>true,
      'type'   => "int",
      'msg'    => 'category_id'
    ),
    "id"     =>array(                  //用户id
      'required'=>true,
      'type'    =>"int",
      'msg'     =>'id'
    ),
    'username'   =>array(                 //账号
      'rquired'=>true,
      'type'   =>'string',
      'msg'    =>'username'
    ),
    'password'   =>array(                  //密码
      'rquired'=>true,
      'type'   =>'string',
      'msg'    =>'password'
    ),
    'alias'   =>array(                      //真实姓名
      'rquired'=>true,
      'type'   =>'string',
      'msg'    =>'alias'
    ),
    'realname'   =>array(                      //真实姓名
      'rquired'=>true,
      'type'   =>'string',
      'msg'    =>'realname'
    ),
    'uid'   =>array(                      //用户id
      'rquired'=>true,
      'type'   =>'int',
      'msg'    =>'uid'
    ),
    'duty'   =>array(                      //用户职责数字
      'rquired'=>true,
      'type'   =>'int',
      'msg'    =>'duty'
    ),
    'duty_cn'   =>array(                      //用户职责中文
      'rquired'=>true,
      'type'   =>'string',
      'msg'    =>'duty_cn'
    ),
    'email'   =>array(                       //email
      'rquired'=>true,
      'type'   =>'email',
      'msg'    =>'email'
    ),
    'gid'    =>array(                        //组id
      'rquired'=>true,
      'type'   =>'int',
      'msg'    =>'disable'
    ),
    'disable'   =>array(                     //是否显示
      'rquired'=>true,
      'type'   =>'int',
      'msg'    =>'disable'
    ),
    'author'   =>array(                     //作者
      'required' => true,
      'regex'     => "/^[\w_%\.]+$/",
      'msg'      => "author"
    ),
    'title'   =>array(                     //标题
      'required' => true,
      'msg'      => "title"
    ),
    'app' =>array( //app类型
      'required' => true,
      'type'   =>'string',
      'msg'      => "appType"
    ),
    'number' =>array(      //条数
      'rquired'=>true,
      'type'   =>'int',
      'msg'    =>'disable'
    ),
    'oldpwd' =>array(
      'required' => true,
      'type'   =>'string',
      'msg'      => "oldpwd"
    ),
    'newpwd' =>array(
      'required' => true,
      'type'   =>'string',
      'msg'      => "newpwd"
    ),
    'appid'=>array(
      'required' => true,
      'type'   =>'int',
      'msg'      => "appid"
    ),
    'source'=>array(
      'required' => true,
      'type'   =>'string',
      'msg'      => "source"
    ),
    'apptype'=>array(
      'required' => true,
      'type'   =>'string',
      'msg'      => "apptype"
    ),
    'destination'=>array(
      'required' => true,
      'type'   =>'string',
      'msg'      => "destination"
    ),
    //android
    'picture'=>array(     //滚动图
      'required' => true,
      'type'   =>'string',
      'msg'      => "picture"
    ),
    'picture_two'=>array(
      'required' => true,
      'type'   =>'string',
      'msg'      => "picture_two"
    ),
    'picture_three'=>array(
      'required' => true,
      'type'   =>'string',
      'msg'      => "picture_three"
    ),
    'pic'=>array(
      'required' => true,
      'type'   =>'string',
      'msg'      => "pic"
    ),
    'rollid' => array(
      'required' => true,
      'type'    => 'int',
      'msg'    => 'rollid'
    ),
    'weight' => array(
      'required' => true,
      'type'    => 'int',
      'msg'    => 'weight'
    ),
    'type' => array(
      'required' => true,
      'type'    => 'string',
      'msg'    => 'type'
    ),
    'name'   =>array(
      'rquired'=>true,
      'type'   =>'string',
      'msg'    =>'name'
    ),
    'packagename'   =>array(
      'rquired'=>true,
      'type'   =>'string',
      'msg'    =>'packagename'
    ),
    'release_date'   =>array(
      'rquired'=>true,
      'type'   =>'string',
      'msg'    =>'release_date'
    ),
    'downloads_sum'   =>array(
      'rquired'=>true,
      'type'   =>'string',
      'msg'    =>'downloads_sum'
    ),
    'download_url'   =>array(
      'rquired'=>true,
      'type'   =>'string',
      'msg'    =>'download_url'
    ),
    'file_size'   =>array(
      'rquired'=>true,
      'type'   =>'string',
      'msg'    =>'file_size'
    ),
    'system_requirements'   =>array(
      'rquired'=>true,
      'type'   =>'string',
      'msg'    =>'system_requirements'
    ),
    'version'   =>array(
      'rquired'=>true,
      'type'   =>'string',
      'msg'    =>'version'
    ),
    'description_original'   =>array(
      'rquired'=>true,
      'type'   =>'string',
      'msg'    =>'description_original'
    ),
    'description'   =>array(
      'rquired'=>true,
      'type'   =>'string',
      'msg'    =>'description'
    ),
    'rating_overall'   =>array(
      'rquired'=>true,
      'type'   =>'string',
      'msg'    =>'rating_overall'
    ),
    'act' => array(
      'required'=>true,
      'type'   =>'string',
      'msg'   =>'act'
    ),
    'keyword' => array(
      'required'=>true,
      'type'   =>'string',
      'msg'   =>'keyword'
    ),
    'id' => array(
      'required'=>true,
      'type'   =>'int',
      'msg'   =>'id'
    ),
    'order' => array(
      'required'=>true,
      'type'   =>'int',
      'msg'   =>'order'
    ),
  );
  // public static $error=array();
  //��ȡget��postֵ
  //@param string $key
  //@return string || array
  public static function v( $key ) {
    return self::getRequer( $key );
  }
  public static function getRequer( $key ) {
    if ( !array_key_exists( $key, self::$verify ) ) { //判断key是否存在验证规则
      return "key does not exist validation rules";
    }else {
      $preg=self::$verify;
    }
    $Validate=new Validate();
    if ( array_key_exists( $key, $data=Y::request()->getParams() ) ) {
      $value=trim( $data[$key] );
      if ( $d=$Validate->check( $value, $preg[$key] ) ) {
        $get=trim( $value );
      }else {
        self::$error[$key]=$Validate->error();
        $get = false;
      }
      return $get;
    }elseif ( array_key_exists( $key, $data=Y::request()->getPost() ) ) {
      $value=trim( $data[$key] );
      if ( $d=$Validate->check( $value, $preg[$key] ) ) {
        $get=trim( $value );
      }else {
        self::$error[$key]=$Validate->error();
        $get = false;
      }
      return $get;
    }else {
      return false;
    }
  }

}
