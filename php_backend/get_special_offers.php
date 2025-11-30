<?php
require_once '../config/db_connect.php';

header('Content-Type: application/json');

try {
    // Get games with special offer status (50% off)
    $stmt = $conn->prepare("
        SELECT 
            g.game_id,
            g.title,
            g.developer_name,
            g.price,
            g.thumbnail_image
        FROM games g
        WHERE g.is_published = 1 AND g.is_special_offer = 1
        ORDER BY g.game_id ASC
        LIMIT 8
    ");
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $games = [];
    while ($row = $result->fetch_assoc()) {
        // Calculate 50% off prices
        $original_price = floatval($row['price']);
        $fake_price = $original_price * 2; // Price before 50% discount
        
        $row['fake_price'] = number_format($fake_price, 2);
        $row['actual_price'] = number_format($original_price, 2);
        
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
        'message' => 'Error fetching special offers: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
