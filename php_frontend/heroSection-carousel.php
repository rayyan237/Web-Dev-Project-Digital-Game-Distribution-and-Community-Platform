<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Steam Store - Clickable Carousel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* --- GLOBAL RESET --- */
        body {
            background-color: #1b2838;
            font-family: "Arial", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #c7d5e0;
            overflow-x: hidden;
        }

        .steam-wrapper {
            width: 95%;
            max-width: 1170px;
            margin: auto;
            position: relative;
        }

        /* --- NAVIGATION ARROWS --- */
        .steam-nav-btn {
            position: absolute;
            top: 40%;
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

        /* --- HERO CARD --- */
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

        .carousel-item {
            height: 450px;
        }

        /* --- VIDEO COLUMN --- */
        .col-video {
            background: #000;
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .media-header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            padding: 8px 12px;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.8), transparent);
            z-index: 2;
            font-size: 13px;
            pointer-events: none;
        }

        video,
        .slide-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* --- INFO COLUMN --- */
        .col-info {
            background-color: #0b1219;
            background-size: cover;
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

        /* --- OVERLAPPING CAPSULE (FIXED SIZE) --- */
        .capsule-overlap {
            position: relative;
            z-index: 10;
            margin-top: 25px;
            margin-bottom: 15px;
            margin-left: -40px;
            width: 112%;
            height: 180px;
            transition: transform 0.3s ease;
        }

        .capsule-overlap:hover {
            transform: scale(1.02);
        }

        .capsule-overlap img {
            box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.7);
            border: 1px solid #4a5a6a;
            width: 100%;
            height: 100%;
            object-fit: cover;
            background-color: #000;
        }

        /* --- CONTENT --- */
        .info-content {
            position: relative;
            z-index: 1;
            height: 100%;
            padding: 0 20px 20px 20px;
            display: flex;
            flex-direction: column;
        }

        /* --- BADGE WRAPPER --- */
        .badge-container {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            margin-bottom: 1rem;
            min-height: 26px;
        }

        .steam-badge {
            background: rgba(255, 255, 255, 0.1);
            color: #66C0F4;
            border: 1px solid rgba(102, 192, 244, 0.2);
            font-weight: normal;
            padding: 6px 6px;
            font-size: 11px;
            border-radius: 6px;
            white-space: nowrap;
        }

        /* --- CSS TRUNCATION LOGIC --- */
        .description-truncate {
            display: -webkit-box !important;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 12px;
            line-height: 1.4;
            max-height: 5.6em;
            color: #acb2b8;
            margin-bottom: auto;
        }

        .price-btn {
            background-color: #4c6b22;
            font-size: 13px;
            padding: 4px 12px;
            color: white;
            border-radius: 2px;
            white-space: nowrap;
        }

        /* --- INDICATORS --- */
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

        /* --- RESPONSIVE FIXES --- */
        @media (max-width: 992px) {
            .steam-nav-btn {
                display: none;
            }

            /* 1. Allow card height to be flexible but have a minimum */
            .hero-card {
                height: auto;
                min-height: 600px; /* Force minimum total height */
                display: flex;
                flex-direction: column; /* Stack video and info */
            }
            
            /* 2. Remove fixed height from carousel item wrapper */
            .carousel-item {
                height: auto;
                min-height: 600px; 
            }

            .col-video {
                height: 250px; /* Fixed height for video/image part */
                flex-shrink: 0; /* Prevent it from shrinking */
            }

            .capsule-overlap {
                display: none !important;
            }

            /* 3. Force the info section to take up the remaining space */
            .col-info {
                flex-grow: 1;
                display: flex;
                flex-direction: column;
            }

            .info-content {
                padding: 20px;
                flex-grow: 1; /* Push content to fill space */
            }

            .description-truncate {
                -webkit-line-clamp: 6;
                max-height: 8.4em;
            }
        }
    </style>
</head>

