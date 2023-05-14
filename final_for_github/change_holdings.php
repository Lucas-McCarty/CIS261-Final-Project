<?php
require_once 'model/database.php';
include_once('holdings_functions.php');
// depending on what the post variable is set to send the user to a certain location
// or use a function
if(isset($_POST['add'])){    
  header("location: ./add_holding.php");
} 
else if(isset($_POST['edit'])){
  header("location: ./edit_holding.php");
}
else if(isset($_POST['added'])){
  session_start();
  createHoldings($db, $_SESSION['userid'],$_POST['ticker'],$_POST['cps'],$_POST['shares']);
}
else if(isset($_POST['edited'])){
  session_start();
  editHolding($db, $_SESSION['userid'],$_POST['ticker'],$_POST['cps'],$_POST['shares']);
}
else if(isset($_POST['delete'])){
  session_start();
  deleteHolding($db, $_SESSION['userid'], $_POST['ticker']);
}
else if(isset($_POST['cancel'])){
  header("location: ./portfolio.php");
}