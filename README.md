# ✈️ Avipro Travels

### CMS-Based Travel Booking Website

🌐 **Live Demo:** https://aviprotravels.kesug.com/

Avipro Travels is a **full-stack travel management system** built with **PHP + MySQL** that allows users to explore destinations, view travel packages, and submit booking enquiries, while administrators manage everything through a dedicated **CMS dashboard**.

Designed to demonstrate **real-world web development, database design, and admin automation**.

---

# ✨ Features

## 👥 User Side

* Modern responsive UI
* Dynamic travel packages
* Popular destinations showcase
* Masonry photo gallery
* Booking / enquiry form with validation
* AJAX-based submissions (no page reload)
* Contact page
* Sticky navigation
* Google login support

---

## 🔐 Admin Panel (CMS)

* Secure login system
* Dashboard with statistics
* Add / Edit / Delete packages
* Image upload management
* View all booking enquiries
* Manage site content dynamically
* Session-based authentication

---

# 🧠 Problem It Solves

Traditional travel sites often:

* require manual updates
* lack admin control
* store enquiries manually
* have poor UX

**Avipro Travels provides:**

* centralized CMS management
* automated booking storage
* dynamic content updates
* scalable architecture
* modern responsive design

---

# 🛠 Tech Stack

### Frontend

* HTML5
* CSS3
* JavaScript
* AJAX

### Backend

* PHP 8.x

### Database

* MySQL / MariaDB

### Deployment

* InfinityFree Hosting

### Version Control

* Git & GitHub

---

# 📁 Project Structure

```
avipro-travels/
│
├── admin/          → CMS dashboard
├── assets/         → CSS, JS, images
├── uploads/        → package & gallery images
├── config.php      → DB configuration
├── index.php       → homepage
├── packages.php
├── contact.php
├── booking_submit.php
```

---

# ⚙️ How It Works

1. User visits the website
2. Packages load dynamically from database
3. User submits booking enquiry
4. AJAX sends data to PHP backend
5. Data stored in MySQL
6. Admin views enquiries in CMS
7. Admin updates packages & content

All updates reflect instantly.

---

# 💻 Local Installation

### 1. Install XAMPP

### 2. Move project:

```
C:/xampp/htdocs/avipro-travels
```

### 3. Start Apache + MySQL

### 4. Create database:

```
avipro_travels
```

### 5. Import:

```
avipro_travels.sql
```

### 6. Open:

```
http://localhost/avipro-travels/
```

---

# 🔑 Admin Access (Demo)

URL:

```
/admin/login.php
```

Credentials:

```
Username: admin
Password: admin123
```

*(For demo/testing only)*

---

# 🗄 Database Tables

| Table    | Purpose            |
| -------- | ------------------ |
| admins   | Admin credentials  |
| packages | Travel packages    |
| bookings | User enquiries     |
| users    | Google login users |

---

# 📈 Future Improvements

* Payment gateway integration
* Booking history dashboard
* Reviews & ratings
* Email notifications
* Advanced filters
* Multi-language support
* Mobile app version

---

# 📌 Project Status

✅ Fully functional
✅ CMS implemented
✅ Database integrated
✅ Live deployed
✅ Admin panel working
✅ Ready for production / academic use

---

# 👨‍💻 Author

**Aditya Seswani**

---

# 📄 License

MIT
