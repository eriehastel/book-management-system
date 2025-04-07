<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'book_management');
define('DB_USER', 'root');
define('DB_PASS', '');
define('BASE_URL', '/book-management-system');

// Secure session initialization
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'name' => 'BookManagementSession',
        'cookie_lifetime' => 86400,       
        'cookie_path' => BASE_URL,
        'cookie_secure' => false,         
        'cookie_httponly' => true,
        'cookie_samesite' => 'Strict',
        'use_strict_mode' => true,
        'use_only_cookies' => 1
    ]);
}

// secure database connection
try {
    $pdo = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_PERSISTENT => false
        ]
    );
} catch(PDOException $e) {
    error_log("Database connection error: " . $e->getMessage());
    die("We're experiencing technical difficulties. Please try again later.");
}

function redirect($location) {
    
    if (strpos($location, BASE_URL) !== 0 && !filter_var($location, FILTER_VALIDATE_URL)) {
        $location = rtrim(BASE_URL, '/') . '/' . ltrim($location, '/');
    }
    
    if (!headers_sent()) {
        header("Location: $location");
        exit;
    }
    
    
    echo "<script>window.location.href='$location';</script>";
    exit;
}

// Security headers
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: strict-origin-when-cross-origin");
?>