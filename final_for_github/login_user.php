<?php
include_once('login_functions.php');

// checks post values and logs in user
if(isset($_POST['submit'])){    
  $name = $_POST['username'];
  $password = $_POST['password'];

  require_once 'model/database.php';
  require_once 'login_functions.php';

  if(emptyInputLogin($name, $password) !== false){
    header("location: ./login.php?error=emptyinput");
    exit();
  }
  // if no errors log in
  loginUser($db, $name, $password);
} else{
  header("location: ./login.php");
  exit();
}