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
        'error' => 'You must be logged in to react to posts.'
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
if (!isset($data['post_id']) || !isset($data['reaction_type'])) {
    echo json_encode([
        'success' => false,
        'error' => 'Post ID and reaction type are required.'
    ]);
    exit;
}

$post_id = intval($data['post_id']);
$reaction_type = trim($data['reaction_type']);
$user_id = $_SESSION['user_id'];

// Validate reaction type
if (!in_array($reaction_type, ['like', 'dislike', 'remove'])) {
    echo json_encode([
        'success' => false,
        'error' => 'Invalid reaction type. Must be "like", "dislike", or "remove".'
    ]);
    exit;
}

try {
    // Check if user already has a reaction on this post
    $check_stmt = $conn->prepare("SELECT reaction_id, reaction_type FROM community_post_reactions WHERE post_id = ? AND user_id = ?");
    $check_stmt->bind_param("ii", $post_id, $user_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    $existing_reaction = $result->fetch_assoc();
    $check_stmt->close();
    
    if ($reaction_type === 'remove') {
        // Remove existing reaction
        if ($existing_reaction) {
            $delete_stmt = $conn->prepare("DELETE FROM community_post_reactions WHERE post_id = ? AND user_id = ?");
            $delete_stmt->bind_param("ii", $post_id, $user_id);
            $delete_stmt->execute();
            $delete_stmt->close();
        }
        
        $action = 'removed';
        $current_reaction = null;
        
    } else {
        // Add or update reaction
        if ($existing_reaction) {
            if ($existing_reaction['reaction_type'] === $reaction_type) {
                // Same reaction - remove it (toggle off)
                $delete_stmt = $conn->prepare("DELETE FROM community_post_reactions WHERE post_id = ? AND user_id = ?");
                $delete_stmt->bind_param("ii", $post_id, $user_id);
                $delete_stmt->execute();
                $delete_stmt->close();
                
                $action = 'removed';
                $current_reaction = null;
            } else {
                // Different reaction - update it
                $update_stmt = $conn->prepare("UPDATE community_post_reactions SET reaction_type = ? WHERE post_id = ? AND user_id = ?");
                $update_stmt->bind_param("sii", $reaction_type, $post_id, $user_id);
                $update_stmt->execute();
                $update_stmt->close();
                
                $action = 'updated';
                $current_reaction = $reaction_type;
            }
        } else {
            // No existing reaction - insert new one
            $insert_stmt = $conn->prepare("INSERT INTO community_post_reactions (post_id, user_id, reaction_type) VALUES (?, ?, ?)");
            $insert_stmt->bind_param("iis", $post_id, $user_id, $reaction_type);
            $insert_stmt->execute();
            $insert_stmt->close();
            
            $action = 'added';
            $current_reaction = $reaction_type;
        }
    }
    
    // Get updated like/dislike counts
    $count_stmt = $conn->prepare("
        SELECT 
            (SELECT COUNT(*) FROM community_post_reactions WHERE post_id = ? AND reaction_type = 'like') as likes,
            (SELECT COUNT(*) FROM community_post_reactions WHERE post_id = ? AND reaction_type = 'dislike') as dislikes
    ");
    $count_stmt->bind_param("ii", $post_id, $post_id);
    $count_stmt->execute();
    $count_result = $count_stmt->get_result();
    $counts = $count_result->fetch_assoc();
    $count_stmt->close();
    
    echo json_encode([
        'success' => true,
        'action' => $action,
        'current_reaction' => $current_reaction,
        'likes' => (int)$counts['likes'],
        'dislikes' => (int)$counts['dislikes']
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Failed to process reaction. Please try again later.'
    ]);
} finally {
    $conn->close();
}
?>
