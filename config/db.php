<?php
/**
 * Database Configuration
 * PDO connection setup for MySQL database
 */

$host='localhost';
$dbname='stock_app';
$user='root';
$pass=''; // XAMPP default is empty

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed:']); // Helps for client-side error
    exit;
}
?>