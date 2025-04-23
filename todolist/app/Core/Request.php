<?php 

namespace App\Core;

class Request {
  // GET URI
  public static function uri() {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . $uri;
    $uri = str_replace(home(),"",$uri);
    return trim($uri,"/");
    }
  // GET REQUEST GET OR POST
  public static function get($kay, $default = null) {
    return $_GET[$kay] ?? $_POST[$kay] ?? $default; 
  }
  // GET METHOD
  public static function method() {
    return strtolower($_SERVER['REQUEST_METHOD']); 
  }
}