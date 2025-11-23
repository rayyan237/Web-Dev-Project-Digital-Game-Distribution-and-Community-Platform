<?php
// Start session and check if user is logged in
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php?error=" . urlencode("Please login to view your profile."));
    exit;
}

// Load database connection to fetch fresh user data
include '../config/db_connect.php';

// Fetch user data from database
$stmt = $conn->prepare("SELECT user_id, username, email, display_name, country, age, is_admin, avatar_url, level, xp, time_stamp FROM users WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    // User not found - logout
    session_destroy();
    header("Location: login.php?error=" . urlencode("User account not found."));
    exit;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile - <?php echo htmlspecialchars($user['display_name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            background-color: #1b2838;
            color: #c7d5e0;
            font-family: "Motiva Sans", "Segoe UI", "Arial", sans-serif;
            min-height: 100vh;
            padding: 30px 0;
        }

        .profile-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        .profile-header {
            background: linear-gradient(135deg, rgba(23, 26, 33, 0.98), rgba(27, 40, 56, 0.98));
            border-radius: 8px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.6);
            border: 1px solid rgba(102, 192, 244, 0.1);
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 8px;
            object-fit: cover;
            border: 3px solid #66c0f4;
            box-shadow: 0 4px 15px rgba(102, 192, 244, 0.3);
        }

        .profile-info h1 {
            color: #ffffff;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .profile-username {
            color: #66c0f4;
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        .profile-stats {
            display: flex;
            gap: 25px;
            margin-top: 15px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stat-label {
            color: #8f98a0;
            font-size: 0.9rem;
        }

        .stat-value {
            color: #ffffff;
            font-weight: 600;
            font-size: 1rem;
        }

        .admin-badge {
            display: inline-block;
            background: linear-gradient(135deg, #ff6b6b, #ff4757);
            color: #ffffff;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-left: 10px;
        }

        .profile-card {
            background: linear-gradient(135deg, rgba(23, 26, 33, 0.98), rgba(27, 40, 56, 0.98));
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(102, 192, 244, 0.1);
        }

        .profile-card h2 {
            color: #ffffff;
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #66c0f4;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #8f98a0;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .info-value {
            color: #ffffff;
            font-size: 0.95rem;
        }

        .btn-back {
            background: linear-gradient(135deg, #66c0f4, #4a9ed6);
            border: none;
            color: #ffffff;
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(102, 192, 244, 0.3);
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #4a9ed6, #3a8ec6);
            box-shadow: 0 6px 20px rgba(102, 192, 244, 0.5);
            transform: translateY(-2px);
            color: #ffffff;
        }

        .btn-logout {
            background: transparent;
            border: 2px solid #ff6b6b;
            color: #ff6b6b;
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-left: 15px;
        }

        .btn-logout:hover {
            background: #ff6b6b;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
            transform: translateY(-2px);
        }

        .progress-bar-custom {
            background-color: #32353c;
            height: 25px;
            border-radius: 4px;
            overflow: hidden;
            margin-top: 10px;
        }

        .progress-fill {
            background: linear-gradient(90deg, #66c0f4, #4a9ed6);
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-weight: 600;
            font-size: 0.85rem;
            transition: width 0.5s ease;
        }

        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-stats {
                flex-direction: column;
                gap: 10px;
            }

            .info-row {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
</head>

<body>

    <div class="profile-container">
        <!-- Profile Header -->
        <div class="profile-header">
            <img src="../<?php echo htmlspecialchars($user['avatar_url']); ?>" alt="Avatar" class="profile-avatar"
                onerror="this.src='../assets/images/avatars/default.jpg'">
            <div class="profile-info">
                <h1>
                    <?php echo htmlspecialchars($user['display_name']); ?>
                    <?php if ($user['is_admin'] == 1): ?>
                    <span class="admin-badge"><i class="fas fa-crown"></i> Admin</span>
                    <?php endif; ?>
                </h1>
                <div class="profile-username">@<?php echo htmlspecialchars($user['username']); ?></div>

                <div class="profile-stats">
                    <div class="stat-item">
                        <i class="fas fa-trophy" style="color: #ffd700;"></i>
                        <span class="stat-label">Level:</span>
                        <span class="stat-value"><?php echo htmlspecialchars($user['level']); ?></span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-star" style="color: #66c0f4;"></i>
                        <span class="stat-label">XP:</span>
                        <span class="stat-value"><?php echo number_format($user['xp']); ?></span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-calendar-alt" style="color: #c7d5e0;"></i>
                        <span class="stat-label">Member Since:</span>
                        <span class="stat-value"><?php echo date('M Y', strtotime($user['time_stamp'])); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Information -->
        <div class="profile-card">
            <h2><i class="fas fa-user-circle"></i> Account Information</h2>
            <div class="info-row">
                <span class="info-label">User ID</span>
                <span class="info-value">#<?php echo htmlspecialchars($user['user_id']); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Username</span>
                <span class="info-value"><?php echo htmlspecialchars($user['username']); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Display Name</span>
                <span class="info-value"><?php echo htmlspecialchars($user['display_name']); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Email Address</span>
                <span class="info-value"><?php echo htmlspecialchars($user['email']); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Country</span>
                <span class="info-value"><?php echo htmlspecialchars($user['country']); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Age</span>
                <span class="info-value"><?php echo htmlspecialchars($user['age']); ?> years old</span>
            </div>
            <div class="info-row">
                <span class="info-label">Account Type</span>
                <span class="info-value">
                    <?php echo ($user['is_admin'] == 1) ? 'Administrator' : 'Regular User'; ?>
                </span>
            </div>
        </div>

        <!-- Level Progress -->
        <div class="profile-card">
            <h2><i class="fas fa-chart-line"></i> Level Progress</h2>
            <div class="info-row">
                <span class="info-label">Current Level</span>
                <span class="info-value">Level <?php echo htmlspecialchars($user['level']); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Total Experience Points</span>
                <span class="info-value"><?php echo number_format($user['xp']); ?> XP</span>
            </div>
            
            <?php
            // Calculate progress to next level (example: 1000 XP per level)
            $xpPerLevel = 1000;
            $currentLevelXP = ($user['level'] - 1) * $xpPerLevel;
            $nextLevelXP = $user['level'] * $xpPerLevel;
            $progressXP = $user['xp'] - $currentLevelXP;
            $requiredXP = $nextLevelXP - $currentLevelXP;
            $percentage = min(100, ($progressXP / $requiredXP) * 100);
            ?>
            
            <div class="info-row">
                <span class="info-label">Progress to Level <?php echo ($user['level'] + 1); ?></span>
                <span class="info-value"><?php echo number_format($progressXP); ?> / <?php echo number_format($requiredXP); ?> XP</span>
            </div>
            
            <div class="progress-bar-custom">
                <div class="progress-fill" style="width: <?php echo $percentage; ?>%">
                    <?php echo round($percentage); ?>%
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="text-center mt-4">
            <a href="index.php" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back to Store
            </a>
            <a href="../php_backend/logout.php" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
