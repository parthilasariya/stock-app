<?php 
/**
 * A backend PHP script that acts as a bridge between frontend and the public stock data API
 */

header('Content-Type: application/json');

// Load Composer autoloader, database and dotenv
require_once '../vendor/autoload.php';
require_once '../config/db.php'; 

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$symbol = $_ENV['STOCK_SYMBOL'];
$api_key = $_ENV['TWELVEDATA_API_KEY']; 
# We can set interval to 5 min, however free tier of Twelve Data API has a limit of 800 calls per day
$interval = $_ENV['STOCK_INTERVAL']; 
$url = "https://api.twelvedata.com/time_series?symbol=$symbol&interval=$interval&apikey=$api_key";

// Fetch data
$response = file_get_contents($url);
if (!$response) {
    echo json_encode(['error' => 'Could not connect to stock API']);
    exit; # If req fails, returns JSON error response
}
// Decode JSON response
$data = json_decode($response, true);

// Check for API error or missing time series, values contains at least two data points
if (!isset($data['values']) || count($data['values']) < 2) {
    echo json_encode(['error' => $data['message'] ?? 'Stock data unavailable', 'api_response' => $data]);
    exit;
}

// Get latest and previous close
$latest = $data['values'][0];
$prev = $data['values'][1];
$latest_close = (float)$latest['close']; # Used float to ensure decimal precision, not strings
$prev_close = (float)$prev['close'];

// Calculate change %
// If we increase interval time then the result of change % will be higher
$change_percent = $prev_close > 0 ? round((($latest_close - $prev_close) / $prev_close) * 100, 2) : null; 

// Output result
echo json_encode([ 
    'symbol' => $symbol,
    'price' => $latest_close,
    'volume' => $latest['volume'],
    'timestamp' => $latest['datetime'],
    'change_percent' => $change_percent
]);
?>