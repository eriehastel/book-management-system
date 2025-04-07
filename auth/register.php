<?php
require_once '../includes/config.php'; // Includes session_start()
require_once '../includes/auth_functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (register_user($username, $password)) {
        $_SESSION['register_success'] = 'Registration successful! Please login.';
        redirect('/auth/login.php'); // absolute path with BASE_URL
    } else {
        $error = "Username already exists";
    }
}

require_once '../includes/header.php';
?>

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

.btn-register {
    padding: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    background-color: #2ecc71;
    border: none;
    transition: all 0.3s;
}

.btn-register:hover {
    background-color: #27ae60;
    transform: translateY(-2px);
}

.login-link {
    color: #3498db;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.3s;
}

.login-link:hover {
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

.password-strength {
    height: 5px;
    background: #eee;
    margin-top: 5px;
    border-radius: 3px;
    overflow: hidden;
}

.strength-meter {
    height: 100%;
    width: 0;
    background: transparent;
    transition: width 0.3s, background 0.3s;
}
</style>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h2 class="login-title">Book Management System</h2>
            <p class="login-subtitle">Create your account</p>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $error; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <form method="post" class="login-form" id="registerForm">
            <div class="form-group mb-4">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                        </svg>
                    </span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required minlength="3">
                </div>
            </div>
            
            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        </svg>
                    </span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required minlength="6">
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                        </svg>
                    </button>
                </div>
                <div class="password-strength">
                    <div class="strength-meter" id="passwordStrength"></div>
                </div>
                <small class="text-muted">Minimum 6 characters</small>
            </div>
            
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-register">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                    Register
                </button>
            </div>
            
            <div class="text-center">
                <p class="mb-0">Already have an account? <a href="<?php echo BASE_URL; ?>/auth/login.php" class="login-link">Login here</a></p>
            </div>
        </form>
    </div>
</div>

<script>
// Toggle password visibility with animation
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

// Password strength indicator
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthMeter = document.getElementById('passwordStrength');
    let strength = 0;
    
    if (password.length >= 6) strength += 1;
    if (password.length >= 8) strength += 1;
    if (/[A-Z]/.test(password)) strength += 1;
    if (/[0-9]/.test(password)) strength += 1;
    if (/[^A-Za-z0-9]/.test(password)) strength += 1;
    
    const width = (strength / 5) * 100;
    let color = '#e74c3c'; // Red
    
    if (strength >= 3) color = '#f39c12'; 
    if (strength >= 4) color = '#2ecc71'; 
    
    strengthMeter.style.width = width + '%';
    strengthMeter.style.background = color;
});
</script>

<?php require_once '../includes/footer.php'; ?>