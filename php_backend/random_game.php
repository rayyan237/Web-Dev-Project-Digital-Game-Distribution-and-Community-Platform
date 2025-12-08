<?php
// File: php_backend/random_game.php

// Start session in case we need to pass messages later (optional but good practice)
session_start();

// 1. Include Database Connection
// Path verified via debug test
require_once '../config/db_connect.php'; 

// 2. Fetch a Random Game ID
// We select 'game_id' specifically because that is your verified primary key
$sql = "SELECT game_id FROM games ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $randomGameId = $row['game_id'];

    // 3. Redirect to the Game Details Page
    // Verified path: ../public/game-details.php?id=88
    header("Location: ../php_frontend/game-details.php?game_id=" . $randomGameId);
    exit();
} else {
    // Fallback: If no games exist, go to home
    header("Location: ../php_frontend/index.php");
    exit();
}
?>