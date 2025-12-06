<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password - Steam Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    
    <style>
        /* SCOPED STYLES 
           All styles are prefixed with .forgot-scoped-wrapper 
           to prevent leaking into the Navbar or Global styles.
        */

        /* The main wrapper handles the background and centering */
        .forgot-scoped-wrapper {
            background-color: #1b2838;
            color: #c7d5e0;
            font-family: "Motiva Sans", "Segoe UI", "Arial", sans-serif;
            /* Subtract approx navbar height to center vertically in remaining space */
            min-height: calc(100vh - 56px); 
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            
            /* Background Image Logic */
            background-image: url('BACKGROUND_IMAGE_LOGIN.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
            padding: 20px;
        }

        /* Dark Overlay specific to this page section */
        .forgot-scoped-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(27, 40, 56, 0.95), rgba(23, 26, 33, 0.95));
            z-index: 0;
        }

        .forgot-scoped-wrapper .forgot-container {
            max-width: 480px;
            width: 100%;
            margin: auto;
            position: relative;
            z-index: 1;
        }

        .forgot-scoped-wrapper .forgot-card {
            background: linear-gradient(135deg, rgba(23, 26, 33, 0.98), rgba(27, 40, 56, 0.98));
            border-radius: 8px;
            padding: 50px 40px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(102, 192, 244, 0.1);
        }

        .forgot-scoped-wrapper .forgot-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .forgot-scoped-wrapper .forgot-header h1 {
            color: #ffffff;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .forgot-scoped-wrapper .forgot-header p {
            color: #8f98a0;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 0;
        }

        .forgot-scoped-wrapper .form-label {
            color: #c7d5e0;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        /* Scoped form-control to avoid affecting Navbar inputs */
        .forgot-scoped-wrapper .form-control {
            background-color: #32353c;
            border: 1px solid #3d4450;
            color: #c7d5e0;
            height: 48px;
            border-radius: 4px;
            font-size: 0.95rem;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .forgot-scoped-wrapper .form-control:focus {
            background-color: #32353c;
            border-color: #66c0f4;
            color: #ffffff;
            box-shadow: 0 0 0 3px rgba(102, 192, 244, 0.15);
            outline: none;
        }

        .forgot-scoped-wrapper .form-control::placeholder {
            color: #5c6873;
        }

        .forgot-scoped-wrapper .btn-submit {
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

        .forgot-scoped-wrapper .btn-submit:hover {
            background: linear-gradient(90deg, #2d73ff 0%, #06bfff 100%);
            box-shadow: 0 6px 20px rgba(102, 192, 244, 0.5);
            transform: translateY(-2px);
        }

        .forgot-scoped-wrapper .btn-submit:active {
            transform: translateY(0);
        }

        .forgot-scoped-wrapper .back-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid rgba(102, 192, 244, 0.1);
        }

        .forgot-scoped-wrapper .back-link a {
            color: #66c0f4;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-scoped-wrapper .back-link a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        .forgot-scoped-wrapper .alert {
            border-radius: 4px;
            padding: 12px 15px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .forgot-scoped-wrapper .alert-danger {
            background-color: rgba(255, 107, 107, 0.1);
            border: 1px solid rgba(255, 107, 107, 0.3);
            color: #ff6b6b;
        }

        .forgot-scoped-wrapper .alert-success {
            background-color: rgba(102, 192, 244, 0.1);
            border: 1px solid rgba(102, 192, 244, 0.3);
            color: #66c0f4;
        }

        .forgot-scoped-wrapper .info-box {
            background-color: rgba(102, 192, 244, 0.05);
            border-left: 3px solid #66c0f4;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 25px;
        }

        .forgot-scoped-wrapper .info-box i {
            color: #66c0f4;
            margin-right: 10px;
        }

        .forgot-scoped-wrapper .info-box p {
            margin: 0;
            color: #c7d5e0;
            font-size: 0.85rem;
            line-height: 1.5;
            display: inline;
        }
        
        @media (max-width: 576px) {
            .forgot-scoped-wrapper .forgot-card {
                padding: 40px 25px;
            }
        }
    </style>
</head>

<body>
    <?php include 'section-navbar.php'; ?>
    
    <div class="forgot-scoped-wrapper">
        <div class="forgot-container">
            <div class="forgot-card">
                <div class="forgot-header">
                    <h1><i class="fas fa-lock"></i> Forgot Password</h1>
                    <p>Enter your email address to reset your password</p>
                </div>

                <div id="messageContainer"></div>

                <div class="info-box">
                    <i class="fas fa-info-circle"></i>
                    <p>This is a temporary reset flow. You will be redirected to change your password directly.</p>
                </div>

                <form id="forgotPasswordForm">
                    <div class="mb-4">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Enter your registered email" required>
                    </div>

                    <button type="submit" class="btn btn-submit">Continue to Reset Password</button>
                </form>

                <div class="back-link">
                    <a href="login.php"><i class="fas fa-arrow-left"></i> Back to Sign In</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const form = document.getElementById('forgotPasswordForm');
        const messageContainer = document.getElementById('messageContainer');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const submitBtn = form.querySelector('button[type="submit"]');
            
            // Disable button and show loading
            submitBtn.disabled = true;
            submitBtn.textContent = 'Verifying...';
            
            try {
                const response = await fetch('../php_backend/verify_email.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ email: email })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Email exists, redirect to reset password page with email
                    window.location.href = `reset_password.php?email=${encodeURIComponent(email)}`;
                } else {
                    // Show error message
                    messageContainer.innerHTML = `
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i> ${data.message || 'Email not found'}
                        </div>
                    `;
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Continue to Reset Password';
                }
            } catch (error) {
                console.error('Error:', error);
                messageContainer.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i> An error occurred. Please try again.
                    </div>
                `;
                submitBtn.disabled = false;
                submitBtn.textContent = 'Continue to Reset Password';
            }
        });
    </script>
</body>

</html>