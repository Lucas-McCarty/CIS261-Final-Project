<?php
// logout a user
  session_start();
  session_unset();
  session_destroy();
  header("location: ./login.php");
  exit();