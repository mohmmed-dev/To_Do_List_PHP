<?php

use App\Core\Sessions;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>To Do List</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap");
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
      }
      .errSpan {
          color: rgb(229, 57, 53);
          margin: 2px;
          display: block;
        }
      body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        padding: 10px;
        background: #00838f;
        overflow: hidden;
      }
      .wrapper {
        max-width: 500px;
        width: 100%;
        background: #fff;
        border-radius: 5px;
        box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.1);
      }
      .wrapper .title {
        padding: 30px 0 20px;
        background: #00838f;
        border-radius: 5px 5px 0 0;
        color: #fff;
        font-size: 30px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .wrapper form {
        padding: 10px 20px;
      }
      .wrapper form .row {
        margin-top: 5px;
        position: relative;
      }
      .wrapper form .row h4{
        color:rgb(0, 73, 80);
      }
      .wrapper form .row input {
        padding: 8px;
        width: 100%;
        outline: none;
        margin: 5px 0;
        display: block;
        border-radius: 5px;
        border: 1px solid lightgrey;
        transition: all 0.3s ease;
      }
      form .row input:focus {
        border-color:  #00838f;
      }
      form .row input::placeholder {
        color: #999;
      }
      .wrapper form .pass {
        margin-top: 5px;
      }
      .wrapper form .pass a {
        color:  #00838f;
        font-size: 17px;
        text-decoration: none;
      }
      .wrapper form .pass a:hover {
        text-decoration: underline;
      }
      .wrapper form .button input {
        margin-top: 10px;
        color: #fff;
        font-size: 20px;
        font-weight: 500;
        padding-left: 0px;
        background:  #00838f;
        border: 1px solid  #00838f;
        cursor: pointer;
      }
      form .button input:hover {
        background:rgb(0, 104, 114);
      }
      .wrapper form .signup-link {
        text-align: center;
        margin-top: 20px;
        font-size: 17px;
      }
      .wrapper form .signup-link a {
        color:  #00838f;
        text-decoration: none;
      }
      form .signup-link a:hover {
        text-decoration: underline;
      }
  </style>
  <!-- Font Awesome CDN link for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body>
  <div class="wrapper">
    <div class="title"><span>Register Form</span></div>
    <form action="register" method="POST">
      <div class="row">
        <h4>Name</h4>
        <input type="text" name="name" placeholder="Name"  />
        <span class="errSpan"><?=  Sessions::getErr('name')  ?></span>
      </div>
      <div class="row">
        <h4>User Name</h4>
        <input type="text" name="username" placeholder="UserName"  />
        <span class="errSpan"><?=  Sessions::getErr('username')  ?></span>
      </div>
      <div class="row">
        <h4>Email</h4>
        <input type="text" name="email" placeholder="Email"  />
        <span class="errSpan"><?=  Sessions::getErr('email')  ?></span>
      </div>
      <div class="row">
        <h4>Password</h4>
        <input type="password" name="password" placeholder="Password"  />
        <span class="errSpan"><?=  Sessions::getErr('password')  ?></span>
      </div>
      <div class="row">
        <h4>Password Conform</h4>
        <input type="password" name="password_conform" placeholder="Password Conform"  />
        <span class="errSpan"><?=  Sessions::getErr('password')  ?></span>
      </div>
      <div class="row button">
        <input type="submit" value="Login" />
      </div>
      <div class="signup-link">I Have Account? <a href="login">Log In</a></div>
    </form>
  </div>
</body>
</html>