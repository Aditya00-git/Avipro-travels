<?php
require_once 'auth.php';

if (!isset($_GET['id'])) {
    header('Location: packages.php');
    exit;
}

$id = (int)$_GET['id'];

$stmt = $conn->prepare("DELETE FROM packages WHERE id = :id");
$stmt->execute(['id' => $id]);

header('Location: packages.php');
exit;
