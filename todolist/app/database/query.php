<?php 
namespace App\Database;

class QUE {
  private static $pdo;
  private static $log;
  public static function make(\PDO $pdo,$log = null) {
  self::$pdo = $pdo;
  self::$log = $log;
  }
  public static function get($table, $where = null,$select = '*') {
    $querySet = "SELECT {$select} FROM  {$table} ";
    if(is_array($where)) {
      $querySet .=  "WHERE " . implode(" ", $where) ;
      } 
    $query = self::$pdo->prepare($querySet);
    $query->execute();
    self::execute($querySet);
    return $query->fetchAll(\PDO::FETCH_OBJ);
  }
  public static function insert($table , $data) {
    $field = array_keys($data);
    $fieldStr = implode(',', $field);
    var_dump($fieldStr);
    $str = str_repeat('?,',count($field) -1 ) . '?';
    $query = "INSERT INTO {$table} ({$fieldStr}) VALUES ({$str})";
    self::execute($query ,array_values($data));
  }
  public static function updata($table , $id ,$data){
    $field = implode('= ?, ', array_keys($data)) . " = ? ";
    $values = array_values($data);
    $query = "UPDATE {$table} SET {$field} WHERE id = {$id}";
    self::execute($query ,$values);
  }
  public static function delete($table,$id,$culm = 'id',$operator = '=') {
    $query = "DELETE FROM $table WHERE $culm $operator $id";
    self::execute($query);
  }
  private static function execute($query,$values = []) {
    if(self::$log) {
      self::$log->info($query);
    }
      $statement = self::$pdo->prepare($query);
    $statement->execute($values);
    return  $statement;
  }
}