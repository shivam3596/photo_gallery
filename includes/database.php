<?php

define("PATH_ROOT", dirname(__FILE__));
require_once PATH_ROOT . "/config.php";

class Mysqldatabase{
  private $connection;

  function __construct(){
    $this->open_connection();
  }

  public function open_connection(){
    $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
    if (mysqli_connect_errno()) {
      die("database connection failed: " . mysqli_connect_errno());
    }
  }

  public function close_connection(){
    if(isset($this->connection)){
      mysqli_close($this->connection);
      unset($this->connection);
    }
  }

  public function query($sql){
    $result = mysqli_query($this->connection, $sql);
    $this->confirm_query($result);
    return $result;
  }

  private function confirm_query($result){
    if (!$result) {
      die("database query failed");
    }
  }

  public function escape_value($string){
    $escaped_string = mysqli_escape_string($this->connection, $string);
    return $escaped_string;
  }

  //database nutural functions
  public function fetch_array($result_set){
    return mysqli_fetch_array($result_set);
  }

  public function num_rows($result_set){
    return mysqli_num_rows($result_set);
  }

  public function insert_id(){
    return mysqli_insert_id($this->connection);
  }

  public function affected_rows(){
    return mysqli_affected_rows($this->connection);
  }
  
}

$database = new Mysqldatabase();

?>
