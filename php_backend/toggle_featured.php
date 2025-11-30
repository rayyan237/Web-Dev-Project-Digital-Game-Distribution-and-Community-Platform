<?php
session_start();
require_once '../config/db_connect.php';

header('Content-Type: application/json');

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT is_admin FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user || $user['is_admin'] != 1) {
    echo json_encode(['success' => false, 'message' => 'Admin privileges required']);
    exit;
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['game_id']) || !isset($input['is_featured'])) {
    echo json_encode(['success' => false, 'message' => 'Game ID and featured status are required']);
    exit;
}

$game_id = intval($input['game_id']);
$is_featured = intval($input['is_featured']);

try {
    // Count current featured games
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM games WHERE is_featured = 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $count_data = $result->fetch_assoc();
    $current_featured = $count_data['count'];
    $stmt->close();

    // Check if game is currently featured
    $stmt = $conn->prepare("SELECT is_featured FROM games WHERE game_id = ?");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $game_data = $result->fetch_assoc();
    $stmt->close();

    if (!$game_data) {
        echo json_encode(['success' => false, 'message' => 'Game not found']);
        exit;
    }

    $currently_featured = $game_data['is_featured'];

    // Validate constraints
    if ($is_featured == 1 && $currently_featured == 0) {
        // Adding to featured
        if ($current_featured >= 4) {
            echo json_encode(['success' => false, 'message' => 'Maximum 4 games can be featured. Remove one first.']);
            exit;
        }
    } elseif ($is_featured == 0 && $currently_featured == 1) {
        // Removing from featured
        if ($current_featured <= 2) {
            echo json_encode(['success' => false, 'message' => 'Minimum 2 games must be featured. Add another one first.']);
            exit;
        }
    }

    // Update featured status
    $stmt = $conn->prepare("UPDATE games SET is_featured = ? WHERE game_id = ?");
    $stmt->bind_param("ii", $is_featured, $game_id);
    
    if ($stmt->execute()) {
        $message = $is_featured == 1 ? 'Game added to featured carousel' : 'Game removed from featured carousel';
        echo json_encode([
            'success' => true,
            'message' => $message
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update featured status']);
    }
    
    $stmt->close();
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error updating featured status: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
