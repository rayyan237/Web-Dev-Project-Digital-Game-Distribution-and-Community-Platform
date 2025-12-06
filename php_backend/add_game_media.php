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

// Get game_id and media_type
$game_id = isset($_POST['game_id']) ? intval($_POST['game_id']) : 0;
$media_type = $_POST['media_type'] ?? '';

// Validate inputs
if ($game_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid game ID']);
    exit;
}

if (!in_array($media_type, ['screenshot', 'gif', 'thumbnail', 'video'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid media type']);
    exit;
}

// Check media limits before upload
// Count existing media for this game
$count_stmt = $conn->prepare("SELECT COUNT(*) as count FROM game_media WHERE game_id = ? AND media_type = ?");
$count_stmt->bind_param("is", $game_id, $media_type);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$count_row = $count_result->fetch_assoc();
$existing_count = $count_row['count'];
$count_stmt->close();

// Enforce limits: max 4 screenshots, max 1 video
if ($media_type === 'screenshot' && $existing_count >= 4) {
    echo json_encode([
        'success' => false, 
        'message' => 'Maximum limit reached: You can only upload 4 screenshots per game. Please delete an existing screenshot to add a new one.'
    ]);
    exit;
}

if ($media_type === 'video' && $existing_count >= 1) {
    echo json_encode([
        'success' => false, 
        'message' => 'Maximum limit reached: You can only upload 1 video per game. Please delete the existing video to add a new one.'
    ]);
    exit;
}

// Check if file was uploaded
if (!isset($_FILES['media_file'])) {
    echo json_encode(['success' => false, 'message' => 'No file uploaded']);
    exit;
}

if ($_FILES['media_file']['error'] !== UPLOAD_ERR_OK) {
    $error_messages = [
        UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize in php.ini',
        UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE in HTML form',
        UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
        UPLOAD_ERR_EXTENSION => 'File upload stopped by extension'
    ];
    $error_message = $error_messages[$_FILES['media_file']['error']] ?? 'Unknown upload error';
    echo json_encode(['success' => false, 'message' => $error_message]);
    exit;
}

// Get game title
$stmt = $conn->prepare("SELECT title FROM games WHERE game_id = ?");
$stmt->bind_param("i", $game_id);
$stmt->execute();
$result = $stmt->get_result();
$game = $result->fetch_assoc();
$stmt->close();

if (!$game) {
    echo json_encode(['success' => false, 'message' => 'Game not found']);
    exit;
}

$game_title = $game['title'];
$file = $_FILES['media_file'];
$file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

// Validate file type based on media_type
if ($media_type === 'video') {
    $allowed_extensions = ['mp4', 'webm', 'ogg'];
    $base_folder = '../assets/videos/' . $game_title;
} else {
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $base_folder = '../assets/images/games/' . $game_title;
}

if (!in_array($file_extension, $allowed_extensions)) {
    echo json_encode(['success' => false, 'message' => 'Invalid file type. Allowed: ' . implode(', ', $allowed_extensions)]);
    exit;
}

// Check file size (max 100MB for videos, 10MB for images)
$max_size = ($media_type === 'video') ? 100 * 1024 * 1024 : 10 * 1024 * 1024;
if ($file['size'] > $max_size) {
    $max_size_mb = $max_size / (1024 * 1024);
    echo json_encode(['success' => false, 'message' => "File size exceeds {$max_size_mb}MB limit"]);
    exit;
}

// Create folder if it doesn't exist
if (!file_exists($base_folder)) {
    if (!mkdir($base_folder, 0777, true)) {
        echo json_encode(['success' => false, 'message' => 'Failed to create directory']);
        exit;
    }
}

// Generate unique filename
$unique_filename = time() . '_' . uniqid() . '.' . $file_extension;
$upload_path = $base_folder . '/' . $unique_filename;

// Move uploaded file
if (!move_uploaded_file($file['tmp_name'], $upload_path)) {
    echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file']);
    exit;
}

// Store relative path in database (without leading ../)
if ($media_type === 'video') {
    $db_path = 'assets/videos/' . $game_title . '/' . $unique_filename;
} else {
    $db_path = 'assets/images/games/' . $game_title . '/' . $unique_filename;
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO game_media (game_id, media_url, media_type) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $game_id, $db_path, $media_type);

if ($stmt->execute()) {
    $media_id = $conn->insert_id;
    echo json_encode([
        'success' => true, 
        'message' => 'Media uploaded successfully',
        'media_id' => $media_id,
        'media_url' => $db_path
    ]);
} else {
    // Delete uploaded file if database insert fails
    unlink($upload_path);
    echo json_encode(['success' => false, 'message' => 'Failed to save media to database']);
}

$stmt->close();
$conn->close();
?>
