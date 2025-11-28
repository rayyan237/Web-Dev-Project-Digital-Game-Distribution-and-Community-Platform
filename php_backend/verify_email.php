<?php
require_once '../config/db_connect.php';

header('Content-Type: application/json');

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['email'])) {
    echo json_encode(['success' => false, 'message' => 'Email is required']);
    exit;
}

$email = trim($input['email']);

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email format']);
    exit;
}

try {
    // Check if email exists in database
    $stmt = $conn->prepare("SELECT user_id, email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Email exists
        echo json_encode([
            'success' => true,
            'message' => 'Email verified'
        ]);
    } else {
        // Email not found
        echo json_encode([
            'success' => false,
            'message' => 'No account found with this email address'
        ]);
    }
    
    $stmt->close();
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error verifying email: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
