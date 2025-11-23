<?php
// Start session
session_start();

// Set JSON header
header('Content-Type: application/json');

// Check if user is logged in
$response = array(
    'logged_in' => false,
    'user_data' => null
);

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset($_SESSION['user_id'])) {
    $response['logged_in'] = true;
    $response['user_data'] = array(
        'user_id' => $_SESSION['user_id'],
        'username' => $_SESSION['username'] ?? '',
        'display_name' => $_SESSION['display_name'] ?? '',
        'email' => $_SESSION['email'] ?? '',
        'level' => $_SESSION['level'] ?? 1,
        'xp' => $_SESSION['xp'] ?? 0,
        'avatar_url' => $_SESSION['avatar_url'] ?? 'assets/images/avatars/default.jpg',
        'is_admin' => $_SESSION['is_admin'] ?? 0
    );
}

echo json_encode($response);
?>
