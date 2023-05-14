<?php

  include_once('login_functions.php');

  // validate the post input and either create the user or redirect with an error
  if(isset($_POST['submit'])){
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['repeat'];

    require_once 'model/database.php';
    require_once 'login_functions.php';

    if(emptyInputSignup($name, $email, $password, $passwordRepeat) !== false){
      header("location: ./login.php?error=emptyinput");
      exit();
    }
    if(invalidUsername($name) !== false){
      header("location: ./login.php?error=invalidusername");
      exit();
    }
    if(invalidEmail($email) !== false){
      header("location: ./login.php?error=invalidemail");
      exit();
    }
    if(passwordMatch($password, $passwordRepeat) !== false){
      header("location: ./login.php?error=passwordsdonotmatch");
      exit();
    }
    if(usernameExists($db, $name, $email) !== false){
      header("location: ./login.php?error=usernametaken");
      exit();
    }
    createUser($db, $name, $email, $password);
  } else{
    header("location : ./login.php");
  }