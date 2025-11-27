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
        'error' => 'You must be logged in to reply to posts.'
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

// Validate required fields
if (!isset($data['post_id']) || !isset($data['content'])) {
    echo json_encode([
        'success' => false,
        'error' => 'Post ID and content are required.'
    ]);
    exit;
}

$post_id = intval($data['post_id']);
$content = trim($data['content']);
$user_id = $_SESSION['user_id'];

// Validate content
if (empty($content)) {
    echo json_encode([
        'success' => false,
        'error' => 'Reply content cannot be empty.'
    ]);
    exit;
}

if (strlen($content) > 5000) {
    echo json_encode([
        'success' => false,
        'error' => 'Reply is too long. Maximum 5,000 characters.'
    ]);
    exit;
}

try {
    // Insert reply into database
    $stmt = $conn->prepare("INSERT INTO community_replies (post_id, user_id, content) VALUES (?, ?, ?)");
    
    if (!$stmt) {
        throw new Exception("Database prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("iis", $post_id, $user_id, $content);
    
    if (!$stmt->execute()) {
        throw new Exception("Database execute failed: " . $stmt->error);
    }
    
    $reply_id = $stmt->insert_id;
    $stmt->close();
    
    // Return success with reply data
    echo json_encode([
        'success' => true,
        'message' => 'Reply posted successfully.',
        'data' => [
            'reply_id' => $reply_id,
            'post_id' => $post_id,
            'user_id' => $user_id,
            'username' => $_SESSION['username'] ?? 'User',
            'display_name' => $_SESSION['display_name'] ?? 'User',
            'content' => htmlspecialchars($content),
            'created_at' => date('Y-m-d H:i:s'),
            'avatar_url' => $_SESSION['avatar_url'] ?? 'assets/images/avatars/default.jpg'
        ]
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Failed to post reply. Please try again later.'
    ]);
} finally {
    $conn->close();
}
?>
