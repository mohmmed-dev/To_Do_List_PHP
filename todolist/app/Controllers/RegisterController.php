<?php

namespace App\Controllers;


use App\Core\Hash;
use App\Core\Request;
use App\Core\Validation;
use App\Model\Session;
use App\Model\User;

class RegisterController {

  public function registerView() {
    return view('users.register');
  }

  public function registering() {
      $data = [
        'name' => Request::get('name'),
        'username' => Request::get('username'),
        'email' => Request::get('email'),
        'password' => Request::get('password'),
      ];
      $roles = [
        'name' => ['required' , 'string'],
        'username' => ['required' , 'string', 'character', 'unique:users:username'],
        'email' => ['required' , 'email','unique:users:email'],
        'password' => ['required' ,'min:8','password'],
      ];

      $data = Validation::make($data,$roles);

      $data['password'] = Hash::make($data['password']);
      $user = new User();
      $user->create($data);
      return redirect('filter');;
  }

}