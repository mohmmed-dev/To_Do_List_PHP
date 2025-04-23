<?php

namespace App\Controllers;


use App\Core\Hash;
use App\Core\Request;
use App\Core\Validation;
use App\Model\Session;
use App\Model\User;

class  LoginController {

  public function loginView() {
    return view('users.login');
  }

  public function login() {
    $user = new User(); 
    $session = new Session(); 
    $data = [
        'email' => Request::get('email'),
        'password' => Request::get('password'),
      ];
      $roles = [
        'email' => ['required' , 'email'],
        'password' => ['required'],
      ];
      $data = Validation::make($data,$roles);
      
      $email = $data["email"];
      $password = $data["password"];
      $user = $user->where('email','=',$email);
      if(count($user) == 1 && Hash::check($password,$user[0]->password)) {
        $user = $user[0];
        $session->createSession($user->id);
      }
      return redirect('filter');
  }

  public function logout() {
    if(!empty(auth())) {
      $session = new Session(); 
      $session->deleteSession('token' , $_COOKIE['user_token']);
      setcookie('user_token' , '', time() - 3600, '/');
    }
    return back();
  }
}