<body>
    <div class="steam-wrapper">

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

        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-inner shadow-lg" id="carousel-items-container">
            </div>

            <div class="indicators-container">
                <div class="carousel-indicators custom-indicators-style" id="carousel-indicators-container">
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        async function loadHeroCarousel() {
            try {
                const response = await fetch('../php_backend/get_hero_games.php');
                const data = await response.json();

                if (data.success && data.games.length > 0) {
                    const carouselInner = document.getElementById('carousel-items-container');
                    const indicatorsContainer = document.getElementById('carousel-indicators-container');

                    carouselInner.innerHTML = '';
                    indicatorsContainer.innerHTML = '';

                    data.games.forEach((game, index) => {
                        const isActive = index === 0 ? 'active' : '';
                        const priceDisplay = game.price == 0 ? 'Free To Play' : `$${parseFloat(game.price).toFixed(2)}`;

                        const fullDescription = game.description;

                        const hasVideo = game.video_url && game.video_url !== null;

                        // 1. Media Content
                        let mediaContentHtml = '';
                        if (hasVideo) {
                            mediaContentHtml = `
                                <video autoplay muted loop playsinline poster="../${game.header_image}">
                                    <source src="../${game.video_url}" type="video/mp4">
                                </video>
                            `;
                        } else {
                            mediaContentHtml = `
                                <img src="../${game.header_image}" class="slide-img" alt="${game.title}" style="object-fit: cover;">
                            `;
                        }

                        // 2. Trailer Label
                        const trailerText = hasVideo ?
                            `<span class="text-info fw-bold">Trailer Preview</span> &nbsp;|&nbsp; ${game.title}` :
                            `<span class="text-info fw-bold">Featured Game</span> &nbsp;|&nbsp; ${game.title}`;

                        // 3. Dynamic Background Image
                        const bgStyle = `background-image: url('../${game.header_image}');`;

                        // 4. Badges Logic
                        const badgesHtml = `
                            <span class="badge steam-badge">${game.developer_name}</span>
                            ${game.price == 0 ? '<span class="badge steam-badge">Free to Play</span>' : ''}
                            <span class="badge steam-badge">Featured</span>
                        `;

                        const slide = `
                            <div class="carousel-item ${isActive}">
                                <a href="game-details.php?game_id=${game.game_id}" class="hero-card row g-0 rounded-top-1 text-decoration-none">
                                    
                                    <div class="col-lg-8 col-video">
                                        <div class="media-header text-white">
                                            ${trailerText}
                                        </div>
                                        ${mediaContentHtml}
                                    </div>

                                    <div class="col-lg-4 col-info" style="${bgStyle}">
                                        <div class="info-content">
                                            
                                            <div class="capsule-overlap">
                                                <img src="../${game.thumbnail_image}" class="img-fluid rounded-1" alt="${game.title} Thumb">
                                            </div>

                                            <h2 class="text-white fw-light mb-2 text-truncate" style="font-size: 28px;">${game.title}</h2>
                                            
                                            <div class="badge-container">
                                                ${badgesHtml}
                                            </div>

                                            <p class="description-truncate">
                                                ${fullDescription}
                                            </p>

                                            <div class="mt-auto ms-auto pb-2">
                                                <span class="price-btn">${priceDisplay}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        `;

                        carouselInner.innerHTML += slide;

                        const indicator = `
                            <button type="button" 
                                data-bs-target="#heroCarousel" 
                                data-bs-slide-to="${index}" 
                                class="${isActive}" 
                                aria-label="Slide ${index + 1}">
                            </button>
                        `;
                        indicatorsContainer.innerHTML += indicator;
                    });
                } else {
                    console.error('No games found for hero carousel');
                }
            } catch (error) {
                console.error('Error loading hero carousel:', error);
            }
        }

        document.addEventListener('DOMContentLoaded', loadHeroCarousel);
    </script>

</body>

</html>