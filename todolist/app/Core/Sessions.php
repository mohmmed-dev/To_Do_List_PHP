<?php 

namespace App\Core;

class Sessions {

  // Set Session
  public static function set($name, $value = null) {
    return $_SESSION[$name] = $value; 
  }
  // GET Session
  public static function get($name) {
    return $_SESSION[$name] ?? null; 
  }

  // Set Session Err
  public static function setErr($name, $value = null) {
    return self::set("Err$name" , $value); 
  }
  // GET Session Err
  public static function getErr($name) {
    return self::get("Err$name"); 
  }


}