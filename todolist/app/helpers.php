<?php

use App\App;
use App\Model\Session;

function home() {
  return trim(App::get('config')['app']['home_url'] , '/');
}

function redirect($to) {
  header("location: {$to}");
}

function redirect_home($to) {
  redirect(home());
}

function back() {
  redirect($_SERVER["HTTP_REFERER"] ?? home());
}

function view($name,$data = []) {
  extract($data);
  $name = str_replace('.',"/",$name);
  require "./views/{$name}.php";
}

function auth() {
    if(isset($_COOKIE['user_token'])) {
      $session = new Session();
      $user = $session->getUserByToken($_COOKIE['user_token']);
      return $user;
    }
    return null;
}