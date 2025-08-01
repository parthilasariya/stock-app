<?php
require_once 'config/db.php';

try {
    $stmt = $pdo->prepare("INSERT INTO requests (action, name, email, shares) VALUES (:action, :name, :email, :shares)");
    $result = $stmt->execute([
        ':action' => 'buy',
        ':name' => 'Test User',
        ':email' => 'test@example.com',
        ':shares' => 100
    ]);
    
    if ($result) {
        echo "Test insert: SUCCESS\n";
        echo "Last insert ID: " . $pdo->lastInsertId() . "\n";
    } else {
        echo "Test insert: FAILED\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
