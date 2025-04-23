<?php

namespace App\Model;

use App\Database\QUE;

class Model {
  protected $table;
  protected $fillable = [];

  public function __construct($table = null) {
    $this->table = $table ?? get_class($this);
    $arr = explode("\\" , strtolower($this->table));
    $this->table = end($arr) . 's';
  }

  public function all() {
    return QUE::get($this->table);
  }

  public function find($id) {
    return QUE::get($this->table, ['id', '=', $id]);
  }
  
  public function create($data) {
    $data = array_intersect_key($data, array_flip($this->fillable));
    return QUE::insert($this->table, $data);
  } 
  
  public function update($id, $data) {
    $data = array_intersect_key($data, array_flip($this->fillable));
    return QUE::updata($this->table, $id, $data);
  }
  
  public function delete($id) {
    return QUE::delete($this->table, $id);
  }

  public function where($column, $operator, $value) {
    return QUE::get($this->table, [$column, $operator, "'$value'"]);
  }
  
  public function whereIn($column, $values) {
    return QUE::get($this->table, [$column, 'IN', "'$values'"]);
  } 
}