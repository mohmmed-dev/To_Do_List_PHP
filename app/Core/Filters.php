<?php 

namespace App\Core;

use App\Database\QUE;

class Filters {

  public function required($value) {
    if(empty($value)) {
      return 'This Input Is Required';
    }
    return true;
  }
  
  public function string($value) {
    if(!is_string($value)) {
      return "This Input Most Be String";
    }
    return true;
  }

  public function numeric($value) {
    if(!is_numeric($value)) {
      return 'This Input Most Be Number';
    }
    return true;
  }

  public function character($value) {
    if(preg_match('/\W/',$value)) {
      return 'This Input Most Be Character Only';
    }
    return true;
  }

  public function email($value) {
    if(!filter_var($value,FILTER_VALIDATE_EMAIL)) {
      return 'This Input Most Be Email';
    }
    return true;
  }

  public function unique($value,$arr) {
    $nameTable = $arr[0];
    $nameColumn = $arr[1];
    $obg = QUE::get($nameTable, [$nameColumn , '=' , "'{$value}'"]);
    if(count($obg) > 0) {
      return 'This Has Use Before '. count($obg);
    }
    return true;
  }

  public function password($value,$name = []) {
    $name = $name[0] ?? 'password';
    $password_conform = Request::get($name."_conform");
    if($value !== $password_conform) {
      return 'This Input Most Be same';
    }
    return true;
  }

  public function min($value,$number) {
    if(strlen($value) < $number[0]) {
      return 'This Input Most Be more Then'. $number[0];
    }
    return true;
  }
}