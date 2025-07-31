<?php
require_once '../config/db.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Check if request method is POST
$type = $_POST['type'] ?? '';
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$shares = intval($_POST['shares'] ?? 0);

// Validate input
if (!in_array($type, ['buy', 'withdraw']) || !$name || !$name || $shares <= 0  || !filter_var($email. FILTER_VALIDATE_EMAIL))
{
    echo json_encode(['success' => false, 'message' => 'Request submitted']);
    exit;
}
// Prepare and execute the database query
$stmt = $pdo->prepare("INSERT INTO requests (type, name, email, shares) VALUES (:type, :name, :email, :shares)");
$stmt->execute([
    ':type' => $type,
    ':name' => $name,
    ':email' => $email,
    ':shares' => $shares
]);
// Check if the query was successful
echo json_encode(['success' => true, 'message' => 'Request submitted successfully']);

?>