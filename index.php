<?php
require_once __DIR__ . '/config.php';

// Fetch site content (about, banner, contact info)
$content = [];
$stmt = $conn->query("SELECT key_name, content FROM site_content");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $content[$row['key_name']] = $row['content'];
}

// Fetch some latest packages for the homepage
$pkgStmt = $conn->query("SELECT * FROM packages ORDER BY created_at DESC LIMIT 3");
$homePackages = $pkgStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch popular destinations from packages (distinct destinations)
$destStmt = $conn->query("
    SELECT destination,
           MIN(image) AS image,
           MIN(short_description) AS short_description,
           COUNT(*) AS package_count
    FROM packages
    GROUP BY destination
    ORDER BY package_count DESC, destination ASC
    LIMIT 3
");
$destinations = $destStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include 'header.php'; ?>

<main>

  <!-- HERO SECTION -->
    <!-- NEW DISTINCTIVE HERO (replace the old .hero section with this) -->
  <section class="hero hero-unique" id="home" aria-label="Main hero">
    <div class="hero-overlay"></div>

    <div class="hero-center container">
      <div class="hero-card">

        <div class="hero-left">
          <h2 class="hero-kicker">Discover India, Differently</h2>
          <h1 class="hero-headline">Avipro Travels</h1>
          <p class="hero-lead">
            Curated journeys across India's most iconic and hidden places. Crafted itineraries, trusted guides,
            unforgettable memories.
          </p>

          <div class="hero-ctas">
            <a href="#packages" class="btn btn-primary">Explore Packages</a>
            <a href="#booking" class="btn btn-outline">Quick Enquiry</a>
          </div>

        </div>

        <div class="hero-right">
          <!-- subtle decorative image box: we will use an uploaded image or a placeholder via CSS background -->
          <div class="hero-photo" aria-hidden="true"></div>
        </div>

      </div>
    </div>
  </section>



  <!-- TOUR SEARCH / BOOKING SHORT FORM -->
 <!-- Modern Booking / Enquiry Card -->
<section id="booking" class="section booking-section" aria-label="Quick enquiry">
  <div class="container">
    <div class="booking-card">

      <header class="booking-head">
        <p class="kicker">Quick Enquiry</p>
        <h3 class="booking-title">Tell us your plan — we’ll take care of the rest</h3>
        <p class="booking-sub">Fast response, personalised itineraries and transparent pricing.</p>
      </header>

      <form id="bookingForm" class="booking-form" novalidate>
        <input type="hidden" name="package_title" id="package_title" value="">

        <div class="row">
          <div class="field">
            <label class="float-label">
              <input name="destination" id="destination" required />
              <span>Destination</span>
            </label>
          </div>

          <div class="field">
            <label class="float-label">
              <input name="persons" id="persons" type="number" min="1" required />
              <span>Number of persons</span>
            </label>
          </div>

          <div class="field">
            <label class="float-label">
              <input name="travel_date" id="travel_date" type="date" required />
              <span>Travel date</span>
            </label>
          </div>

          <div class="field">
            <label class="float-label">
              <input name="name" id="name" required />
              <span>Your name</span>
            </label>
          </div>

          <div class="field">
            <label class="float-label">
              <input name="email" id="email" type="email" required />
              <span>Your email</span>
            </label>
          </div>

          <div class="field">
            <label class="float-label">
              <input name="phone" id="phone" required />
              <span>Your phone</span>
            </label>
          </div>

          <div class="field wide">
            <label class="float-label textarea-label">
              <textarea name="message" id="message" rows="3" placeholder="Tell us any preferences (optional)"></textarea>
              <span>Message (optional)</span>
            </label>
          </div>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn btn-primary submit-btn">Send Enquiry</button>
          <button type="button" id="resetBooking" class="btn btn-outline">Reset</button>
        </div>

        <div id="bookingResponse" class="booking-response" role="status" aria-live="polite"></div>
      </form>
    </div>
  </div>
</section>


  <!-- ===== Modern About Section (replace old about area) ===== -->
<section id="about" class="about-modern section" aria-label="About Avipro Travels">
  <div class="container">

    <!-- top intro -->
    <div class="about-intro" style="text-align:center; margin-bottom:32px;">
      <p class="section-subtitle">About Us</p>
      <h2 class="h2 section-title">We craft journeys that stay with you</h2>
      <p class="section-text" style="max-width:70ch; margin-inline:auto;">
        Avipro Travels blends local knowledge, curated itineraries and sustainable experiences to create trips that
        feel personal and effortless. From honeymoon escape to high-altitude adventures, our team plans each step
        so you can travel with confidence.
      </p>
    </div>

    <!-- feature cards -->
    <ul class="about-features" style="display:grid; grid-template-columns:repeat(3,1fr); gap:18px; margin-bottom:32px;">
      <li class="feature-card">
        <div class="feature-icon">✈️</div>
        <h3 class="h3">Handpicked Experiences</h3>
        <p class="card-text">We select hotels, guides and local partners to deliver seamless, enriching travel.</p>
      </li>
      <li class="feature-card">
        <div class="feature-icon">🛡️</div>
        <h3 class="h3">Trusted Support</h3>
        <p class="card-text">24/7 local assistance and flexible booking policies to keep your journey worry-free.</p>
      </li>
      <li class="feature-card">
        <div class="feature-icon">🌱</div>
        <h3 class="h3">Responsible Travel</h3>
        <p class="card-text">We work with communities to minimize impact and maximize benefits for local people.</p>
      </li>
    </ul>

    <!-- stats + team -->
    <div class="about-grid" style="display:grid; grid-template-columns:1fr 420px; gap:28px; align-items:start;">
      <!-- left: stats + timeline -->
      <div>
        <div class="stats-row" style="display:flex;gap:18px; margin-bottom:22px;">
          <div class="stat">
            <div class="stat-number" data-target="12">0</div>
            <div class="stat-label">Years Experience</div>
          </div>
          <div class="stat">
            <div class="stat-number" data-target="250">0</div>
            <div class="stat-label">Packages</div>
          </div>
          <div class="stat">
            <div class="stat-number" data-target="9800">0</div>
            <div class="stat-label">Happy Travelers</div>
          </div>
        </div>

        <div class="about-timeline">
          <h4 class="h3">Our Story</h4>
          <ol>
            <li><strong>2013</strong> — Founded by travel enthusiasts.</li>
            <li><strong>2016</strong> — Expanded operations across India.</li>
            <li><strong>2020</strong> — Focus on curated, sustainable travel.</li>
          </ol>
        </div>
      </div>

      <!-- right: team card -->
      <aside class="team-card" style="background:var(--cultured); padding:18px; border-radius:12px;">
        <h3 class="h3" style="margin-bottom:12px;">Meet the Team</h3>

        <div class="team-list" style="display:flex;flex-direction:column;gap:12px;">
          <div style="display:flex;align-items:center;gap:12px;">
            <img src="uploads/team-1.jpg" alt="Team member" style="width:56px;height:56px;border-radius:8px;object-fit:cover;">
            <div>
              <div style="font-weight:700;">Aditya Seswani</div>
              <div style="font-size:13px;color:var(--spanish-gray);">Founder &amp; CEO</div>
            </div>
          </div>

          <div style="display:flex;align-items:center;gap:12px;">
            <img src="uploads/team-2.jpg" alt="Team member" style="width:56px;height:56px;border-radius:8px;object-fit:cover;">
            <div>
              <div style="font-weight:700;">Sumukh Agrawal</div>
              <div style="font-size:13px;color:var(--spanish-gray);">Head of Operations</div>
            </div>
          </div>

          <div style="display:flex;align-items:center;gap:12px;">
            <img src="uploads/team-3.jpg" alt="Team member" style="width:56px;height:56px;border-radius:8px;object-fit:cover;">
            <div>
              <div style="font-weight:700;">Aryan Thombare</div>
              <div style="font-size:13px;color:var(--spanish-gray);">Experience Designer</div>
            </div>
          </div>
          <div style="display:flex;align-items:center;gap:12px;">
            <img src="uploads/team-4.jpg" alt="Team member" style="width:56px;height:56px;border-radius:8px;object-fit:cover;">
            <div>
              <div style="font-weight:700;">Heramb Arora</div>
              <div style="font-size:13px;color:var(--spanish-gray);">HR &amp; Leader</div>
            </div>
          </div>
          <div style="display:flex;align-items:center;gap:12px;">
            <img src="uploads/team-5.jpg" alt="Team member" style="width:56px;height:56px;border-radius:8px;object-fit:cover;">
            <div>
              <div style="font-weight:700;">Chaitanya Bagade</div>
              <div style="font-size:13px;color:var(--spanish-gray);">Destination Specialist: &amp; COO</div>
            </div>
          </div>

        </div>
      </aside>
    </div>

    <!-- CTA banner -->
    <div class="about-cta" style="margin-top:28px;padding:22px;border-radius:12px;background:linear-gradient(90deg,var(--bright-navy-blue),var(--yale-blue));color:#fff;display:flex;justify-content:space-between;align-items:center;gap:12px;">
      <div>
        <h3 style="margin:0;font-size:20px;">Ready to curate your next trip?</h3>
        <p style="margin:6px 0 0;">Tell us a little about what you want and we’ll propose a plan.</p>
      </div>
      <div>
        <a href="#packages" class="btn btn-primary">Explore Packages</a>
        <a href="#booking" class="btn btn-secondary" style="margin-left:10px;">Quick Enquiry</a>
      </div>
    </div>

  </div>
</section>
<!-- ===== end about modern ===== -->


  <!-- POPULAR DESTINATIONS SECTION -->
  <section class="section popular" id="destination">
    <div class="container">

      <p class="section-subtitle">Uncover place</p>

      <h2 class="h2 section-title">Popular destination</h2>

      <p class="section-text">
        Fusce hic augue velit wisi quibusdam pariatur, iusto primis, nec nemo, rutrum.
        Vestibulum cumque laudantium. Sit ornare mollitia tenetur, aptent.
      </p>

      <ul class="popular-list">
        <?php if (!empty($destinations)): ?>
          <?php foreach ($destinations as $dest): ?>
            <li>
              <div class="popular-card">

                <?php if (!empty($dest['image'])): ?>
                  <figure class="card-banner">
                    <img src="uploads/<?php echo htmlspecialchars($dest['image']); ?>"
                         alt="<?php echo htmlspecialchars($dest['destination']); ?>" class="img-cover">
                  </figure>
                <?php else: ?>
                  <!-- Fallback to one of Tourly’s destination images if no package image -->
                  <figure class="card-banner">
                    <img src="assets/images/popular-1.jpg"
                         alt="<?php echo htmlspecialchars($dest['destination']); ?>" class="img-cover">
                  </figure>
                <?php endif; ?>

                <div class="card-content">
                  <p class="card-subtitle"><?php echo htmlspecialchars($dest['destination']); ?></p>
                  <h3 class="h3 card-title">
                    <?php echo htmlspecialchars($dest['destination']); ?>
                  </h3>
                  <p class="card-text">
                    <?php echo htmlspecialchars($dest['short_description'] ?? 'Explore this amazing destination with our curated packages.'); ?>
                  </p>
                </div>

              </div>
            </li>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No destinations available yet. Add some packages in admin to see them here.</p>
        <?php endif; ?>
      </ul>

      <div class="section-footer">
        <a href="#packages" class="btn btn-primary">More destination</a>
      </div>

    </div>
  </section>

  <!-- PACKAGES SECTION (dynamic from CMS) -->
  <section class="section package" id="packages">
    <div class="container">

      <p class="section-subtitle">Popular Packages</p>

      <h2 class="h2 section-title">Checkout Our Packages</h2>

      <p class="section-text">
        Fusce hic augue velit wisi quibusdam pariatur, iusto primis, nec nemo, rutrum.
        Vestibulum cumque laudantium. Sit ornare mollitia tenetur, aptent.
      </p>

      <ul class="package-list">
        <?php if (!empty($homePackages)): ?>
          <?php foreach ($homePackages as $pkg): ?>
            <li>
              <div class="package-card">

                <figure class="card-banner">
                  <?php if (!empty($pkg['image'])): ?>
                    <img src="uploads/<?php echo htmlspecialchars($pkg['image']); ?>"
                         alt="<?php echo htmlspecialchars($pkg['title']); ?>" class="img-cover">
                  <?php else: ?>
                    <!-- Fallback to one of Tourly’s package images -->
                    <img src="assets/images/package-1.jpg"
                         alt="<?php echo htmlspecialchars($pkg['title']); ?>" class="img-cover">
                  <?php endif; ?>
                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <?php echo htmlspecialchars($pkg['title']); ?>
                  </h3>

                  <p class="card-text">
                    <?php echo htmlspecialchars($pkg['short_description'] ?? 'Enjoy an unforgettable holiday experience with Avipro Travels.'); ?>
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
                    <a href="booking.php?package_id=<?php echo $pkg['id']; ?>" class="btn btn-secondary">
                      Book Now
                    </a>
                  </div>

                </div>

              </div>
            </li>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No packages found. Add some packages from the admin panel.</p>
        <?php endif; ?>
      </ul>

      <div class="section-footer">
        <a href="packages.php" class="btn btn-primary">View All Packages</a>
      </div>

    </div>
  </section>

  <!-- GALLERY SECTION (static images from Tourly assets) -->
  <!-- Masonry Gallery (auto-load) - replace the old gallery section with this -->
<section class="section gallery-masonry" id="gallery">
  <div class="container">

    <p class="section-subtitle">Photo Gallery</p>
    <h2 class="h2 section-title">Photos From Travellers</h2>

    <p class="section-text">
      Memories captured by our travellers — click to expand any image.
    </p>

    <?php
    // server folder and web url
    $galleryDir = __DIR__ . '/uploads/gallery';
    $galleryUrl = '/uploads/gallery';

    $images = [];
    if (is_dir($galleryDir)) {
      $all = array_diff(scandir($galleryDir), ['.','..']);
      foreach ($all as $f) {
        $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg','jpeg','png','webp','gif'])) {
          // use filemtime so newest images appear first
          $images[filemtime($galleryDir . '/' . $f) . '_' . $f] = $f;
        }
      }
      krsort($images);
      $images = array_values($images);
    }
    ?>

    <?php if (empty($images)): ?>
      <p class="section-text">No gallery images yet. Upload images to <code>/uploads/gallery/</code></p>
    <?php else: ?>
      <div class="masonry" aria-live="polite">
        <?php foreach ($images as $img): 
          // create a friendly caption from filename
          $caption = ucwords(str_replace(['-','_'], ' ', pathinfo($img, PATHINFO_FILENAME)));
        ?>
          <figure class="masonry-item">
            <img
              src="<?php echo htmlspecialchars($galleryUrl . '/' . $img); ?>"
              alt="<?php echo htmlspecialchars($caption); ?>"
              loading="lazy"
              data-full="<?php echo htmlspecialchars($galleryUrl . '/' . $img); ?>"
              data-caption="<?php echo htmlspecialchars($caption); ?>">
          </figure>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</section>

