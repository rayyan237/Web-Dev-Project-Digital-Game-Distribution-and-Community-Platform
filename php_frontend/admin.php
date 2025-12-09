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

        /* .featured-info {
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
        } */

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
            min-height: 120px;
            max-height: 120px;
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
            width: 215px;
            min-width: 215px;
            height: 120px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .game-info {
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
            overflow: hidden;
        }

        .game-details {
            flex: 1;
            min-width: 0;
        }

        .game-title {
            color: #ffffff;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 3px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .game-developer {
            color: #8f98a0;
            font-size: 0.8rem;
            margin-bottom: 5px;
        }

        .game-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.8rem;
        }

        .game-price {
            color: #66c0f4;
            font-weight: 600;
        }

        .game-status {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .game-actions {
            display: flex;
            gap: 6px;
            flex-shrink: 0;
            padding-right: 15px;
            flex-wrap: wrap;
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
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            min-width: 80px;
            text-align: center;
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

        .btn-edit {
            background: linear-gradient(90deg, #4CAF50 0%, #45a049 100%);
            color: #ffffff;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            min-width: 80px;
            text-align: center;
        }

        .btn-edit:hover {
            background: linear-gradient(90deg, #45a049 0%, #4CAF50 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.4);
        }

        .btn-delete {
            background: rgba(244, 67, 54, 0.2);
            border: 1px solid rgba(244, 67, 54, 0.4);
            color: #f44336;
            padding: 6px 10px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            min-width: 80px;
            text-align: center;
        }

        .btn-delete:hover {
            background: rgba(244, 67, 54, 0.3);
            border-color: rgba(244, 67, 54, 0.6);
        }

        .btn-featured:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .search-container {
            background: linear-gradient(135deg, rgba(23, 26, 33, 0.98), rgba(27, 40, 56, 0.98));
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            border: 1px solid rgba(102, 192, 244, 0.2);
        }

        .search-box {
            position: relative;
            max-width: 600px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 45px 12px 45px;
            background: rgba(42, 71, 94, 0.6);
            border: 2px solid rgba(102, 192, 244, 0.3);
            border-radius: 6px;
            color: #c7d5e0;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: #66c0f4;
            background: rgba(42, 71, 94, 0.8);
            box-shadow: 0 0 15px rgba(102, 192, 244, 0.2);
        }

        .search-box input::placeholder {
            color: #8f98a0;
        }

        .search-box .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #66c0f4;
            font-size: 1.1rem;
            pointer-events: none;
        }

        .search-box .clear-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #8f98a0;
            font-size: 1.1rem;
            cursor: pointer;
            display: none;
            transition: color 0.3s ease;
        }

        .search-box .clear-icon:hover {
            color: #66c0f4;
        }

        .search-box .clear-icon.active {
            display: block;
        }

        .search-results-info {
            color: #8f98a0;
            font-size: 0.9rem;
            margin-top: 10px;
        }

        .search-results-info strong {
            color: #66c0f4;
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
    <?php include 'section-navbar.php'; ?>

    <div class="admin-container">
        <div class="admin-header">
            <h1><i class="fas fa-cogs"></i> Admin Panel - Game Management</h1>
            <p>Manage featured games for the hero carousel on the homepage</p>
        </div>

        <!-- <div class="featured-info">
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
        </div> -->

        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="text-white">Admin Panel - Manage Games</h1>
                <a href="admin_add_game.php" class="btn btn-success btn-lg">
                    <i class="fas fa-plus-circle me-2"></i>Add New Game
                </a>
            </div>

            <div class="alert alert-info">
                <strong>Featured Games:</strong> Add 2-4 games to the hero carousel (shows video trailers)<br>
                <strong>50% Off:</strong> Add 4-8 games to special offers section<br>
                <strong>Recommended:</strong> Add 1-2 games to Featured & Recommended section
            </div>

            <div id="messageContainer"></div>

            <!-- Search Bar -->
            <div class="search-container">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="gameSearchInput" placeholder="Search games by title, developer, genre, or tags..." autocomplete="off">
                    <i class="fas fa-times clear-icon" id="clearSearch"></i>
                </div>
                <div class="search-results-info" id="searchResultsInfo"></div>
            </div>

            <div id="gamesContainer" class="games-grid">
                <div class="loading-spinner">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3">Loading games...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Media Modal -->
    <div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #1b2838; border: 1px solid #66c0f4;">
                <div class="modal-header" style="border-bottom: 1px solid #3e6c96;">
                    <h5 class="modal-title text-white" id="mediaModalLabel">
                        <i class="fas fa-photo-video me-2"></i>Add Media for <span id="modalGameTitle"></span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="mediaUploadForm" enctype="multipart/form-data">
                        <input type="hidden" id="modal_game_id" name="game_id">
                        
                        <div class="mb-3">
                            <label for="media_type" class="form-label" style="color: #66c0f4;">Media Type</label>
                            <select class="form-select" id="media_type" name="media_type" required style="background-color: #2a475e; border: 1px solid #000; color: #fff;">
                                <option value="">Select Type</option>
                                <option value="screenshot">Screenshot</option>
                                <option value="gif">GIF</option>
                                <option value="thumbnail">Thumbnail</option>
                                <option value="video">Video</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="media_file" class="form-label" style="color: #66c0f4;">Select File</label>
                            <input type="file" class="form-control" id="media_file" name="media_file" required style="background-color: #2a475e; border: 1px solid #000; color: #fff;">
                            <div class="form-text" style="color: #8f98a0;">
                                <small>Images: JPG, PNG, GIF, WEBP | Videos: MP4, WEBM, OGG</small>
                            </div>
                        </div>

                        <div id="uploadProgress" class="mb-3" style="display: none;">
                            <div class="progress" style="height: 25px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%; background-color: #66c0f4;" id="progressBar">0%</div>
                            </div>
                        </div>

                        <div id="uploadMessage" class="mb-3" style="display: none;"></div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #3e6c96;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="uploadMedia()" style="background: linear-gradient(90deg, #06bfff 0%, #2d73ff 100%);">
                        <i class="fas fa-upload"></i> Upload Media
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let featuredCount = 0;
        let specialOfferCount = 0;
        let recommendedCount = 0;
        let allGames = []; // Store all games for search filtering
        const MIN_FEATURED = 2;
        const MAX_FEATURED = 4;
        const MIN_SPECIAL_OFFERS = 4;
        const MAX_SPECIAL_OFFERS = 8;
        const MIN_RECOMMENDED = 1;
        const MAX_RECOMMENDED = 4;

        async function loadGames() {
            try {
                const response = await fetch('../php_backend/get_all_games_admin.php');
                const data = await response.json();

                if (data.success) {
                    allGames = data.games; // Store games globally for search
                    featuredCount = data.games.filter(g => g.is_featured == 1).length;
                    specialOfferCount = data.games.filter(g => g.is_special_offer == 1).length;
                    recommendedCount = data.games.filter(g => g.is_recommended == 1).length;
                    renderGames(data.games);
                    updateSearchInfo(data.games.length, data.games.length);
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
                                <button class="btn-edit" onclick="editGame(${game.game_id})">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn-edit" onclick="openMediaModal(${game.game_id}, '${game.title.replace(/'/g, "\\'")}')">
                                    <i class="fas fa-photo-video"></i> Add Media
                                </button>
                                <button class="btn-delete" onclick="deleteGame(${game.game_id}, '${game.title.replace(/'/g, "\\'")}')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
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

        function editGame(gameId) {
            window.location.href = `admin_add_game.php?edit=1&game_id=${gameId}`;
        }

        function openMediaModal(gameId, gameTitle) {
            document.getElementById('modal_game_id').value = gameId;
            document.getElementById('modalGameTitle').textContent = gameTitle;
            document.getElementById('mediaUploadForm').reset();
            document.getElementById('uploadProgress').style.display = 'none';
            document.getElementById('uploadMessage').style.display = 'none';
            
            const modal = new bootstrap.Modal(document.getElementById('mediaModal'));
            modal.show();
        }

        async function uploadMedia() {
            const form = document.getElementById('mediaUploadForm');
            const formData = new FormData(form);
            const progressBar = document.getElementById('progressBar');
            const uploadProgress = document.getElementById('uploadProgress');
            const uploadMessage = document.getElementById('uploadMessage');

            // Validate form
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            // Show progress bar
            uploadProgress.style.display = 'block';
            uploadMessage.style.display = 'none';
            progressBar.style.width = '0%';
            progressBar.textContent = '0%';

            try {
                const xhr = new XMLHttpRequest();

                // Upload progress
                xhr.upload.addEventListener('progress', (e) => {
                    if (e.lengthComputable) {
                        const percentComplete = Math.round((e.loaded / e.total) * 100);
                        progressBar.style.width = percentComplete + '%';
                        progressBar.textContent = percentComplete + '%';
                    }
                });

                // Upload complete
                xhr.addEventListener('load', () => {
                    try {
                        const data = JSON.parse(xhr.responseText);
                        
                        if (data.success) {
                            uploadMessage.innerHTML = `<div class="alert alert-success" style="background-color: rgba(102, 192, 244, 0.1); border-left: 3px solid #66c0f4; color: #66c0f4;">
                                <i class="fas fa-check-circle"></i> ${data.message}
                            </div>`;
                            uploadMessage.style.display = 'block';
                            
                            // Reset form after 2 seconds
                            setTimeout(() => {
                                form.reset();
                                uploadProgress.style.display = 'none';
                                uploadMessage.style.display = 'none';
                            }, 2000);
                        } else {
                            uploadMessage.innerHTML = `<div class="alert alert-danger" style="background-color: rgba(255, 107, 107, 0.1); border-left: 3px solid #ff6b6b; color: #ff6b6b;">
                                <i class="fas fa-exclamation-circle"></i> ${data.message || 'Upload failed'}
                            </div>`;
                            uploadMessage.style.display = 'block';
                            uploadProgress.style.display = 'none';
                        }
                    } catch (error) {
                        console.error('Error parsing response:', error);
                        uploadMessage.innerHTML = `<div class="alert alert-danger" style="background-color: rgba(255, 107, 107, 0.1); border-left: 3px solid #ff6b6b; color: #ff6b6b;">
                            <i class="fas fa-exclamation-circle"></i> Error processing upload
                        </div>`;
                        uploadMessage.style.display = 'block';
                        uploadProgress.style.display = 'none';
                    }
                });

                // Upload error
                xhr.addEventListener('error', () => {
                    uploadMessage.innerHTML = `<div class="alert alert-danger" style="background-color: rgba(255, 107, 107, 0.1); border-left: 3px solid #ff6b6b; color: #ff6b6b;">
                        <i class="fas fa-exclamation-circle"></i> Network error during upload
                    </div>`;
                    uploadMessage.style.display = 'block';
                    uploadProgress.style.display = 'none';
                });

                xhr.open('POST', '../php_backend/add_game_media.php');
                xhr.send(formData);

            } catch (error) {
                console.error('Error uploading media:', error);
                uploadMessage.innerHTML = `<div class="alert alert-danger" style="background-color: rgba(255, 107, 107, 0.1); border-left: 3px solid #ff6b6b; color: #ff6b6b;">
                    <i class="fas fa-exclamation-circle"></i> Error uploading media. Please try again.
                </div>`;
                uploadMessage.style.display = 'block';
                uploadProgress.style.display = 'none';
            }
        }

        async function deleteGame(gameId, gameTitle) {
            if (!confirm(`Are you sure you want to delete "${gameTitle}"?\n\nThis will permanently remove:\n• The game from the database\n• All associated genres and tags\n• All reviews for this game\n• All media files\n• The game from user libraries and wishlists\n\nThis action cannot be undone!`)) {
                return;
            }

            try {
                const response = await fetch('../php_backend/delete_game.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        game_id: gameId
                    })
                });

                const data = await response.json();

                if (data.success) {
                    showMessage(data.message, 'success');
                    loadGames(); // Reload games list
                } else {
                    showMessage(data.message || 'Failed to delete game', 'danger');
                }
            } catch (error) {
                console.error('Error deleting game:', error);
                showMessage('Error deleting game. Please try again.', 'danger');
            }
        }

        // Setup search functionality
        function setupSearch() {
            const searchInput = document.getElementById('gameSearchInput');
            const clearBtn = document.getElementById('clearSearch');

            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.trim();
                
                // Show/hide clear button
                if (searchTerm) {
                    clearBtn.classList.add('active');
                } else {
                    clearBtn.classList.remove('active');
                }

                filterGames(searchTerm);
            });

            clearBtn.addEventListener('click', function() {
                searchInput.value = '';
                clearBtn.classList.remove('active');
                filterGames('');
                searchInput.focus();
            });

            // Clear search on Escape key
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    searchInput.value = '';
                    clearBtn.classList.remove('active');
                    filterGames('');
                }
            });
        }

        // Filter games based on search term
        function filterGames(searchTerm) {
            if (!searchTerm) {
                renderGames(allGames);
                updateSearchInfo(allGames.length, allGames.length);
                return;
            }

            const lowerSearch = searchTerm.toLowerCase();
            const filteredGames = allGames.filter(game => {
                // Search in title
                if (game.title && game.title.toLowerCase().includes(lowerSearch)) {
                    return true;
                }
                // Search in developer
                if (game.developer_name && game.developer_name.toLowerCase().includes(lowerSearch)) {
                    return true;
                }
                // Search in description
                if (game.short_description && game.short_description.toLowerCase().includes(lowerSearch)) {
                    return true;
                }
                // Search in genres (comma-separated)
                if (game.genres && game.genres.toLowerCase().includes(lowerSearch)) {
                    return true;
                }
                // Search in tags (comma-separated)
                if (game.tags && game.tags.toLowerCase().includes(lowerSearch)) {
                    return true;
                }
                return false;
            });

            renderGames(filteredGames);
            updateSearchInfo(filteredGames.length, allGames.length);
        }

        // Update search results info
        function updateSearchInfo(shown, total) {
            const infoDiv = document.getElementById('searchResultsInfo');
            if (shown === total) {
                infoDiv.innerHTML = `Showing <strong>${total}</strong> game${total !== 1 ? 's' : ''}`;
            } else {
                infoDiv.innerHTML = `Showing <strong>${shown}</strong> of <strong>${total}</strong> game${total !== 1 ? 's' : ''}`;
            }
        }

        // Load games on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadGames();
            setupSearch();
        });
    </script>
</body>

</html>
