<?php
// Main entry point for the application
require_once 'includes/config.php';

if (is_logged_in()) {
    redirect('dashboard.php');
} else {
    redirect('auth/login.php');
}
?>