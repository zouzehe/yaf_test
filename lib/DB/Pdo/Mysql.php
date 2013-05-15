<?php
/**
 *
 */
class DB_Pdo_Mysql extends DB_Pdo_Abstract {
  protected function _dsn() {
    return "mysql:host=" . $this->_config['host'] . ";port=" . $this->_config['port'] . ";dbname=" . $this->_config['dbname'];
  }
}