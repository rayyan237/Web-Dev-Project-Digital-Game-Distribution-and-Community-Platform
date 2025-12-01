<?php
require_once '../config/db_connect.php';

header('Content-Type: application/json');

$max_price = isset($_GET['max_price']) ? floatval($_GET['max_price']) : 10;

try {
    // Get all games under the price limit
    $stmt = $conn->prepare("
        SELECT game_id, title, price, release_date, thumbnail_image
        FROM games
        WHERE is_published = 1 AND price > 0 AND price <= ?
        ORDER BY price ASC
    ");
    $stmt->bind_param("d", $max_price);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $games = [];
    while ($row = $result->fetch_assoc()) {
        // Get tags for this game
        $tagStmt = $conn->prepare("
            SELECT t.tag_name 
            FROM tags t 
            INNER JOIN game_tag gt ON t.tag_id = gt.tag_id 
            WHERE gt.game_id = ?
            ORDER BY t.tag_name
        ");
        $tagStmt->bind_param("i", $row['game_id']);
        $tagStmt->execute();
        $tagResult = $tagStmt->get_result();
        
        $tags = [];
        while ($tagRow = $tagResult->fetch_assoc()) {
            $tags[] = $tagRow['tag_name'];
        }
        $tagStmt->close();
        
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
        
        $games[] = [
            'game_id' => $row['game_id'],
            'title' => $row['title'],
            'price' => $row['price'],
            'release_date' => $row['release_date'],
            'thumbnail_image' => $row['thumbnail_image'],
            'tags' => $tags,
            'genres' => $genres
        ];
    }
    $stmt->close();
    
    // Get all genres for filters
    $allGenresStmt = $conn->prepare("SELECT genre_id, genre_name FROM genres ORDER BY genre_name ASC");
    $allGenresStmt->execute();
    $allGenresResult = $allGenresStmt->get_result();
    
    $allGenres = [];
    while ($genreRow = $allGenresResult->fetch_assoc()) {
        $allGenres[] = [
            'genre_id' => $genreRow['genre_id'],
            'genre_name' => $genreRow['genre_name']
        ];
    }
    $allGenresStmt->close();
    
    // Get all tags for filters
    $allTagsStmt = $conn->prepare("SELECT DISTINCT tag_name FROM tags ORDER BY tag_name ASC");
    $allTagsStmt->execute();
    $allTagsResult = $allTagsStmt->get_result();
    
    $allTags = [];
    while ($tagRow = $allTagsResult->fetch_assoc()) {
        $allTags[] = $tagRow['tag_name'];
    }
    $allTagsStmt->close();
    
    echo json_encode([
        'success' => true,
        'games' => $games,
        'filter_genres' => $allGenres,
        'filter_tags' => $allTags
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching games: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
