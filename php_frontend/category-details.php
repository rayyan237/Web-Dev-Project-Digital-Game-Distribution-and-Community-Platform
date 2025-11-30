<?php
// Check if genre_id is provided
if (!isset($_GET['genre_id']) || !is_numeric($_GET['genre_id'])) {
    header('Location: index.php');
    exit;
}

$genre_id = intval($_GET['genre_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Details | Professional Distro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="../css/style.css" rel="stylesheet">
    <style>
        /* =========================================
           1. GLOBAL & LAYOUT
           ========================================= */
        body {
            background-color: #1b2838;
            font-family: "Arial", sans-serif;
            color: #c7d5e0;
            overflow-x: hidden;
            padding-bottom: 50px;
        }

        .steam-wrapper {
            width: 95%;
            max-width: 1170px;
            margin: 30px auto;
            position: relative;
        }

        h2.section-title {
            color: #fff;
            font-weight: 300;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
            border-bottom: 1px solid #3a414b;
            padding-bottom: 10px;
            margin-top: 60px;
        }

        /* =========================================
       2. HERO CAROUSEL
       ========================================= */
        .steam-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            z-index: 20;
            opacity: 0.3;
            transition: opacity 0.2s, transform 0.1s;
            width: 50px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            outline: none;
        }

        .steam-nav-btn:hover {
            opacity: 1;
        }

        .steam-nav-btn:active svg {
            filter: drop-shadow(0 0 5px #fff) drop-shadow(0 0 10px #66C0F4);
            transform: scale(0.95);
        }

        .prev-btn {
            left: -60px;
        }

        .next-btn {
            right: -60px;
        }

        .steam-nav-btn svg {
            width: 50px;
            height: 100px;
            fill: #fff;
            transition: filter 0.1s;
        }

        .hero-card {
            background-color: #0f1922;
            height: 450px;
            border-radius: 0;
            overflow: visible;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            display: flex;
            text-decoration: none;
            color: inherit;
            transition: filter 0.2s;
        }

        .hero-card:hover {
            filter: brightness(1.05);
        }

        .col-video {
            background: #000;
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        video, .col-video img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .col-info {
            background: #0f1922;
            position: relative;
            height: 100%;
        }

        .col-info::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(21, 32, 43, 0.9) 0%, rgba(11, 18, 25, 1) 100%);
            z-index: 0;
        }

        .capsule-overlap {
            position: relative;
            z-index: 10;
            margin-top: 25px;
            margin-bottom: 10px;
            margin-left: -40px;
            width: 112%;
            transition: transform 0.3s ease;
        }

        .capsule-overlap:hover {
            transform: scale(1.02);
        }

        .capsule-overlap img {
            box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.7);
            border: 1px solid #4a5a6a;
        }

        .info-content {
            position: relative;
            z-index: 1;
            height: 100%;
            padding: 0 20px 20px 20px;
        }

        .description-truncate {
            display: -webkit-box !important;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 12px;
            line-height: 1.4;
            max-height: 7em;
            color: #acb2b8;
            margin-bottom: auto;
        }

        .steam-badge {
            background: rgba(255, 255, 255, 0.1);
            color: #66C0F4;
            border: 1px solid rgba(102, 192, 244, 0.2);
            font-weight: normal;
            padding: 2px 6px;
            font-size: 11px;
            border-radius: 2px;
            margin-right: 4px;
        }

        .hero-price-btn {
            background-color: #4c6b22;
            font-size: 13px;
            padding: 4px 12px;
            color: white;
            border-radius: 2px;
        }

        .indicators-container {
            margin-top: 10px;
            display: flex;
            justify-content: center;
        }

        .carousel-indicators.custom-indicators-style {
            position: static;
            margin: 0;
            justify-content: center;
            gap: 6px;
        }

        .carousel-indicators.custom-indicators-style [data-bs-target] {
            width: 18px;
            height: 10px;
            border: none;
            border-radius: 2px;
            background-color: rgba(255, 255, 255, 0.2);
            opacity: 1;
            transition: all 0.2s;
            margin: 0;
            text-indent: -999px;
        }

        .carousel-indicators.custom-indicators-style .active {
            background-color: #66C0F4;
            box-shadow: 0 0 5px #66C0F4;
        }

        /* =========================================
       3. POPULAR TITLES
       ========================================= */
        .grid-card {
            display: block;
            position: relative;
            text-decoration: none;
            overflow: hidden;
            border: 1px solid transparent;
            transition: border 0.2s, transform 0.2s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .grid-card:hover {
            border-color: #66C0F4;
            transform: scale(1.02);
            z-index: 10;
        }

        .grid-lg {
            height: 250px;
        }

        .grid-sm {
            height: 180px;
            margin-top: 15px;
        }

        .grid-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .grid-black-strip {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(2px);
            padding: 5px 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .grid-title {
            color: #fff;
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 55%;
        }

        .price-badge-container {
            display: flex;
            align-items: center;
            background: #000;
            padding: 2px;
            height: 24px;
        }

        .badge-price {
            color: #fff;
            font-size: 13px;
            padding: 0 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* =========================================
       4. LIST VIEW & LOAD MORE
       ========================================= */
        .game-list-item {
            background: rgba(0, 0, 0, 0.2);
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            padding: 10px;
            transition: background 0.2s;
            text-decoration: none;
            color: #c7d5e0;
        }

        .game-list-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
        }

        .list-img {
            width: 120px;
            height: 55px;
            object-fit: cover;
            margin-right: 20px;
        }

        .list-info {
            flex-grow: 1;
        }

        .list-title {
            font-size: 1.1rem;
            font-weight: bold;
            display: block;
        }

        .list-tags {
            font-size: 0.8rem;
            color: #67c1f5;
            opacity: 0.7;
        }

        .list-meta {
            text-align: right;
            min-width: 100px;
        }

        .load-more-btn {
            display: block;
            width: 100%;
            max-width: 300px;
            margin: 30px auto 0 auto;
            padding: 12px;
            background-color: rgba(103, 193, 245, 0.1);
            color: #67c1f5;
            border: 1px solid rgba(103, 193, 245, 0.3);
            border-radius: 2px;
            text-transform: uppercase;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .load-more-btn:hover {
            background-color: #67c1f5;
            color: #fff;
        }

        .load-more-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* =========================================
       5. RESPONSIVE
       ========================================= */
        @media (max-width: 992px) {
            .steam-nav-btn {
                display: none;
            }

            .hero-card,
            .carousel-item {
                height: auto;
            }

            .hero-card {
                flex-direction: column;
            }

            .col-video {
                height: 250px;
            }

            .capsule-overlap {
                display: none !important;
            }

            .info-content {
                padding: 20px;
            }

            .description-truncate {
                -webkit-line-clamp: 6;
                max-height: 8.4em;
            }

            .grid-lg,
            .grid-sm {
                height: auto;
                aspect-ratio: 16/9;
            }
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
    </style>
</head>

<body>

    <?php include 'navbar_include.php'; ?>

    <div id="mainContent">
        <div class="loading-spinner">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3">Loading category details...</p>
        </div>
    </div>

    <!-- Footer -->
    <footer data-bs-theme="dark">
        <div class="main-footer-section">
            <div class="container">
                <div class="row align-items-center gy-4">
                    <div class="col-lg-6">
                        <div>
                            <h2 class="footer-brand-heading">[Steam Clone]</h2>
                            <p class="footer-tagline mb-0">Where Worlds Collide.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="newsletter-email" class="newsletter-label mb-2">Join our Newsletter</label>
                            <div class="newsletter-input-group input-group">
                                <input type="email" id="newsletter-email" class="newsletter-input form-control"
                                    placeholder="your.email@universe.com" required>
                                <button class="newsletter-submit-btn btn" type="submit">→</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center border-top border-secondary-subtle mt-5 pt-5">
                    <nav class="nav flex-wrap justify-content-center">
                        <a class="footer-nav-link nav-link px-2 px-md-3" href="index.php">Store</a>
                        <a class="footer-nav-link nav-link px-2 px-md-3" href="about.php">About</a>
                        <a class="footer-nav-link nav-link px-2 px-md-3" href="community.php">Community</a>
                        <a class="footer-nav-link nav-link px-2 px-md-3" href="support.php">Support</a>
                    </nav>
                    <div class="d-flex gap-4 mt-4 mt-md-0">
                        <a href="#" aria-label="Discord" class="footer-social-icon icon-discord fab fa-discord"></a>
                        <a href="#" aria-label="Reddit" class="footer-social-icon icon-reddit fab fa-reddit-alien"></a>
                        <a href="#" aria-label="YouTube" class="footer-social-icon icon-youtube fab fa-youtube"></a>
                        <a href="#" aria-label="Twitter" class="footer-social-icon icon-twitter fab fa-twitter"></a>
                        <a href="#" aria-label="TikTok" class="footer-social-icon icon-tiktok fab fa-tiktok"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-bar">
            <div class="footer-glow-border"></div>
            <div class="container">
                <div class="row align-items-center py-3 gy-2">
                    <div class="col-md-6 text-center text-md-start">
                        <small class="footer-copyright">© 2025 [Game Platform Name]. All Rights Reserved.</small>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3 gap-md-4 justify-content-center justify-content-md-end">
                            <a class="footer-legal-link" href="#"><small>Terms of Service</small></a>
                            <a class="footer-legal-link" href="#"><small>Privacy Policy</small></a>
                            <a class="footer-legal-link" href="#"><small>Refund Policy</small></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const genreId = <?php echo $genre_id; ?>;
        let allGames = [];
        let displayedGames = 0;
        const gamesPerLoad = 10;

        async function loadCategoryData() {
            try {
                const response = await fetch(`../php_backend/get_category_details.php?genre_id=${genreId}`);
                const data = await response.json();

                if (data.success) {
                    allGames = data.all_games;
                    renderHeroCarousel(data.genre_name, data.hero_games);
                    renderPopularTitles(data.popular_games);
                    renderBrowseAll(data.genre_name);
                    loadMoreGames();
                } else {
                    document.getElementById('mainContent').innerHTML = `
                        <div class="error-message">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                            <h3>Category Not Found</h3>
                            <p>${data.message}</p>
                            <a href="index.php" class="btn btn-primary mt-3">Back to Home</a>
                        </div>
                    `;
                }
            } catch (error) {
                console.error('Error loading category:', error);
                document.getElementById('mainContent').innerHTML = `
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                        <h3>Error Loading Category</h3>
                        <p>Please try again later.</p>
                        <a href="index.php" class="btn btn-primary mt-3">Back to Home</a>
                    </div>
                `;
            }
        }

        function renderHeroCarousel(genreName, games) {
            if (games.length === 0) {
                document.getElementById('mainContent').innerHTML = `
                    <div class="steam-wrapper">
                        <h2 class="section-title">${genreName} Games</h2>
                        <p>No games found in this category.</p>
                    </div>
                `;
                return;
            }

            const carouselItems = games.map((game, index) => `
                <div class="carousel-item ${index === 0 ? 'active' : ''}">
                    <a href="game-details.php?game_id=${game.game_id}" class="hero-card">
                        <div class="col-video col-md-8">
                            ${game.video_url ? 
                                `<video autoplay loop muted playsinline><source src="../${game.video_url}" type="video/mp4"></video>` :
                                `<img src="../${game.header_image}" alt="${game.title}">`
                            }
                        </div>
                        <div class="col-info col-md-4">
                            <div class="info-content d-flex flex-column justify-content-between">
                                <div class="capsule-overlap">
                                    <img src="../${game.thumbnail_image}" class="img-fluid" alt="${game.title}">
                                </div>
                                <div class="d-flex flex-column flex-grow-1">
                                    <div class="mb-2">
                                        ${game.genres.map(g => `<span class="steam-badge">${g}</span>`).join('')}
                                    </div>
                                    <p class="description-truncate">${game.description || 'No description available.'}</p>
                                </div>
                                <div class="text-end">
                                    <span class="hero-price-btn">$${parseFloat(game.price).toFixed(2)}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            `).join('');

            const indicators = games.map((_, index) => 
                `<button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="${index}" 
                 class="${index === 0 ? 'active' : ''}" aria-label="Slide ${index + 1}"></button>`
            ).join('');

            const content = `
                <div class="steam-wrapper">
                    <h2 class="section-title">${genreName} Games</h2>
                    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" id="hero-carousel-inner">
                            ${carouselItems}
                        </div>
                        <button class="steam-nav-btn prev-btn" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                            <svg viewBox="0 0 50 100" style="transform: rotate(180deg);">
                                <polygon points="0,0.093 0,25.702 24.323,50.026 0,74.349 0,99.955 49.929,50.026 "></polygon>
                            </svg>
                        </button>
                        <button class="steam-nav-btn next-btn" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                            <svg viewBox="0 0 50 100">
                                <polygon points="0,0.093 0,25.702 24.323,50.026 0,74.349 0,99.955 49.929,50.026 "></polygon>
                            </svg>
                        </button>
                        <div class="indicators-container">
                            <div class="carousel-indicators custom-indicators-style">
                                ${indicators}
                            </div>
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('mainContent').innerHTML = content;
        }

        function renderPopularTitles(games) {
            if (games.length === 0) return;

            const chunkedGames = [];
            for (let i = 0; i < games.length; i += 5) {
                chunkedGames.push(games.slice(i, i + 5));
            }

            const carouselItems = chunkedGames.map((chunk, slideIndex) => {
                const firstGame = chunk[0];
                const remainingGames = chunk.slice(1);

                return `
                    <div class="carousel-item ${slideIndex === 0 ? 'active' : ''}">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <a href="game-details.php?game_id=${firstGame.game_id}" class="grid-card grid-lg d-block">
                                    <img src="../${firstGame.header_image}" class="grid-img" alt="${firstGame.title}">
                                    <div class="grid-black-strip">
                                        <span class="grid-title">${firstGame.title}</span>
                                        <div class="price-badge-container">
                                            <span class="badge-price">$${parseFloat(firstGame.price).toFixed(2)}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                                ${remainingGames.map(game => `
                                    <a href="game-details.php?game_id=${game.game_id}" class="grid-card grid-sm d-block">
                                        <img src="../${game.header_image}" class="grid-img" alt="${game.title}">
                                        <div class="grid-black-strip">
                                            <span class="grid-title">${game.title}</span>
                                            <div class="price-badge-container">
                                                <span class="badge-price">$${parseFloat(game.price).toFixed(2)}</span>
                                            </div>
                                        </div>
                                    </a>
                                `).join('')}
                            </div>
                        </div>
                    </div>
                `;
            }).join('');

            const popularSection = `
                <div class="steam-wrapper">
                    <h2 class="section-title">Popular Titles</h2>
                    <div id="popularCarousel" class="carousel slide" data-bs-ride="false">
                        <div class="carousel-inner">
                            ${carouselItems}
                        </div>
                        <button class="steam-nav-btn prev-btn" type="button" data-bs-target="#popularCarousel" data-bs-slide="prev" style="top:50%">
                            <svg viewBox="0 0 50 100" style="transform: rotate(180deg);">
                                <polygon points="0,0.093 0,25.702 24.323,50.026 0,74.349 0,99.955 49.929,50.026 "></polygon>
                            </svg>
                        </button>
                        <button class="steam-nav-btn next-btn" type="button" data-bs-target="#popularCarousel" data-bs-slide="next" style="top:50%">
                            <svg viewBox="0 0 50 100">
                                <polygon points="0,0.093 0,25.702 24.323,50.026 0,74.349 0,99.955 49.929,50.026 "></polygon>
                            </svg>
                        </button>
                    </div>
                </div>
            `;

            document.getElementById('mainContent').innerHTML += popularSection;
        }

        function renderBrowseAll(genreName) {
            const browseSection = `
                <div class="steam-wrapper">
                    <div class="d-flex justify-content-between align-items-end mb-3">
                        <h2 class="section-title mb-0" style="margin-top:0;">Browse All</h2>
                    </div>
                    <div id="game-list-container"></div>
                    <button id="loadMoreBtn" class="load-more-btn">Load More</button>
                </div>
            `;

            document.getElementById('mainContent').innerHTML += browseSection;

            document.getElementById('loadMoreBtn').addEventListener('click', loadMoreGames);
        }

        function loadMoreGames() {
            const container = document.getElementById('game-list-container');
            const btn = document.getElementById('loadMoreBtn');
            
            const gamesToShow = allGames.slice(displayedGames, displayedGames + gamesPerLoad);
            
            gamesToShow.forEach(game => {
                const gameItem = document.createElement('a');
                gameItem.href = `game-details.php?game_id=${game.game_id}`;
                gameItem.className = 'game-list-item';
                gameItem.innerHTML = `
                    <img src="../${game.thumbnail_image}" class="list-img" alt="${game.title}">
                    <div class="list-info">
                        <span class="list-title">${game.title}</span>
                        <div class="list-tags">${game.tags || 'No tags'}</div>
                    </div>
                    <div class="list-meta">
                        <div style="font-size:0.8rem; color:#8f98a0;">${game.release_date}</div>
                        <div style="font-size:1rem; font-weight:bold; color:#fff;">$${parseFloat(game.price).toFixed(2)}</div>
                    </div>
                `;
                container.appendChild(gameItem);
            });

            displayedGames += gamesToShow.length;

            if (displayedGames >= allGames.length) {
                btn.disabled = true;
                btn.textContent = 'No More Games';
            }
        }

        // Initialize on page load
        window.addEventListener('DOMContentLoaded', loadCategoryData);
    </script>

</body>
</html>
