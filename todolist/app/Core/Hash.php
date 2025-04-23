<?php

namespace App\Core;

class Hash {

  public static function make($password) {
    return password_hash($password,PASSWORD_BCRYPT);
  }

  public static function check($password , $hash_password) {
    return password_verify($password,$hash_password);
  }
}