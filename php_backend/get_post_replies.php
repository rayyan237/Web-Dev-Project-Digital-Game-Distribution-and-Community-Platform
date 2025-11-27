<?php
// Start session
session_start();

// Set JSON response header
header('Content-Type: application/json');

// Load database connection
include '../config/db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo json_encode([
        'success' => false,
        'error' => 'You must be logged in to view replies.'
    ]);
    exit;
}

// Get post_id parameter
if (!isset($_GET['post_id'])) {
    echo json_encode([
        'success' => false,
        'error' => 'Post ID is required.'
    ]);
    exit;
}

$post_id = intval($_GET['post_id']);

try {
    // Fetch replies from database with user information
    $stmt = $conn->prepare("
        SELECT 
            cr.reply_id,
            cr.post_id,
            cr.user_id,
            cr.content,
            cr.created_at,
            u.username,
            u.display_name,
            u.avatar_url
        FROM community_replies cr
        INNER JOIN users u ON cr.user_id = u.user_id
        WHERE cr.post_id = ?
        ORDER BY cr.created_at ASC
    ");
    
    if (!$stmt) {
        throw new Exception("Database prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("i", $post_id);
    
    if (!$stmt->execute()) {
        throw new Exception("Database execute failed: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    $replies = [];
    
    while ($row = $result->fetch_assoc()) {
        $replies[] = [
            'reply_id' => $row['reply_id'],
            'post_id' => $row['post_id'],
            'user_id' => $row['user_id'],
            'username' => $row['username'],
            'display_name' => $row['display_name'],
            'content' => $row['content'],
            'created_at' => $row['created_at'],
            'avatar_url' => $row['avatar_url'] ?? 'assets/images/avatars/default.jpg',
            'is_own_reply' => ($row['user_id'] == $_SESSION['user_id']),
            'likes' => 0, // Placeholder - can add reply reactions later
            'userLiked' => false
        ];
    }
    
    $stmt->close();
    
    echo json_encode([
        'success' => true,
        'replies' => $replies,
        'count' => count($replies)
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Failed to load replies. Please try again later.'
    ]);
} finally {
    $conn->close();
}
?>
