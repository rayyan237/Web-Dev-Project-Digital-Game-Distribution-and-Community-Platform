<?php
session_start();
require_once '../config/db_connect.php';

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login to post a review']);
    exit;
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['game_id']) || !isset($input['rating']) || !isset($input['comment'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

$user_id = $_SESSION['user_id'];
$game_id = intval($input['game_id']);
$rating = intval($input['rating']);
$comment = trim($input['comment']);
$played_on = isset($input['played_on']) ? trim($input['played_on']) : null;

if (empty($comment)) {
    echo json_encode(['success' => false, 'message' => 'Review comment cannot be empty']);
    exit;
}

if ($rating < 1 || $rating > 5) {
    echo json_encode(['success' => false, 'message' => 'Rating must be between 1 and 5']);
    exit;
}

try {
    // Check if user already reviewed this game
    $stmt = $conn->prepare("SELECT review_id FROM reviews WHERE user_id = ? AND game_id = ?");
    $stmt->bind_param("ii", $user_id, $game_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Update existing review
        $stmt->close();
        $stmt = $conn->prepare("UPDATE reviews SET rating = ?, comment = ?, played_on = ?, created_at = NOW() WHERE user_id = ? AND game_id = ?");
        $stmt->bind_param("issii", $rating, $comment, $played_on, $user_id, $game_id);
        $message = 'Review updated successfully';
    } else {
        // Insert new review
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO reviews (user_id, game_id, rating, comment, played_on) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiss", $user_id, $game_id, $rating, $comment, $played_on);
        $message = 'Review posted successfully';
    }
    
    if ($stmt->execute()) {
        // Update average rating for the game
        $stmt->close();
        $stmt = $conn->prepare("
            UPDATE games 
            SET average_rating = (
                SELECT AVG(rating) 
                FROM reviews 
                WHERE game_id = ?
            )
            WHERE game_id = ?
        ");
        $stmt->bind_param("ii", $game_id, $game_id);
        $stmt->execute();
        
        echo json_encode(['success' => true, 'message' => $message]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to post review']);
    }
    
    $stmt->close();
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error posting review: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
