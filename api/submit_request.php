<?php
require_once '../config/db.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Enable error logging
error_reporting(E_ALL);
ini_set('log_errors', 1);

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$action = $_POST['action'] ?? '';
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$shares = intval($_POST['shares'] ?? 0);

// Validate input
if (!in_array($action, ['buy', 'withdraw']) || !$name || !$email || $shares <= 0 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid input data. Please check all fields.']);
    exit;
}
// Prepare and execute the database query
try {
    $stmt = $pdo->prepare("INSERT INTO requests (action, name, email, shares) VALUES (:action, :name, :email, :shares)");
    $result = $stmt->execute([
        ':action' => $action,
        ':name' => $name,
        ':email' => $email,
        ':shares' => $shares
    ]);
    
    // Check if the query was successful
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Request submitted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save request']);
    }
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error occurred']);
}

?>