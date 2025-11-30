<?php
require_once '../config/db_connect.php';

header('Content-Type: application/json');

try {
    // Get featured games with their video trailers or banner images
    $stmt = $conn->prepare("
        SELECT 
            g.game_id,
            g.title,
            g.developer_name,
            g.price,
            g.description,
            g.header_image,
            g.thumbnail_image,
            gm.media_url as video_url
        FROM games g
        LEFT JOIN game_media gm ON g.game_id = gm.game_id AND gm.media_type = 'video'
        WHERE g.is_published = 1 AND g.is_featured = 1
        ORDER BY g.game_id ASC
        LIMIT 4
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
        'message' => 'Error fetching hero games: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
