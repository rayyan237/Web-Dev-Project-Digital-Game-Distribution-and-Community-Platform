<?php
session_start();
require_once '../config/db_connect.php';

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to update your profile picture']);
    exit;
}

// Check if file was uploaded
if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => 'No file uploaded or upload error occurred']);
    exit;
}

$user_id = $_SESSION['user_id'];
$file = $_FILES['avatar'];

// Validate file type
$allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
$file_type = strtolower($file['type']);

if (!in_array($file_type, $allowed_types)) {
    echo json_encode(['success' => false, 'message' => 'Invalid file type. Only JPEG, PNG, GIF, and WEBP images are allowed']);
    exit;
}

// Validate file size (max 5MB)
if ($file['size'] > 5 * 1024 * 1024) {
    echo json_encode(['success' => false, 'message' => 'File size exceeds 5MB limit']);
    exit;
}

// Create avatars directory if it doesn't exist
$upload_dir = '../assets/images/avatars';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Generate unique filename
$file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
$new_filename = 'user_' . $user_id . '_' . time() . '.' . $file_extension;
$upload_path = $upload_dir . '/' . $new_filename;
$db_path = 'assets/images/avatars/' . $new_filename;

// Get old avatar path to delete it
$stmt = $conn->prepare("SELECT avatar_url FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

$old_avatar = $user['avatar_url'] ?? null;

// Move uploaded file
if (!move_uploaded_file($file['tmp_name'], $upload_path)) {
    echo json_encode(['success' => false, 'message' => 'Failed to save uploaded file']);
    exit;
}

// Update database
$stmt = $conn->prepare("UPDATE users SET avatar_url = ? WHERE user_id = ?");
$stmt->bind_param("si", $db_path, $user_id);

if ($stmt->execute()) {
    // Update session
    $_SESSION['avatar_url'] = $db_path;
    
    // Delete old avatar file if it exists and is not the default
    if ($old_avatar && $old_avatar !== 'assets/images/avatars/default.jpg' && file_exists('../' . $old_avatar)) {
        unlink('../' . $old_avatar);
    }
    
    echo json_encode([
        'success' => true,
        'message' => 'Profile picture updated successfully',
        'avatar_url' => $db_path
    ]);
} else {
    // Delete uploaded file if database update fails
    unlink($upload_path);
    echo json_encode(['success' => false, 'message' => 'Failed to update database']);
}

$stmt->close();
$conn->close();
?>
