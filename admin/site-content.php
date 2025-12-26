<?php
require_once 'auth.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach (['about_us', 'contact_info', 'home_banner'] as $key) {
        if (isset($_POST[$key])) {
            $content = $_POST[$key];

            $stmt = $conn->prepare("INSERT INTO site_content (key_name, content)
                VALUES (:key_name, :content)
                ON DUPLICATE KEY UPDATE content = :content2");

            $stmt->execute([
                'key_name' => $key,
                'content' => $content,
                'content2' => $content
            ]);
        }
    }
    $message = 'Site content updated.';
}

// Fetch current values
$data = [];
$stmt = $conn->query("SELECT key_name, content FROM site_content");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[$row['key_name']] = $row['content'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Site Content</title>
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
  <h3>Site Content</h3>
  <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>

  <?php if ($message): ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label class="form-label">Home Banner Text</label>
      <textarea name="home_banner" class="form-control" rows="2"><?php
        echo htmlspecialchars($data['home_banner'] ?? '');
      ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">About Us</label>
      <textarea name="about_us" class="form-control" rows="5"><?php
        echo htmlspecialchars($data['about_us'] ?? '');
      ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Contact Info</label>
      <textarea name="contact_info" class="form-control" rows="5"><?php
        echo htmlspecialchars($data['contact_info'] ?? '');
      ?></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Save</button>
  </form>
</div>
</body>
</html>
