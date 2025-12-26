// gallery.js — tiny lightbox for masonry gallery
document.addEventListener('DOMContentLoaded', function () {
  const masonry = document.querySelector('.masonry');
  if (!masonry) return;

  const lb = document.getElementById('masonryLightbox');
  const lbImg = document.getElementById('mlbImage');
  const lbCaption = document.querySelector('.mlb-caption');
  const lbClose = document.querySelector('.mlb-close');

  masonry.addEventListener('click', function (e) {
    const img = e.target.closest('img');
    if (!img) return;
    const src = img.getAttribute('data-full') || img.src;
    lbImg.src = src;
    lbCaption.textContent = img.getAttribute('data-caption') || img.alt || '';
    lb.style.display = 'flex';
    lb.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  });

  function closeLB() {
    lb.style.display = 'none';
    lb.setAttribute('aria-hidden', 'true');
    lbImg.src = '';
    document.body.style.overflow = '';
  }

  lbClose.addEventListener('click', closeLB);
  lb.addEventListener('click', (ev) => {
    if (ev.target === lb) closeLB();
  });

  document.addEventListener('keydown', (ev) => {
    if (ev.key === 'Escape') closeLB();
  });
});
