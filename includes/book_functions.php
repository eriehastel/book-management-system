<?php
require_once 'config.php';

function add_book($user_id, $title, $author, $year, $recommendations) {
    global $pdo;
    
    $stmt = $pdo->prepare("INSERT INTO books 
                          (user_id, title, author, year_of_publish, recommendations, created_at, updated_at) 
                          VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
    return $stmt->execute([$user_id, $title, $author, $year, $recommendations]);
}

function get_user_books($user_id) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM books WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}

function get_book($book_id, $user_id) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM books WHERE id = ? AND user_id = ?");
    $stmt->execute([$book_id, $user_id]);
    return $stmt->fetch();
}

function update_book($book_id, $user_id, $title, $author, $year, $recommendations) {
    global $pdo;
    
    $stmt = $pdo->prepare("UPDATE books 
                          SET title = ?, author = ?, year_of_publish = ?, 
                              recommendations = ?, updated_at = NOW() 
                          WHERE id = ? AND user_id = ?");
    return $stmt->execute([$title, $author, $year, $recommendations, $book_id, $user_id]);
}

function delete_book($book_id, $user_id) {
    global $pdo;
    
    $stmt = $pdo->prepare("DELETE FROM books WHERE id = ? AND user_id = ?");
    return $stmt->execute([$book_id, $user_id]);

    
}

?>