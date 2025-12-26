<?php
require_once __DIR__ . '/config.php';

// Fetch all packages
$stmt = $conn->query("SELECT * FROM packages ORDER BY created_at DESC");
$packages = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'header.php';
?>

<main>

  <section class="section package" id="packages">
    <div class="container">

      <p class="section-subtitle">Our Packages</p>

      <h2 class="h2 section-title">Explore Our Tour Packages</h2>

      <p class="section-text">
        Choose from a variety of curated holiday packages crafted by Avipro Travels to give you the best travel experience.
      </p>

      <?php if (!empty($packages)): ?>
        <ul class="package-list">
          <?php foreach ($packages as $pkg): ?>
            <li>
              <div class="package-card">

                <figure class="card-banner">
                  <?php if (!empty($pkg['image'])): ?>
                    <img src="uploads/<?php echo htmlspecialchars($pkg['image']); ?>"
                         alt="<?php echo htmlspecialchars($pkg['title']); ?>" class="img-cover">
                  <?php else: ?>
                    <img src="assets/images/package-1.jpg"
                         alt="<?php echo htmlspecialchars($pkg['title']); ?>" class="img-cover">
                  <?php endif; ?>
                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <?php echo htmlspecialchars($pkg['title']); ?>
                  </h3>

                  <p class="card-text">
                    <?php echo htmlspecialchars($pkg['short_description'] ?? 'Enjoy an unforgettable experience with this package.'); ?>
                  </p>

                  <ul class="card-meta-list">
                    <li class="card-meta-item">
                      <ion-icon name="time"></ion-icon>
                      <span class="meta-text">
                        <?php echo htmlspecialchars($pkg['duration'] ?? '5D/4N'); ?>
                      </span>
                    </li>
                    <li class="card-meta-item">
                      <ion-icon name="location"></ion-icon>
                      <span class="meta-text">
                        <?php echo htmlspecialchars($pkg['destination']); ?>
                      </span>
                    </li>
                  </ul>

                 <div class="card-price">
  <p class="price">
    ₹<?php echo number_format($pkg['price'], 2); ?>
    <span>/ per person</span>
  </p>
  <a href="package-details.php?id=<?php echo $pkg['id']; ?>" class="btn btn-secondary">
    Book Now
  </a>
</div>


                </div>

              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p>No packages available yet. Please add some from the admin panel.</p>
      <?php endif; ?>

    </div>
  </section>

</main>

<?php include 'footer.php'; ?>
