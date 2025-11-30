<?php
require_once '../config/db_connect.php';

header('Content-Type: application/json');

try {
    // Get all genres to display as categories
    $stmt = $conn->prepare("
        SELECT 
            genre_id,
            genre_name
        FROM genres
        ORDER BY genre_name ASC
    ");
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $genres = [];
    while ($row = $result->fetch_assoc()) {
        $genres[] = $row;
    }
    
    echo json_encode([
        'success' => true,
        'categories' => $genres
    ]);
    
    $stmt->close();
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching categories: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
