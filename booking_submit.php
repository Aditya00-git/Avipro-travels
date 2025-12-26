<?php
// booking_submit.php
header('Content-Type: application/json; charset=utf-8');

// require config using absolute path so includes always work
require_once __DIR__ . '/config.php';

function respond($success, $message, $httpCode = 200) {
    http_response_code($httpCode);
    echo json_encode(['success' => $success, 'message' => $message]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request method. Use POST.', 405);
}

// read POST fields (FormData)
$name          = trim($_POST['name'] ?? '');
$email         = trim($_POST['email'] ?? '');
$phone         = trim($_POST['phone'] ?? '');
$destination   = trim($_POST['destination'] ?? '');
$travel_date   = trim($_POST['travel_date'] ?? '');
$persons       = (int)($_POST['persons'] ?? 0);
$message       = trim($_POST['message'] ?? '');
$package_title = trim($_POST['package_title'] ?? '');

if ($package_title !== '') {
    $message = "Package: {$package_title}\n" . $message;
}

if ($name === '' || $email === '' || $phone === '' || $destination === '' || $travel_date === '' || $persons <= 0) {
    respond(false, 'Please fill all required fields correctly.', 400);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    respond(false, 'Invalid email address.', 400);
}

try {
    $stmt = $conn->prepare("INSERT INTO bookings
        (name, email, phone, destination, travel_date, persons, message)
        VALUES (:name, :email, :phone, :destination, :travel_date, :persons, :message)");

    $stmt->execute([
        ':name'        => $name,
        ':email'       => $email,
        ':phone'       => $phone,
        ':destination' => $destination,
        ':travel_date' => $travel_date,
        ':persons'     => $persons,
        ':message'     => $message
    ]);

    respond(true, 'Thank you! Your enquiry has been submitted.', 200);
} catch (Exception $e) {
    // optionally log $e->getMessage() to a file for debugging
    // error_log($e->getMessage());
    respond(false, 'Error saving your enquiry.', 500);
}
