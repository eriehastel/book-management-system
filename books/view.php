<?php
require_once '../includes/auth_functions.php';
require_once '../includes/book_functions.php';
require_once '../includes/helpers.php';

if (!is_logged_in()) {
    redirect('../auth/login.php');
}

$user_id = $_SESSION['user_id'];
$book_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$book = get_book($book_id, $user_id);

if (!$book) {
    $_SESSION['error'] = 'Book not found or you don\'t have permission to view it';
    redirect('../dashboard.php');
}

require_once '../includes/header.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Book Details</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3 fw-bold">Title:</div>
                        <div class="col-sm-9"><?php echo htmlspecialchars($book['title']); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 fw-bold">Author:</div>
                        <div class="col-sm-9"><?php echo htmlspecialchars($book['author']); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 fw-bold">Year of Publication:</div>
                        <div class="col-sm-9"><?php echo $book['year_of_publish']; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 fw-bold">Your Recommendations:</div>
                        <div class="col-sm-9"><?php echo nl2br(htmlspecialchars($book['recommendations'])); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 offset-sm-3">
                            <a href="edit.php?id=<?php echo $book['id']; ?>" class="btn btn-primary">Edit</a>
                            <a href="delete.php?id=<?php echo $book['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
                            <a href="../dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    Added on <?php echo date('F j, Y', strtotime($book['created_at'])); ?>
                    <?php if ($book['updated_at'] != $book['created_at']): ?>
                        <br>Last updated on <?php echo date('F j, Y', strtotime($book['updated_at'])); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>