<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ResumeBuilder Pro | Sign Up</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #224abe;
            --accent-color: #2e59d9;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .signup-container {
            max-width: 550px;
            width: 100%;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .signup-container:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .signup-header {
            background: var(--primary-color);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        
        .signup-header h2 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .signup-header p {
            opacity: 0.9;
            font-size: 0.9rem;
        }
        
        .signup-body {
            padding: 2rem;
            background: white;
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
        }
        
        .btn-signup {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-signup:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }
        
        .login-link a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .brand-logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
            display: inline-block;
        }
        
        .brand-logo i {
            margin-right: 10px;
        }
        
        .form-field {
            margin-bottom: 1.25rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="signup-container mx-auto">
            <div class="signup-header">
                <div class="brand-logo">
                    <i class="fas fa-file-alt"></i>ResumeBuilder Pro
                </div>
                <h2>Create Your Account</h2>
                <p>Start building your professional resume today</p>
            </div>
            
            <div class="signup-body">
                <form action="../../backend/services/registerService.php" method="post">
                    <div class="form-field">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" required>
                        </div>
                    </div>
                    
                    <div class="form-field">
                        <label for="full_name" class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" class="form-control" name="fullName" id="full_name" placeholder="Your full name" required>
                        </div>
                    </div>
                    
                    <div class="form-field">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                        </div>
                    </div>
                    
                    <div class="form-field">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" name ="password" id="password" placeholder="Create password" required>
                        </div>
                    </div>
                    
                    <div class="form-field">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" name="confirmPassword" id="confirm_password" placeholder="Confirm password" required>
                        </div>
                    </div>
                    
                    <div class="form-field">
                        <label for="address" class="form-label">Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Your address">
                        </div>
                    </div>
                    
                    <div class="form-field">
                        <label for="contact_no" class="form-label">Contact Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="tel" class="form-control" name="contactNo" id="contact_no" placeholder="Phone number">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-signup w-100 mb-3">
                        <i class="fas fa-user-plus me-2"></i>Create Account
                    </button>
                    
                    <div class="login-link">
                        Already have an account? <a href="#">Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>