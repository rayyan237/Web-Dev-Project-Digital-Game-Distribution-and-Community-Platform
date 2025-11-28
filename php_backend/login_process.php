<?php
// Start session to track login state
session_start();

// Load database connection
include '..\config\db_connect.php';

// Check if form was submitted using POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ==========================================
    // 1. GET AND SANITIZE INPUT DATA
    // ==========================================
    
    $input_username = trim($_POST['username'] ?? '');
    $input_password = $_POST['password'] ?? '';
    $remember_me = isset($_POST['remember']);
    
    // ==========================================
    // 2. BASIC VALIDATION
    // ==========================================
    
    // Check if fields are empty
    if (empty($input_username) || empty($input_password)) {
        $error = "Please fill in both username and password.";
        header("Location: ../php_frontend/login.php?error=" . urlencode($error));
        exit;
    }
    
    // Validate username format (basic check)
    if (strlen($input_username) < 3 || strlen($input_username) > 50) {
        $error = "Invalid username or password.";
        header("Location: ../php_frontend/login.php?error=" . urlencode($error));
        exit;
    }
    
    // ==========================================
    // 3. QUERY DATABASE FOR USER
    // ==========================================
    
    // Use prepared statement to prevent SQL injection
    // Select user_id, password_hash, display_name, and is_admin for the session
    $stmt = $conn->prepare("SELECT user_id, password_hash, display_name, email, is_admin, avatar_url FROM users WHERE username = ?");
    
    if (!$stmt) {
        $error = "Database error. Please try again later.";
        header("Location: ../php_frontend/login.php?error=" . urlencode($error));
        exit;
    }
    
    // Bind the username parameter
    $stmt->bind_param("s", $input_username);
    
    // Execute the query
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // ==========================================
    // 4. VERIFY USER EXISTS & PASSWORD MATCHES
    // ==========================================
    
    // Check if a user with that username exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $stored_hash = $user['password_hash'];
        
        // Verify the password against the stored hash
        if (password_verify($input_password, $stored_hash)) {
            
            // ==========================================
            // 5. AUTHENTICATION SUCCESS - CREATE SESSION
            // ==========================================
            
            // Regenerate session ID to prevent session fixation attacks
            session_regenerate_id(true);
            
            // Store user information in session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $input_username;
            $_SESSION['display_name'] = $user['display_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['is_admin'] = $user['is_admin'];
            $_SESSION['avatar_url'] = $user['avatar_url'];
            $_SESSION['logged_in'] = true;
            $_SESSION['login_time'] = time();
            
            // ==========================================
            // 6. HANDLE "REMEMBER ME" FUNCTIONALITY
            // ==========================================
            
            if ($remember_me) {
                // Create a secure token for "remember me" cookie (30 days)
                $token = bin2hex(random_bytes(32));
                $token_hash = hash('sha256', $token);
                $expiry = time() + (30 * 24 * 60 * 60); // 30 days
                
                // Store token in cookie (httponly and secure flags for security)
                setcookie('remember_token', $token, $expiry, '/', '', false, true);
                
                // In a production environment, you would store the hashed token
                // in a database table (e.g., 'remember_tokens') associated with the user
                // For now, we'll skip this step as the table doesn't exist yet
            }
            
            // ==========================================
            // 7. UPDATE LAST LOGIN TIME (Optional)
            // ==========================================
            
            // Update last_login timestamp in database (if column exists)
            $update_stmt = $conn->prepare("UPDATE users SET time_stamp = CURRENT_DATE WHERE user_id = ?");
            if ($update_stmt) {
                $update_stmt->bind_param("i", $user['user_id']);
                $update_stmt->execute();
                $update_stmt->close();
            }
            
            // ==========================================
            // 8. REDIRECT TO MAIN PAGE
            // ==========================================
            
            // Close the statement and connection
            $stmt->close();
            $conn->close();
            
            // Redirect to main page (index.php or dashboard)
            header("Location: ../php_frontend/index.php");
            exit;
            
        } else {
            // Password did not match
            $error = "Invalid username or password.";
            $stmt->close();
            header("Location: ../php_frontend/login.php?error=" . urlencode($error));
            exit;
        }
    } else {
        // No user found with that username
        $error = "Invalid username or password.";
        $stmt->close();
        header("Location: ../php_frontend/login.php?error=" . urlencode($error));
        exit;
    }
    
} else {
    // Not a POST request - redirect to login page
    header("Location: ../php_frontend/login.php");
    exit;
}

// Close database connection (fallback)
if (isset($conn)) {
    $conn->close();
}
?>
