<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Your Account - Steam Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* SCOPED STYLES 
           All styles are now prefixed with .steam-auth-scope 
           to prevent leaking into the navbar 
        */

        .steam-auth-scope {
            /* Moved body styles here to act as a page wrapper */
            background-color: #1b2838;
            color: #c7d5e0;
            min-height: calc(100vh - 56px); /* Adjust based on navbar height */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Centers form vertically */
            padding: 30px 0;
            background-image: url('BACKGROUND_IMAGE_SIGNUP.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
        }

        /* Overlay for the background image */
        .steam-auth-scope::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(27, 40, 56, 0.95), rgba(23, 26, 33, 0.95));
            z-index: 0;
        }

        .steam-auth-scope .signup-container {
            max-width: 520px;
            margin: auto;
            padding: 20px;
            position: relative;
            z-index: 1; /* Ensures card sits above the background overlay */
        }

        .steam-auth-scope .signup-card {
            background: linear-gradient(135deg, rgba(23, 26, 33, 0.98), rgba(27, 40, 56, 0.98));
            border-radius: 8px;
            padding: 45px 40px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(102, 192, 244, 0.1);
        }

        .steam-auth-scope .signup-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .steam-auth-scope .signup-header h1 {
            color: #ffffff;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .steam-auth-scope .signup-header p {
            color: #8f98a0;
            font-size: 0.9rem;
        }

        .steam-auth-scope .form-label {
            color: #c7d5e0;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        /* Scoped Bootstrap Overrides - Won't affect Navbar inputs */
        .steam-auth-scope .form-control,
        .steam-auth-scope .form-select {
            background-color: #32353c;
            border: 1px solid #3d4450;
            color: #c7d5e0;
            height: 46px;
            border-radius: 4px;
            font-size: 0.9rem;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .steam-auth-scope .form-control:focus,
        .steam-auth-scope .form-select:focus {
            background-color: #32353c;
            border-color: #66c0f4;
            color: #ffffff;
            box-shadow: 0 0 0 3px rgba(102, 192, 244, 0.15);
            outline: none;
        }

        .steam-auth-scope .form-control::placeholder {
            color: #7a7f84;
        }

        .steam-auth-scope .form-select {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23c7d5e0' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        }

        .steam-auth-scope .form-select option {
            background-color: #1b2838;
            color: #c7d5e0;
        }

        .steam-auth-scope .captcha-container {
            background-color: #32353c;
            border: 1px solid #3d4450;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .steam-auth-scope .captcha-checkbox {
            width: 24px;
            height: 24px;
            background-color: #1b2838;
            border: 2px solid #3d4450;
            border-radius: 3px;
            cursor: pointer;
            margin-right: 12px;
            position: relative;
            appearance: none; /* Remove default checkbox style */
            -webkit-appearance: none;
        }

        .steam-auth-scope .captcha-checkbox:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #66c0f4;
            font-size: 18px;
            font-weight: bold;
        }

        .steam-auth-scope .captcha-text {
            color: #c7d5e0;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .steam-auth-scope .captcha-logo {
            margin-left: auto;
            width: 80px;
            height: auto;
        }

        .steam-auth-scope .terms-check {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
        }

        .steam-auth-scope .terms-check input[type="checkbox"] {
            width: 20px;
            height: 20px;
            background-color: #32353c;
            border: 2px solid #3d4450;
            cursor: pointer;
            margin-right: 10px;
            margin-top: 2px;
            flex-shrink: 0;
            appearance: none;
            -webkit-appearance: none;
        }

        .steam-auth-scope .terms-check input[type="checkbox"]:checked {
            background-color: #66c0f4;
            border-color: #66c0f4;
            position: relative;
        }
        
        /* Custom checkmark for terms */
        .steam-auth-scope .terms-check input[type="checkbox"]:checked::after {
            content: '';
            position: absolute;
            left: 6px;
            top: 2px;
            width: 5px;
            height: 10px;
            border: solid #1b2838;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .steam-auth-scope .terms-check label {
            color: #c7d5e0;
            font-size: 0.85rem;
            line-height: 1.5;
        }

        .steam-auth-scope .terms-check a {
            color: #66c0f4;
            text-decoration: none;
        }

        .steam-auth-scope .terms-check a:hover {
            text-decoration: underline;
        }

        .steam-auth-scope .btn-signup {
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

        .steam-auth-scope .btn-signup:hover:not(:disabled) {
            background: linear-gradient(135deg, #4a9ed6, #3a8ec6);
            box-shadow: 0 6px 20px rgba(102, 192, 244, 0.5);
            transform: translateY(-2px);
        }

        .steam-auth-scope .btn-signup:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .steam-auth-scope .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #3d4450;
        }

        .steam-auth-scope .login-link p {
            color: #8f98a0;
            font-size: 0.95rem;
            margin-bottom: 0;
        }

        .steam-auth-scope .login-link a {
            color: #66c0f4;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .steam-auth-scope .login-link a:hover {
            color: #4a9ed6;
            text-decoration: underline;
        }

        .steam-auth-scope .alert {
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .steam-auth-scope .alert-danger {
            background-color: rgba(194, 45, 45, 0.2);
            border: 1px solid rgba(194, 45, 45, 0.4);
            color: #ff6b6b;
        }

        .steam-auth-scope .alert-success {
            background-color: rgba(76, 175, 80, 0.2);
            border: 1px solid rgba(76, 175, 80, 0.4);
            color: #4caf50;
        }

        .steam-auth-scope .password-strength {
            height: 4px;
            background-color: #3d4450;
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
        }

        .steam-auth-scope .password-strength-bar {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .steam-auth-scope .password-strength-bar.weak {
            width: 33%;
            background-color: #ff6b6b;
        }

        .steam-auth-scope .password-strength-bar.medium {
            width: 66%;
            background-color: #ffa726;
        }

        .steam-auth-scope .password-strength-bar.strong {
            width: 100%;
            background-color: #4caf50;
        }

        .steam-auth-scope .password-hint {
            font-size: 0.75rem;
            color: #8f98a0;
            margin-top: 5px;
        }

        @media (max-width: 576px) {
            .steam-auth-scope .signup-card {
                padding: 35px 25px;
            }

            .steam-auth-scope .signup-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <?php include 'section-navbar.php'; ?>

    <main class="steam-auth-scope">
        <div class="signup-container">
            <div class="signup-card">
                <div class="signup-header">
                    <h1>Create Your Account</h1>
                    <p>Join the gaming community today</p>
                </div>

                <div id="errorAlert" class="alert alert-danger" role="alert" style="display: none;"></div>
                <div id="successAlert" class="alert alert-success" role="alert" style="display: none;"></div>

                <form action="../php_backend/register_process.php" method="POST" id="signupForm">

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Enter your email address" required>
                    </div>

                    <div class="mb-3">
                        <label for="confirm_email" class="form-label">Confirm your Address</label>
                        <input type="email" class="form-control" id="confirm_email" name="confirm_email"
                            placeholder="Re-enter your email address" required>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Choose a unique username" required minlength="3" maxlength="50">
                    </div>

                    <div class="mb-3">
                        <label for="display_name" class="form-label">Display Name</label>
                        <input type="text" class="form-control" id="display_name" name="display_name"
                            placeholder="How your name will appear" required maxlength="100">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Create a strong password" required minlength="8">
                        <div class="password-strength">
                            <div class="password-strength-bar" id="strengthBar"></div>
                        </div>
                        <div class="password-hint">At least 8 characters with letters and numbers</div>
                    </div>

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                            placeholder="Re-enter your password" required>
                    </div>

                    <div class="mb-3">
                        <label for="country" class="form-label">Country of Residence</label>
                        <select class="form-select" id="country" name="country" required>
                            <option value="" selected disabled>Select your country</option>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Canada">Canada</option>
                            <option value="China">China</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Egypt">Egypt</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="Germany">Germany</option>
                            <option value="Greece">Greece</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran">Iran</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Italy">Italy</option>
                            <option value="Japan">Japan</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Norway">Norway</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Russia">Russia</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Singapore">Singapore</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Korea">South Korea</option>
                            <option value="Spain">Spain</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" placeholder="Enter your age" required
                            min="13" max="120">
                    </div>

                    <div class="captcha-container">
                        <input type="checkbox" class="captcha-checkbox" id="captcha" name="captcha" required>
                        <label for="captcha" class="captcha-text">I am human</label>

                    </div>

                    <div class="terms-check">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">
                            I am 13 years of age or older and agree to the terms of the
                            <a href="#" target="_blank">Steam Subscriber Agreement</a> and the
                            <a href="#" target="_blank">Valve Privacy Policy</a>.
                        </label>
                    </div>

                    <button type="submit" class="btn btn-signup" id="submitBtn">Continue</button>
                </form>

                <div class="login-link">
                    <p>Already have an account? <a href="login.php">Sign in here</a></p>
                </div>
            </div>
        </div>
    </main>
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

        // Password Strength Checker
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;

            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            strengthBar.className = 'password-strength-bar';
            if (strength === 0 || strength === 1) {
                strengthBar.classList.add('weak');
            } else if (strength === 2 || strength === 3) {
                strengthBar.classList.add('medium');
            } else {
                strengthBar.classList.add('strong');
            }
        });

        // Form Validation
        const form = document.getElementById('signupForm');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const confirmEmail = document.getElementById('confirm_email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const age = parseInt(document.getElementById('age').value);

            // Email Match Validation
            if (email !== confirmEmail) {
                alert('Email addresses do not match!');
                return;
            }

            // Password Match Validation
            if (password !== confirmPassword) {
                alert('Passwords do not match!');
                return;
            }

            // Age Validation
            if (age < 13) {
                alert('You must be at least 13 years old to create an account.');
                return;
            }

            // Submit form if all validations pass
            this.submit();
        });
    </script>
</body>

</html>