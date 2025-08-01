<?php
try {
    require_once 'vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    
    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_NAME'];
    $user = $_ENV['DB_USER'];
    $pass = $_ENV['DB_PASS'];
    $socket = $_ENV['DB_SOCKET'] ?? null;
    
    $dsn = "mysql:unix_socket=/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database connection: SUCCESS\n";
    
    // Check if requests table exists
    $stmt = $pdo->query('SHOW TABLES LIKE "requests"');
    if ($stmt->rowCount() > 0) {
        echo "Table 'requests' exists: YES\n";
        // Check table structure
        $stmt = $pdo->query('DESCRIBE requests');
        echo "Table structure:\n";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "  " . $row['Field'] . " (" . $row['Type'] . ")\n";
        }
    } else {
        echo "Table 'requests' exists: NO\n";
        echo "You need to create the table first!\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
