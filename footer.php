<?php
// if you want, you can later pull contact text from site_content like before
?>
<footer class="footer" id="contact">

  <!-- TOP PART: contact + newsletter -->
  <div class="footer-top">
    <div class="container">

      <!-- LEFT: Brand / about -->
      <div class="footer-brand">
        <a href="#home" class="logo">
          <span style="color:white;font-weight:700;font-size:22px;">Avipro Travels</span>
        </a>

        <p class="footer-text">
          Avipro Travels is your trusted travel partner, crafting customized itineraries and unforgettable
          journeys across incredible destinations.
        </p>
      </div>

      <!-- MIDDLE: Contact info -->
      <div class="footer-contact">
        <h3 class="contact-title">Contact Us</h3>

        <p class="contact-text">
          Feel free to reach out for custom tour packages or any travel-related queries.
        </p>

        <ul>

          <li class="contact-item">
            <ion-icon name="call-outline"></ion-icon>
            <a href="tel:+9975384000" class="contact-link">+91 9975384000</a>
          </li>

          <li class="contact-item">
            <ion-icon name="mail-outline"></ion-icon>
            <a href="mailto:avipr0supp0rt@gmail.com" class="contact-link">
              avipr0supp0rt@gmail.com
            </a>
          </li>

          <li class="contact-item">
            <ion-icon name="location-outline"></ion-icon>
            <address class="contact-link">
              Avipro Travels, Madhya Pradesh, India
            </address>
          </li>

        </ul>
      </div>

      <!-- RIGHT: Newsletter / contact form style -->
      <div class="footer-form">
        <h3 class="contact-title">Get Updates</h3>

        <p class="form-text">
          Subscribe to receive the latest offers and travel deals from Avipro Travels.
        </p>

        <form action="#" class="form-wrapper">
          <input type="email"
                 name="email"
                 required
                 placeholder="Enter Your Email"
                 class="input-field">

          <button type="submit" class="btn btn-secondary">
            Subscribe
          </button>
        </form>
      </div>

    </div>
  </div>

  <!-- BOTTOM BAR -->
  <div class="footer-bottom">
    <div class="container">

      <p class="copyright">
        &copy; <?php echo date('Y'); ?> Avipro Travels. All rights reserved.
      </p>

      <ul class="footer-bottom-list">
        <li><a href="#" class="footer-bottom-link">Privacy Policy</a></li>
        <li><a href="#" class="footer-bottom-link">Terms &amp; Conditions</a></li>
        <li><a href="#" class="footer-bottom-link">FAQ</a></li>
      </ul>

    </div>
  </div>

</footer>

<!-- GO TO TOP BUTTON -->
<a href="#top" class="go-top" data-go-top>
  <ion-icon name="chevron-up-outline"></ion-icon>
</a>

<!-- Ionicons -->
<script type="module"
        src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule
        src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<!-- Your booking AJAX/validation JS -->
<script src="/avipro-travels/assets/js/main.js"></script>

<!-- Tourly theme JS -->
<script src="/avipro-travels/assets/js/script.js"></script>
<!-- Google Identity Services -->
<script src="https://accounts.google.com/gsi/client" async defer></script>

<script>
  // expose client id to header.js
  window.__AVIPRO_GOOGLE_CLIENT_ID = "<?php echo htmlspecialchars($google_client_id ?? ''); ?>";
</script>
<script src="/avipro-travels/assets/js/gallery.js" defer></script>

</body>
</html>