<!-- Lightbox markup (single reusable modal) -->
<div id="masonryLightbox" class="masonry-lightbox" aria-hidden="true">
  <button class="mlb-close" aria-label="Close">✕</button>
  <img id="mlbImage" src="" alt="">
  <div class="mlb-caption"></div>
</div>


  <!-- Modern CTA / Contact Banner -->
<section id="contact-cta" class="cta-modern" aria-labelledby="cta-title">
  <div class="container cta-inner">
    <div class="cta-content">
      <p class="kicker">Plan with Confidence</p>
      <h2 id="cta-title" class="cta-title">Ready to plan your next unforgettable trip?</h2>
      <p class="cta-body">
        Tell us where you want to go and how you like to travel — we'll craft a customised itinerary,
        transparent pricing and local support so you can relax and enjoy the journey.
      </p>

      <div class="cta-actions">
        <a class="btn btn-primary btn-cta" href="/contact.php" role="button" id="primaryCta">
          <svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" style="margin-right:10px;">
            <path fill="currentColor" d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
          </svg>
          Get a Free Quote
        </a>

        <a class="btn btn-outline" href="/packages.php" id="secondaryCta">Explore Packages</a>
      </div>
    </div>

    <div class="cta-visual" aria-hidden="true">
      <!-- decorative image — put a representative SVG/PNG here or leave as background -->
      <div class="hero-visual" role="presentation"></div>
    </div>
  </div>
</section>

</main>

<?php include 'footer.php'; ?>
