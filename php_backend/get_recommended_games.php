<?php
require_once '../config/db_connect.php';

header('Content-Type: application/json');

try {
    // Get games marked as recommended for Featured & Recommended section
    $stmt = $conn->prepare("
        SELECT 
            g.game_id,
            g.title,
            g.developer_name,
            g.price,
            g.header_image,
            g.thumbnail_image
        FROM games g
        WHERE g.is_published = 1 AND g.is_recommended = 1
        ORDER BY g.game_id ASC
        LIMIT 2
    ");
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $games = [];
    while ($row = $result->fetch_assoc()) {
        // Get tags for this game
        $tags_stmt = $conn->prepare("
            SELECT t.tag_name
            FROM tags t
            INNER JOIN game_tag gt ON t.tag_id = gt.tag_id
            WHERE gt.game_id = ?
            ORDER BY t.tag_name ASC
        ");
        $tags_stmt->bind_param("i", $row['game_id']);
        $tags_stmt->execute();
        $tags_result = $tags_stmt->get_result();
        
        $tags = [];
        while ($tag_row = $tags_result->fetch_assoc()) {
            $tags[] = $tag_row['tag_name'];
        }
        $tags_stmt->close();
        
        $row['tags'] = $tags;
        
        // Get screenshots for this game (up to 4)
        $media_stmt = $conn->prepare("
            SELECT media_url 
            FROM game_media 
            WHERE game_id = ? AND media_type = 'screenshot'
            ORDER BY media_id ASC
            LIMIT 4
        ");
        $media_stmt->bind_param("i", $row['game_id']);
        $media_stmt->execute();
        $media_result = $media_stmt->get_result();
        
        $screenshots = [];
        while ($media_row = $media_result->fetch_assoc()) {
            $screenshots[] = $media_row['media_url'];
        }
        $media_stmt->close();
        
        // If no screenshots, use header and thumbnail as fallbacks
        if (empty($screenshots)) {
            $screenshots = [
                $row['header_image'],
                $row['thumbnail_image'],
                $row['header_image'],
                $row['thumbnail_image']
            ];
        } else {
            // Fill remaining slots if less than 4 screenshots
            while (count($screenshots) < 4) {
                $screenshots[] = $row['header_image'];
            }
        }
        
        $row['screenshots'] = $screenshots;
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
        'message' => 'Error fetching recommended games: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
