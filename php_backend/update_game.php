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

// Get POST data
$game_id = isset($_POST['game_id']) ? intval($_POST['game_id']) : 0;
$title = $_POST['title'] ?? '';
$developer_name = $_POST['developer'] ?? '';
$release_date = $_POST['release_date'] ?? '';
$price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
$description = $_POST['description'] ?? '';
$thumbnail_image = $_POST['thumbnail_image'] ?? '';
$header_image = $_POST['header_image'] ?? '';
$download_url = $_POST['download_url'] ?? '';
// Note: video_url and has_video are preserved from existing game data
$genres = $_POST['genres'] ?? [];
$tags = $_POST['tags'] ?? [];

// System requirements
$min_os = $_POST['min_os'] ?? '';
$min_processor = $_POST['min_processor'] ?? '';
$min_memory = $_POST['min_memory'] ?? '';
$min_graphics = $_POST['min_graphics'] ?? '';
$min_directx = $_POST['min_directx'] ?? '';
$min_storage = $_POST['min_storage'] ?? '';
$rec_os = $_POST['rec_os'] ?? '';
$rec_processor = $_POST['rec_processor'] ?? '';
$rec_memory = $_POST['rec_memory'] ?? '';
$rec_graphics = $_POST['rec_graphics'] ?? '';
$rec_directx = $_POST['rec_directx'] ?? '';
$rec_storage = $_POST['rec_storage'] ?? '';

// Validate required fields
if (empty($title) || empty($developer_name) || empty($release_date) || empty($description)) {
    echo json_encode(['success' => false, 'message' => 'All required fields must be filled']);
    exit;
}

if ($game_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid game ID']);
    exit;
}

// Begin transaction
$conn->begin_transaction();

try {
    // Update game (preserve video_url and has_video from existing data)
    $stmt = $conn->prepare("
        UPDATE games SET 
            title = ?,
            developer_name = ?,
            release_date = ?,
            price = ?,
            description = ?,
            thumbnail_image = ?,
            header_image = ?,
            download_url = ?,
            min_os = ?,
            min_processor = ?,
            min_memory = ?,
            min_graphics = ?,
            min_directx = ?,
            min_storage = ?,
            rec_os = ?,
            rec_processor = ?,
            rec_memory = ?,
            rec_graphics = ?,
            rec_directx = ?,
            rec_storage = ?
        WHERE game_id = ?
    ");
    
    $stmt->bind_param(
        "sssdssssssssssssssssi",
        $title,
        $developer_name,
        $release_date,
        $price,
        $description,
        $thumbnail_image,
        $header_image,
        $download_url,
        $min_os,
        $min_processor,
        $min_memory,
        $min_graphics,
        $min_directx,
        $min_storage,
        $rec_os,
        $rec_processor,
        $rec_memory,
        $rec_graphics,
        $rec_directx,
        $rec_storage,
        $game_id
    );
    
    $stmt->execute();
    $stmt->close();

    // Delete existing genre associations
    $stmt = $conn->prepare("DELETE FROM game_genre WHERE game_id = ?");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $stmt->close();

    // Insert new genre associations
    if (!empty($genres)) {
        $stmt = $conn->prepare("INSERT INTO game_genre (game_id, genre_id) VALUES (?, ?)");
        foreach ($genres as $genre_id) {
            $genre_id = intval($genre_id);
            $stmt->bind_param("ii", $game_id, $genre_id);
            $stmt->execute();
        }
        $stmt->close();
    }

    // Delete existing tag associations
    $stmt = $conn->prepare("DELETE FROM game_tag WHERE game_id = ?");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $stmt->close();

    // Insert new tag associations
    if (!empty($tags)) {
        $stmt = $conn->prepare("INSERT INTO game_tag (game_id, tag_id) VALUES (?, ?)");
        foreach ($tags as $tag_id) {
            $tag_id = intval($tag_id);
            $stmt->bind_param("ii", $game_id, $tag_id);
            $stmt->execute();
        }
        $stmt->close();
    }

    // Commit transaction
    $conn->commit();
    
    echo json_encode(['success' => true, 'message' => 'Game updated successfully', 'game_id' => $game_id]);
    
} catch (Exception $e) {
    // Rollback on error
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'Error updating game: ' . $e->getMessage()]);
}

$conn->close();
?>
