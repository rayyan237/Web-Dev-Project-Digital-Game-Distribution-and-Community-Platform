<?php
session_start();
require_once '../config/db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?error=' . urlencode('Please login to access admin panel'));
    exit;
}

// Check if user is admin
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT is_admin FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user || $user['is_admin'] != 1) {
    header('Location: index.php?error=' . urlencode('Access denied. Admin privileges required.'));
    exit;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - Game Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <style>
        body {
            background-color: #1b2838;
            color: #c7d5e0;
            font-family: "Motiva Sans", "Segoe UI", "Arial", sans-serif;
            min-height: 100vh;
        }

        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .admin-header {
            background: linear-gradient(135deg, rgba(23, 26, 33, 0.98), rgba(27, 40, 56, 0.98));
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(102, 192, 244, 0.2);
        }

        .admin-header h1 {
            color: #ffffff;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .admin-header p {
            color: #8f98a0;
            margin: 0;
        }

        .featured-info {
            background: rgba(102, 192, 244, 0.1);
            border-left: 3px solid #66c0f4;
            padding: 15px 20px;
            border-radius: 4px;
            margin-bottom: 30px;
        }

        .featured-info h5 {
            color: #66c0f4;
            font-size: 0.9rem;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .featured-info p {
            color: #c7d5e0;
            margin: 0;
            font-size: 0.9rem;
        }

        .games-grid {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .game-card {
            background: linear-gradient(135deg, rgba(23, 26, 33, 0.98), rgba(27, 40, 56, 0.98));
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid rgba(102, 192, 244, 0.1);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            min-height: 150px;
            max-height: 150px;
        }

        .game-card:hover {
            border-color: rgba(102, 192, 244, 0.3);
            transform: translateX(2px);
        }

        .game-card.featured {
            border-color: rgba(102, 192, 244, 0.5);
            box-shadow: 0 0 20px rgba(102, 192, 244, 0.2);
        }

        .game-thumbnail {
            width: 200px;
            min-width: 200px;
            height: 150px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .game-info {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            flex: 1;
        }

        .game-details {
            flex: 1;
            min-width: 0;
        }

        .game-title {
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .game-developer {
            color: #8f98a0;
            font-size: 0.85rem;
            margin-bottom: 8px;
        }

        .game-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 0.85rem;
        }

        .game-price {
            color: #66c0f4;
            font-weight: 600;
        }

        .game-status {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .game-actions {
            display: flex;
            gap: 10px;
            flex-shrink: 0;
            padding-right: 20px;
        }

        .badge-featured {
            background: linear-gradient(90deg, #06bfff 0%, #2d73ff 100%);
            color: #ffffff;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .badge-video {
            background: rgba(102, 192, 244, 0.2);
            color: #66c0f4;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .badge-special-offer {
            background: linear-gradient(90deg, #FFD700 0%, #FFA500 100%);
            color: #1b2838;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .badge-recommended {
            background: linear-gradient(90deg, #9147ff 0%, #b968ff 100%);
            color: #ffffff;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .btn-featured {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .btn-add-featured {
            background: linear-gradient(90deg, #06bfff 0%, #2d73ff 100%);
            color: #ffffff;
        }

        .btn-add-featured:hover:not(:disabled) {
            background: linear-gradient(90deg, #2d73ff 0%, #06bfff 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 192, 244, 0.4);
        }

        .btn-remove-featured {
            background: rgba(255, 107, 107, 0.2);
            border: 1px solid rgba(255, 107, 107, 0.4);
            color: #ff6b6b;
        }

        .btn-remove-featured:hover {
            background: rgba(255, 107, 107, 0.3);
        }

        .btn-add-offer {
            background: linear-gradient(90deg, #FFD700 0%, #FFA500 100%);
            color: #1b2838;
        }

        .btn-add-offer:hover:not(:disabled) {
            background: linear-gradient(90deg, #FFA500 0%, #FFD700 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
        }

        .btn-remove-offer {
            background: rgba(255, 215, 0, 0.2);
            border: 1px solid rgba(255, 215, 0, 0.4);
            color: #FFD700;
        }

        .btn-remove-offer:hover {
            background: rgba(255, 215, 0, 0.3);
        }

        .btn-add-recommended {
            background: linear-gradient(90deg, #9147ff 0%, #b968ff 100%);
            color: #ffffff;
        }

        .btn-add-recommended:hover:not(:disabled) {
            background: linear-gradient(90deg, #b968ff 0%, #9147ff 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(145, 71, 255, 0.4);
        }

        .btn-remove-recommended {
            background: rgba(145, 71, 255, 0.2);
            border: 1px solid rgba(145, 71, 255, 0.4);
            color: #9147ff;
        }

        .btn-remove-recommended:hover {
            background: rgba(145, 71, 255, 0.3);
        }

        .btn-featured:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .loading-spinner {
            text-align: center;
            padding: 60px;
            color: #66c0f4;
        }

        .alert-custom {
            border-radius: 4px;
            padding: 15px 20px;
            margin-bottom: 20px;
            border: none;
        }

        .alert-success {
            background-color: rgba(102, 192, 244, 0.1);
            border-left: 3px solid #66c0f4;
            color: #66c0f4;
        }

        .alert-danger {
            background-color: rgba(255, 107, 107, 0.1);
            border-left: 3px solid #ff6b6b;
            color: #ff6b6b;
        }
    </style>
</head>

<body>
    <?php include 'navbar_include.php'; ?>

    <div class="admin-container">
        <div class="admin-header">
            <h1><i class="fas fa-cogs"></i> Admin Panel - Game Management</h1>
            <p>Manage featured games for the hero carousel on the homepage</p>
        </div>

        <div class="featured-info">
            <h5><i class="fas fa-info-circle"></i> Featured Games Rules</h5>
            <p>• You can feature between 2 and 4 games for the hero carousel</p>
            <p>• Games with video trailers will display videos; others will show their banner image</p>
            <p>• Featured games appear in order on the homepage hero section</p>
        </div>

        <div class="featured-info" style="border-left-color: #FFD700;">
            <h5 style="color: #FFD700;"><i class="fas fa-tags"></i> Special Offers (50% Off) Rules</h5>
            <p>• You can add between 4 and 8 games to the 50% off special offers section</p>
            <p>• These games will appear on the homepage "Special Offers 50% off!" carousel</p>
            <p>• Discount is automatically calculated as 50% off the database price</p>
        </div>

        <div class="featured-info" style="border-left-color: #9147ff;">
            <h5 style="color: #9147ff;"><i class="fas fa-star"></i> Featured & Recommended Rules</h5>
            <p>• You can feature between 1 and 2 games for the "Featured & Recommended" section</p>
            <p>• These games will display with full descriptions and large showcases</p>
            <p>• Perfect for highlighting new releases or exceptional titles</p>
        </div>

        <div id="messageContainer"></div>

        <div id="gamesContainer" class="games-grid">
            <div class="loading-spinner">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3">Loading games...</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let featuredCount = 0;
        let specialOfferCount = 0;
        let recommendedCount = 0;
        const MIN_FEATURED = 2;
        const MAX_FEATURED = 4;
        const MIN_SPECIAL_OFFERS = 4;
        const MAX_SPECIAL_OFFERS = 8;
        const MIN_RECOMMENDED = 1;
        const MAX_RECOMMENDED = 2;

        async function loadGames() {
            try {
                const response = await fetch('../php_backend/get_all_games_admin.php');
                const data = await response.json();

                if (data.success) {
                    featuredCount = data.games.filter(g => g.is_featured == 1).length;
                    specialOfferCount = data.games.filter(g => g.is_special_offer == 1).length;
                    recommendedCount = data.games.filter(g => g.is_recommended == 1).length;
                    renderGames(data.games);
                } else {
                    showMessage(data.message || 'Failed to load games', 'danger');
                }
            } catch (error) {
                console.error('Error loading games:', error);
                showMessage('Error loading games. Please try again.', 'danger');
            }
        }

        function renderGames(games) {
            const container = document.getElementById('gamesContainer');
            
            if (games.length === 0) {
                container.innerHTML = '<p class="text-center text-secondary">No games found in database.</p>';
                return;
            }

            container.innerHTML = games.map(game => {
                const isFeatured = game.is_featured == 1;
                const isSpecialOffer = game.is_special_offer == 1;
                const isRecommended = game.is_recommended == 1;
                const hasVideo = game.has_video == 1;
                const price = game.price == 0 ? 'Free' : `$${parseFloat(game.price).toFixed(2)}`;
                
                const canAdd = featuredCount < MAX_FEATURED;
                const canRemove = featuredCount > MIN_FEATURED;
                const canAddOffer = specialOfferCount < MAX_SPECIAL_OFFERS;
                const canRemoveOffer = specialOfferCount > MIN_SPECIAL_OFFERS;
                const canAddRecommended = recommendedCount < MAX_RECOMMENDED;
                const canRemoveRecommended = recommendedCount > MIN_RECOMMENDED;

                return `
                    <div class="game-card ${isFeatured ? 'featured' : ''}">
                        <img src="../${game.thumbnail_image}" alt="${game.title}" class="game-thumbnail">
                        <div class="game-info">
                            <div class="game-details">
                                <h3 class="game-title">${game.title}</h3>
                                <p class="game-developer">${game.developer_name}</p>
                                <div class="game-meta">
                                    <span class="game-price">${price}</span>
                                    <div class="game-status">
                                        ${isFeatured ? '<span class="badge-featured"><i class="fas fa-star"></i> Featured</span>' : ''}
                                        ${isSpecialOffer ? '<span class="badge-special-offer"><i class="fas fa-percent"></i> 50% Off</span>' : ''}
                                        ${isRecommended ? '<span class="badge-recommended"><i class="fas fa-thumbs-up"></i> Recommended</span>' : ''}
                                        ${hasVideo ? '<span class="badge-video"><i class="fas fa-video"></i> Has Trailer</span>' : ''}
                                    </div>
                                </div>
                            </div>
                            <div class="game-actions">
                                ${isFeatured ? `
                                    <button class="btn-featured btn-remove-featured" 
                                        onclick="toggleFeatured(${game.game_id}, false)"
                                        ${!canRemove ? 'disabled' : ''}>
                                        <i class="fas fa-times"></i> Remove from Featured
                                    </button>
                                ` : `
                                    <button class="btn-featured btn-add-featured" 
                                        onclick="toggleFeatured(${game.game_id}, true)"
                                        ${!canAdd ? 'disabled' : ''}>
                                        <i class="fas fa-plus"></i> Add to Featured
                                    </button>
                                `}
                                ${isSpecialOffer ? `
                                    <button class="btn-featured btn-remove-offer" 
                                        onclick="toggleSpecialOffer(${game.game_id}, false)"
                                        ${!canRemoveOffer ? 'disabled' : ''}>
                                        <i class="fas fa-times"></i> Remove 50% Off
                                    </button>
                                ` : `
                                    <button class="btn-featured btn-add-offer" 
                                        onclick="toggleSpecialOffer(${game.game_id}, true)"
                                        ${!canAddOffer ? 'disabled' : ''}>
                                        <i class="fas fa-percent"></i> 50% Off
                                    </button>
                                `}
                                ${isRecommended ? `
                                    <button class="btn-featured btn-remove-recommended" 
                                        onclick="toggleRecommended(${game.game_id}, false)"
                                        ${!canRemoveRecommended ? 'disabled' : ''}>
                                        <i class="fas fa-times"></i> Remove Recommended
                                    </button>
                                ` : `
                                    <button class="btn-featured btn-add-recommended" 
                                        onclick="toggleRecommended(${game.game_id}, true)"
                                        ${!canAddRecommended ? 'disabled' : ''}>
                                        <i class="fas fa-thumbs-up"></i> Recommended
                                    </button>
                                `}
                                <!-- Additional action buttons can be added here -->
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        async function toggleFeatured(gameId, addToFeatured) {
            try {
                const response = await fetch('../php_backend/toggle_featured.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        game_id: gameId,
                        is_featured: addToFeatured ? 1 : 0
                    })
                });

                const data = await response.json();

                if (data.success) {
                    showMessage(data.message, 'success');
                    loadGames(); // Reload games list
                } else {
                    showMessage(data.message || 'Failed to update featured status', 'danger');
                }
            } catch (error) {
                console.error('Error toggling featured:', error);
                showMessage('Error updating featured status. Please try again.', 'danger');
            }
        }

        async function toggleSpecialOffer(gameId, addToOffer) {
            try {
                const response = await fetch('../php_backend/toggle_special_offer.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        game_id: gameId,
                        is_special_offer: addToOffer ? 1 : 0
                    })
                });

                const data = await response.json();

                if (data.success) {
                    showMessage(data.message, 'success');
                    loadGames(); // Reload games list
                } else {
                    showMessage(data.message || 'Failed to update special offer status', 'danger');
                }
            } catch (error) {
                console.error('Error toggling special offer:', error);
                showMessage('Error updating special offer status. Please try again.', 'danger');
            }
        }

        async function toggleRecommended(gameId, addToRecommended) {
            try {
                const response = await fetch('../php_backend/toggle_recommended.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        game_id: gameId,
                        is_recommended: addToRecommended ? 1 : 0
                    })
                });

                const data = await response.json();

                if (data.success) {
                    showMessage(data.message, 'success');
                    loadGames(); // Reload games list
                } else {
                    showMessage(data.message || 'Failed to update recommended status', 'danger');
                }
            } catch (error) {
                console.error('Error toggling recommended:', error);
                showMessage('Error updating recommended status. Please try again.', 'danger');
            }
        }

        function showMessage(message, type) {
            const container = document.getElementById('messageContainer');
            container.innerHTML = `
                <div class="alert-custom alert-${type}">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                    ${message}
                </div>
            `;

            setTimeout(() => {
                container.innerHTML = '';
            }, 5000);
        }

        // Load games on page load
        document.addEventListener('DOMContentLoaded', loadGames);
    </script>
</body>

</html>
