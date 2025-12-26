<?php
session_start();

$host = "localhost";
$user = "root";
$pass = ""; // default empty in XAMPP
$dbname = "avipro_travels";
// Google OAuth client id (create this in Google Cloud Console and paste value here)
$google_client_id = "110035814796-kau5u0mjf8a4ef7g4nj38dg19hrl8v4f.apps.googleusercontent.com";


try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
?>
