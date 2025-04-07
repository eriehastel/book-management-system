<?php
require_once '../includes/config.php';  // Make sure to include config first
require_once '../includes/auth_functions.php';

// Enhanced logout function with session cleanup
function secure_logout() {
    // Unset all session variables
    $_SESSION = array();

    // Delete session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Destroy the session
    session_destroy();
}

// Perform logout
secure_logout();

// Set logout message
$_SESSION['logout_message'] = 'You have been successfully logged out.';

// Redirect to login page using absolute URL
header('Location: ' . BASE_URL . '/auth/login.php');
exit;
?>