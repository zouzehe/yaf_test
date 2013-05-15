<?php
/**
 * bootstrap
 */
class Y_B extends Yaf_Bootstrap_Abstract  {
  public function _initHook() {
    Y::registerPlugin( 'Hook' );
  }
  public function _initRoute( Yaf_Dispatcher $dispatcher ) {
  	if (Y::get( "config" )->routes) {
  		Y::addConfig( Y::get( "config" )->routes );
  	}
  }
}
