<?php
require_once 'auth.php';

$stmt = $conn->query("SELECT * FROM packages ORDER BY created_at DESC");
$packages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Packages</title>
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
  <h3>Packages</h3>
  <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>
  <a href="package-add.php" class="btn btn-success mb-3">Add New Package</a>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th><th>Title</th><th>Destination</th><th>Price</th><th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($packages as $pkg): ?>
      <tr>
        <td><?php echo $pkg['id']; ?></td>
        <td><?php echo htmlspecialchars($pkg['title']); ?></td>
        <td><?php echo htmlspecialchars($pkg['destination']); ?></td>
        <td>₹<?php echo number_format($pkg['price'], 2); ?></td>
        <td>
          <a class="btn btn-sm btn-primary"
             href="package-edit.php?id=<?php echo $pkg['id']; ?>">Edit</a>
          <a class="btn btn-sm btn-danger"
             href="package-delete.php?id=<?php echo $pkg['id']; ?>"
             onclick="return confirm('Delete this package?');">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
