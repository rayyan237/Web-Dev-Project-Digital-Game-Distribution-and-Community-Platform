<?php
require_once '../config/db_connect.php';

header('Content-Type: application/json');

if (!isset($_GET['game_id']) || !is_numeric($_GET['game_id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid game ID']);
    exit;
}

$game_id = intval($_GET['game_id']);

try {
    // Get game basic info
    $stmt = $conn->prepare("
        SELECT 
            game_id,
            title,
            developer_name,
            price,
            release_date,
            description,
            average_rating,
            header_image,
            thumbnail_image,
            min_os,
            min_processor,
            min_memory,
            min_graphics,
            min_directx,
            min_storage,
            rec_os,
            rec_processor,
            rec_memory,
            rec_graphics,
            rec_directx,
            rec_storage
        FROM games
        WHERE game_id = ? AND is_published = 1
    ");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Game not found']);
        exit;
    }
    
    $game = $result->fetch_assoc();
    $stmt->close();
    
    // Format release date
    $game['release_date'] = date('d M, Y', strtotime($game['release_date']));
    
    // Get genres
    $stmt = $conn->prepare("
        SELECT g.genre_name
        FROM genres g
        INNER JOIN game_genre gg ON g.genre_id = gg.genre_id
        WHERE gg.game_id = ?
        ORDER BY g.genre_name
    ");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $genres = [];
    while ($row = $result->fetch_assoc()) {
        $genres[] = $row['genre_name'];
    }
    $stmt->close();
    
    // Get tags
    $stmt = $conn->prepare("
        SELECT t.tag_name
        FROM tags t
        INNER JOIN game_tag gt ON t.tag_id = gt.tag_id
        WHERE gt.game_id = ?
        ORDER BY t.tag_name
    ");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $tags = [];
    while ($row = $result->fetch_assoc()) {
        $tags[] = $row['tag_name'];
    }
    $stmt->close();
    
    // Get media (videos and screenshots)
    $stmt = $conn->prepare("
        SELECT media_url, media_type
        FROM game_media
        WHERE game_id = ?
        ORDER BY FIELD(media_type, 'video', 'screenshot'), media_id ASC
    ");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $media = [];
    while ($row = $result->fetch_assoc()) {
        $media[] = [
            'type' => $row['media_type'],
            'url' => $row['media_url']
        ];
    }
    $stmt->close();
    
    // If no media, add header image as fallback
    if (empty($media)) {
        $media[] = [
            'type' => 'screenshot',
            'url' => $game['header_image']
        ];
    }
    
    // Get reviews
    $stmt = $conn->prepare("
        SELECT 
            r.review_id,
            r.rating,
            r.comment,
            r.created_at,
            u.username,
            u.display_name,
            u.avatar_url
        FROM reviews r
        INNER JOIN users u ON r.user_id = u.user_id
        WHERE r.game_id = ?
        ORDER BY r.created_at DESC
    ");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $reviews = [];
    while ($row = $result->fetch_assoc()) {
        $reviews[] = [
            'review_id' => $row['review_id'],
            'username' => $row['display_name'] ?: $row['username'],
            'avatar_url' => $row['avatar_url'] ?: 'assets/images/default-avatar.png',
            'rating' => $row['rating'],
            'comment' => $row['comment'],
            'created_at' => date('d M, Y', strtotime($row['created_at']))
        ];
    }
    $stmt->close();
    
    echo json_encode([
        'success' => true,
        'game' => $game,
        'genres' => $genres,
        'tags' => $tags,
        'media' => $media,
        'reviews' => $reviews
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching game details: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
