<?php
require_once 'auth.php';

// Count packages and bookings
$pkgCount = $conn->query("SELECT COUNT(*) FROM packages")->fetchColumn();
$bookingCount = $conn->query("SELECT COUNT(*) FROM bookings")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Avipro Travels</title>
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <span class="navbar-brand">Admin - Avipro Travels</span>
    <div>
      <a href="packages.php" class="btn btn-sm btn-outline-light">Packages</a>
      <a href="bookings.php" class="btn btn-sm btn-outline-light">Bookings</a>
      <a href="site-content.php" class="btn btn-sm btn-outline-light">Site Content</a>
      <a href="logout.php" class="btn btn-sm btn-danger">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <h3>Dashboard</h3>
  <div class="row">
    <div class="col-md-3">
      <div class="card mb-3">
        <div class="card-body">
          <h5>Packages</h5>
          <p><?php echo $pkgCount; ?></p>
          <a href="packages.php" class="btn btn-sm btn-primary">Manage</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card mb-3">
        <div class="card-body">
          <h5>Bookings</h5>
          <p><?php echo $bookingCount; ?></p>
          <a href="bookings.php" class="btn btn-sm btn-primary">View</a>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
