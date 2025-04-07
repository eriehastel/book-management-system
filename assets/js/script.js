// Client-side JavaScript for the Book Management System
document.addEventListener('DOMContentLoaded', function() {
    // Confirm before deleting a book (added as backup to the inline onclick)
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this book?')) {
                e.preventDefault();
            }
        });
    });

    // Form validation for book forms
    const bookForms = document.querySelectorAll('.book-form');
    bookForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const title = form.querySelector('#title').value.trim();
            const author = form.querySelector('#author').value.trim();
            const year = form.querySelector('#year').value.trim();
            
            if (!title || !author || !year) {
                e.preventDefault();
                alert('Please fill in all required fields');
            }
        });
    });
});