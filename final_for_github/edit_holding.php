<?php include('view/header.php'); ?>
<?php 
require_once 'model/database.php';
include_once 'holdings_functions.php';
// get user holdings
if(isset($_SESSION['userid'])){
  $numHoldings = getNumHoldings($db, $_SESSION['userid']);
  $holdings = getHoldings($db, $_SESSION['userid']);
}
?>
<?php include('view/navbar.php'); ?>
<!-- Form to change holdings -->
<section class="change-holdings-form">
  <form action="change_holdings.php" method="post" class="change-holdings-body">
    <h2>Edit Holding</h2>
    <div class="form-group">
      <label class="input-label"  for="ticker">Ticker Symbol</label>
      <select class="form-input" name="ticker">
        <!-- Options for select come from user holdings -->
        <?php for($x = 0; $x < $numHoldings; $x++){
          echo "<option value=".$holdings[$x]['symbol'].">".$holdings[$x]['symbol']."</option>";
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label class="input-label" for="shares">Shares</label>
      <input class="form-input" type="text" name="shares">
    </div>
    <div class="form-group">
      <label class="input-label"  for="cps">Cost Per Share</label>
      <input class="form-input" type="text" name="cps">
    </div>
    <!-- Submit buttongs to edit, delete, or cancel -->
    <div class="change-holdings-buttons">
      <input type="submit" name="edited" value="Submit">
      <input type="submit" name="delete" value="Delete">
      <input type="submit" name="cancel" value="Cancel">
    </div>
  </form>
</section>
<?php include('view/footer.php'); ?>