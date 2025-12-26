<?php
require_once __DIR__ . '/config.php';

// Fetch contact info
$stmt = $conn->prepare("SELECT content FROM site_content WHERE key_name = 'contact_info'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$contactInfo = $row['content'] ?? "Email: avipr0supp0rt@gmail.com\nPhone: +919999999999\nAddress: Madhya Pradesh, India";

include 'header.php';
?>

<main>

  <section class="section cta" id="contact">
    <div class="container">

      <div class="cta-content">
        <p class="section-subtitle">Contact Us</p>

        <h2 class="h2 section-title">We'd love to hear from you</h2>

        <p class="section-text">
          For customised tour packages, special requests or any questions, reach out to us using the details below.
        </p>

        <pre style="white-space: pre-wrap; font-family: inherit; margin-top:1rem;">
<?php echo htmlspecialchars($contactInfo); ?>
        </pre>

        <a href="mailto:avipr0supp0rt@gmail.com" class="btn btn-secondary" style="margin-top:1rem;">
          Send us an Email
        </a>
      </div>

    </div>
  </section>

</main>

<?php include 'footer.php'; ?>
