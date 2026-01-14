AVIPRO TRAVELS (CMS BASED TRAVEL WEBSITE)
------------------------------------------------------------

LIVE APPLICATION
------------------------------------------------------------
https://aviprotravels.kesug.com/


PROJECT OVERVIEW
------------------------------------------------------------
Avipro Travels is a CMS-based travel package booking website developed using
PHP, MySQL, HTML, CSS, JavaScript, and AJAX.

The project provides a complete travel management solution where users can
browse destinations, explore tour packages, and submit booking enquiries.
An admin panel allows administrators to manage packages, bookings, and site
content dynamically.


PROBLEM THIS PROJECT SOLVES
------------------------------------------------------------
Traditional travel websites often face these issues:
- Static content that cannot be updated easily
- No centralized admin control
- Manual handling of booking enquiries
- Poor user experience
- Lack of automation

Avipro Travels solves these problems by:
- Providing a CMS-based system
- Automating booking management
- Centralizing package control
- Offering a modern and responsive UI
- Making the system scalable and easy to manage


KEY FEATURES
------------------------------------------------------------
Frontend
- Modern responsive UI
- Hero section with custom branding
- About Us section with enhanced layout
- Popular Destinations display
- Dynamic Tour Packages
- Masonry-style Photo Gallery
- Booking / Enquiry Form with validation
- AJAX-based form submission
- Contact Page
- Sticky navigation bar

Admin Panel (CMS)
- Secure admin login system
- Dashboard with statistics
- Add / Edit / Delete travel packages
- Upload and manage package images
- View booking and enquiry requests
- Manage site content
- Session-based authentication system


TECHNOLOGIES USED
------------------------------------------------------------
Frontend
- HTML5
- CSS3
- JavaScript

Backend
- PHP 8.x

Database
- MySQL / MariaDB

AJAX
- Used for booking form submission

Deployment
- InfinityFree (PHP hosting)

Version Control
- Git & GitHub


PROJECT STRUCTURE
------------------------------------------------------------
avipro-travels/
|
|-- admin/
|   |-- login.php
|   |-- dashboard.php
|   |-- packages.php
|   |-- bookings.php
|
|-- assets/
|   |-- css/
|   |-- js/
|   |-- images/
|
|-- uploads/
|   |-- packages/
|   |-- gallery/
|
|-- config.php
|-- index.php
|-- packages.php
|-- contact.php
|-- booking_submit.php
|-- google-login.php
|-- google-logout.php
|-- README.md


HOW THE SYSTEM WORKS
------------------------------------------------------------
1. User opens the website.
2. Frontend loads dynamic content from the database.
3. User explores destinations and packages.
4. User submits enquiry through booking form.
5. AJAX sends data to the backend.
6. PHP stores enquiry in MySQL database.
7. Admin logs in to the CMS panel.
8. Admin views bookings and manages packages.
9. Changes are reflected instantly on the website.


INSTALLATION (LOCAL SETUP)
------------------------------------------------------------
1. Install XAMPP.
2. Move project folder to:

   C:/xampp/htdocs/avipro-travels

3. Start Apache and MySQL.
4. Open phpMyAdmin:

   http://localhost/phpmyadmin

5. Create database:

   avipro_travels

6. Import database file:

   avipro_travels.sql

7. Open website:

   http://localhost/avipro-travels/


DEPLOYMENT
------------------------------------------------------------
This project is deployed using InfinityFree.

Live Website:
https://aviprotravels.kesug.com/

The hosting supports PHP and MySQL, making it suitable for CMS-based
applications with database integration.


ADMIN PANEL ACCESS
------------------------------------------------------------
Admin Login URL:
https://aviprotravels.kesug.com/admin/login.php

Admin Credentials:
Username: admin
Password: admin123


DATABASE STRUCTURE
------------------------------------------------------------
Tables used in the system:

- admins
  -> Stores admin login credentials

- packages
  -> Stores travel package information

- bookings
  -> Stores user booking enquiries

- users
  -> Stores Google sign-in users 



FUTURE IMPROVEMENTS
------------------------------------------------------------
- User dashboard for booking history
- Payment gateway integration
- Advanced search and filters
- Review and rating system
- Email notification system
- Multi-language support
- Mobile app version


PROJECT STATUS
------------------------------------------------------------
- Fully functional
- CMS implemented
- Database connected
- Live deployed
- Admin panel working
- Booking system working
- Ready for academic submission


TEAM MEMBERS
------------------------------------------------------------
Aditya  
Sumukh  
Aryan  
Heramb  
Chaitanya  


CONCLUSION
------------------------------------------------------------
Avipro Travels is a complete CMS-based travel website that demonstrates
full-stack web development skills using PHP and MySQL. The project focuses on
real-world usability, admin control, automation, and modern user interface
design, making it suitable for academic evaluation and portfolio showcase.


AUTHOR
------------------------------------------------------------
Aditya Seswani
