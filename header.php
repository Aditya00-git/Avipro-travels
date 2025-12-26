<?php
require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Avipro Travels</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <link rel="stylesheet" href="/avipro-travels/assets/css/style.css">

  <!-- small header-specific styles (optional; can move to style.css) -->
  <style>
    /* dark-blue top band */
    .top-band {
      background: #0b2a4a; /* deep navy */
      color: #fff;
      padding: 8px 0;
      text-align: center;
      font-size: 14px;
      font-weight: 600;
    }
    .top-band .container { display:flex; justify-content:space-between; align-items:center; gap:10px; }
    .site-logo { font-weight:800; font-size:20px; color:#ffffff; letter-spacing:0.5px; }
    .header-actions { display:flex; gap:12px; align-items:center; }
    .header-search-btn, .header-signin-btn {
      background: #2e6fb5;
      color:#fff;
      border-radius:24px;
      padding:8px 14px;
      border: none;
      font-weight:600;
    }
    .header-signin-btn { background: transparent; color:#fff; border:2px solid rgba(255,255,255,0.15); }
    .header-search-input {
      position: fixed;
      top: 12%;
      left: 50%;
      transform: translateX(-50%);
      width: 70%;
      max-width:800px;
      z-index: 9999;
      display:none;
    }
    .search-results { background: #fff; border-radius:6px; max-height:320px; overflow:auto; padding:8px; box-shadow:0 6px 20px rgba(0,0,0,0.15); }
    .search-row { padding:8px 6px; border-bottom:1px solid #eee; }
    .search-row a { color:#0b2a4a; font-weight:600; text-decoration:none; }
  </style>
</head>
<body>

<!-- Top dark band -->
<div class="top-band sticky-top">
  <div class="container" style="max-width:1180px;margin:0 auto;">
    <div style="display:flex;align-items:center;gap:8px;">
      <div style="display:flex; align-items:center; gap:10px;">
  <img src="/avipro-travels/assets/images/logo.png" alt="Avipro Logo" class="avipro-logo">
  <span class="site-logo">Avipro Travels</span>
</div>

    </div>

    <div class="header-actions">
      <!-- Search button -->
      <button id="openSearchBtn" class="header-search-btn" aria-label="Open search">Search</button>

      <!-- Sign in button -->
      <?php if (!empty($_SESSION['user_email'])): ?>
        <div style="color:#fff;font-weight:600;padding:6px 10px;border-radius:6px;background:rgba(255,255,255,0.06);">
          <?php echo htmlspecialchars($_SESSION['user_name'] ?? $_SESSION['user_email']); ?>
          <a href="/avipro-travels/google-logout.php" style="color:#fff;margin-left:10px;text-decoration:underline;">Sign out</a>
        </div>
      <?php else: ?>
        <button id="googleSignInBtn" class="header-signin-btn">Sign in</button>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Main nav (white background under the band) -->
<header class="sticky-nav" style="background:#fff;padding:14px 0;border-bottom:1px solid #eee;">
<div class="container" style="max-width:1180px;margin:0 auto;display:flex;align-items:center;justify-content:center;">
    <div></div>


    <nav aria-label="Main nav">
      <ul style="display:flex;gap:20px;list-style:none;margin:0;padding:0;">
        <li><a href="/avipro-travels/#home">Home</a></li>
        <li><a href="/avipro-travels/#about">About Us</a></li>
        <li><a href="/avipro-travels/#destination">Destination</a></li>
        <li><a href="/avipro-travels/packages.php">Packages</a></li>
        <li><a href="/avipro-travels/#gallery">Gallery</a></li>
        <li><a href="/avipro-travels/contact.php">Contact Us</a></li>
      </ul>
    </nav>
  </div>
</header>

<!-- Compact search popup (hidden by default) -->
<div id="searchPopup" style="position:relative;">
  <div id="searchPopupPanel" aria-hidden="true" style="display:none;">
    <input id="searchInput" type="search" placeholder="Search packages or destinations..." autocomplete="off" />
    <div id="searchResults" class="search-results" style="display:none;"></div>
  </div>
</div>


<!-- load header js -->
<script src="/avipro-travels/assets/js/header.js" defer></script>
