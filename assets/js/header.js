document.addEventListener('DOMContentLoaded', function() {
  // --- SEARCH popup anchored to button ---
  const openSearchBtn = document.getElementById('openSearchBtn');
  const searchPopupPanel = document.getElementById('searchPopupPanel');
  const searchInput = document.getElementById('searchInput');
  const searchResults = document.getElementById('searchResults');

  // position popup near button and toggle
  openSearchBtn.addEventListener('click', (e) => {
    // toggle visibility
    const isVisible = searchPopupPanel.style.display === 'block';
    if (isVisible) {
      searchPopupPanel.style.display = 'none';
      searchResults.style.display = 'none';
      return;
    }

    // position the panel: compute button rect
    const rect = openSearchBtn.getBoundingClientRect();
    // put panel so its right aligns with button's right edge
    searchPopupPanel.style.display = 'block';
    // adjust absolute positioning relative to viewport:
    // place panel using transform to avoid layout shift
    searchPopupPanel.style.top = (rect.bottom + window.scrollY + 6) + 'px';
    // prefer aligning right edges:
    const panelWidth = Math.min(340, Math.max(220, window.innerWidth * 0.35));
    searchPopupPanel.style.width = panelWidth + 'px';
    // calculate left so panel's right aligns with button's right:
    const left = rect.right + window.scrollX - panelWidth;
    searchPopupPanel.style.left = Math.max(8, left) + 'px';

    searchInput.value = '';
    searchInput.focus();
  });

  // hide when clicking outside
  document.addEventListener('click', function (ev) {
    const target = ev.target;
    if (!openSearchBtn.contains(target) && !searchPopupPanel.contains(target)) {
      searchPopupPanel.style.display = 'none';
      searchResults.style.display = 'none';
    }
  });

  // Escape to close
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      searchPopupPanel.style.display = 'none';
      searchResults.style.display = 'none';
    }
  });

  // Live search debounced
  let timer = null;
  searchInput.addEventListener('input', function() {
    clearTimeout(timer);
    const q = this.value.trim();
    if (!q) { searchResults.style.display = 'none'; return; }
    timer = setTimeout(() => {
      fetch('/avipro-travels/search.php?q=' + encodeURIComponent(q))
        .then(r => r.json())
        .then(data => {
          if (!data || !data.length) {
            searchResults.innerHTML = '<div style="padding:8px;color:#666;">No results</div>';
            searchResults.style.display = 'block';
            return;
          }
          searchResults.innerHTML = data.map(item => {
            return `<div class="search-row">
                <a href="/avipro-travels/package-details.php?id=${item.id}">${escapeHtml(item.title)}</a>
                <div class="muted">${escapeHtml(item.destination)} — ₹${Number(item.price).toLocaleString()}</div>
              </div>`;
          }).join('');
          searchResults.style.display = 'block';
        });
    }, 250);
  });

  function escapeHtml(s) {
    return s ? s.replace(/[&<>"']/g, (m) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m])) : '';
  }

  // ... rest of header.js (Google sign-in code) remains unchanged ...



  // GOOGLE SIGN-IN (client) - using Google Identity Services
  // NOTE: you must set google_client_id in config.php and expose it here in HTML if needed
  const googleBtn = document.getElementById('googleSignInBtn');
  if (googleBtn) {
    googleBtn.addEventListener('click', () => {
      // Use Google one-tap popup via window.google - requires the GIS script to be included in header/footer.
      // We'll open the standard popup using the new "google.accounts.id" library if available.
      if (window.google && google?.accounts?.id) {
        // open popup by rendering a button or using token client; simplest is to use token client (OAuth)
        const client_id = window.__AVIPRO_GOOGLE_CLIENT_ID || '';
        if (!client_id) {
          alert('Google Sign-in not configured. Please set the Google Client ID in config.php.');
          return;
        }

        // Use the token client for OAuth 2.0 to get an id_token
        const tokenClient = google.accounts.oauth2.initTokenClient({
          client_id: client_id,
          scope: 'openid email profile',
          callback: (resp) => {
            if (resp && resp.access_token) {
              // fetch id_token via tokeninfo is not provided by the token client directly,
              // but we can call people API or use access_token to get userinfo.
              // Simpler: request id_token using the popup credential flow (google.accounts.id.prompt)
              // For a quick implementation, we'll use the "google.accounts.id" credential flow if available below.
              console.log('access_token acquired (not id_token). Using backend with access token.');
              // send access_token to backend to exchange for user info
              fetch('/avipro-travels/google-login.php', {
                method:'POST',
                headers:{'Content-Type':'application/json'},
                body: JSON.stringify({ access_token: resp.access_token })
              }).then(r=>r.json()).then(j=>{
                if (j.success) location.reload();
                else alert('Login failed: ' + (j.message || 'unknown'));
              });
            } else {
              alert('Could not acquire Google token.');
            }
          }
        });
        // request token (this will open a popup)
        tokenClient.requestAccessToken();
      } else {
        alert('Google Sign-in library not loaded. Make sure you inserted the Google script tag and client id in config.php as instructed.');
      }
    });
  }

});
