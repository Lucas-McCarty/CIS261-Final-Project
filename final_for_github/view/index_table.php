<?php
// if the session variable is not set create it
if(!isset($_SESSION['index'])){
  // retrieve index data using function
  $stockData = getIndexData();
  $sp = $stockData["S&P500"];
  $dji = $stockData["DJI"];
  $nasdaq = $stockData["NASDAQ"];

  //set session variable
  $_SESSION['index'] = [
    'sp' => [
      'price' => $sp["Price"],
      'change' => $sp["PriceChange"],
      'percent' => $sp["PercentChange"]
    ],
    'dji' => [
      'price' => $dji["Price"],
      'change' => $dji["PriceChange"],
      'percent' => $dji["PercentChange"]
    ],
    'nasdaq' => [
      'price' => $nasdaq["Price"],
      'change' => $nasdaq["PriceChange"],
      'percent' => $nasdaq["PercentChange"]
    ]
  ];
}
// format variables for display
//S&P 500 Data
$sp_price = sprintf("%0.2f", $_SESSION['index']['sp']['price']); 
$sp_change = sprintf("%0.2f", $_SESSION['index']['sp']['change']);
$sp_percent = sprintf("%0.2f", $_SESSION['index']['sp']['percent']);
//Dow Jones Data
$dji_price = sprintf("%0.2f", $_SESSION['index']['dji']['price']);
$dji_change = sprintf("%0.2f", $_SESSION['index']['dji']['change']);
$dji_percent = sprintf("%0.2f", $_SESSION['index']['dji']['percent']);
//Nasdaq Data
$nasdaq_price = sprintf("%0.2f", $_SESSION['index']['nasdaq']['price']);
$nasdaq_change = sprintf("%0.2f", $_SESSION['index']['nasdaq']['change']);
$nasdaq_percent = sprintf("%0.2f", $_SESSION['index']['nasdaq']['percent']);
?>
<!-- Table with information on stock indexes -->
<main id="index-main">
  <table>
    <tr>
        <th>Index</th>
        <th>Price</th>
        <th>Day Change($)</th>
        <th>Day Change(%)</th>
      </tr>
      <tr>
        <td>S&P 500</td>
        <td><?php echo $sp_price ?></td>
        <td><?php echo $sp_change ?></td>
        <td><?php echo $sp_percent ?></td>
      </tr>
      <tr>
        <td>Nasdaq</td>
        <td><?php echo $nasdaq_price ?></td>
        <td><?php echo $nasdaq_change ?></td>
        <td><?php echo $nasdaq_percent ?></td>
      </tr>
      <tr>
        <td>Dow Jones</td>
        <td><?php echo $dji_price ?></td>
        <td><?php echo $dji_change ?></td>
        <td><?php echo $dji_percent ?></td>
      </tr>
  </table>
</main>