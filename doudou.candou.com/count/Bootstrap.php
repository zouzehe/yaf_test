<?php
/**
 * 所有在Bootstrap类中, 以_init开头的方法, 都会被Ap调用,
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends Y_B {
	public function _initMVC() {
		$_mca = array (
				'Index' => array (
						'Index' => array (
								"index" => 1,
								"show" => 1 
						),
						'User' => array (
								"edit" => 1,
								"save" => 1,
								"list" => 1,
								"qudao" => 1,
								"date" => 1,
								"search" => 1,
								"vip" => 1 ,
								"email" => 1,
								"kick" => 1 ,
								"kicksave" => 1 ,
								"speak" => 1 ,
								"friends" => 1 ,
								"items" => 1 ,
								"viprecord" => 1	
						),
                        //财务管理
						'Finance' => array (
								"order" => 1,
								"qudao" => 1,
								"date" => 1,
								"pay" => 1 
                            ),
                         //渠道管理
                        'Channel'=>array(
                                'partner'=>1,
                                'platform'=>1,
                                'pay'=>1,
                                'partneradd'=>1,
                                'platformadd'=>1,
                                'payadd'=>1,
                                'newitem'=>1,
                                'partneredit'=>1,
                                'platformedit'=>1,
                                'payedit'=>1,
                                'edititem'=>1
                            ),
						'Qudao' => array (
								"list" => 1,
								"account" => 1 
						)
						,
						'Game' => array (
						        "index" => 1,        
								"roomlist" => 1,
								"roomattr" => 1,
								"roomadd" => 1,
								"roomdel" => 1,
								"roomedit" => 1,
								"doroomedit"=> 1,
								"roomset" => 1,
								"userleveladd"=>1,
								"userleveledit"=>1,
								"userlevellist" => 1,
								"userleveldel"=>1 ,
								'learning' => 1 
						),
						'NetWork' => array(
						         "query" => 1,

						),
						'Admin' => array (
								"list" => 1,
								"add" => 1,
								"edit" => 1 
						),
				)
				
		);
		
		Y::set ( 'mca', $_mca );
	}
	
	// 为本地目录lib下的文件注册空间名
	public function _initPath() {
		Y::path ( 'V' );
	}
	
	// 创建常量
	public function _initdefind() {
		define ( "HOST_STATIC", Y::get ( 'config' )->uri->static );
		define ( "HOST", Y::get ( 'config' )->uri->host );
		define ( "PHOTO_URL", Y::get ( 'config' )->uri->photo );
		define ( "PHOTO_ADDR", Y::get ( 'config' )->uri->photoaddr );
	}
}
