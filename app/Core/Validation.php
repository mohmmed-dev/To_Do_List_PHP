<?php 

namespace App\Core;
use App\Core\Filters;
use App\Core\Sessions;
use ErrorException;

class Validation {
  protected $validArr;

  public static function make($valueArr,$rolesArr) {
    $filters = new filters(); 
    $roles = self::FiltersValueRoles($valueArr,$rolesArr,$filters);
    $errCount = count(self::makeErrMassage($roles));
    return $errCount  > 0 ? back() . exit : $valueArr ;
  }

  protected static function checkValidationArray($array) {
    foreach($array as $key => $value) {
      $array[$key] = self::StringToArray($value);
    }
    return $array;
  }

  protected static function StringToArray($string) {
    if(!is_array($string)) {
      return $string = explode('|', $string);
    }
    return $string;
  }

  protected static function makeErrMassage($array) {
    $errArr = [];
    foreach($array as $key => $items) {
      foreach($items as $num => $value) {
        if($value !== true) {
          $errArr[$key] =  $value;
          Sessions::setErr($key, $value);
          continue;
        } elseif ($value == true &&  !array_key_exists($key,$errArr) &&  Sessions::getErr($key) != null ) {
          Sessions::setErr($key,null);
        }
      }
    }
    return $errArr;
  }

  protected static function FiltersValueRoles($values,$roles,Filters $filters) {
    $roles = self::checkValidationArray($roles);;
    foreach($roles as $key => $items) {
    if(!array_key_exists($key,$values)) {
      return new ErrorException('The key Name is Not Valet');
    }
    $checkValue = $values[$key];
    $nameKey = $key;
    foreach($items as $key => $value) {
      if(!str_contains($value,':')) {
        $roles[$nameKey][$key] = $filters->{$value}($checkValue);
      } else {
        $valueArr = explode(':' , $value);
        $roles[$nameKey][$key] = $filters->{$valueArr[0]}($checkValue,array_slice($valueArr,1));
      }
    }
  }
    return $roles;
  }



}