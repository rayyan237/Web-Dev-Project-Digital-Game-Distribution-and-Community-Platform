<?php
// Start session
session_start();

// Set JSON response header
header('Content-Type: application/json');

// Load database connection
include '../config/db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo json_encode([
        'success' => false,
        'error' => 'You must be logged in to view posts.'
    ]);
    exit;
}

// Get optional parameters for filtering
$category = isset($_GET['category']) ? trim($_GET['category']) : 'all';
$user_filter = isset($_GET['user_filter']) ? trim($_GET['user_filter']) : 'all'; // 'all' or 'mine'
$sort = isset($_GET['sort']) ? trim($_GET['sort']) : 'newest'; // 'newest' or 'popular'
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 100;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

// Validate parameters
if ($limit < 1 || $limit > 100) $limit = 100;
if ($offset < 0) $offset = 0;

$valid_categories = ['all', 'general', 'feedback', 'help', 'guide'];
if (!in_array($category, $valid_categories)) {
    $category = 'all';
}

try {
    // Build the SQL query
    $sql = "
        SELECT 
            cp.post_id,
            cp.user_id,
            cp.title,
            cp.content,
            cp.category,
            cp.created_at,
            u.username,
            u.display_name,
            u.avatar_url,
            (SELECT COUNT(*) FROM community_post_reactions WHERE post_id = cp.post_id AND reaction_type = 'like') as likes,
            (SELECT COUNT(*) FROM community_post_reactions WHERE post_id = cp.post_id AND reaction_type = 'dislike') as dislikes,
            (SELECT reaction_type FROM community_post_reactions WHERE post_id = cp.post_id AND user_id = ? LIMIT 1) as user_reaction
        FROM community_posts cp
        INNER JOIN users u ON cp.user_id = u.user_id
    ";
    
    $where_conditions = [];
    $params = [$_SESSION['user_id']]; // For user_reaction subquery
    $param_types = "i";
    
    // Add category filter
    if ($category !== 'all') {
        $where_conditions[] = "cp.category = ?";
        $params[] = $category;
        $param_types .= "s";
    }
    
    // Add user filter (my posts only)
    if ($user_filter === 'mine') {
        $where_conditions[] = "cp.user_id = ?";
        $params[] = $_SESSION['user_id'];
        $param_types .= "i";
    }
    
    // Add WHERE clause if there are conditions
    if (count($where_conditions) > 0) {
        $sql .= " WHERE " . implode(" AND ", $where_conditions);
    }
    
    // Add sorting
    if ($sort === 'popular') {
        $sql .= " ORDER BY (likes - dislikes) DESC, cp.created_at DESC";
    } else {
        $sql .= " ORDER BY cp.created_at DESC";
    }
    
    // Add limit and offset
    $sql .= " LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;
    $param_types .= "ii";
    
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        throw new Exception("Database prepare failed: " . $conn->error);
    }
    
    // Bind parameters dynamically
    $stmt->bind_param($param_types, ...$params);
    
    if (!$stmt->execute()) {
        throw new Exception("Database execute failed: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    $posts = [];
    
    while ($row = $result->fetch_assoc()) {
        // Get replies count for this post
        $reply_stmt = $conn->prepare("SELECT COUNT(*) as reply_count FROM community_replies WHERE post_id = ?");
        $reply_stmt->bind_param("i", $row['post_id']);
        $reply_stmt->execute();
        $reply_result = $reply_stmt->get_result();
        $reply_data = $reply_result->fetch_assoc();
        $reply_stmt->close();
        
        $posts[] = [
            'post_id' => $row['post_id'],
            'user_id' => $row['user_id'],
            'username' => $row['username'],
            'display_name' => $row['display_name'],
            'title' => $row['title'],
            'content' => $row['content'],
            'category' => $row['category'],
            'created_at' => $row['created_at'],
            'avatar_url' => $row['avatar_url'] ?? 'assets/images/avatars/default.jpg',
            'likes' => (int)$row['likes'],
            'dislikes' => (int)$row['dislikes'],
            'user_reaction' => $row['user_reaction'], // 'like', 'dislike', or null
            'reply_count' => (int)$reply_data['reply_count'],
            'is_own_post' => ($row['user_id'] == $_SESSION['user_id'])
        ];
    }
    
    $stmt->close();
    
    echo json_encode([
        'success' => true,
        'posts' => $posts,
        'count' => count($posts)
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Failed to load posts. Please try again later.',
        'debug' => $e->getMessage()
    ]);
} finally {
    $conn->close();
}
?>
