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
    // Get user basic info
    $stmt = $conn->prepare("
        SELECT 
            u.display_name,
            u.username,
            u.avatar_url,
            u.about,
            (SELECT COUNT(*) FROM community_posts WHERE user_id = ?) as posts_count,
            (SELECT COUNT(*) FROM community_post_reactions WHERE post_id IN 
                (SELECT post_id FROM community_posts WHERE user_id = ?) AND reaction_type = 'like') as total_likes,
            0 as games_count
        FROM users u
        WHERE u.user_id = ?
    ");
    
    $stmt->bind_param("iii", $user_id, $user_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'User not found'
        ]);
    }
    
    $stmt->close();
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching profile data: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
