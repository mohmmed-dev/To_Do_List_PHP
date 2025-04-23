<?php

namespace App\Core;


class Router {
  private $get = [];
  private $post = [];
  // MAKE NEW SELF OBJ
  public static function make() {
  $router = new self;
  return $router;
  }
  // ADD ARR GET
  public function get($uri, $action)  {
    $this->get[$uri] = $action;
    return $this;
  }
  // ADD ARR POST
  public function post($uri, $action)  {
    $this->post[$uri] = $action;
    return $this;
  }
  // GO tO THE PAGE
  public function resolve($uri,$method) {
    if(array_key_exists($uri,$this->{$method})) {
    $action = $this->{$method}[$uri];
    $this->callAction(...$action);
    } else {
    echo '<h1>404</h1>';
    return ;
    }
  }
  private function callAction($controller ,$action) {
    $controller = new $controller;
    $controller->{$action}();
  } 
}