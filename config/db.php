<?php
/**
 * Database Configuration
 * PDO connection setup for MySQL database
 */

// Load environment variables if not already loaded
if (!isset($_ENV['DB_HOST'])) {
    require_once __DIR__ . '/../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
}

$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS']; // XAMPP default is empty
$socket = $_ENV['DB_SOCKET'] ?? null;

try {
    $dsn = "mysql:unix_socket=/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $user, $pass);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed:']); // Helps for client-side error
    exit;
}
?>