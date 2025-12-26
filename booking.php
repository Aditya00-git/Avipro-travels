<?php
require_once __DIR__ . '/config.php';

// If coming from a package, fetch its details
$selectedPackage = null;
$prefillDestination = '';

if (isset($_GET['package_id'])) {
    $pid = (int)$_GET['package_id'];
    $stmt = $conn->prepare("SELECT * FROM packages WHERE id = :id");
    $stmt->execute(['id' => $pid]);
    $selectedPackage = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($selectedPackage) {
        $prefillDestination = $selectedPackage['destination'];
    }
}

// Fallback: if only destination is passed in query
if (!$prefillDestination && isset($_GET['destination'])) {
    $prefillDestination = $_GET['destination'];
}

include 'header.php';
?>

<main>

  <section class="section tour-search" id="booking">
    <div class="container">

      <p class="section-subtitle">Booking</p>
      <h2 class="h2 section-title">Book Your Next Adventure</h2>

      <?php if ($selectedPackage): ?>
        <!-- Small package summary card -->
        <div class="package-card" style="margin-bottom: 30px;">
          <figure class="card-banner">
            <?php if (!empty($selectedPackage['image'])): ?>
              <img src="uploads/<?php echo htmlspecialchars($selectedPackage['image']); ?>"
                   alt="<?php echo htmlspecialchars($selectedPackage['title']); ?>" class="img-cover">
            <?php else: ?>
              <img src="assets/images/package-1.jpg"
                   alt="<?php echo htmlspecialchars($selectedPackage['title']); ?>" class="img-cover">
            <?php endif; ?>
          </figure>
          <div class="card-content">
            <h3 class="h3 card-title"><?php echo htmlspecialchars($selectedPackage['title']); ?></h3>
            <p class="card-text">
              <?php echo htmlspecialchars($selectedPackage['short_description'] ?? ''); ?>
            </p>
            <ul class="card-meta-list">
              <li class="card-meta-item">
                <div class="meta-box">
                  <ion-icon name="time"></ion-icon>
                  <p class="meta-text">
                    <?php echo htmlspecialchars($selectedPackage['duration'] ?? ''); ?>
                  </p>
                </div>
              </li>
              <li class="card-meta-item">
                <div class="meta-box">
                  <ion-icon name="location"></ion-icon>
                  <p class="meta-text">
                    <?php echo htmlspecialchars($selectedPackage['destination']); ?>
                  </p>
                </div>
              </li>
            </ul>
            <div class="card-price" style="margin-top: 15px;">
              <p class="price">
                ₹<?php echo number_format($selectedPackage['price'], 2); ?>
                <span>/ per person</span>
              </p>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <p class="section-text">
        Fill in the details below and our team will contact you with the best itinerary and price options.
      </p>

      <form id="bookingForm" class="tour-search-form">

        <?php if ($selectedPackage): ?>
          <!-- hidden package title for backend -->
          <input type="hidden" name="package_title"
                 value="<?php echo htmlspecialchars($selectedPackage['title']); ?>">
        <?php endif; ?>

        <div class="input-wrapper">
          <label for="name" class="input-label">Name*</label>
          <input type="text" name="name" id="name" required placeholder="Your Name" class="input-field">
        </div>

        <div class="input-wrapper">
          <label for="email" class="input-label">Email*</label>
          <input type="email" name="email" id="email" required placeholder="Your Email" class="input-field">
        </div>

        <div class="input-wrapper">
          <label for="phone" class="input-label">Phone*</label>
          <input type="text" name="phone" id="phone" required placeholder="Your Phone" class="input-field">
        </div>

        <div class="input-wrapper">
          <label for="destination" class="input-label">Destination*</label>
          <input type="text" name="destination" id="destination" required
                 value="<?php echo htmlspecialchars($prefillDestination); ?>"
                 placeholder="Enter Destination" class="input-field">
        </div>

        <div class="input-wrapper">
          <label for="travel_date" class="input-label">Travel Date*</label>
          <input type="date" name="travel_date" id="travel_date" required class="input-field">
        </div>

        <div class="input-wrapper">
          <label for="persons" class="input-label">Number of Persons*</label>
          <input type="number" name="persons" id="persons" required min="1"
                 placeholder="No. of People" class="input-field">
        </div>

        <div class="input-wrapper full-width">
          <label for="message" class="input-label">Message</label>
          <textarea name="message" id="message" rows="3" class="input-field"
                    placeholder="Any special requests or notes"></textarea>
        </div>

        <button type="submit" class="btn btn-secondary w-100">Submit Enquiry</button>

      </form>

      <div id="bookingResult"></div>

    </div>
  </section>

</main>

<?php include 'footer.php'; ?>
