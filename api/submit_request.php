<?php
require_once '../config/db.php';
header('Content-Type: application/json');

$type = $_POST['type'] ?? '';
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$shares = intval($_POST['shares'] ?? 0);


?>