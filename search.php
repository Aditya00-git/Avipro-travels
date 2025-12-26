<?php
require_once __DIR__ . '/config.php';
header('Content-Type: application/json; charset=utf-8');

$q = trim($_GET['q'] ?? '');
if ($q === '') { echo json_encode([]); exit; }

// simple search: title or destination
$stmt = $conn->prepare("SELECT id, title, destination, price FROM packages WHERE title LIKE :q OR destination LIKE :q LIMIT 10");
$stmt->execute(['q' => "%$q%"]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rows);
