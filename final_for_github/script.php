<!---------------------
RealStonks (100,000 requests per month)
  Stock Information
    Returns very accurate real-time price and day price change

Seeking Alpha (500 requests per month, 5 requests per second)
  market/get-realtime-quotes
  market/get-day-watch
    top gainers
    top losers
  get-summary
  get-valuation

Alpha Vantage (500 requests per day, 5 requests per minute)
  Quote Endpoint
  Search Endpoint (for search bar functionality)

MS Finance (500 requests per month, 5 requests per second)
  get-summary(For market indicies)
  stock/v2/get-trailing-total-returns

---------------------->
<?php
//alpha vantage
// Used to get the symbol, price, price change($), and price change(%)
//
//
// Must have an api key in place for this variable for the website to work
$GLOBALS['api_key'] = "your rapidApi key";
//
//
function getCurrentStockDataAV($symbol) {
  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://alpha-vantage.p.rapidapi.com/query?function=GLOBAL_QUOTE&symbol=$symbol&datatype=json",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
      "X-RapidAPI-Host: alpha-vantage.p.rapidapi.com",
      "X-RapidAPI-Key: {$GLOBALS['api_key']}"
    ],
  ]);

  $response = curl_exec($curl);

  curl_close($curl);

  $data = json_decode($response, true);
  if (!empty($data['Global Quote'])) {
        $stockData = array(
            'symbol' => $data['Global Quote']['01. symbol'],
            'price' => $data['Global Quote']['05. price'],
            'change' => $data['Global Quote']['09. change'],
            'change_percent' => $data['Global Quote']['10. change percent']
        );
        return $stockData;
    }
    return false;
}
//RealStonks
//Returns price, price change($), and price change(%)
function getCurrentValue($symbol){
  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://realstonks.p.rapidapi.com/$symbol",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
      "X-RapidAPI-Host: realstonks.p.rapidapi.com",
      "X-RapidAPI-Key: {$GLOBALS['api_key']}"
    ],
  ]);

  $response = curl_exec($curl);

  curl_close($curl);

  $data = json_decode($response, true);
  if(!empty($data)){
    $stockData = array(
      "price" => $data["price"],
      "change" => $data["change_point"],
      "change_percent" => $data["change_percentage"]
    );
    return $stockData;
  }
  return false;
}
//Seeking Alpha
//Returns financial data that is used in the portfolio and research pages
function getCurrentStockDataSA($symbol){
  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://seeking-alpha.p.rapidapi.com/symbols/get-summary?symbols=$symbol",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
      "X-RapidAPI-Host: seeking-alpha.p.rapidapi.com",
      "X-RapidAPI-Key: {$GLOBALS['api_key']}"
    ],
  ]);

  $response = curl_exec($curl);

  curl_close($curl);

  $data = json_decode($response, true);
  if(!empty($data["data"])){
    $stockData = array(
      "pe_ratio" => $data["data"][0]["attributes"]["peRatioFwd"],
      "high52" => $data["data"][0]["attributes"]["high52"],
      "low52" => $data["data"][0]["attributes"]["low52"],
      "divRate" => $data["data"][0]["attributes"]["divRate"],
      "divYield" => $data["data"][0]["attributes"]["divYield"],
      "eps" => $data["data"][0]["attributes"]["estimateEps"],
      "marketCap" => $data["data"][0]["attributes"]["marketCap"],
      "dividendGrowth" => $data["data"][0]["attributes"]["dividendGrowth"],
      "payoutRatio" => $data["data"][0]["attributes"]["payoutRatio"]
    );
    return $stockData;
  }
  return false;
}
//Seeking Alpha
//Returns the company's name from the stock ticker
function getCompanyNameFromTicker($symbol){
  
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://seeking-alpha.p.rapidapi.com/symbols/get-meta-data?symbol=$symbol",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: seeking-alpha.p.rapidapi.com",
		"X-RapidAPI-Key: {$GLOBALS['api_key']}"
	],
]);

$response = curl_exec($curl);

curl_close($curl);
$data = json_decode($response, true);
  if(!empty($data["data"])){
    $stockData = array(
      "name" => $data["data"]["attributes"]["company"],
      "companyName" => $data["data"]["attributes"]["companyName"]
    );
    return $stockData;
  }
  return false;

}
//MS Finance
//Returns the day change data from the major stock indexes
function getIndexData(){
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://ms-finance.p.rapidapi.com/market/get-summary",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: ms-finance.p.rapidapi.com",
		"X-RapidAPI-Key: {$GLOBALS['api_key']}"
	],
]);

$response = curl_exec($curl);

curl_close($curl);
$data = json_decode($response, true);
  if(!empty($data["MarketRegions"])){
    $stockData = array(
      "DJI" => $data["MarketRegions"]["USA"][1],
      "S&P500" => $data["MarketRegions"]["USA"][2],
      "NASDAQ" => $data["MarketRegions"]["USA"][3]
    );
    return $stockData;
   } else {
    return false;
  }
}