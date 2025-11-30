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

if (!isset($input['game_id']) || !isset($input['is_recommended'])) {
    echo json_encode(['success' => false, 'message' => 'Game ID and recommended status are required']);
    exit;
}

$game_id = intval($input['game_id']);
$is_recommended = intval($input['is_recommended']);

try {
    // Count current recommended games
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM games WHERE is_recommended = 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $count_data = $result->fetch_assoc();
    $current_recommended = $count_data['count'];
    $stmt->close();

    // Check if game is currently recommended
    $stmt = $conn->prepare("SELECT is_recommended FROM games WHERE game_id = ?");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $game_data = $result->fetch_assoc();
    $stmt->close();

    if (!$game_data) {
        echo json_encode(['success' => false, 'message' => 'Game not found']);
        exit;
    }

    $currently_recommended = $game_data['is_recommended'];

    // Validate constraints (min 1, max 2)
    if ($is_recommended == 1 && $currently_recommended == 0) {
        // Adding to recommended
        if ($current_recommended >= 2) {
            echo json_encode(['success' => false, 'message' => 'Maximum 2 games can be recommended. Remove one first.']);
            exit;
        }
    } elseif ($is_recommended == 0 && $currently_recommended == 1) {
        // Removing from recommended
        if ($current_recommended <= 1) {
            echo json_encode(['success' => false, 'message' => 'Minimum 1 game must be recommended. Add another one first.']);
            exit;
        }
    }

    // Update recommended status
    $stmt = $conn->prepare("UPDATE games SET is_recommended = ? WHERE game_id = ?");
    $stmt->bind_param("ii", $is_recommended, $game_id);
    
    if ($stmt->execute()) {
        $message = $is_recommended == 1 ? 'Game added to Featured & Recommended' : 'Game removed from Featured & Recommended';
        echo json_encode([
            'success' => true,
            'message' => $message
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update recommended status']);
    }
    
    $stmt->close();
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error updating recommended status: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
