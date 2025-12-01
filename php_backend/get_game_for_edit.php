<?php
session_start();
require_once '../config/db_connect.php';

header('Content-Type: application/json');

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

if (!isset($_GET['game_id'])) {
    echo json_encode(['success' => false, 'message' => 'Game ID is required']);
    exit;
}

$game_id = intval($_GET['game_id']);

// Get game details
$stmt = $conn->prepare("
    SELECT * FROM games WHERE game_id = ?
");
$stmt->bind_param("i", $game_id);
$stmt->execute();
$result = $stmt->get_result();
$game = $result->fetch_assoc();
$stmt->close();

if (!$game) {
    echo json_encode(['success' => false, 'message' => 'Game not found']);
    exit;
}

// Get associated genres
$stmt = $conn->prepare("SELECT genre_id FROM game_genre WHERE game_id = ?");
$stmt->bind_param("i", $game_id);
$stmt->execute();
$result = $stmt->get_result();
$genres = [];
while ($row = $result->fetch_assoc()) {
    $genres[] = $row['genre_id'];
}
$stmt->close();

// Get associated tags
$stmt = $conn->prepare("SELECT tag_id FROM game_tag WHERE game_id = ?");
$stmt->bind_param("i", $game_id);
$stmt->execute();
$result = $stmt->get_result();
$tags = [];
while ($row = $result->fetch_assoc()) {
    $tags[] = $row['tag_id'];
}
$stmt->close();

$game['genres'] = $genres;
$game['tags'] = $tags;

echo json_encode(['success' => true, 'game' => $game]);
$conn->close();
?>
