<?php
require_once 'auth.php';   // same auth used by dashboard

// fetch bookings
try {
    $stmt = $conn->query("SELECT * FROM bookings ORDER BY created_at DESC");
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $bookings = [];
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Bookings | Avipro Travels</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>.container{max-width:1100px;}</style>
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
  <h3>Bookings</h3>

  <?php if (empty($bookings)): ?>
    <div class="alert alert-info">No bookings found.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Destination</th>
            <th>Travel Date</th>
            <th>Persons</th>
            <th>Message</th>
            <th>Submitted At</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($bookings as $b): ?>
            <tr>
              <td><?php echo htmlspecialchars($b['id']); ?></td>
              <td><?php echo htmlspecialchars($b['name']); ?></td>
              <td><?php echo htmlspecialchars($b['email']); ?></td>
              <td><?php echo htmlspecialchars($b['phone']); ?></td>
              <td><?php echo htmlspecialchars($b['destination']); ?></td>
              <td><?php echo htmlspecialchars($b['travel_date']); ?></td>
              <td><?php echo htmlspecialchars($b['persons']); ?></td>
              <td style="max-width:220px;white-space:pre-wrap;"><?php echo htmlspecialchars($b['message']); ?></td>
              <td><?php echo htmlspecialchars($b['created_at'] ?? ''); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>

  <p><a href="dashboard.php" class="btn btn-sm btn-secondary">Back to Dashboard</a></p>
</div>
</body>
</html>
