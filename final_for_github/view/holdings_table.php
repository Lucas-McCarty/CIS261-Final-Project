<?php
require_once 'model/database.php';
include_once 'holdings_functions.php';
include_once 'script.php';
if(isset($_SESSION['userid'])){
  $numHoldings = getNumHoldings($db, $_SESSION['userid']);
  $holdings = getHoldings($db, $_SESSION['userid']);
}
?>
<!-- Table displays the holdings of the users -->
<main id="holdings-main">
  <?php if(isset($_SESSION['userid'])): ?>
    <p><?php echo $_SESSION['username'] . "'s holdings"; ?></p>
  <table>
    <!-- Table headings -->
    <tr>
      <th class="table-headings">Name</th>               <!-- Full company vame -->
      <th class="table-headings">Symbol</th>             <!-- Ticker symbol -->
      <th class="table-headings">Price</th>              <!-- Current stock price-->
      <th class="table-headings">Day Change</th>         <!-- Price change day -->
      <th class="table-headings">Quantity</th>           <!-- Number of shares -->
      <th class="table-headings">Value</th>              <!-- Total value of all shares -->
      <th class="table-headings">Cost Basis</th>         <!-- Total cost to purchase shares -->
      <th class="table-headings">Cost Per Share</th>     <!-- Cost per share -->
      <th class="table-headings">Gain/Loss</th>          <!-- Total gain or loss -->
      <th class="table-headings">Dividend Yield</th>     <!-- Dividend yield -->
      <th class="table-headings">Dividend Per Share</th> <!-- Dividend per share per payout -->
      <th class="table-headings">Total Dividend</th>     <!-- Total dividend per payout -->
    </tr>
    <!-- Display all table rows -->
    <?php for($x=0; $x < $numHoldings; $x++): ?>
      <?php 
        // assign variables using functions and apis
        $ticker = $holdings[$x]['symbol'];
        $shares = $holdings[$x]['shares'];
        $cps = $holdings[$x]['cost_per_share'];
        $companyName = getCompanyNameFromTicker($ticker);
        $info = getCurrentStockDataAV($ticker);
        $data = getCurrentStockDataSA($ticker);
      ?>
      <tr>    
        <?php if(!empty($companyName["name"])) : ?>
          <?php echo "<th class='table-body'>".$companyName["name"]."</th>"; ?> 
        <?php else: ?>
          <?php echo "<th class='table-body'>".$companyName["companyName"]."</th>"; ?> 
        <?php endif; ?></th>
        <th class='table-body'>          
          <?php echo $ticker; ?> 
        </th>
        <th class='table-body'>
          <?php echo "$" . sprintf("%0.2f",$info['price']); ?>
        </th>
        <th class='table-body'>
          <?php echo "$" . sprintf("%0.2f",$info['change']); ?>
        </th>
        <th class='table-body'>
          <?php echo sprintf("%0.2f",$shares); ?> 
        </th>
        <th class='table-body'>
          <?php echo "$" . sprintf("%0.2f",$info['price']*$shares); ?>
        </th>
        <th class='table-body'>
          <?php echo "$" . sprintf("%0.2f",$cps*$shares); ?>
        </th>
        <th class='table-body'>
          <?php echo "$" . sprintf("%0.2f",$cps); ?> 
        </th>
        <th class='table-body'>
          <?php echo "$" . sprintf("%0.2f",($info['price']*$shares)-($cps*$shares)); ?>
        </th>
        <th class='table-body'>
          <?php echo sprintf("%0.2f",$data['divYield'])."%";?>
        </th>
        <th class='table-body'>
          <?php  echo "$" . sprintf("%0.2f",$data['divRate']);?>
        </th>
        <th class='table-body'>
          <?php  echo "$" . sprintf("%0.2f",$data['divRate']*$shares);?>
        </th>
      </tr>
    <?php endfor; ?>
  </table>
  <!-- Buttons to add or edit holdings -->
  <form id="holdings-buttons" action="./change_holdings.php" method="POST">
    <input type="submit" name="add" value="Add Holding">
    <input type="submit"  name="edit" value="Edit Holding">
  </form>
  <!-- Redirect to login if not logged in -->
  <?php else: ?>
    <?php
    header("location: ./login.php?error=notloggedin");
    ?>
  <?php endif ?>
  
</main>