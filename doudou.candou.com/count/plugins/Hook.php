<?php
/**
 * Ap定义了如下的7个Hook,
 * 插件之间的执行顺序是先进先Call
 */
class HookPlugin extends Yaf_Plugin_Abstract {
  public function routerStartup( Yaf_Request_Abstract $request, Yaf_Response_Abstract $response ) {
  }
  public function routerShutdown( Yaf_Request_Abstract $request, Yaf_Response_Abstract $response ) {
    Y::fliter();


  /*//判断用户登录
	$path=Y::pathinfo();
  $info=Y::session()->get("userinfo");
	if($path['c'] !="Login" && $path['c'] !="Error"){
		  if(empty($info['login']) && !$info['login']){
      Y::reRoute("login");
      }
	}
  */
     
  }
  public function dispatchLoopStartup( Yaf_Request_Abstract $request, Yaf_Response_Abstract $response ) {

  }
  public function preDispatch( Yaf_Request_Abstract $request, Yaf_Response_Abstract $response ) {

  }
  public function postDispatch( Yaf_Request_Abstract $request, Yaf_Response_Abstract $response ) {

  }
  public function dispatchLoopShutdown( Yaf_Request_Abstract $request, Yaf_Response_Abstract $response ) {
  //生产模式下对html代码格式化
	//if(!Y::config()->debug)$response->setBody(Minifier::html($response->getBody()));
  }
  public function preResponse( Yaf_Request_Abstract $request, Yaf_Response_Abstract $response ) {

  }
}
