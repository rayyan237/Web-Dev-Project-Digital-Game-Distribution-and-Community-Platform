<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In - Steam Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    
    <style>
        /* SCOPED STYLES 
           All styles are prefixed with .login-scoped-wrapper 
           to prevent leaking into the Navbar or Global styles.
        */

        /* The main wrapper handles the background and centering */
        .login-scoped-wrapper {
            background-color: #1b2838;
            color: #c7d5e0;
            font-family: "Motiva Sans", "Segoe UI", "Arial", sans-serif;
            min-height: calc(100vh - 56px); /* Subtract approx navbar height */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Centers card vertically */
            align-items: center;     /* Centers card horizontally */
            
            /* Background Image Logic */
            background-image: url('BACKGROUND_IMAGE_LOGIN.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
            padding: 20px;
        }

        /* Dark Overlay specifically for the login area */
        .login-scoped-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(27, 40, 56, 0.95), rgba(23, 26, 33, 0.95));
            z-index: 0;
        }

        /* Ensure content sits above the overlay */
        .login-scoped-wrapper .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 480px;
        }

        .login-scoped-wrapper .login-card {
            background: linear-gradient(135deg, rgba(23, 26, 33, 0.98), rgba(27, 40, 56, 0.98));
            border-radius: 8px;
            padding: 50px 40px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(102, 192, 244, 0.1);
        }

        .login-scoped-wrapper .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .login-scoped-wrapper .login-header h1 {
            color: #ffffff;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .login-scoped-wrapper .login-header p {
            color: #8f98a0;
            font-size: 0.95rem;
            margin-bottom: 0;
        }

        .login-scoped-wrapper .form-label {
            color: #c7d5e0;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        /* Scoped form-control to avoid breaking Navbar inputs */
        .login-scoped-wrapper .form-control {
            background-color: #32353c;
            border: 1px solid #3d4450;
            color: #c7d5e0;
            height: 48px;
            border-radius: 4px;
            font-size: 0.95rem;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .login-scoped-wrapper .form-control:focus {
            background-color: #32353c;
            border-color: #66c0f4;
            color: #ffffff;
            box-shadow: 0 0 0 3px rgba(102, 192, 244, 0.15);
            outline: none;
        }

        .login-scoped-wrapper .form-control::placeholder {
            color: #7a7f84;
        }

        .login-scoped-wrapper .btn-login {
            background: linear-gradient(135deg, #66c0f4, #4a9ed6);
            border: none;
            color: #ffffff;
            height: 50px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 10px;
            box-shadow: 0 4px 15px rgba(102, 192, 244, 0.3);
        }

        .login-scoped-wrapper .btn-login:hover {
            background: linear-gradient(135deg, #4a9ed6, #3a8ec6);
            box-shadow: 0 6px 20px rgba(102, 192, 244, 0.5);
            transform: translateY(-2px);
        }

        .login-scoped-wrapper .btn-login:active {
            transform: translateY(0);
        }

        .login-scoped-wrapper .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .login-scoped-wrapper .form-check {
            display: flex;
            align-items: center;
            min-height: auto;
            margin-bottom: 0;
        }

        .login-scoped-wrapper .form-check-input {
            width: 18px;
            height: 18px;
            background-color: #32353c;
            border: 2px solid #3d4450;
            cursor: pointer;
            margin-right: 8px;
            margin-top: 0;
            float: none;
        }

        .login-scoped-wrapper .form-check-input:checked {
            background-color: #66c0f4;
            border-color: #66c0f4;
        }

        .login-scoped-wrapper .form-check-label {
            color: #c7d5e0;
            font-size: 0.9rem;
            cursor: pointer;
            user-select: none;
        }

        .login-scoped-wrapper .forgot-password {
            color: #66c0f4;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .login-scoped-wrapper .forgot-password:hover {
            color: #4a9ed6;
            text-decoration: underline;
        }

        .login-scoped-wrapper .signup-link {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #3d4450;
        }

        .login-scoped-wrapper .signup-link p {
            color: #8f98a0;
            font-size: 0.95rem;
            margin-bottom: 15px;
        }

        .login-scoped-wrapper .btn-signup {
            background-color: transparent;
            border: 2px solid #66c0f4;
            color: #66c0f4;
            height: 48px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .login-scoped-wrapper .btn-signup:hover {
            background-color: #66c0f4;
            color: #171a21;
            box-shadow: 0 4px 15px rgba(102, 192, 244, 0.4);
            transform: translateY(-2px);
        }

        .login-scoped-wrapper .alert {
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .login-scoped-wrapper .alert-danger {
            background-color: rgba(194, 45, 45, 0.2);
            border: 1px solid rgba(194, 45, 45, 0.4);
            color: #ff6b6b;
        }

        @media (max-width: 576px) {
            .login-scoped-wrapper .login-card {
                padding: 40px 25px;
            }

            .login-scoped-wrapper .login-header h1 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>
    <?php include 'section-navbar.php'; ?>

    <div class="login-scoped-wrapper">
        <div class="login-container">
            <div class="login-card">
                <div class="login-header">
                    <h1>Sign In</h1>
                    <p>Welcome back to the gaming platform</p>
                </div>

                <div id="errorAlert" class="alert alert-danger" role="alert" style="display: none;"></div>
                <div id="successAlert" class="alert alert-success" role="alert" style="display: none;"></div>

                <form action="../php_backend/login_process.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Sign In With Account Name</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Enter your username" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter your password" required>
                    </div>

                    <div class="remember-forgot">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                        <a href="forgot_password.php" class="forgot-password">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn btn-login">Sign In</button>
                </form>

                <div class="signup-link">
                    <p>Don't have an account yet?</p>
                    <a href="signup.php">
                        <button type="button" class="btn btn-signup">Create Your Account</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Show error/success messages from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');
        const success = urlParams.get('success');

        if (error) {
            const errorAlert = document.getElementById('errorAlert');
            errorAlert.textContent = decodeURIComponent(error);
            errorAlert.style.display = 'block';
        }

        if (success) {
            const successAlert = document.getElementById('successAlert');
            if (success === 'password_reset') {
                successAlert.textContent = 'Password reset successfully! You can now sign in with your new password.';
            } else {
                successAlert.textContent = decodeURIComponent(success);
            }
            successAlert.style.display = 'block';
        }
    </script>
</body>

</html>