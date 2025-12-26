document.addEventListener('DOMContentLoaded', function () {
  const bookingForm = document.getElementById('bookingForm');
  const resultDiv = document.getElementById('bookingResult');

  if (!bookingForm) return;

  bookingForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(bookingForm);

    const requiredFields = ['name', 'email', 'phone', 'destination', 'travel_date', 'persons'];
    for (let field of requiredFields) {
      if (!formData.get(field)) {
        alert('Please fill all required fields.');
        return;
      }
    }

    const email = formData.get('email');
    if (!/^\S+@\S+\.\S+$/.test(email)) {
      alert('Please enter a valid email address.');
      return;
    }

    const persons = parseInt(formData.get('persons'), 10);
    if (isNaN(persons) || persons <= 0) {
      alert('Please enter a valid number of persons.');
      return;
    }

    fetch('booking_submit.php', {
      method: 'POST',
      body: formData
    })
      .then(response => response.json())
      .then(data => {
        if (!resultDiv) return;
        if (data.success) {
          resultDiv.innerHTML = '<div class="alert-success" style="padding:10px;margin-top:10px;border-radius:4px;">'
            + data.message + '</div>';
          bookingForm.reset();
        } else {
          resultDiv.innerHTML = '<div class="alert-error" style="padding:10px;margin-top:10px;border-radius:4px;background:#fdd;">'
            + data.message + '</div>';
        }
      })
      .catch(() => {
        if (!resultDiv) return;
        resultDiv.innerHTML = '<div class="alert-error" style="padding:10px;margin-top:10px;border-radius:4px;background:#fdd;">An error occurred. Please try again.</div>';
      });
  });
});
// simple counter animation for .stat-number
document.addEventListener('DOMContentLoaded', function () {
  const counters = document.querySelectorAll('.stat-number');
  counters.forEach(counter => {
    const target = parseInt(counter.getAttribute('data-target')) || 0;
    let current = 0;
    const step = Math.max(1, Math.round(target / 60));
    const interval = setInterval(() => {
      current += step;
      if (current >= target) {
        counter.textContent = target.toLocaleString();
        clearInterval(interval);
      } else {
        counter.textContent = current.toLocaleString();
      }
    }, 16);
  });
});
// subtle attention pulse on CTA after page load
document.addEventListener('DOMContentLoaded', function () {
  const cta = document.getElementById('primaryCta');
  if (!cta) return;
  setTimeout(()=>{
    cta.animate([
      { boxShadow: '0 8px 30px rgba(3,12,22,0.28)', transform: 'translateY(0)'},
      { boxShadow: '0 22px 48px rgba(3,12,22,0.32)', transform: 'translateY(-3px)'},
      { boxShadow: '0 8px 30px rgba(3,12,22,0.28)', transform: 'translateY(0)'}
    ], { duration: 1400, iterations: 1 });
  }, 900);
});
// booking.js — client validation and AJAX submit
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('bookingForm');
  const resp = document.getElementById('bookingResponse');
  const resetBtn = document.getElementById('resetBooking');

  if (!form) return;

  // helper: check non-empty
  function validEmail(e){ return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(e); }

  form.addEventListener('submit', function (ev) {
    ev.preventDefault();
    resp.textContent = '';
    const fd = new FormData(form);
    const name = (fd.get('name') || '').trim();
    const email = (fd.get('email') || '').trim();
    const phone = (fd.get('phone') || '').trim();
    const dest = (fd.get('destination') || '').trim();
    const date = (fd.get('travel_date') || '').trim();
    const persons = parseInt(fd.get('persons') || 0, 10);

    // basic validation
    if (!name || !email || !phone || !dest || !date || !persons || !validEmail(email)) {
      resp.style.color = '#b12c2c';
      resp.textContent = 'Please complete all required fields with valid details.';
      return;
    }

    // disable button while sending
    const submitBtn = form.querySelector('.submit-btn');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Sending...';

    // send to server - absolute path
    fetch('/avipro-travels/booking_submit.php', {
      method: 'POST',
      body: fd
    }).then(r => r.json())
      .then(json => {
        if (json && json.success) {
          resp.style.color = '#0b8a44';
          resp.textContent = json.message || 'Enquiry submitted. We will contact you soon.';
          form.reset();
        } else {
          resp.style.color = '#b12c2c';
          resp.textContent = (json && json.message) ? json.message : 'Failed to submit. Try again later.';
        }
      })
      .catch(() => {
        resp.style.color = '#b12c2c';
        resp.textContent = 'Network error. Please try again later.';
      })
      .finally(() => {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Send Enquiry';
      });
  });

  if (resetBtn) resetBtn.addEventListener('click', () => {
    form.reset();
    resp.textContent = '';
  });
});
