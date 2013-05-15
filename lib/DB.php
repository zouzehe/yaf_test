<?php
class DB {
  public static function factory($config) {

    $config = $config->toArray();


    if (isset($config['ms']) && ($config['ms'] == 'masterslave')) {

      return new DB_Masterslave($config);
    }
    $class = 'DB_' . ucfirst($config['adapter']);
    return new $class($config);
  }
}