<?php
require_once '../includes/config.php'; // This includes session_start()
require_once '../includes/auth_functions.php';

// Display logout message if exists
if (isset($_SESSION['logout_message'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            '.$_SESSION['logout_message'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    unset($_SESSION['logout_message']);
}

// Process login form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (login_user($username, $password)) {
        redirect('/dashboard.php'); // Using absolute path with BASE_URL
    } else {
        $error = "Invalid username or password";
    }
}

require_once '../includes/header.php';
?>

<!--  Login style -->
<style>
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding: 20px;
}

.login-card {
    width: 100%;
    max-width: 450px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    padding: 2.5rem;
    transition: transform 0.3s ease;
}

.login-card:hover {
    transform: translateY(-5px);
}

.login-header {
    text-align: center;
    margin-bottom: 2rem;
}

.login-title {
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.login-subtitle {
    color: #7f8c8d;
    font-size: 0.95rem;
}

.login-form .form-label {
    font-weight: 600;
    color: #34495e;
    margin-bottom: 0.5rem;
}

.input-group-text {
    background-color: #f8f9fa;
    border-right: none;
}

.form-control {
    border-left: none;
    padding: 0.75rem;
    transition: border-color 0.3s;
}

.form-control:focus {
    box-shadow: none;
    border-color: #a1cbef;
}

.btn-login {
    padding: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    background-color: #3498db;
    border: none;
    transition: all 0.3s;
}

.btn-login:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
}

.register-link {
    color: #3498db;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.3s;
}

.register-link:hover {
    color: #2980b9;
    text-decoration: underline;
}

.toggle-password {
    cursor: pointer;
    transition: all 0.3s;
}

.toggle-password:hover {
    background-color: #e9ecef;
}
</style>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h2 class="login-title">Book Management System</h2>
            <p class="login-subtitle">Sign in to your account</p>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $error; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <form method="post" class="login-form">
            <div class="form-group mb-4">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                        </svg>
                    </span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                </div>
            </div>
            
            <div class="form-group mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        </svg>
                    </span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-login">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                    Login
                </button>
            </div>
            
            <div class="text-center mt-4">
                <p class="mb-0">Don't have an account? <a href="<?php echo BASE_URL; ?>/auth/register.php" class="register-link">Register here</a></p>
            </div>
        </form>
    </div>
</div>

<script>
// Enhanced password toggle with animation
document.querySelector('.toggle-password').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const icon = this.querySelector('svg');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
        this.classList.add('active');
    } else {
        passwordInput.type = 'password';
        icon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
        this.classList.remove('active');
    }
});
</script>

<?php require_once '../includes/footer.php'; ?>