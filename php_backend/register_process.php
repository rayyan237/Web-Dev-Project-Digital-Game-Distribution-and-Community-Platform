<?php
// Start session for error/success messages
session_start();

// Load database connection
include '../config/db_connect.php';

// Check if form was submitted using POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ==========================================
    // 1. GET AND SANITIZE INPUT DATA
    // ==========================================
    
    $email = trim($_POST['email'] ?? '');
    $confirm_email = trim($_POST['confirm_email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $display_name = trim($_POST['display_name'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $country = trim($_POST['country'] ?? '');
    $age = intval($_POST['age'] ?? 0);
    
    // ==========================================
    // 2. VALIDATION - CHECK ALL REQUIRED FIELDS
    // ==========================================
    
    // Check if any field is empty
    if (empty($email) || empty($confirm_email) || empty($username) || 
        empty($display_name) || empty($password) || empty($confirm_password) || 
        empty($country) || $age <= 0) {
        
        $error = "All fields are required. Please fill in all information.";
        header("Location: ../php_frontend/signup.php?error=" . urlencode($error));
        exit;
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format. Please enter a valid email address.";
        header("Location: ../php_frontend/signup.php?error=" . urlencode($error));
        exit;
    }
    
    // Check if emails match
    if ($email !== $confirm_email) {
        $error = "Email addresses do not match. Please check and try again.";
        header("Location: ../php_frontend/signup.php?error=" . urlencode($error));
        exit;
    }
    
    // Validate username length (3-50 characters)
    if (strlen($username) < 3 || strlen($username) > 50) {
        $error = "Username must be between 3 and 50 characters.";
        header("Location: ../php_frontend/signup.php?error=" . urlencode($error));
        exit;
    }
    
    // Validate username format (alphanumeric and underscores only)
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $error = "Username can only contain letters, numbers, and underscores.";
        header("Location: ../php_frontend/signup.php?error=" . urlencode($error));
        exit;
    }
    
    // Validate display name length
    if (strlen($display_name) < 1 || strlen($display_name) > 100) {
        $error = "Display name must be between 1 and 100 characters.";
        header("Location: ../php_frontend/signup.php?error=" . urlencode($error));
        exit;
    }
    
    // Validate password length
    if (strlen($password) < 8) {
        $error = "Password must be at least 8 characters long.";
        header("Location: ../php_frontend/signup.php?error=" . urlencode($error));
        exit;
    }
    
    // Check if passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match. Please check and try again.";
        header("Location: ../php_frontend/signup.php?error=" . urlencode($error));
        exit;
    }
    
    // Validate password strength (must contain letters and numbers)
    if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $error = "Password must contain both letters and numbers.";
        header("Location: ../php_frontend/signup.php?error=" . urlencode($error));
        exit;
    }
    
    // Validate age (minimum 13 years old)
    if ($age < 13 || $age > 120) {
        $error = "You must be at least 13 years old to create an account.";
        header("Location: ../php_frontend/signup.php?error=" . urlencode($error));
        exit;
    }
    
    // Validate country (ensure it's not empty and not the default value)
    if (empty($country) || $country === 'Select your country') {
        $error = "Please select your country of residence.";
        header("Location: ../php_frontend/signup.php?error=" . urlencode($error));
        exit;
    }
    
    // ==========================================
    // 3. CHECK FOR DUPLICATE USERNAME/EMAIL
    // ==========================================
    
    // Check if username already exists
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $error = "Username already exists. Please choose a different username.";
        $stmt->close();
        header("Location: ../php_frontend/signup.php?error=" . urlencode($error));
        exit;
    }
    $stmt->close();
    
    // Check if email already exists
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $error = "Email address already registered. Please use a different email or login.";
        $stmt->close();
        header("Location: ../php_frontend/signup.php?error=" . urlencode($error));
        exit;
    }
    $stmt->close();
    
    // ==========================================
    // 4. HASH PASSWORD & INSERT USER
    // ==========================================
    
    // Hash the password using bcrypt (secure password hashing)
    $password_hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    
    // Prepare INSERT statement
    $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, display_name, country, age, is_admin, avatar_url) VALUES (?, ?, ?, ?, ?, ?, 0, 'assets/images/avatars/default.jpg')");
    
    if (!$stmt) {
        $error = "Database error. Please try again later.";
        header("Location: ../php_frontend/signup.php?error=" . urlencode($error));
        exit;
    }
    
    // Bind parameters
    $stmt->bind_param("sssssi", $username, $email, $password_hash, $display_name, $country, $age);
    
    // Execute the query
    if ($stmt->execute()) {
        // Registration successful!
        $user_id = $stmt->insert_id;
        
        // Close statement
        $stmt->close();
        $conn->close();
        
        // Set success message and redirect to login
        $_SESSION['success_message'] = "Account created successfully! Please login.";
        header("Location: ../php_frontend/login.php?success=" . urlencode("Account created successfully! Please login."));
        exit;
        
    } else {
        // Registration failed
        $error = "Registration failed. Please try again later.";
        $stmt->close();
        header("Location: ../php_frontend/signup.php?error=" . urlencode($error));
        exit;
    }
    
} else {
    // Not a POST request - redirect to signup page
    header("Location: ../php_frontend/signup.php");
    exit;
}

// Close database connection
$conn->close();
?>
