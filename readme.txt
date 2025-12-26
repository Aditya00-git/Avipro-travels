===========================================
README.txt – Avipro Travels (CMS Project)
===========================================

Project Title:
Avipro Travels – CMS-Based Travel Package Booking Website

Developed by:
Aditya, Sumukh, Aryan, Heramb, Chaitanya

Technologies Used:
HTML, CSS, JavaScript, AJAX, PHP (8.x), MySQL (MariaDB)
Server Required:
XAMPP / WAMP / LAMP (Recommended: XAMPP 8+)

Project Type:
Dynamic CMS-based travel package website with admin control panel


-------------------------------------------
1. PROJECT OVERVIEW
-------------------------------------------

Avipro Travels is a dynamic travel website that allows users to explore Indian 
tourist destinations, view travel packages, submit enquiries, and browse a 
masonry-style photo gallery. The website includes:

- Home section with hero banner
- Modern About Us section
- Destinations
- Packages (dynamic from database)
- Gallery with auto-loading images
- Contact Us
- Booking/Enquiry system (AJAX)
- Google Sign-In integration

A full CMS-based Admin Panel allows site administrators to:

- Add, edit, delete travel packages
- Upload package images
- Manage website content
- View booking/enquiry submissions
- Maintain data securely using sessions


-------------------------------------------
2. FOLDER STRUCTURE
-------------------------------------------

avipro-travels/
│
├── admin/
│   ├── login.php
│   ├── logout.php
│   ├── dashboard.php
│   ├── packages.php / manage_packages.php
│   ├── add_package.php
│   ├── edit_package.php
│   ├── delete_package.php
│   ├── bookings.php / view_bookings.php
│   ├── site-content.php (if added)
│
├── assets/
│   ├── css/style.css
│   ├── js/main.js
│   ├── js/script.js
│   ├── js/header.js
│   ├── images/* (frontend images)
│
├── uploads/
│   ├── packages/ 
│   ├── gallery/  
│
├── config.php
├── index.php
├── packages.php
├── package-details.php
├── contact.php
├── booking_submit.php
├── google-login.php
├── google-logout.php
└── README.txt
├── avipro report.pdf
├── website images/



-------------------------------------------
3. INSTALLATION INSTRUCTIONS
-------------------------------------------

1. Extract the ZIP file.

2. Move the folder:
   avipro-travels → C:/xampp/htdocs/

3. Start XAMPP:
   - Apache (ON)
   - MySQL (ON)

4. Import the database:
   - Open http://localhost/phpmyadmin
   - Create a database named: avipro_travels
   - Click IMPORT
   - Select file: avipro_travels.sql
   - Click GO

5. Open the website in browser:
   http://localhost/avipro-travels/

6. Open Admin Panel:
   http://localhost/avipro-travels/admin/login.php


-------------------------------------------
4. ADMIN LOGIN CREDENTIALS
-------------------------------------------

Username: admin
Password: admin123

These credentials are stored inside the 'admins' table.


-------------------------------------------
5. FRONTEND FEATURES
-------------------------------------------

- Clean and modern hero section
- Dark blue header with search and sign-in options
- Sticky navigation bar
- Enhanced About Us section with modern design
- Popular destinations displayed dynamically
- Dynamic Packages system (CRUD from admin panel)
- Masonry-style auto-loading gallery
- Contact page with email & phone display
- Modern Booking/Enquiry form with:
  - Client-side validation
  - AJAX submission
  - Database storage
- Fully responsive layout across devices
- Smooth scroll navigation
- Footer with structured layout


-------------------------------------------
6. ADMIN PANEL FEATURES
-------------------------------------------

- Session-based secure login system
- Dashboard showing package & booking counts
- Add new travel packages
- Edit existing packages
- Delete packages
- Upload and update package images
- View all booking enquiries submitted by users
- Organized Bootstrap-based UI for ease of use
- Logout system with session destroy


-------------------------------------------
7. DATABASE TABLES
-------------------------------------------

1. admins
   Columns: id, username, password

2. packages
   Columns: id, title, slug, destination, duration, price, 
            short_description, full_description, image

3. bookings
   Columns: id, name, email, phone, destination, travel_date,
            persons, message, created_at


-------------------------------------------
8. HOW TO USE THE PROJECT
-------------------------------------------

Frontend user:
- Browse packages and destinations
- Open package details
- Submit enquiries using AJAX-based form
- View gallery images auto-loaded from uploads/gallery
- Contact via contact form
- Optional: Sign in using Google OAuth

Admin user:
- Log in using admin credentials
- Manage packages (add / edit / delete)
- View booking requests
- Update website content
- Upload images for packages and gallery


-------------------------------------------
9. IMPORTANT NOTES
-------------------------------------------

- Ensure "uploads/" folder has write permissions:
  Windows: No issue
  Linux/Mac: chmod 755 or 777 if required

- booking_submit.php must NOT be renamed (AJAX depends on it)

- Google Sign-In:
  Works only on developer's system unless the professor
  updates the Google Client ID and Redirect URI.
  This is NORMAL and does NOT affect evaluation.

- If packages do not show images:
  Ensure images exist inside uploads/packages/

- If gallery is empty:
  Add images inside uploads/gallery/


-------------------------------------------
10. WHAT THE PROFESSOR MUST DO TO RUN THE PROJECT
-------------------------------------------

1. Install and open XAMPP  
2. Move the avipro-travels folder into htdocs  
3. Import the avipro_travels.sql file  
4. Open:
   http://localhost/avipro-travels/

Admin Panel:
   http://localhost/avipro-travels/admin/login.php

5. Use credentials:
   Username: admin
   Password: admin123

6. Test:
   - Add packages
   - Delete packages
   - Submit a sample enquiry
   - Check if booking appears in admin panel


-------------------------------------------
11. WHAT TO SUBMIT (PROJECT REQUIREMENTS)
-------------------------------------------

1. ZIP file of the complete project  
2. Database file (.sql)  
3. Admin login credentials  
4. Screenshots of:
   - Homepage
   - About Us
   - Destinations
   - Packages
   - Gallery
   - Contact Us
   - Booking Form
   - Admin Login
   - Admin Dashboard
   - Manage Packages
   - View Bookings


-------------------------------------------
12. PROJECT STATUS
-------------------------------------------

- Fully functional
- Database integrated
- Admin CMS working
- Booking system complete
- Responsive UI implemented
- Google OAuth integrated (optional)
- Ready for submission


-------------------------------------------
END OF README
-------------------------------------------
