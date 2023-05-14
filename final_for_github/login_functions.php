<?php
require_once 'model/database.php';
// checks if any field is empty
function emptyInputSignup($name, $email, $password, $passwordRepeat){
  if(empty($name) || empty($email) || empty($password) || empty($passwordRepeat)){
    $result = true;
  } else{
    $result = false;
  }
  return $result;
}
// checks for a valid username
function invalidUsername($name){
  if(!preg_match("/^[a-zA-Z0-9]*$/", $name)){
    $result = true;
  } else{
    $result = false;
  }
  return $result;
}
// checks for a valid email
function invalidEmail($email){
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $result = true;
  } else{
    $result = false;
  }
  return $result;
}
// check for matching passwords
function passwordMatch($password, $passwordRepeat){
  if($password !== $passwordRepeat){
    $result = true;
  } else{
    $result = false;
  }
  return $result;
}
// check if username exists
function usernameExists($db, $username, $email){
  $username_q = $db->quote($username);
  $email_q = $db->quote($email);

  $sql = "SELECT * FROM login WHERE username = $username_q OR email = $email_q;";
  if(!$stmt = $db->prepare($sql)){
    header('location: ./login.php?error=statementfailed');
  }
  $stmt->execute();
  if($result = $stmt->fetch()){
    $stmt->closeCursor();
    return $result;
  } else{
    $stmt->closeCursor();
    return false;
  }
}
// create user
function createUser($db, $username, $email, $password){
  $username_q = $db->quote($username);
  $email_q = $db->quote($email);
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  $hashed_password_q = $db->quote($hashedPassword);

  $sql = "INSERT INTO login (username, email, password) 
          VALUES ($username_q, $email_q, $hashed_password_q);";
  if(!$stmt = $db->prepare($sql)){
    header('location: ./login.php?error=statementfailed');
  }
  $stmt->execute();
  $stmt->closeCursor();
  header('location: ./login.php?error=none');
  exit();
}
// check for empty input
function emptyInputLogin($username, $password){
  if(empty($username) || empty($password)){
    $result = true;
  } else{
    $result = false;
  }
  return $result;
}
// login user
function loginUser($db, $name, $password){
  $usernameExists = usernameExists($db, $name, $name);

  if($usernameExists === false){
    header("location: ./login.php?error=wronglogin");
    exit();
  }

  $passwordHashed = $usernameExists["password"];
  $checkPassword = password_verify($password, $passwordHashed);
  
  if($checkPassword === false){
    header("location: ./login.php?error=incorrectpassword");
    exit();
  } else if($checkPassword === true){
    session_start();
    $_SESSION["userid"] = $usernameExists["id"];
    $_SESSION["username"] = $usernameExists["username"];
    header("location: ./portfolio.php");
    exit();
  }
}