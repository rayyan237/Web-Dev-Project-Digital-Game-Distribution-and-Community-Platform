<?php
session_start();
require_once '../config/db_connect.php';

header('Content-Type: application/json');

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT is_admin FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user || $user['is_admin'] != 1) {
    echo json_encode(['success' => false, 'message' => 'Admin privileges required']);
    exit;
}

try {
    // Get all published games with their featured status and check if they have video
    $stmt = $conn->prepare("
        SELECT 
            g.game_id,
            g.title,
            g.developer_name,
            g.price,
            g.header_image,
            g.thumbnail_image,
            g.is_featured,
            g.is_special_offer,
            g.is_recommended,
            CASE WHEN gm.media_id IS NOT NULL THEN 1 ELSE 0 END as has_video
        FROM games g
        LEFT JOIN game_media gm ON g.game_id = gm.game_id AND gm.media_type = 'video'
        WHERE g.is_published = 1
        ORDER BY 
            g.is_featured DESC,
            g.is_special_offer DESC,
            g.is_recommended DESC,
            g.title ASC
    ");
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $games = [];
    while ($row = $result->fetch_assoc()) {
        $games[] = $row;
    }
    
    echo json_encode([
        'success' => true,
        'games' => $games
    ]);
    
    $stmt->close();
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching games: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
