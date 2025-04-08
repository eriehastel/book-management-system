## Installation Guide

### Requirements
- PHP 7.4+
- MySQL 5.7+
- Web server (Apache/Nginx)

### Setup Steps
1. Clone repository:
   bash
   git clone https://github.com/eriehastel/book-management-system.git
  
2. Import database:
   bash
   mysql -u root -p book_management < database.sql
   
3. Configure database:
   php
   // includes/config.php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'book_management');
   define('DB_USER', 'your_username');
   define('DB_PASS', 'your_password');
   
4. Set permissions:
   bash
   chmod 755 -R assets/
   
