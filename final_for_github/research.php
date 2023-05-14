<?php 
  // create variables from functions
  include('script.php');
  $stock = $_GET["search_value"];
  $info = getCurrentStockDataAV($stock);
  $data = getCurrentStockDataSA($stock);
  $companyName = getCompanyNameFromTicker($stock);
?>
<?php include('view/header.php'); ?>
<?php include('view/navbar.php'); ?>

<!-- Research page -->
<main id="research-main">
  <section>
    <!-- Display company name -->
    <div class="research-name">
      <?php if(!empty($companyName["name"])) : ?>
        <?php echo $info['symbol']." : ".$companyName["name"]; ?> 
      <?php else : ?>
        <?php echo $info['symbol']." : ".$companyName["name"]; ?> 
      <?php endif ?>
  </div>
  </section>
  <br>
  <section>
    <!-- Display price change in percent and dollar amount -->
    <div class="research-price"><?php echo sprintf("%0.2f",$info['price']); ?></div>
    <div class="research-change"><?php echo sprintf("%0.2f", $info['change'])." : ".sprintf("%0.2f",$info['change_percent'])."%"; ?></div>
  </section>
  <br>
  <br>
  <section class="research-information">
    <!-- Display financial and stock data -->
      <?php if(!empty($data['marketCap'])) : ?>
              <?php if($data['marketCap'] > 1000000000000) : ?>
                <?php $num = $data['marketCap'] / 1000000000000; ?>
                <div>Market Cap: <?php echo sprintf("%0.2f",$num)."T"; ?></div>
              <?php elseif($data['marketCap'] > 1000000000) : ?>
                <?php $num = $data['marketCap'] / 1000000000; ?>
                <div>Market Cap: <?php echo sprintf("%0.2f",$num)."B"; ?></div>
              <?php elseif($data['marketCap'] > 1000000) : ?>
                <?php $num = $data['marketCap'] / 1000000; ?>
                <div>Market Cap: <?php echo sprintf("%0.2f",$num)."M"; ?></div>
              <?php endif; ?>              
      <?php endif; ?>
      <?php if(!empty($data['pe_ratio'])) : ?>
              <div>PE Ratio: <?php echo sprintf("%0.2f",$data['pe_ratio']); ?></div>
      <?php endif; ?>
      <?php if(!empty($data['high52'])) : ?>
                <div>52 Week High: 
                  <?php echo sprintf("%0.2f",$data['high52']); ?>
                </div>
        <?php endif; ?>
        <?php if(!empty($data['divYield'])) : ?>
                <div>Dividend Yield: 
                  <?php echo sprintf("%0.2f",$data['divYield'])."%"; ?>
                </div>
        <?php endif; ?>
        <?php if(!empty($data['low52'])) : ?>
                <div>52 Week Low: 
                  <?php echo sprintf("%0.2f",$data['low52']); ?>
                </div>
        <?php endif; ?>
        <?php if(!empty($data['divRate'])) : ?>
                <div>Dividend Amount: 
                  <?php echo sprintf("%0.2f",$data['divRate']); ?>
                </div>
        <?php endif; ?>
        <?php if(!empty($data['eps'])) : ?>
                <div>Earnings Per Share: 
                  <?php echo sprintf("%0.2f",$data['eps']); ?>
                </div>
        <?php endif; ?>
        <?php if(!empty($data['dividendGrowth'])) : ?>
                <div>Years of Dividend Growth: 
                  <?php echo $data['dividendGrowth']; ?>
                </div>
        <?php endif; ?>
        <?php if(!empty($data['payoutRatio'])) : ?>
                <div>Payout Ratio: 
                  <?php echo sprintf("%0.2f",$data['payoutRatio']); ?>
                </div>
        <?php endif; ?>
  </section>
</main>
<?php include('view/footer.php'); ?>