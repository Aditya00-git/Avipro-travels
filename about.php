<?php
require_once __DIR__ . '/config.php';

// Fetch about content
$stmt = $conn->prepare("SELECT content FROM site_content WHERE key_name = 'about_us'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$about = $row['content'] ?? 'Avipro Travels is your trusted travel partner.';

include 'header.php';
?>

<main>

  <section class="section about">
    <div class="container">

      <p class="section-subtitle">About Us</p>
      <h2 class="h2 section-title">Who We Are</h2>

      <p class="section-text">
        <?php echo nl2br(htmlspecialchars($about)); ?>
      </p>

    </div>
  </section>

</main>

<?php include 'footer.php'; ?>
