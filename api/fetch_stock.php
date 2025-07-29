
<?php 
/**
 * A backend PHP script that acts as a bridge between frontend and the public stock data API (Alpha Vantage)
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
require_once '../config/db.php'; 

$symbol = 'RCI-B.TO'; // Toronto Stock Exchange stock symbol for Rogers Communications
$apiKey = getenv('ALPHA_VANTAGE_API_KEY'); //Key is stored in .env file
# Fetch stock data from Alpha Vantage API asking 5min interval, I have recalled above variable
$url = "https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=$symbol&interval=5min&apikey=$apiKey";


// Add debug logging need to remove
error_log("Fetching from URL: " . $url);

// -- Fetch Data --
$response = @file_get_contents($url);
if (!$response) {
    $error = error_get_last();
    error_log("Failed to fetch data: " . print_r($error, true));
    echo json_encode([
        'error' => 'Could not connect to stock API',
        'details' => $error['message'] ?? 'Unknown error'
    ]);
    exit;
}

$data = json_decode($response, true);
error_log("API Response: " . print_r($data, true));

// -- Validate Data --
$series = $data['Time Series (5min)'] ?? null;
if (!$series) {
    echo json_encode(['error' => 'Stock data unavailable']);
    exit;
}

// -- Get Latest and Previous Data --
$timestamps = array_keys($series);
$latest = $series[$timestamps[0]];
$prev = $series[$timestamps[1]] ?? null;

// -- Calculate Change % --
$change_percent = null;
if ($prev) {
    $latest_close = (float) $latest['4. close'];
    $prev_close = (float) $prev['4. close'];
    if ($prev_close > 0) {
        $change_percent = round((($latest_close - $prev_close) / $prev_close) * 100, 2);
    }
}

// -- Output JSON --
echo json_encode([
    'symbol'         => $symbol,
    'price'          => $latest['4. close'],
    'volume'         => $latest['5. volume'],
    'timestamp'      => $timestamps[0],
    'change_percent' => $change_percent
]);
?>