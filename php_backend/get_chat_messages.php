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
        'error' => 'You must be logged in to view messages.'
    ]);
    exit;
}

// Get optional parameters for pagination
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 50; // Default 50 messages
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

// Validate limits
if ($limit < 1 || $limit > 100) $limit = 50;
if ($offset < 0) $offset = 0;

try {
    // Fetch messages from database with user information
    $stmt = $conn->prepare("
        SELECT 
            cm.chat_id,
            cm.user_id,
            cm.message,
            cm.sent_at,
            u.username,
            u.display_name,
            u.avatar_url
        FROM chat_messages cm
        INNER JOIN users u ON cm.user_id = u.user_id
        ORDER BY cm.sent_at ASC
        LIMIT ? OFFSET ?
    ");
    
    if (!$stmt) {
        throw new Exception("Database prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("ii", $limit, $offset);
    
    if (!$stmt->execute()) {
        throw new Exception("Database execute failed: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    $messages = [];
    
    while ($row = $result->fetch_assoc()) {
        $messages[] = [
            'chat_id' => $row['chat_id'],
            'user_id' => $row['user_id'],
            'username' => $row['username'],
            'display_name' => $row['display_name'],
            'message' => htmlspecialchars($row['message']),
            'sent_at' => $row['sent_at'],
            'avatar_url' => $row['avatar_url'] ?? 'assets/images/avatars/default.jpg',
            'is_own_message' => ($row['user_id'] == $_SESSION['user_id'])
        ];
    }
    
    $stmt->close();
    
    echo json_encode([
        'success' => true,
        'messages' => $messages,
        'count' => count($messages)
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Failed to load messages. Please try again later.'
    ]);
} finally {
    $conn->close();
}
?>
