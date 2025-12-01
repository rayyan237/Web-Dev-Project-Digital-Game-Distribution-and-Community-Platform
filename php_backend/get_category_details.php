<?php
require_once '../config/db_connect.php';

header('Content-Type: application/json');

if (!isset($_GET['genre_id']) || !is_numeric($_GET['genre_id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid genre ID']);
    exit;
}

$genre_id = intval($_GET['genre_id']);

try {
    // Get genre name
    $stmt = $conn->prepare("SELECT genre_name FROM genres WHERE genre_id = ?");
    $stmt->bind_param("i", $genre_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Genre not found']);
        exit;
    }
    
    $genre = $result->fetch_assoc();
    $stmt->close();
    
    // Get 3 cheapest games for hero carousel (excluding free games)
    $stmt = $conn->prepare("
        SELECT DISTINCT g.game_id, g.title, g.developer_name, g.price, g.description,
               g.header_image, g.thumbnail_image
        FROM games g
        INNER JOIN game_genre gg ON g.game_id = gg.game_id
        LEFT JOIN game_media gm ON g.game_id = gm.game_id AND gm.media_type = 'video'
        WHERE gg.genre_id = ? AND g.is_published = 1 AND g.price > 0
        GROUP BY g.game_id
        ORDER BY g.price ASC
        LIMIT 3
    ");
    $stmt->bind_param("i", $genre_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $hero_games = [];
    while ($row = $result->fetch_assoc()) {
        // Check for video
        $videoStmt = $conn->prepare("
            SELECT media_url FROM game_media 
            WHERE game_id = ? AND media_type = 'video' 
            LIMIT 1
        ");
        $videoStmt->bind_param("i", $row['game_id']);
        $videoStmt->execute();
        $videoResult = $videoStmt->get_result();
        $video = $videoResult->fetch_assoc();
        $videoStmt->close();
        
        // Get genres for this game
        $genreStmt = $conn->prepare("
            SELECT g.genre_name 
            FROM genres g 
            INNER JOIN game_genre gg ON g.genre_id = gg.genre_id 
            WHERE gg.game_id = ?
            ORDER BY g.genre_name
        ");
        $genreStmt->bind_param("i", $row['game_id']);
        $genreStmt->execute();
        $genreResult = $genreStmt->get_result();
        
        $genres = [];
        while ($genreRow = $genreResult->fetch_assoc()) {
            $genres[] = $genreRow['genre_name'];
        }
        $genreStmt->close();
        
        $hero_games[] = [
            'game_id' => $row['game_id'],
            'title' => $row['title'],
            'developer_name' => $row['developer_name'],
            'price' => $row['price'],
            'description' => $row['description'],
            'thumbnail_image' => $row['thumbnail_image'],
            'header_image' => $row['header_image'],
            'video_url' => $video ? $video['media_url'] : null,
            'genres' => $genres
        ];
    }
    $stmt->close();
    
    // Get up to 10 most popular games (by rating)
    $stmt = $conn->prepare("
        SELECT DISTINCT g.game_id, g.title, g.price, g.average_rating, g.header_image
        FROM games g
        INNER JOIN game_genre gg ON g.game_id = gg.game_id
        WHERE gg.genre_id = ? AND g.is_published = 1
        GROUP BY g.game_id
        ORDER BY g.average_rating DESC, g.title ASC
        LIMIT 10
    ");
    $stmt->bind_param("i", $genre_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $popular_games = [];
    while ($row = $result->fetch_assoc()) {
        $popular_games[] = [
            'game_id' => $row['game_id'],
            'title' => $row['title'],
            'price' => $row['price'],
            'average_rating' => $row['average_rating'],
            'header_image' => $row['header_image']
        ];
    }
    $stmt->close();
    
    // Get all games in category for browse section
    $stmt = $conn->prepare("
        SELECT DISTINCT g.game_id, g.title, g.release_date, g.price, g.thumbnail_image
        FROM games g
        INNER JOIN game_genre gg ON g.game_id = gg.game_id
        WHERE gg.genre_id = ? AND g.is_published = 1
        GROUP BY g.game_id
        ORDER BY g.release_date DESC
    ");
    $stmt->bind_param("i", $genre_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $all_games = [];
    while ($row = $result->fetch_assoc()) {
        // Get tags for this game
        $tagStmt = $conn->prepare("
            SELECT t.tag_name 
            FROM tags t 
            INNER JOIN game_tag gt ON t.tag_id = gt.tag_id 
            WHERE gt.game_id = ?
            ORDER BY t.tag_name
            LIMIT 2
        ");
        $tagStmt->bind_param("i", $row['game_id']);
        $tagStmt->execute();
        $tagResult = $tagStmt->get_result();
        
        $tags = [];
        while ($tagRow = $tagResult->fetch_assoc()) {
            $tags[] = $tagRow['tag_name'];
        }
        $tagStmt->close();
        
        $all_games[] = [
            'game_id' => $row['game_id'],
            'title' => $row['title'],
            'release_date' => date('M d, Y', strtotime($row['release_date'])),
            'price' => $row['price'],
            'thumbnail_image' => $row['thumbnail_image'],
            'tags' => implode(', ', $tags)
        ];
    }
    $stmt->close();
    
    echo json_encode([
        'success' => true,
        'genre_name' => $genre['genre_name'],
        'hero_games' => $hero_games,
        'popular_games' => $popular_games,
        'all_games' => $all_games
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching category details: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
