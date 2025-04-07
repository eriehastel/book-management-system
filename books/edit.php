<?php
require_once '../includes/auth_functions.php';
require_once '../includes/book_functions.php';

if (!is_logged_in()) {
    redirect('../auth/login.php');
}

$user_id = $_SESSION['user_id'];
$book_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$book = get_book($book_id, $user_id);

if (!$book) {
    redirect('../dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $year = trim($_POST['year']);
    $recommendations = trim($_POST['recommendations']);
    
    if (update_book($book_id, $user_id, $title, $author, $year, $recommendations)) {
        redirect('../dashboard.php');
    } else {
        $error = "Failed to update book";
    }
}

require_once '../includes/header.php';
?>

<div class="container">
    <h2>Edit Book</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>
        </div>
        <div class="form-group">
            <label for="year">Year of Publication</label>
            <input type="number" class="form-control" id="year" name="year" value="<?php echo $book['year_of_publish']; ?>" required>
        </div>
        <div class="form-group">
            <label for="recommendations">Your Recommendations</label>
            <textarea class="form-control" id="recommendations" name="recommendations" rows="5" required><?php echo htmlspecialchars($book['recommendations']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Book</button>
        <a href="../dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>