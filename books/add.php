<?php
require_once '../includes/config.php'; 
require_once '../includes/auth_functions.php';
require_once '../includes/book_functions.php';

if (!is_logged_in()) {
    redirect('/auth/login.php'); // Using absolute path with BASE_URL
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $year = trim($_POST['year']);
    $recommendations = trim($_POST['recommendations']);
    
    if (add_book($_SESSION['user_id'], $title, $author, $year, $recommendations)) {
        $_SESSION['success_message'] = 'Book added successfully!';
        redirect('/dashboard.php'); // Using absolute path
    } else {
        $error = "Failed to add book. Please try again.";
    }
}

require_once '../includes/header.php';
?>

<div class="container">
    <h2>Add New Book</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>
        <div class="form-group">
            <label for="year">Year of Publication</label>
            <input type="number" class="form-control" id="year" name="year" required>
        </div>
        <div class="form-group">
            <label for="recommendations">Your Recommendations</label>
            <textarea class="form-control" id="recommendations" name="recommendations" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Book</button>
        <a href="../dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>