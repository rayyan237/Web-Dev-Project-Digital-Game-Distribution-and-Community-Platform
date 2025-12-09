<?php
// Check if game_id is provided
if (!isset($_GET['game_id']) || !is_numeric($_GET['game_id'])) {
    header('Location: index.php');
    exit;
}

$game_id = intval($_GET['game_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Details | Professional Distro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* --- 1. CORE VARIABLES --- */
        :root {
            --gp-bg-dark: #171a21;
            --gp-bg-main: #1b2838;
            --gp-text-main: #c6d4df;
            --gp-text-blue: #66c0f4;
            --gp-btn-green-top: #799905;
            --gp-btn-green-bot: #536904;
        }

        body {
            background-color: var(--gp-bg-main);
            color: var(--gp-text-main);
            margin: 0;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: var(--gp-text-main);
            transition: 0.2s;
        }

        a:hover {
            color: #fff;
        }

        .page-wrapper {
            max-width: 960px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* --- HEADER & HERO --- */
        .game-header-title {
            font-size: 26px;
            color: #fff;
            margin-bottom: 5px;
        }

        .hero-bg {
            background: rgba(0, 0, 0, 0.2);
        }

        /* Gallery - Strict Layout Control */
        .gallery-wrapper {
            width: 100%;
        }

        .main-media-view {
            width: 100%;
            aspect-ratio: 16/9;
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .main-media-view img,
        .main-media-view video {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .thumbs-row {
            display: flex;
            gap: 4px;
            margin-top: 4px;
            height: 69px;
            overflow-x: auto;
            background: #000;
            scrollbar-width: thin;
            scrollbar-color: #3d4450 #000;
        }

        .thumbs-row::-webkit-scrollbar {
            height: 6px;
        }

        .thumbs-row::-webkit-scrollbar-track {
            background: #000;
        }

        .thumbs-row::-webkit-scrollbar-thumb {
            background: #3d4450;
            border-radius: 3px;
        }

        .thumb-unit {
            width: 120px;
            height: 65px;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.2s;
            flex-shrink: 0;
            border: 1px solid transparent;
        }

        .thumb-unit:hover,
        .thumb-unit.active {
            opacity: 1;
            border: 1px solid #fff;
        }

        .thumb-unit img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Side Info */
        .side-info-panel {
            padding-left: 15px;
        }

        .header-capsule {
            width: 100%;
            height: 151px;
            margin-bottom: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
            object-fit: cover;
        }

        .short-description {
            font-size: 13px;
            line-height: 18px;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 6;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 108px;
        }

        .meta-data-row {
            display: flex;
            font-size: 12px;
            margin-bottom: 2px;
        }

        .meta-title {
            color: #556772;
            text-transform: uppercase;
            font-size: 10px;
            width: 90px;
            padding-top: 3px;
        }

        .meta-content {
            color: #66c0f4;
        }

        .game-tag {
            background: #2a475e;
            color: #67c1f5;
            padding: 2px 7px;
            border-radius: 2px;
            font-size: 11px;
            display: inline-block;
            margin: 0 2px 2px 0;
            cursor: pointer;
        }

        /* --- PURCHASE BAR --- */
        .purchase-widget {
            background: linear-gradient(to right, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.1));
            margin: 30px 0;
            position: relative;
            padding: 2px;
        }

        .purchase-inner {
            background: linear-gradient(-60deg, rgba(42, 65, 81, 1) 0%, rgba(27, 40, 56, 1) 100%);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 2px;
        }

        .buy-game-title {
            font-size: 22px;
            color: #fff;
            margin: 0;
        }

        .btn-add-cart {
            background: linear-gradient(to bottom, var(--gp-btn-green-top) 5%, var(--gp-btn-green-bot) 95%);
            border: none;
            border-radius: 2px;
            color: #d2efa9;
            font-weight: bold;
            font-size: 15px;
            padding: 8px 30px;
            text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .btn-add-cart:hover {
            background: linear-gradient(to bottom, #a3cf06 5%, #6e8c05 95%);
            color: #fff;
        }

        /* --- CONTENT & RAIL --- */
        .section-header {
            text-transform: uppercase;
            font-size: 14px;
            color: #fff;
            border-bottom: 1px solid #3b4d61;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .description-content {
            color: #acb2b8;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        /* Rail Box Generic */
        .rail-box {
            background: rgba(0, 0, 0, 0.2);
            padding: 12px;
            margin-bottom: 15px;
            font-size: 12px;
        }

        .rail-field {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding-bottom: 4px;
        }

        .rail-label {
            color: #8f98a0;
        }

        .rail-val {
            color: #66c0f4;
        }

        /* System Requirements Specifics */
        .sys-req-title {
            color: #fff;
            font-size: 12px;
            margin-bottom: 8px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 4px;
        }

        .sys-req-block {
            font-size: 11px;
            color: #acb2b8;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .sys-req-block strong {
            color: #c6d4df;
            display: block;
            margin-bottom: 2px;
        }

        .sys-req-item {
            margin-bottom: 4px;
        }

        .sys-label {
            color: #6b7782;
        }

        /* --- REVIEWS --- */
        .write-review-box {
            background: rgba(0, 0, 0, 0.4);
            padding: 15px;
            margin-bottom: 25px;
            border: 1px solid #2a475e;
        }

        .form-control-steam {
            background: #222b35;
            border: 1px solid #000;
            color: #d6d7d8;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .form-control-steam:focus {
            background: #2a3f5a;
            color: #fff;
            border-color: #66c0f4;
            box-shadow: none;
        }

        textarea.form-control-steam {
            resize: none;
            overflow: hidden;
            min-height: 50px;
        }

        .btn-post-review {
            background: #2a475e;
            color: #66c0f4;
            border: none;
            padding: 6px 15px;
            font-size: 13px;
            cursor: pointer;
        }

        .btn-post-review:hover {
            background: #67c1f5;
            color: #fff;
        }

        .btn-post-review:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Review List */
        .review-card {
            background: rgba(0, 0, 0, 0.2);
            margin-bottom: 16px;
            display: flex;
        }

        .review-user {
            width: 164px;
            background: rgba(0, 0, 0, 0.3);
            padding: 10px;
            flex-shrink: 0;
        }

        .avatar-holder {
            width: 34px;
            height: 34px;
            border: 1px solid #555;
            float: left;
            margin-right: 8px;
        }

        .avatar-holder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-name {
            font-size: 13px;
            color: #c1dbf4;
            font-weight: bold;
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .review-body {
            flex-grow: 1;
            padding: 10px;
            background: #16202d;
        }

        .review-rating-bar {
            background: rgba(0, 0, 0, 0.2);
            padding: 5px;
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .thumb-icon {
            font-size: 20px;
            margin-right: 10px;
        }

        .posted-date {
            font-size: 10px;
            color: #8091a2;
            text-transform: uppercase;
            margin-bottom: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 5px;
        }

        .review-text {
            font-family: "Georgia", serif;
            font-size: 13px;
            color: #acb2b8;
            line-height: 1.5;
        }

        /* Star Rating System */
        .star-rating-container {
            margin-bottom: 15px;
        }
        
        .star-rating-label {
            color: #66c0f4;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
        }
        
        .star-rating {
            display: inline-flex;
            gap: 5px;
            cursor: pointer;
        }
        
        .star {
            font-size: 28px;
            color: #66c0f4;
            transition: color 0.2s ease;
            cursor: pointer;
            user-select: none;
        }
        
        .star.active {
            color: #FFD700;
        }
        
        .star:hover {
            transform: scale(1.1);
        }
        
        .review-stars {
            display: inline-flex;
            gap: 3px;
        }
        
        .review-stars .star {
            font-size: 16px;
            cursor: default;
        }
        
        .review-stars .star:hover {
            transform: none;
        }

        .loading-spinner {
            text-align: center;
            padding: 100px 20px;
            color: #66c0f4;
        }

        .error-message {
            text-align: center;
            padding: 100px 20px;
            color: #ff6b6b;
        }

        /* ... existing css ... */

        /* Fix for Date/Month picker in Dark Mode */
        .form-control-steam::-webkit-calendar-picker-indicator {
            filter: invert(1);
            /* Turns the black calendar icon white */
            cursor: pointer;
        }

        /* content inside the date picker */
        .form-control-steam {
            color-scheme: dark;
        }

        /* ... existing css ... */

        /* Custom Steam-themed Select Dropdown */
        .form-select-steam {
            background-color: #222b35;
            border: 1px solid #000;
            color: #d6d7d8;
            font-size: 13px;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2366c0f4' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
        }

        .form-select-steam:focus {
            background-color: #2a3f5a;
            color: #fff;
            border-color: #66c0f4;
            box-shadow: none;
            outline: none;
        }
    </style>
</head>

<body>

    <?php include 'section-navbar.php'; ?>

    <div class="page-wrapper" id="mainContent">
        <div class="loading-spinner">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3">Loading game details...</p>
        </div>
    </div>

    <div class="section-spacer"></div>

    <?php include 'section-footer.php'; ?>

    <div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #1b2838; color: #c6d4df; border: 1px solid #2a475e;">
                <div class="modal-header" style="border-bottom: 1px solid #2a475e;">
                    <h5 class="modal-title">Checkout: <span id="modalGameTitle" style="color: #fff;"></span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info" style="background: rgba(0,0,0,0.2); border: 1px solid #2a475e; color: #66c0f4; font-size: 12px;">
                        <i class="fas fa-lock"></i> Secure Payment Environment
                    </div>

                    <form id="paymentForm">
                        <div class="mb-3">
                            <label class="form-label" style="font-size: 12px; text-transform: uppercase; color: #556772;">Cardholder Name</label>
                            <input type="text" class="form-control form-control-steam" placeholder="JOHN DOE" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-size: 12px; text-transform: uppercase; color: #556772;">Card Number</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: #222b35; border: 1px solid #000; color: #66c0f4;"><i class="fas fa-credit-card"></i></span>
                                <input type="text" id="cardNumber" class="form-control form-control-steam" placeholder="0000 0000 0000 0000" maxlength="19" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" style="font-size: 12px; text-transform: uppercase; color: #556772;">Expiry Date</label>

                                    <div class="d-flex gap-2">
                                        <select id="expiryMonth" class="form-select form-select-steam" required>
                                            <option value="" selected disabled>MM</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>

                                        <select id="expiryYear" class="form-select form-select-steam" required>
                                            <option value="" selected disabled>YY</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" style="font-size: 12px; text-transform: uppercase; color: #556772;">CVV / CVC</label>
                                    <input type="text" id="cardCvv" class="form-control form-control-steam" placeholder="123" maxlength="3" required>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div style="font-size: 18px; color: #fff;">Total: <span id="modalPrice" style="color: #a4d007;"></span></div>
                            <button type="submit" class="btn-add-cart" id="btnConfirmPay">Pay Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const gameId = <?php echo $game_id; ?>;
        let gameData = null;

        async function loadGameDetails() {
            try {
                const response = await fetch(`../php_backend/get_game_details.php?game_id=${gameId}`);
                const data = await response.json();

                if (data.success) {
                    gameData = data;
                    renderGamePage();
                } else {
                    showError(data.message || 'Game not found');
                }
            } catch (error) {
                console.error('Error loading game details:', error);
                showError('Failed to load game details. Please try again.');
            }
        }

        function renderGamePage() {
            const {
                game,
                genres,
                tags,
                media,
                reviews
            } = gameData;

            document.title = `${game.title} | Professional Distro`;

            // --- PURCHASE LOGIC START ---
            // Deciding which button to show based on "is_owned"
            const isOwned = game.is_owned;
            let purchaseButtonHtml = '';
            const priceDisplay = game.price == 0 ? 'Free to Play' : '$' + parseFloat(game.price).toFixed(2);

            if (isOwned) {
                // User owns the game -> Show Blue Download Button
                purchaseButtonHtml = `
                <button class="btn-add-cart" 
                    style="background: linear-gradient(to bottom, #47bfff 5%, #1a44c2 95%); color: #fff;" 
                    onclick="startDownload('${game.download_url}')">
                    <i class="fas fa-download"></i> Download Now
                </button>`;
            } else {
                // User doesn't own it -> Show Green Buy Button (Triggers Modal)
                // Note: We escape the title with replace to prevent JS errors on quotes
                purchaseButtonHtml = `
                <button class="btn-add-cart" 
                    onclick="openPurchaseModal('${game.title.replace(/'/g, "\\'")}', '${priceDisplay}')">
                    Buy ${priceDisplay}
                </button>`;
            }
            // --- PURCHASE LOGIC END ---

            const content = `
            <h1 class="game-header-title" style="margin-top: 20px;">${game.title}</h1>

            <div class="row g-0 hero-bg">
                <div class="col-lg-8" style="border-right: 1px solid transparent;">
                    <div class="gallery-wrapper">
                        <div class="main-media-view" id="mainMediaStage"></div>
                        <div class="thumbs-row" id="thumbStrip"></div>
                    </div>
                </div>

                <div class="col-lg-4 side-info-panel">
                    <img src="../${game.header_image}" class="header-capsule" alt="${game.title}">
                    
                    <div class="short-description">${stripHtml(game.description).substring(0, 300)}...</div>

                    <div class="meta-data-row">
                        <div class="meta-title">Release Date:</div>
                        <div class="meta-content">${game.release_date}</div>
                    </div>
                    <div class="meta-data-row">
                        <div class="meta-title">Developer:</div>
                        <div class="meta-content">${game.developer_name}</div>
                    </div>
                    
                    <div class="tag-block">
                        <div class="tag-label" style="font-size: 10px; color: #556772; margin-bottom: 5px;">Popular tags:</div>
                        <div id="tagContainer">
                            ${tags.map(tag => `<span class="game-tag">${tag}</span>`).join('')}
                        </div>
                    </div>
                </div>
            </div>

            <div class="purchase-widget">
                <div class="purchase-inner">
                    <h2 class="buy-game-title">${isOwned ? 'Install ' + game.title : 'Buy ' + game.title}</h2>
                    <div class="price-actions">
                        ${purchaseButtonHtml}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-left-main">
                    <h3 class="section-header">About This Game</h3>
                    <div class="description-content">${game.description}</div>

                    <h3 class="section-header" style="margin-top: 50px;">Customer Reviews</h3>

                    <div class="write-review-box">
                        <div style="color: #66c0f4; font-size: 16px; margin-bottom: 10px;">Write a Review</div>
                        
                        <div class="star-rating-container">
                            <span class="star-rating-label">Your Rating:</span>
                            <div class="star-rating" id="starRating">
                                <span class="star" data-rating="1">★</span>
                                <span class="star" data-rating="2">★</span>
                                <span class="star" data-rating="3">★</span>
                                <span class="star" data-rating="4">★</span>
                                <span class="star" data-rating="5">★</span>
                            </div>
                            <input type="hidden" id="reviewRating" value="0">
                        </div>
                        
                        <textarea id="reviewText" class="form-control form-control-steam" rows="1" placeholder="Share your thoughts..." oninput="autoResize(this)"></textarea>
                        
                        <button onclick="postReview()" class="btn-post-review">Post Review</button>
                    </div>

                    <div id="reviewsWrapper"></div>
                </div>

                <div class="col-lg-4 col-right-rail">
                    <div class="rail-box">
                        <div class="rail-field">
                            <span class="rail-label">Single-player</span>
                            <span class="rail-val"><i class="fas fa-check"></i></span>
                        </div>
                        <div class="rail-field">
                            <span class="rail-label">Avg Rating</span>
                            <span class="rail-val">${game.average_rating || 'N/A'}/5</span>
                        </div>
                        <div class="rail-field">
                            <span class="rail-label">Genres</span>
                            <span class="rail-val">${genres.join(', ')}</span>
                        </div>
                    </div>

                    <div class="rail-box">
                        <div class="sys-req-title">System Requirements</div>
                        
                        <div class="sys-req-block">
                            <strong>Minimum:</strong>
                            <div class="sys-req-item"><span class="sys-label">OS:</span> ${game.min_os || 'Windows 10 or later 64-bit'}</div>
                            <div class="sys-req-item"><span class="sys-label">Processor:</span> ${game.min_processor || 'Intel Core i5-6600K / AMD Ryzen R5 1600'}</div>
                            <div class="sys-req-item"><span class="sys-label">Memory:</span> ${game.min_memory || '12 GB RAM'}</div>
                            <div class="sys-req-item"><span class="sys-label">Graphics:</span> ${game.min_graphics || 'GTX 1050 Ti / RX 580 / Arc A380'}</div>
                            <div class="sys-req-item"><span class="sys-label">DirectX:</span> ${game.min_directx || 'Version 12'}</div>
                            <div class="sys-req-item"><span class="sys-label">Storage:</span> ${game.min_storage || '50 GB available space'}</div>
                        </div>

                        <div class="sys-req-block">
                            <strong>Recommended:</strong>
                            <div class="sys-req-item"><span class="sys-label">OS:</span> ${game.rec_os || 'Windows 10 or later 64-bit'}</div>
                            <div class="sys-req-item"><span class="sys-label">Processor:</span> ${game.rec_processor || 'Intel Core i5-9600K / AMD Ryzen 5 3600'}</div>
                            <div class="sys-req-item"><span class="sys-label">Memory:</span> ${game.rec_memory || '16 GB RAM'}</div>
                            <div class="sys-req-item"><span class="sys-label">Graphics:</span> ${game.rec_graphics || 'RTX 2070 / RX 5700 XT / Arc B570'}</div>
                            <div class="sys-req-item"><span class="sys-label">DirectX:</span> ${game.rec_directx || 'Version 12'}</div>
                            <div class="sys-req-item"><span class="sys-label">Storage:</span> ${game.rec_storage || '50 GB available space'}</div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        document.getElementById('mainContent').innerHTML = content;
        
        renderGallery(media);
        renderReviews(reviews);
        
        // Initialize star rating after content is rendered
        initStarRating();
    }

        function renderGallery(media) {
            const stage = document.getElementById('mainMediaStage');
            const strip = document.getElementById('thumbStrip');

            media.forEach((item, idx) => {
                const div = document.createElement('div');
                div.className = `thumb-unit ${idx===0?'active':''}`;

                if (item.type === 'video') {
                    div.innerHTML = `<div style="position:relative; width:100%; height:100%; overflow:hidden;">
                    <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&q=80&w=200" style="opacity:0.6; width:100%; height:100%; object-fit:cover;">
                    <i class="fas fa-play-circle" style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); color:#fff; font-size:24px;"></i>
                </div>`;
                } else {
                    div.innerHTML = `<img src="../${item.url}">`;
                }

                div.onclick = () => {
                    document.querySelectorAll('.thumb-unit').forEach(el => el.classList.remove('active'));
                    div.classList.add('active');
                    setStage(item);
                };
                strip.appendChild(div);
            });

            if (media.length > 0) setStage(media[0]);
        }

        function setStage(item) {
            const stage = document.getElementById('mainMediaStage');
            stage.innerHTML = '';

            if (item.type === 'video') {
                const vid = document.createElement('video');
                vid.src = `../${item.url}`;
                vid.controls = true;
                vid.autoplay = true;
                vid.muted = true;
                vid.style.width = "100%";
                vid.style.height = "100%";
                stage.appendChild(vid);
            } else {
                const img = document.createElement('img');
                img.src = `../${item.url}`;
                stage.appendChild(img);
            }
        }

    function renderReviews(reviews) {
        const container = document.getElementById('reviewsWrapper');
        container.innerHTML = ""; 
        
        if (reviews.length === 0) {
            container.innerHTML = '<p style="color: #8f98a0; text-align: center; padding: 20px;">No reviews yet. Be the first to review this game!</p>';
            return;
        }
        
        reviews.forEach(review => {
            const rating = parseInt(review.rating) || 0;
            const avatarPath = review.avatar_url.startsWith('assets/') ? `../${review.avatar_url}` : review.avatar_url;
            
            // Generate 5 stars, fill based on rating
            let starsHTML = '';
            for (let i = 1; i <= 5; i++) {
                const starColor = i <= rating ? '#FFD700' : '#2a475e';
                starsHTML += `<span style="color: ${starColor}; font-size: 20px; margin-right: 2px;">★</span>`;
            }
            
            const html = `
            <div class="review-card">
                <div class="review-user">
                    <div class="avatar-holder">
                        <img src="${avatarPath}">
                    </div>
                    <span class="user-name">${review.username}</span>
                    <span class="user-products" style="font-size: 11px; color: #8f98a0;">Owner</span>
                </div>
                <div class="review-body">
                    <div class="review-rating-bar">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            ${starsHTML}
                            <span style="color: #8f98a0; font-size: 14px;">(${rating}/5)</span>
                        </div>
                    </div>
                    <div class="posted-date">Posted: ${review.created_at}</div>
                    <div class="review-text">${review.comment}</div>
                </div>
            </div>`;

                container.innerHTML += html;
            });
        }

        // --- INPUT FORMATTING & VALIDATION ---
        document.addEventListener('DOMContentLoaded', () => {

            // 1. Card Number Formatting
            const ccInput = document.getElementById('cardNumber');
            ccInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                value = value.substring(0, 16);
                const formatted = value.match(/.{1,4}/g)?.join(' ') || value;
                e.target.value = formatted;
            });

            // 2. CVV Formatting
            const cvvInput = document.getElementById('cardCvv');
            cvvInput.addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/\D/g, '');
            });

            // 3. Expiry Dropdown Logic (User Friendly)
            const yearSelect = document.getElementById('expiryYear');
            const monthSelect = document.getElementById('expiryMonth');
            const currentYear = new Date().getFullYear();
            const currentMonth = new Date().getMonth() + 1; // 1-12

            // Populate the next 15 years
            for (let i = 0; i < 15; i++) {
                const year = currentYear + i;
                const option = document.createElement('option');
                // Show full year (2025) but value is usually last 2 digits for payment processors
                option.value = year.toString().slice(-2);
                option.text = year;
                yearSelect.appendChild(option);
            }

            // Real-time Expiry Check
            function checkExpiry() {
                const selectedYear = parseInt("20" + yearSelect.value); // Convert "25" to 2025
                const selectedMonth = parseInt(monthSelect.value);

                // Only check if both are selected
                if (yearSelect.value && monthSelect.value) {
                    // If selected year is this year, but month is past
                    if (selectedYear === currentYear && selectedMonth < currentMonth) {
                        alert("Card has expired! Please check the date.");
                        monthSelect.value = ""; // Reset month
                    }
                }
            }

            yearSelect.addEventListener('change', checkExpiry);
            monthSelect.addEventListener('change', checkExpiry);
        });

        // --- NEW PAYMENT FUNCTIONS ---

        // 1. Open Modal
        function openPurchaseModal(title, price) {
            document.getElementById('modalGameTitle').innerText = title;
            document.getElementById('modalPrice').innerText = price;
            const payModal = new bootstrap.Modal(document.getElementById('paymentModal'));
            payModal.show();
        }

        // 2. Handle Payment Submit
        document.getElementById('paymentForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const btn = document.getElementById('btnConfirmPay');
            const originalText = btn.innerText;

            // UI Feedback
            btn.disabled = true;
            btn.innerText = "Processing...";

            // Simulate Bank Delay (2 seconds)
            await new Promise(r => setTimeout(r, 2000));

            // Send to Backend
            try {
                const response = await fetch('../php_backend/buy_game.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `game_id=${gameId}`
                });

                const result = await response.json();

                if (result.success) {
                    // Close Modal
                    const modalEl = document.getElementById('paymentModal');
                    const modalInstance = bootstrap.Modal.getInstance(modalEl);
                    modalInstance.hide();

                    alert("Payment Successful! The game can be downloaded now.");

                    // Reload page to show "Download" button
                    loadGameDetails();
                } else {
                    alert(result.message || "Payment Failed");
                }
            } catch (err) {
                console.error(err);
                alert("Transaction Error");
            } finally {
                btn.disabled = false;
                btn.innerText = originalText;
            }
        });

        // 3. Handle Download Click
        function startDownload(url) {
            if (!url || url === 'null' || url === '') {
                alert("Download link not available yet.");
                return;
            }
            window.open(url, '_blank');
        }

        // --- END PAYMENT FUNCTIONS ---

        async function postReview() {
            const ratingInput = document.getElementById('reviewRating');
            const textInput = document.getElementById('reviewText');

            if (textInput.value.trim() === "") {
                alert("Please write a comment.");
                return;
            }
        
        if(parseInt(ratingInput.value) === 0) {
            alert("Please select a star rating (1-5 stars).");
            return;
        }

            const reviewData = {
                game_id: gameId,
                rating: parseInt(ratingInput.value),
                comment: textInput.value.trim()
            };

            const button = document.querySelector('.btn-post-review');
            button.disabled = true;
            button.textContent = 'Posting...';

            try {
                const response = await fetch('../php_backend/post_review.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(reviewData)
                });

                const data = await response.json();

            if (data.success) {
                alert(data.message);
                textInput.value = "";
                textInput.style.height = "auto";
                ratingInput.value = "0";
                
                // Reset star visual state
                const stars = document.querySelectorAll('.star');
                stars.forEach(s => s.classList.remove('active'));
                
                loadGameDetails();
            } else {
                alert(data.message || 'Failed to post review');
            }
        } catch (error) {
            console.error('Error posting review:', error);
            alert('Error posting review. Please try again.');
        } finally {
            button.disabled = false;
            button.textContent = 'Post Review';
        }
    }

    // Star rating interaction
    function initStarRating() {
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('reviewRating');
        
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = parseInt(this.getAttribute('data-rating'));
                ratingInput.value = rating;
                
                // Update visual state
                stars.forEach(s => {
                    const starRating = parseInt(s.getAttribute('data-rating'));
                    if (starRating <= rating) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });
            
            // Hover preview
            star.addEventListener('mouseenter', function() {
                const rating = parseInt(this.getAttribute('data-rating'));
                stars.forEach(s => {
                    const starRating = parseInt(s.getAttribute('data-rating'));
                    if (starRating <= rating) {
                        s.style.color = '#FFD700';
                    }
                });
            });
        });
        
        // Reset hover effect
        document.getElementById('starRating').addEventListener('mouseleave', function() {
            const currentRating = parseInt(ratingInput.value);
            stars.forEach(s => {
                const starRating = parseInt(s.getAttribute('data-rating'));
                if (starRating <= currentRating) {
                    s.style.color = '#FFD700';
                } else {
                    s.style.color = '#66c0f4';
                }
            });
        });
    }

        function autoResize(el) {
            el.style.height = 'auto';
            el.style.height = el.scrollHeight + 'px';
        }

        function stripHtml(html) {
            let tmp = document.createElement("DIV");
            tmp.innerHTML = html;
            return tmp.textContent || tmp.innerText || "";
        }

        function showError(message) {
            document.getElementById('mainContent').innerHTML = `
            <div class="error-message">
                <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                <h3>${message}</h3>
                <a href="index.php" class="btn btn-primary mt-3">Return to Home</a>
            </div>
        `;
        }

    document.addEventListener('DOMContentLoaded', () => {
        loadGameDetails();
    });
</script>

</body>

</html>