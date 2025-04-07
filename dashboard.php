<?php
require_once 'includes/auth_functions.php';
require_once 'includes/book_functions.php';

if (!is_logged_in()) {
    redirect('auth/login.php');
}

$user_id = $_SESSION['user_id'];
$books = get_user_books($user_id);

require_once 'includes/header.php';
require_once 'includes/helpers.php';

display_message();
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <a href="books/add.php" class="btn btn-success mb-3">Add New Book</a>
    
    <div class="row">
        <?php foreach ($books as $book): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="books/view.php?id=<?php echo $book['id']; ?>" class="text-decoration-none">
                                <?php echo htmlspecialchars($book['title']); ?>
                            </a>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($book['author']); ?> (<?php echo $book['year_of_publish']; ?>)</h6>
                        <p class="card-text"><?php echo nl2br(htmlspecialchars(substr($book['recommendations'], 0, 100))); ?><?php if (strlen($book['recommendations']) > 100) echo '...'; ?></p>
                        <div class="btn-group" role="group">
                            <a href="books/view.php?id=<?php echo $book['id']; ?>" class="btn btn-info btn-sm">View</a>
                            <a href="books/edit.php?id=<?php echo $book['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="books/delete.php?id=<?php echo $book['id']; ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>