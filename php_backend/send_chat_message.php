<?php
// Start session
session_start();

// Set JSON response header
header('Content-Type: application/json');

// Load database connection
include '../config/db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || !isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'error' => 'You must be logged in to send messages.'
    ]);
    exit;
}

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        'success' => false,
        'error' => 'Invalid request method.'
    ]);
    exit;
}

// Get the JSON input
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

// Validate message
if (!isset($data['message']) || empty(trim($data['message']))) {
    echo json_encode([
        'success' => false,
        'error' => 'Message cannot be empty.'
    ]);
    exit;
}

$message = trim($data['message']);
$user_id = $_SESSION['user_id'];

// Validate message length (optional - prevent spam/abuse)
if (strlen($message) > 1000) {
    echo json_encode([
        'success' => false,
        'error' => 'Message is too long. Maximum 1000 characters.'
    ]);
    exit;
}

// Insert message into database
try {
    $stmt = $conn->prepare("INSERT INTO chat_messages (user_id, message) VALUES (?, ?)");
    
    if (!$stmt) {
        throw new Exception("Database prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("is", $user_id, $message);
    
    if (!$stmt->execute()) {
        throw new Exception("Database execute failed: " . $stmt->error);
    }
    
    $chat_id = $stmt->insert_id;
    $stmt->close();
    
    // Return success with message data
    echo json_encode([
        'success' => true,
        'message' => 'Message sent successfully.',
        'data' => [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
            'username' => $_SESSION['username'] ?? 'User',
            'display_name' => $_SESSION['display_name'] ?? 'User',
            'message' => htmlspecialchars($message),
            'sent_at' => date('Y-m-d H:i:s'),
            'avatar_url' => $_SESSION['avatar_url'] ?? 'assets/images/avatars/default.jpg'
        ]
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Failed to send message. Please try again later.'
    ]);
} finally {
    $conn->close();
}
?>
