<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - Steam Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Global Styles matching Steam theme */
        body {
            background-color: #1b2838;
            color: #c7d5e0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-image: url('BACKGROUND_IMAGE_LOGIN.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(27, 40, 56, 0.95), rgba(23, 26, 33, 0.95));
            z-index: -1;
        }

        .reset-container {
            max-width: 480px;
            margin: auto;
            padding: 20px;
        }

        .reset-card {
            background: linear-gradient(135deg, rgba(23, 26, 33, 0.98), rgba(27, 40, 56, 0.98));
            border-radius: 8px;
            padding: 50px 40px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(102, 192, 244, 0.1);
        }

        .reset-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .reset-header h1 {
            color: #ffffff;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .reset-header p {
            color: #8f98a0;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .email-display {
            background-color: rgba(102, 192, 244, 0.1);
            border: 1px solid rgba(102, 192, 244, 0.3);
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 25px;
            text-align: center;
        }

        .email-display strong {
            color: #66c0f4;
            font-size: 0.95rem;
        }

        .form-label {
            color: #c7d5e0;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .form-control {
            background-color: #32353c;
            border: 1px solid #3d4450;
            color: #c7d5e0;
            height: 48px;
            border-radius: 4px;
            font-size: 0.95rem;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: #32353c;
            border-color: #66c0f4;
            color: #ffffff;
            box-shadow: 0 0 0 3px rgba(102, 192, 244, 0.15);
            outline: none;
        }

        .form-control::placeholder {
            color: #5c6873;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #8f98a0;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #66c0f4;
        }

        .password-input-wrapper {
            position: relative;
        }

        .btn-submit {
            width: 100%;
            background: linear-gradient(90deg, #06bfff 0%, #2d73ff 100%);
            color: #ffffff;
            border: none;
            padding: 14px;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 4px;
            margin-top: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 192, 244, 0.3);
        }

        .btn-submit:hover {
            background: linear-gradient(90deg, #2d73ff 0%, #06bfff 100%);
            box-shadow: 0 6px 20px rgba(102, 192, 244, 0.5);
            transform: translateY(-2px);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .back-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid rgba(102, 192, 244, 0.1);
        }

        .back-link a {
            color: #66c0f4;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .back-link a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        .alert {
            border-radius: 4px;
            padding: 12px 15px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .alert-danger {
            background-color: rgba(255, 107, 107, 0.1);
            border: 1px solid rgba(255, 107, 107, 0.3);
            color: #ff6b6b;
        }

        .alert-success {
            background-color: rgba(102, 192, 244, 0.1);
            border: 1px solid rgba(102, 192, 244, 0.3);
            color: #66c0f4;
        }

        .password-requirements {
            background-color: rgba(102, 192, 244, 0.05);
            border-left: 3px solid #66c0f4;
            padding: 15px;
            border-radius: 4px;
            margin-top: 15px;
        }

        .password-requirements h6 {
            color: #66c0f4;
            font-size: 0.85rem;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .password-requirements ul {
            margin: 0;
            padding-left: 20px;
        }

        .password-requirements li {
            color: #8f98a0;
            font-size: 0.8rem;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="reset-container">
        <div class="reset-card">
            <div class="reset-header">
                <h1><i class="fas fa-key"></i> Reset Password</h1>
                <p>Create a new password for your account</p>
            </div>

            <div class="email-display" id="emailDisplay">
                <strong id="userEmail">Loading...</strong>
            </div>

            <div id="messageContainer"></div>

            <form id="resetPasswordForm">
                <input type="hidden" id="email" name="email">
                
                <div class="mb-3">
                    <label for="newPassword" class="form-label">New Password</label>
                    <div class="password-input-wrapper">
                        <input type="password" class="form-control" id="newPassword" name="newPassword"
                            placeholder="Enter new password" required>
                        <i class="fas fa-eye password-toggle" id="toggleNewPassword"></i>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <div class="password-input-wrapper">
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                            placeholder="Confirm new password" required>
                        <i class="fas fa-eye password-toggle" id="toggleConfirmPassword"></i>
                    </div>
                </div>

                <div class="password-requirements">
                    <h6><i class="fas fa-shield-alt"></i> Password Requirements</h6>
                    <ul>
                        <li>At least 8 characters long</li>
                        <li>Contains uppercase and lowercase letters</li>
                        <li>Contains at least one number</li>
                    </ul>
                </div>

                <button type="submit" class="btn btn-submit">Reset Password</button>
            </form>

            <div class="back-link">
                <a href="login.php"><i class="fas fa-arrow-left"></i> Back to Sign In</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Get email from URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const email = urlParams.get('email');
        
        // Check if email exists in URL
        if (!email) {
            window.location.href = 'forgot_password.php';
        }

        // Display email
        document.getElementById('userEmail').textContent = email;
        document.getElementById('email').value = email;

        const form = document.getElementById('resetPasswordForm');
        const messageContainer = document.getElementById('messageContainer');

        // Password toggle functionality
        document.getElementById('toggleNewPassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('newPassword');
            const icon = this;
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('confirmPassword');
            const icon = this;
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Form submission
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const submitBtn = form.querySelector('button[type="submit"]');
            
            // Clear previous messages
            messageContainer.innerHTML = '';
            
            // Validate passwords match
            if (newPassword !== confirmPassword) {
                messageContainer.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i> Passwords do not match
                    </div>
                `;
                return;
            }
            
            // Validate password strength
            if (newPassword.length < 8) {
                messageContainer.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i> Password must be at least 8 characters long
                    </div>
                `;
                return;
            }
            
            // Disable button and show loading
            submitBtn.disabled = true;
            submitBtn.textContent = 'Resetting Password...';
            
            try {
                const response = await fetch('../php_backend/update_password.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ 
                        email: email,
                        new_password: newPassword 
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Show success message
                    messageContainer.innerHTML = `
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> ${data.message}
                        </div>
                    `;
                    
                    // Redirect to login after 2 seconds
                    setTimeout(() => {
                        window.location.href = 'login.php?success=password_reset';
                    }, 2000);
                } else {
                    // Show error message
                    messageContainer.innerHTML = `
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i> ${data.message || 'Failed to reset password'}
                        </div>
                    `;
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Reset Password';
                }
            } catch (error) {
                console.error('Error:', error);
                messageContainer.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i> An error occurred. Please try again.
                    </div>
                `;
                submitBtn.disabled = false;
                submitBtn.textContent = 'Reset Password';
            }
        });
    </script>
</body>

</html>
