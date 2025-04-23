<?php

namespace App\Model;
use App\Model\Model;

class Session extends Model {
  protected $fillable = ['user_id', 'token', 'email'];

  public function createSession($user_id) {
    $this->deleteSession('user_id',$user_id);
    $token = bin2hex(random_bytes(16));
    $this->create(['user_id' => $user_id , 'token' => $token]);
    setcookie('user_token', $token, time() + (86400 * 1), '/');
  }

  public function deleteSession($table , $value) {
    $hasSession = $this->where($table, '=', $value);
    if(count($hasSession) > 0) {
      $this->delete($hasSession[0]->id);
    }
  }

  public function getUserByToken($token) {
    $token = $this->where('token', '=', "$token");
    if(count($token) > 0) {
      $user = (new User())->find($token[0]->user_id);
      return reset($user);
    }
  }
}