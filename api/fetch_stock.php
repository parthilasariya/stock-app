<?php 
require_once '..config/db.php'; // Database configuration file

$symbol = 'RCI-B.TO'; // Toronto Stock Exchange stock symbol for Rogers Communications
$apiKey = getenv('ALPHA_VANTAGE_API_KEY'); //Key is stored in .env file

# Fetch stock data from Alpha Vantage API, I have recalled above var
$url = "https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=$symbol&interval=1min&apikey=$apiKey";
$data = file_get_contents($url);
$json = json_decode($data, true);

?>