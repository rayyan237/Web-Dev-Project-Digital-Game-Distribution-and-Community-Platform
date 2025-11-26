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
        'error' => 'You must be logged in to create a post.'
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
if (!isset($data['title']) || !isset($data['content'])) {
    echo json_encode([
        'success' => false,
        'error' => 'Title and content are required.'
    ]);
    exit;
}

$title = trim($data['title']);
$content = trim($data['content']);
$category = isset($data['category']) ? trim($data['category']) : 'general';
$user_id = $_SESSION['user_id'];

// Validate category (must be one of the enum values)
$valid_categories = ['general', 'feedback', 'help', 'guide'];
if (!in_array($category, $valid_categories)) {
    $category = 'general'; // Default to general if invalid
}

// Validate title
if (empty($title)) {
    echo json_encode([
        'success' => false,
        'error' => 'Title cannot be empty.'
    ]);
    exit;
}

if (strlen($title) > 255) {
    echo json_encode([
        'success' => false,
        'error' => 'Title is too long. Maximum 255 characters.'
    ]);
    exit;
}

// Validate content
if (empty($content)) {
    echo json_encode([
        'success' => false,
        'error' => 'Content cannot be empty.'
    ]);
    exit;
}

if (strlen($content) > 10000) {
    echo json_encode([
        'success' => false,
        'error' => 'Content is too long. Maximum 10,000 characters.'
    ]);
    exit;
}

// Insert post into database
try {
    $stmt = $conn->prepare("INSERT INTO community_posts (user_id, title, content, category) VALUES (?, ?, ?, ?)");
    
    if (!$stmt) {
        throw new Exception("Database prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("isss", $user_id, $title, $content, $category);
    
    if (!$stmt->execute()) {
        throw new Exception("Database execute failed: " . $stmt->error);
    }
    
    $post_id = $stmt->insert_id;
    $stmt->close();
    
    // Return success with post data
    echo json_encode([
        'success' => true,
        'message' => 'Post created successfully.',
        'data' => [
            'post_id' => $post_id,
            'user_id' => $user_id,
            'username' => $_SESSION['username'] ?? 'User',
            'display_name' => $_SESSION['display_name'] ?? 'User',
            'title' => htmlspecialchars($title),
            'content' => htmlspecialchars($content),
            'category' => $category,
            'created_at' => date('Y-m-d H:i:s'),
            'avatar_url' => $_SESSION['avatar_url'] ?? 'assets/images/avatars/default.jpg'
        ]
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Failed to create post. Please try again later.'
    ]);
} finally {
    $conn->close();
}
?>
