<?php
require_once __DIR__ . '/config.php';

if (!isset($_GET['id'])) {
    header('Location: packages.php');
    exit;
}

$id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM packages WHERE id = :id");
$stmt->execute(['id' => $id]);
$pkg = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pkg) {
    header('Location: packages.php');
    exit;
}

include 'header.php';
?>

<main>

  <section class="section package">
    <div class="container">

      <p class="section-subtitle">Package Details</p>
      <h2 class="h2 section-title"><?php echo htmlspecialchars($pkg['title']); ?></h2>

      <div class="package-card" style="margin-top: 2rem;">

        <figure class="card-banner" style="max-width: 500px; margin: 0 auto;">
          <?php if (!empty($pkg['image'])): ?>
            <img src="uploads/<?php echo htmlspecialchars($pkg['image']); ?>"
                 alt="<?php echo htmlspecialchars($pkg['title']); ?>" class="img-cover">
          <?php else: ?>
            <img src="assets/images/package-1.jpg"
                 alt="<?php echo htmlspecialchars($pkg['title']); ?>" class="img-cover">
          <?php endif; ?>
        </figure>

        <div class="card-content" style="margin-top: 2rem;">

          <ul class="card-meta-list">
            <li class="card-meta-item">
              <ion-icon name="location"></ion-icon>
              <span class="meta-text">
                <?php echo htmlspecialchars($pkg['destination']); ?>
              </span>
            </li>
            <li class="card-meta-item">
              <ion-icon name="time"></ion-icon>
              <span class="meta-text">
                <?php echo htmlspecialchars($pkg['duration'] ?? 'Duration not specified'); ?>
              </span>
            </li>
          </ul>

          <div class="card-price" style="margin-top: 1rem;">
            <p class="price">
              ₹<?php echo number_format($pkg['price'], 2); ?>
              <span>/ per person</span>
            </p>
          </div>

          <div class="card-text" style="margin-top: 1.5rem;">
            <h3 class="h3">Overview</h3>
            <p>
              <?php echo nl2br(htmlspecialchars($pkg['full_description'] ?? $pkg['short_description'] ?? 'No detailed description available.')); ?>
            </p>
          </div>

          <div style="margin-top: 2rem;">
  <a href="booking.php?package_id=<?php echo $pkg['id']; ?>&destination=<?php echo urlencode($pkg['destination']); ?>"
     class="btn btn-secondary">
    Book This Package
  </a>
  <a href="packages.php" class="btn btn-outline" style="margin-left: 10px;">Back to Packages</a>
</div>


        </div>

      </div>

    </div>
  </section>

</main>

<?php include 'footer.php'; ?>
