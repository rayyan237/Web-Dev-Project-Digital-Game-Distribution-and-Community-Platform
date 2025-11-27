<?php
session_start();
require_once '../config/db_connect.php';

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    // Start transaction
    $conn->begin_transaction();
    
    // Delete user's chat messages
    $stmt = $conn->prepare("DELETE FROM chat_messages WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
    
    // Delete reactions to user's posts
    $stmt = $conn->prepare("DELETE FROM community_post_reactions WHERE post_id IN (SELECT post_id FROM community_posts WHERE user_id = ?)");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
    
    // Delete user's reactions to other posts
    $stmt = $conn->prepare("DELETE FROM community_post_reactions WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
    
    // Delete replies to user's posts
    $stmt = $conn->prepare("DELETE FROM community_replies WHERE post_id IN (SELECT post_id FROM community_posts WHERE user_id = ?)");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
    
    // Delete user's replies to other posts
    $stmt = $conn->prepare("DELETE FROM community_replies WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
    
    // Delete user's posts
    $stmt = $conn->prepare("DELETE FROM community_posts WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
    
    // Finally, delete the user account
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
    
    // Commit transaction
    $conn->commit();
    
    // Destroy session
    session_destroy();
    
    echo json_encode([
        'success' => true,
        'message' => 'Account deleted successfully'
    ]);
    
} catch (Exception $e) {
    // Rollback on error
    $conn->rollback();
    
    echo json_encode([
        'success' => false,
        'message' => 'Error deleting account: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
