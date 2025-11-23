<?php
/**
 * Session Check Helper
 * Include this file at the top of any page that requires authentication
 * Usage: include '../config/check_session.php';
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset($_SESSION['user_id']);
}

// Require login - redirect to login page if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        // Store the current page URL to redirect back after login
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
        
        // Redirect to login page
        header("Location: ../html/login.php?error=" . urlencode("Please login to access this page."));
        exit;
    }
}

// Check if user is admin
function isAdmin() {
    return isLoggedIn() && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
}

// Require admin - redirect if not admin
function requireAdmin() {
    requireLogin();
    
    if (!isAdmin()) {
        header("Location: ../html/index.php?error=" . urlencode("You do not have permission to access this page."));
        exit;
    }
}

// Get logged-in user ID
function getUserId() {
    return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
}

// Get logged-in username
function getUsername() {
    return isset($_SESSION['username']) ? $_SESSION['username'] : null;
}

// Get display name
function getDisplayName() {
    return isset($_SESSION['display_name']) ? $_SESSION['display_name'] : null;
}

// Get user level
function getUserLevel() {
    return isset($_SESSION['level']) ? $_SESSION['level'] : 1;
}

// Get user XP
function getUserXP() {
    return isset($_SESSION['xp']) ? $_SESSION['xp'] : 0;
}

// Get avatar URL
function getAvatarUrl() {
    return isset($_SESSION['avatar_url']) ? $_SESSION['avatar_url'] : 'assets/images/avatars/default.jpg';
}

// Session timeout check (optional - checks if user has been inactive for too long)
function checkSessionTimeout($timeout = 3600) { // Default 1 hour
    if (isset($_SESSION['login_time'])) {
        $elapsed = time() - $_SESSION['login_time'];
        
        if ($elapsed > $timeout) {
            // Session has expired
            session_unset();
            session_destroy();
            header("Location: ../html/login.php?error=" . urlencode("Your session has expired. Please login again."));
            exit;
        }
    }
}
?>
