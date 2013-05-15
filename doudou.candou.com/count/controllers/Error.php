<?php
class ErrorController extends Yaf_Controller_Abstract {

  public function errorAction( $exception ) {
Y::disableView();
  echo "Errot.php";
    Y::dump($exception);
  }
  public function error404Action() {
Y::disableView();
  //echo "bbbbbb";
  Y::dump(Y::pathinfo());
    Y::dump('404_index');
  }
}
