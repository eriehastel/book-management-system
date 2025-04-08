<?php
require_once '../config/config.php'; 
require_once '../includes/auth_functions.php';
require_once '../includes/book_functions.php';

if (!is_logged_in()) {
    redirect(BASE_URL . '/auth/login.php');
}

$user_id = $_SESSION['user_id'];
$book_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($book_id > 0) {
    delete_book($book_id, $user_id);
}

redirect(BASE_URL . '/dashboard.php');
?>