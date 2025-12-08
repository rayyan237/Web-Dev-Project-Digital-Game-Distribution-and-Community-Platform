<?php
// php_backend/buy_game.php

// 1. Start Session to know who is logged in
session_start();

// 2. Connect to Database (using YOUR specific path)
require_once '../config/db_connect.php';

header('Content-Type: application/json');

// 3. Security Check: Is user logged in?
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login to purchase.']);
    exit;
}

// 4. Input Check: Did we get a Game ID?
if (!isset($_POST['game_id'])) {
    echo json_encode(['success' => false, 'message' => 'Game ID missing.']);
    exit;
}

$user_id = $_SESSION['user_id'];
$game_id = intval($_POST['game_id']);

try {
    // 5. Duplicate Check: Does the user ALREADY own this?
    $check_stmt = $conn->prepare("SELECT id FROM user_library WHERE user_id = ? AND game_id = ?");
    $check_stmt->bind_param("ii", $user_id, $game_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'You already own this game.']);
        exit;
    }
    $check_stmt->close();

    // 6. The Purchase: Insert into Library
    $insert_stmt = $conn->prepare("INSERT INTO user_library (user_id, game_id) VALUES (?, ?)");
    $insert_stmt->bind_param("ii", $user_id, $game_id);

    if ($insert_stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Purchase successful!']);
    } else {
        throw new Exception("Database insert failed");
    }
    $insert_stmt->close();

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Transaction error: ' . $e->getMessage()]);
}

$conn->close();
?>