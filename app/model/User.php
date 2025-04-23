<?php

namespace App\Model;
use App\Model\Model;

class User extends Model {
  protected $fillable = ['name', 'username', 'email', 'password'];
}