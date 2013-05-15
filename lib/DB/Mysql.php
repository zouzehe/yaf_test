<?php
/**
 *
 */
class DB_Mysql extends DB_Abstract {
  /**
   * Connect to MySQL
   *
   * @return resource connection
   */
  protected function _connect($params) {
    if (!extension_loaded('mysql')) {
      throw new Yaf_Exception('Can not find mysql extension.');
    }

    if ($params['persistent']){
      $connection = @mysql_pconnect(
              $params['host'] . ':' . $params['port'], $params['username'], $params['password'],  MYSQL_CLIENT_COMPRESS
      );
    } else {
      $connection = @mysql_connect(
              $params['host'] . ':' . $params['port'], $params['username'], $params['password'], true, MYSQL_CLIENT_COMPRESS
      );

    }
    if (is_resource($connection) && mysql_select_db($params['dbname'], $connection)) {
      $this->_connection = $connection;
        $this->query("SET NAMES '{$params['charset']}';");
        return $this->_connection;
      }

      try {
        throw new Yaf_Exception($this->error());
      } catch (Yaf_Exception $e) {
        CD::log($e->getMessage(), __FILE__ . ':' . __LINE__);
    }
  }
  /**
   * Select Database
   *
   * @param string $database
   * @return boolean
   */
  public function selectDb($database) {
    return mysql_select_db($database, $this->_connection);
  }
  /**
   * Close mysql connection
   *
   */
  public function close() {
    if (is_resource($this->_connection)) {
      mysql_close($this->_connection);
    }
  }
  /**
   * Free result
   *
   */
  public function free() {
    mysql_free_result($this->_query);
  }
  /**
   * Query sql
   *
   * @param string $sql
   * @return DB_Mysql
   */
  public function query($sql) {
    $this->_lastSql = $sql;


    try {
      if ($this->_query = @mysql_query($sql, $this->_connection)) {
        return $this;
      }
      else {
        throw new Yaf_Exception($this->error());
      }
    } catch (Yaf_Exception $e) {
      CD::log('sql:' . $sql . ':' . $e->getMessage(), __FILE__ . ':' . __LINE__);
    }
  }

  public function exe($sql) {

    try {
      if ($result = @mysql_query($sql, $this->_connection)) {
        return $result;
      }
      else {
        throw new Yaf_Exception($this->error());
      }
    } catch (Yaf_Exception $e) {
      CD::log('sql:' . $sql . ':' . $e->getMessage(), __FILE__ . ':' . __LINE__);
    }
  }
  /**
   * Return the rows affected of the last sql
   *
   * @return int
   */
  public function affectedRows() {
    return mysql_affected_rows($this->_connection);
  }
  /**
   * Fetch one row result
   *
   * @param string $type
   * @return mixd
   */
  public function fetch($type = 'ASSOC') {
    $type = strtoupper($type);

    switch ($type) {
      case 'ASSOC':
        $func = 'mysql_fetch_assoc';
        break;
      case 'NUM':
        $func = 'mysql_fetch_array';
        break;
      case 'OBJECT':
        $func = 'mysql_fetch_object';
        break;
      default:
        $func = 'mysql_fetch_assoc';
    }

    return $func($this->_query);
  }
  /**
   * Fetch All result
   *
   * @param string $type
   * @return array
   */
  public function fetchAll($type = 'ASSOC') {
    switch ($type) {
      case 'ASSOC':
        $func = 'mysql_fetch_assoc';
        break;
      case 'NUM':
        $func = 'mysql_fetch_array';
        break;
      case 'OBJECT':
        $func = 'mysql_fetch_object';
        break;
      default:
        $func = 'mysql_fetch_assoc';
    }
    $result = array();
    while ($row = $func($this->_query)) {
      $result[] = $row;
    }
    mysql_free_result($this->_query);
    return $result;
  }
  /**
   * Get last insert id
   *
   * @return int
   */
  public function lastInsertId() {
    return mysql_insert_id($this->_connection);
  }
  /**
   * Beging transaction
   *
   */
  public function beginTransaction() {
    mysql_query('START TRANSACTION', $this->_connection);
  }
  /**
   * Commit transaction
   *
   * @return boolean
   */
  public function commit() {
    if ($result = mysql_query('COMMIT', $this->_connection)) {
      return true;
    }

    throw new Yaf_Exception($this->error());
  }
  /**
   * Roll back transaction
   *
   * @return boolean
   */
  public function rollBack() {
    if ($result = mysql_query('ROLLBACK', $this->_connection)) {
      return true;
    }

    throw new Yaf_Exception($this->error());
  }
  /**
   * Escape string
   *
   * @param string $str
   * @return string
   */
  public function escape($str) {
    return mysql_escape_string($str);
  }
  /**
   * Get error
   *
   * @return string|array
   */
  public function error($type = 'STRING') {
    $type = strtoupper($type);

    if (is_resource($this->_connection)) {
      $errno = mysql_errno($this->_connection);
      $error = mysql_error($this->_connection);
    }
    else {
      $errno = mysql_errno();
      $error = mysql_error();
    }

    if ('ARRAY' == $type) {
      return array('code' => $errno, 'msg' => $error);
    }
    return $errno . ':' . $error;
  }
}
