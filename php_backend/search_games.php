<?php
require_once '../config/db_connect.php';

header('Content-Type: application/json');

// Get search parameters
$query = isset($_GET['q']) ? trim($_GET['q']) : '';
$genre = isset($_GET['genre']) ? intval($_GET['genre']) : 0;
$min_price = isset($_GET['min_price']) ? floatval($_GET['min_price']) : 0;
$max_price = isset($_GET['max_price']) ? floatval($_GET['max_price']) : 999999;
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'title_asc';
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 20;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

try {
    // Build the query
    $sql = "SELECT DISTINCT g.game_id, g.title, g.developer_name, g.price, g.release_date, 
            g.average_rating, g.header_image, g.thumbnail_image, g.description
            FROM games g";
    
    $conditions = ["g.is_published = 1"];
    $params = [];
    $types = "";
    
    // Join with game_genre if genre filter is applied
    if ($genre > 0) {
        $sql .= " INNER JOIN game_genre gg ON g.game_id = gg.game_id";
        $conditions[] = "gg.genre_id = ?";
        $params[] = $genre;
        $types .= "i";
    }
    
    // Search query
    if (!empty($query)) {
        $conditions[] = "(g.title LIKE ? OR g.developer_name LIKE ? OR g.description LIKE ?)";
        $searchTerm = "%{$query}%";
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $types .= "sss";
    }
    
    // Price range
    if ($min_price > 0 || $max_price < 999999) {
        $conditions[] = "g.price >= ? AND g.price <= ?";
        $params[] = $min_price;
        $params[] = $max_price;
        $types .= "dd";
    }
    
    // Add WHERE clause
    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }
    
    // Add ORDER BY
    switch ($sort) {
        case 'title_asc':
            $sql .= " ORDER BY g.title ASC";
            break;
        case 'title_desc':
            $sql .= " ORDER BY g.title DESC";
            break;
        case 'price_asc':
            $sql .= " ORDER BY g.price ASC";
            break;
        case 'price_desc':
            $sql .= " ORDER BY g.price DESC";
            break;
        case 'rating_desc':
            $sql .= " ORDER BY g.average_rating DESC";
            break;
        case 'release_desc':
            $sql .= " ORDER BY g.release_date DESC";
            break;
        case 'release_asc':
            $sql .= " ORDER BY g.release_date ASC";
            break;
        default:
            $sql .= " ORDER BY g.title ASC";
    }
    
    // Get total count before applying limit
    $countSql = "SELECT COUNT(DISTINCT g.game_id) as total " . 
                substr($sql, strpos($sql, "FROM"));
    $countSql = substr($countSql, 0, strpos($countSql, "ORDER BY"));
    
    $countStmt = $conn->prepare($countSql);
    if (!empty($params)) {
        $countStmt->bind_param($types, ...$params);
    }
    $countStmt->execute();
    $totalResult = $countStmt->get_result();
    $totalRow = $totalResult->fetch_assoc();
    $total = $totalRow['total'];
    $countStmt->close();
    
    // Add LIMIT and OFFSET
    $sql .= " LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;
    $types .= "ii";
    
    // Execute main query
    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    
    $games = [];
    while ($row = $result->fetch_assoc()) {
        // Get genres for each game
        $genreStmt = $conn->prepare("
            SELECT g.genre_name 
            FROM genres g 
            INNER JOIN game_genre gg ON g.genre_id = gg.genre_id 
            WHERE gg.game_id = ?
            ORDER BY g.genre_name
            LIMIT 3
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
            'developer_name' => $row['developer_name'],
            'price' => $row['price'],
            'release_date' => date('d M, Y', strtotime($row['release_date'])),
            'average_rating' => $row['average_rating'],
            'header_image' => $row['header_image'],
            'thumbnail_image' => $row['thumbnail_image'],
            'description' => substr($row['description'], 0, 150) . '...',
            'genres' => $genres
        ];
    }
    
    $stmt->close();
    
    echo json_encode([
        'success' => true,
        'games' => $games,
        'total' => $total,
        'limit' => $limit,
        'offset' => $offset,
        'has_more' => ($offset + $limit) < $total
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error searching games: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
