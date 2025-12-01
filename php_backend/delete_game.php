<?php
session_start();
require_once '../config/db_connect.php';

header('Content-Type: application/json');

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Get JSON data
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['game_id'])) {
    echo json_encode(['success' => false, 'message' => 'Game ID is required']);
    exit;
}

$game_id = intval($data['game_id']);

// Begin transaction
$conn->begin_transaction();

try {
    // Delete from game_genre junction table
    $stmt = $conn->prepare("DELETE FROM game_genre WHERE game_id = ?");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $stmt->close();

    // Delete from game_tag junction table
    $stmt = $conn->prepare("DELETE FROM game_tag WHERE game_id = ?");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $stmt->close();

    // Delete from game_media table
    $stmt = $conn->prepare("DELETE FROM game_media WHERE game_id = ?");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $stmt->close();

    // Delete from reviews table
    $stmt = $conn->prepare("DELETE FROM reviews WHERE game_id = ?");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $stmt->close();

    // Delete from library table (if users have this game in library)
    $stmt = $conn->prepare("DELETE FROM library WHERE game_id = ?");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $stmt->close();

    // Delete from wishlist table (if users have this game in wishlist)
    $stmt = $conn->prepare("DELETE FROM wishlist WHERE game_id = ?");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $stmt->close();

    // Finally delete the game itself
    $stmt = $conn->prepare("DELETE FROM games WHERE game_id = ?");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    
    if ($stmt->affected_rows === 0) {
        throw new Exception('Game not found or already deleted');
    }
    
    $stmt->close();

    // Commit transaction
    $conn->commit();
    
    echo json_encode(['success' => true, 'message' => 'Game deleted successfully']);
    
} catch (Exception $e) {
    // Rollback on error
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'Error deleting game: ' . $e->getMessage()]);
}

$conn->close();
?>
