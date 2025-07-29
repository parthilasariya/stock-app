<!-- A backend PHP script that acts as a bridge between frontend and the public stock data API (Alpha Vantage) -->

<?php 
require_once '../config/db.php'; // Fixed: was '..config/db.php'

$symbol = 'RCI-B.TO'; // Toronto Stock Exchange stock symbol for Rogers Communications
$apiKey = getenv('ALPHA_VANTAGE_API_KEY'); //Key is stored in .env file

# Fetch stock data from Alpha Vantage API asking 5min interval, I have recalled above var
$url = "https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=$symbol&interval=5min&apikey=$apiKey";

$response = file_get_contents($url); // Sends HTTP req to the API and gets the JSON response
$data = json_decode($response, true); // Decode JSON response

// error handling for API response
# !$data checks if the response is null
if (!$data || !isset($data['Time Series (5min)'])) {
    echo json_encode(['error' => 'failed to fetch stock data']);
    exit;
}

$timeseries = $data['Time Series (5min)'];
$timestamps = array_keys($timeseries);

$latest_timestamp = $timestamps[0];
$latest = $timeseries[$latest_timestamp];



?>