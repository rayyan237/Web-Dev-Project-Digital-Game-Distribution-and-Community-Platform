<?php
require_once '../config/db_connect.php';

header('Content-Type: application/json');

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['email']) || !isset($input['new_password'])) {
    echo json_encode(['success' => false, 'message' => 'Email and new password are required']);
    exit;
}

$email = trim($input['email']);
$new_password = $input['new_password'];

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email format']);
    exit;
}

// Validate password strength
if (strlen($new_password) < 8) {
    echo json_encode(['success' => false, 'message' => 'Password must be at least 8 characters long']);
    exit;
}

try {
    // Check if email exists
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Email not found']);
        exit;
    }
    
    $stmt->close();
    
    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT, ['cost' => 12]);
    
    // Update password in database
    $stmt = $conn->prepare("UPDATE users SET password_hash = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Password reset successfully! Redirecting to login...'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to update password'
        ]);
    }
    
    $stmt->close();
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error updating password: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
