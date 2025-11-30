<?php
require_once '../config/db_connect.php';

header('Content-Type: application/json');

try {
    // Get all games with price less than $10
    $stmt = $conn->prepare("
        SELECT 
            g.game_id,
            g.title,
            g.price,
            g.header_image
        FROM games g
        WHERE g.is_published = 1 AND g.price > 0 AND g.price < 10
        ORDER BY g.price ASC, g.title ASC
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
        'message' => 'Error fetching games under $10: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
