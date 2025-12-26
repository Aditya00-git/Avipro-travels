<?php
require_once 'auth.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $destination = trim($_POST['destination'] ?? '');
    $duration = trim($_POST['duration'] ?? '');
    $price = (float)($_POST['price'] ?? 0);
    $short_description = trim($_POST['short_description'] ?? '');
    $full_description = trim($_POST['full_description'] ?? '');

    $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $title));

    $imageName = null;
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $imageName);
    }

    $stmt = $conn->prepare("INSERT INTO packages
        (title, slug, destination, duration, price, short_description, full_description, image)
        VALUES (:title, :slug, :destination, :duration, :price, :short_description, :full_description, :image)");

    $stmt->execute([
        'title' => $title,
        'slug'  => $slug,
        'destination' => $destination,
        'duration' => $duration,
        'price' => $price,
        'short_description' => $short_description,
        'full_description' => $full_description,
        'image' => $imageName
    ]);

    $message = 'Package added successfully.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Package</title>
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
  <h3>Add Package</h3>
  <a href="packages.php" class="btn btn-secondary mb-3">Back</a>

  <?php if ($message): ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
  <?php endif; ?>

  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Destination</label>
      <input type="text" name="destination" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Duration</label>
      <input type="text" name="duration" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Price</label>
      <input type="number" step="0.01" name="price" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Short Description</label>
      <textarea name="short_description" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Full Description</label>
      <textarea name="full_description" class="form-control" rows="5"></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Image</label>
      <input type="file" name="image" class="form-control">
    </div>
    <button class="btn btn-primary" type="submit">Save</button>
  </form>
</div>
</body>
</html>
