<?php
session_start();
require_once '../config/db_connect.php';

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in']);
    exit;
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['about'])) {
    echo json_encode(['success' => false, 'message' => 'About text is required']);
    exit;
}

$about = trim($input['about']);
$user_id = $_SESSION['user_id'];

// Validate about length (max 1000 characters)
if (strlen($about) > 1000) {
    echo json_encode(['success' => false, 'message' => 'About text must be 1000 characters or less']);
    exit;
}

try {
    $stmt = $conn->prepare("UPDATE users SET about = ? WHERE user_id = ?");
    $stmt->bind_param("si", $about, $user_id);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'About updated successfully',
            'data' => ['about' => $about]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update about']);
    }
    
    $stmt->close();
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error updating about: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
