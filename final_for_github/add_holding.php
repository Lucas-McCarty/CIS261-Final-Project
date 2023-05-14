<?php 
include('script.php');
include('view/header.php'); 
include('view/navbar.php'); 
?>
<!-- Form to add holdings -->
<section class="change-holdings-form">
  <form action="change_holdings.php" method="post" class="change-holdings-body">
    <h2>Add Holding</h2>
    <div class="form-group">
      <label class="input-label"  for="ticker">Ticker Symbol</label>
      <input class="form-input" type="text" name="ticker">
    </div>
    <div class="form-group">
      <label class="input-label" for="shares">Shares</label>
      <input class="form-input" type="text" name="shares">
    </div>
    <div class="form-group">
      <label class="input-label"  for="cps">Cost Per Share</label>
      <input class="form-input" type="text" name="cps">
    </div>
<!-- Submit buttongs to add a holding or cancel -->
    <div class="change-holdings-buttons">
      <input type="submit" name="added" value="Submit">
      <input type="submit" name="cancel" value="Cancel">
    </div>
  </form>
</section>
<?php include('view/footer.php'); ?>