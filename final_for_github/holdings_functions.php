<?php
require_once 'model/database.php';
// create holdings
function createHoldings($db, $userid, $symbol, $cost_per_share, $shares){
  if(!holdingExists($db, $userid, $symbol)){
    $userid_q = $db->quote($userid);
    $symbol_q = $db->quote($symbol);
    $cps_q = $db->quote($cost_per_share);
    $shares_q = $db->quote($shares);

    $sql = "INSERT INTO holdings (userid, symbol, cost_per_share, shares) 
            VALUES($userid_q, $symbol_q, $cps_q, $shares_q);";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $stmt->closeCursor();  
    header('location: ./portfolio.php');
    exit();
  } else{
    header("location: ./edit_holding.php?error=holdingexists");
    exit();
  }
}
//check if the holding already exists
function holdingExists($db, $userid, $symbol){
  $userid_q = $db->quote($userid);
  $symbol_q = $db->quote($symbol);

  $sql = "SELECT * FROM holdings WHERE userid = $userid_q AND symbol = $symbol_q;";
  if(!$stmt = $db->prepare($sql)){
    header('location: ./add_holding.php?error=statementfailed');
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
// get user holdings
function getHoldings($db, $userid){
  $userid_q = $db->quote($userid);

  $sql = "SELECT symbol, cost_per_share, shares FROM holdings WHERE userid = $userid_q;";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $holdings = $stmt->fetchAll();
  $stmt->closeCursor();  
  return $holdings;
}
// get the number of user holdings
function getNumHoldings($db, $userid){
  $userid_q = $db->quote($userid);

  $sql = "SELECT symbol FROM holdings WHERE userid = $userid_q;";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $num_holdings = $stmt->rowCount();
  $stmt->closeCursor();  
  return $num_holdings;
}
// edit user holdings
function editHolding($db, $userid, $symbol, $cost_per_share, $shares){
    $userid_q = $db->quote($userid);
    $symbol_q = $db->quote($symbol);
    $cps_q = $db->quote($cost_per_share);
    $shares_q = $db->quote($shares);

    $sql = "UPDATE holdings 
    SET cost_per_share = $cps_q, shares = $shares_q 
    WHERE userid = $userid_q AND symbol = $symbol_q;";

    $stmt = $db->prepare($sql);
    $stmt->execute();
    $stmt->closeCursor();
    header('location: ./portfolio.php');
    exit();
}
// delete holding
function deleteHolding($db, $userid, $symbol){
  $userid_q = $db->quote($userid);
  $symbol_q = $db->quote($symbol);

  $sql = "DELETE FROM holdings WHERE userid = $userid_q AND symbol = $symbol_q;";

  $stmt = $db->prepare($sql);
  $stmt->execute();
  $stmt->closeCursor();
  header('location: ./portfolio.php');
  exit();
}