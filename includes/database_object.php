<?php

require_once PATH_ROOT . "/database.php";

class DatabaseObject{

  protected static $table_name="users";

  public static function find_all(){
    global $database;
    return self::find_by_sql("SELECT * FROM ".static::$table_name);
  }

  public static function find_by_id($id=0){
    global $database;
    $result_array = self::find_by_sql("SELECT * FROM ".static::$table_name." WHERE id={$database->escape_value($id)} LIMIT 1");
    return !empty($result_array) ? array_shift($result_array) : false;
  }

  public static function find_by_sql($sql=""){
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }

  public static function count_all(){
    global $database;
    $sql = "SELECT COUNT(*) FROM photographs ";
    $result_set = $database->query($sql);
    $row = $database->fetch_array($result_set);
    return array_shift($row);
  }

  private static function instantiate($record){
    $class_name = get_called_class();
    $object = new $class_name;
    foreach ($record as $attribute=> $value) {
      if ($object->has_attribute($attribute)) {
        $object->$attribute = $value;
      }
    }
    return $object;
  }

  private function has_attribute($attribute){
    $object_vars = get_object_vars($this);
    return array_key_exists($attribute,$object_vars);
  }

}

?>
