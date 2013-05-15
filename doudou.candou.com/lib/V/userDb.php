<?php
/**
 * Created by zouzehe.
 * User: Administrator
 * Date: 13-3-21
 * Time: 下午12:27
 *
 */
class V_userDb extends DB_Mysqli{ 
  private static  $instance;
  public static function getInstance(){
      if(is_null(self::$instance)){            
          self::$instance = CD::mysql("game");
      }
      return self::$instance;
  }
   
}
