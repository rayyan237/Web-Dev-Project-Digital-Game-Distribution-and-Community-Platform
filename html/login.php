<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In - Steam Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Global Styles matching Steam theme */
        body {
            background-color: #1b2838;
            color: #c7d5e0;
            font-family: "Motiva Sans", "Segoe UI", "Arial", sans-serif;
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

        .login-container {
            max-width: 480px;
            margin: auto;
            padding: 20px;
        }

        .login-card {
            background: linear-gradient(135deg, rgba(23, 26, 33, 0.98), rgba(27, 40, 56, 0.98));
            border-radius: 8px;
            padding: 50px 40px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(102, 192, 244, 0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .login-header h1 {
            color: #ffffff;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .login-header p {
            color: #8f98a0;
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
            color: #7a7f84;
        }

        .btn-login {
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

        .btn-login:hover {
            background: linear-gradient(135deg, #4a9ed6, #3a8ec6);
            box-shadow: 0 6px 20px rgba(102, 192, 244, 0.5);
            transform: translateY(-2px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .form-check {
            display: flex;
            align-items: center;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            background-color: #32353c;
            border: 2px solid #3d4450;
            cursor: pointer;
            margin-right: 8px;
        }

        .form-check-input:checked {
            background-color: #66c0f4;
            border-color: #66c0f4;
        }

        .form-check-label {
            color: #c7d5e0;
            font-size: 0.9rem;
            cursor: pointer;
            user-select: none;
        }

        .forgot-password {
            color: #66c0f4;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .forgot-password:hover {
            color: #4a9ed6;
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 30px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #3d4450;
        }

        .divider span {
            padding: 0 15px;
            color: #8f98a0;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .qr-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .qr-section h2 {
            color: #66c0f4;
            font-size: 0.9rem;
            text-transform: uppercase;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .qr-code-container {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
        }

        .qr-code-placeholder {
            width: 180px;
            height: 180px;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            position: relative;
        }

        .qr-refresh-icon {
            position: absolute;
            background-color: rgba(0, 0, 0, 0.7);
            color: #ffffff;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .qr-refresh-icon:hover {
            background-color: rgba(0, 0, 0, 0.9);
            transform: rotate(180deg);
        }

        .qr-info {
            color: #8f98a0;
            font-size: 0.85rem;
            margin-top: 15px;
        }

        .signup-link {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #3d4450;
        }

        .signup-link p {
            color: #8f98a0;
            font-size: 0.95rem;
            margin-bottom: 15px;
        }

        .btn-signup {
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

        .btn-signup:hover {
            background-color: #66c0f4;
            color: #171a21;
            box-shadow: 0 4px 15px rgba(102, 192, 244, 0.4);
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .alert-danger {
            background-color: rgba(194, 45, 45, 0.2);
            border: 1px solid rgba(194, 45, 45, 0.4);
            color: #ff6b6b;
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 40px 25px;
            }

            .login-header h1 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-card">
            <!-- Login Header -->
            <div class="login-header">
                <h1>Sign In</h1>
                <p>Welcome back to the gaming platform</p>
            </div>

            <!-- Error/Success Messages (will be shown via JavaScript) -->
            <div id="errorAlert" class="alert alert-danger" role="alert" style="display: none;"></div>
            <div id="successAlert" class="alert alert-success" role="alert" style="display: none;"></div>

            <!-- Login Form -->
            <form action="../config/login_process.php" method="POST">
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
                    <a href="#" class="forgot-password">Help, I can't sign in</a>
                </div>

                <button type="submit" class="btn btn-login">Sign In</button>
            </form>

            <!-- Divider -->
            <div class="divider">
                <span>or sign in with qr</span>
            </div>

            <!-- QR Code Section -->
            <div class="qr-section">
                <div class="qr-code-container">
                    <div class="qr-code-placeholder">
                        <!-- QR Code Image Placeholder -->
                        <img src="QR_CODE_IMAGE.png" alt="QR Code"
                            style="width: 100%; height: 100%; object-fit: contain;">
                        <div class="qr-refresh-icon">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                    </div>
                </div>
                <p class="qr-info">Use the Steam Mobile App to sign in via QR code</p>
            </div>

            <!-- Sign Up Link -->
            <div class="signup-link">
                <p>Don't have an account yet?</p>
                <a href="signup.php">
                    <button type="button" class="btn btn-signup">Create Your Account</button>
                </a>
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
            successAlert.textContent = decodeURIComponent(success);
            successAlert.style.display = 'block';
        }
    </script>
</body>

</html>