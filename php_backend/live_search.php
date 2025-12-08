<?php
require_once "../config/db_connect.php";

header("Content-Type: application/json");

// Agar search empty hai to empty array return karo
if (!isset($_GET['q']) || trim($_GET['q']) === "") {
    echo json_encode([]);
    exit;
}

$q = trim($_GET['q']);
$qLike = "%{$q}%";   // Kahin bhi match kare (Anywhere)
$qStart = "{$q}%";   // Start mein match kare (Priority)

// ✅ CORRECTED SQL QUERY
// 1. 'id' ko 'game_id' se replace kiya.
// 2. 'thumbnail' ko 'thumbnail_image' se replace kiya (DB structure ke mutabiq).
$sql = $conn->prepare("
    SELECT game_id, title, thumbnail_image 
    FROM games
    WHERE 
        title LIKE ?       -- start match e.g. 'bat%'
        OR title LIKE ?    -- anywhere match e.g. '%bat%'
        OR description LIKE ?
        OR tags LIKE ?
    ORDER BY 
        CASE 
            WHEN title LIKE ? THEN 0   -- Agar naam start match ho to sabse upar
            ELSE 1
        END,
        title ASC
    LIMIT 15
");

// 5 Parameters bind kar rahe hain
$sql->bind_param("sssss", $qStart, $qLike, $qLike, $qLike, $qStart);

$sql->execute();
$result = $sql->get_result();

$games = [];

while ($row = $result->fetch_assoc()) {
    // ✅ Image check fix
    // DB mein aksar 'assets/...' store hota hai, isliye '../' lagaya hai check ke liye
    if (!file_exists("../" . $row['thumbnail_image']) || empty($row['thumbnail_image'])) {
        $row['thumbnail_image'] = "assets/images/default-game.jpg";
    }
    $games[] = $row;
}

echo json_encode($games);
exit;
?>