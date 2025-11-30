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

if (!isset($input['game_id']) || !isset($input['is_special_offer'])) {
    echo json_encode(['success' => false, 'message' => 'Game ID and special offer status are required']);
    exit;
}

$game_id = intval($input['game_id']);
$is_special_offer = intval($input['is_special_offer']);

try {
    // Count current special offer games
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM games WHERE is_special_offer = 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $count_data = $result->fetch_assoc();
    $current_offers = $count_data['count'];
    $stmt->close();

    // Check if game is currently in special offers
    $stmt = $conn->prepare("SELECT is_special_offer FROM games WHERE game_id = ?");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $game_data = $result->fetch_assoc();
    $stmt->close();

    if (!$game_data) {
        echo json_encode(['success' => false, 'message' => 'Game not found']);
        exit;
    }

    $currently_offered = $game_data['is_special_offer'];

    // Validate constraints (min 4, max 8)
    if ($is_special_offer == 1 && $currently_offered == 0) {
        // Adding to special offers
        if ($current_offers >= 8) {
            echo json_encode(['success' => false, 'message' => 'Maximum 8 games can be in special offers. Remove one first.']);
            exit;
        }
    } elseif ($is_special_offer == 0 && $currently_offered == 1) {
        // Removing from special offers
        if ($current_offers <= 4) {
            echo json_encode(['success' => false, 'message' => 'Minimum 4 games must be in special offers. Add another one first.']);
            exit;
        }
    }

    // Update special offer status
    $stmt = $conn->prepare("UPDATE games SET is_special_offer = ? WHERE game_id = ?");
    $stmt->bind_param("ii", $is_special_offer, $game_id);
    
    if ($stmt->execute()) {
        $message = $is_special_offer == 1 ? 'Game added to 50% off special offers' : 'Game removed from special offers';
        echo json_encode([
            'success' => true,
            'message' => $message
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update special offer status']);
    }
    
    $stmt->close();
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error updating special offer status: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
