<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carousel - Simple CSS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* =========================================
           1. GLOBAL STYLES
           ========================================= */
        body {
            background-color: #1b2838;
            color: #c7d5e0;
        }

        .main-container {
            max-width: 1000px;
        }

        /* =========================================
           2. CAROUSEL STYLES (Specific)
           ========================================= */

        /* Base Container */
        .store-carousel-box {
            height: 385px;
            background-color: #171a21;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8), 0 0 20px rgba(0, 0, 0, 0.5);
        }

        /* Main Image Area */
        .featured-image-container {
            background-color: #171a21;
        }

        .featured-game-image {
            object-fit: fill;
            max-height: 385px;
            min-height: 385px;
            height: 100%;
            width: 100%;
            background-color: #171a21;
        }

        /* Info Panel (Right Side) */
        .game-details-panel {
            background-color: #0d121c;
            color: white;
            padding: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            box-shadow: none;
        }

        .game-title-box {
            height: 3.9em;
            margin-bottom: 0.5rem;
        }

        .game-title-text {
            color: #fff;
            font-size: 1.5em;
            font-weight: 600;
            margin: 0;
            padding: 0;
            text-align: left;
            line-height: 1.3;
        }

        /* Thumbnails Grid */
        .thumbnails-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 5px;
            padding: 5px 0;
            background-color: #0d121c;
            margin-top: 0;
            margin-left: -20px;
            margin-right: -20px;
        }

        .thumbnail-image {
            width: 100%;
            height: 85px;
            object-fit: cover;
            border-radius: 3px;
            opacity: 0.6;
            transition: opacity 0.3s, transform 0.2s ease-in-out;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .thumbnail-image:hover {
            opacity: 1;
            cursor: pointer;
            transform: scale(1.03);
        }

        /* Bottom Info Area */
        .bottom-info-row {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            flex-grow: 1;
        }

        .status-row {
            display: flex;
            align-items: center;
            margin-top: 15px;
            margin-bottom: 15px;
            flex-wrap: wrap; 
            gap: 5px;
        }

        /* --- NEW PRICE BUTTON STYLE --- */
        .price-btn {
            background-color: #4c6b22;
            font-size: 13px;
            padding: 4px 12px;
            color: white;
            border-radius: 2px;
            white-space: nowrap;
            display: inline-block; /* Added to ensure it respects padding/width correctly */
            width: fit-content;    /* Prevents it from stretching to full width */
        }

        /* Specific Badges (No reusable utility) */
        .status-badge-blue {
            background-color: #3b5a7e;
            color: #e0e6e9;
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 0.75em;
            font-weight: 600;
            text-transform: uppercase;
        }

        /* Navigation Arrows */
        .carousel-indicators-custom {
            position: relative;
            margin-top: 15px;
            margin-bottom: 0;
            gap: 5px;
        }

        .custom-nav-arrow {
            width: 45px;
            height: 90px;
            background-color: rgba(0, 0, 0, 0.7);
            border: none;
            z-index: 10;
            opacity: 0.5;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .custom-nav-arrow:hover {
            opacity: 1;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .arrow-icon-style {
            filter: none;
            transition: all 0.2s ease;
            opacity: 1;
        }

        .custom-nav-arrow:hover .arrow-icon-style {
            filter: drop-shadow(0 0 3px rgba(255, 255, 255, 0.9));
        }

        /* ======================================= */
        /* Mobile Styles */
        /* ======================================= */
        @media (max-width: 767.98px) {
            .main-container {
                padding-left: 0;
                padding-right: 0;
            }

            .custom-nav-arrow,
            .carousel-indicators-custom {
                display: none;
            }

            .store-carousel-box.overflow-hidden {
                overflow: auto !important;
                overflow-x: scroll !important;
            }

            .store-carousel-box {
                height: auto;
                box-shadow: none;
                display: flex;
                flex-wrap: nowrap;
                -webkit-overflow-scrolling: touch;
                scroll-snap-type: x mandatory;
            }

            .slide-item {
                min-width: 90%;
                margin: 0 5%;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
                scroll-snap-align: center;
                background-color: #171a21;
                display: flex;
                flex-shrink: 0;
            }

            .slide-item.active {
                display: flex;
            }

            .slide-item .row {
                flex-direction: column;
                height: auto;
                width: 100%;
            }

            .featured-game-image {
                max-height: 200px;
                min-height: 200px;
                object-fit: cover;
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
            }

            .game-details-panel {
                padding: 15px;
                height: auto;
                min-height: 250px;
                background-color: #0d121c;
                border-bottom-left-radius: 8px;
                border-bottom-right-radius: 8px;
            }

            .game-title-text {
                font-size: 1.3em;
            }

            .thumbnails-grid {
                display: none;
            }

            .bottom-info-row {
                flex-grow: 0;
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5 position-relative main-container">
        <div id="gameCarousel" class="carousel slide" data-bs-ride="false" data-bs-interval="false">

            <div class="store-carousel-box carousel-inner rounded-3 overflow-hidden shadow-lg" id="carousel-items-container">
                <div class="text-center p-5 text-secondary w-100 h-100 d-flex align-items-center justify-content-center">
                    Loading Recommended Games...
                </div>
            </div>

            <div class="carousel-indicators-custom carousel-indicators" id="carousel-indicators-container"></div>

            <button class="custom-nav-arrow carousel-control-prev" type="button"
                data-bs-target="#gameCarousel" data-bs-slide="prev"
                style="left: -45px; top: 50%; transform: translateY(-50%);">
                <span class="arrow-icon-style carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="custom-nav-arrow carousel-control-next" type="button"
                data-bs-target="#gameCarousel" data-bs-slide="next"
                style="right: -45px; top: 50%; transform: translateY(-50%);">
                <span class="arrow-icon-style carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // 1. Define Interaction Logic (Re-used after fetch)
        function initInteractions() {
            const carouselElement = document.getElementById('gameCarousel');
            const screenshotImages = document.querySelectorAll('.thumbnail-image');

            // Screenshot Hover Logic
            screenshotImages.forEach(screenshotImg => {
                const carouselItem = screenshotImg.closest('.carousel-item');
                const mainImage = carouselItem ? carouselItem.querySelector('.featured-game-image') : null;

                if (mainImage) {
                    const originalSrc = mainImage.getAttribute('data-original');

                    screenshotImg.addEventListener('mouseover', function () {
                        if (window.innerWidth >= 768) {
                            mainImage.src = this.src;
                        }
                    });

                    screenshotImg.addEventListener('mouseout', function () {
                        if (window.innerWidth >= 768) {
                            mainImage.src = originalSrc;
                        }
                    });
                }
            });

            // Reset Main Image on Slide Change
            carouselElement.addEventListener('slid.bs.carousel', function (event) {
                const activeItem = event.relatedTarget;
                const mainImage = activeItem.querySelector('.featured-game-image');
                if (mainImage) {
                    mainImage.src = mainImage.getAttribute('data-original');
                }
            });

            // Pause on Mobile
            if (window.innerWidth < 768) {
                const carouselInstance = bootstrap.Carousel.getOrCreateInstance(carouselElement);
                carouselInstance.pause();
            }
        }

        // 2. Fetch and Render Logic
        async function loadRecommendedGames() {
            try {
                // Using your backend API endpoint
                const response = await fetch('../php_backend/get_recommended_games.php');
                const data = await response.json();

                if (data.success && data.games.length > 0) {
                    const carouselInner = document.getElementById('carousel-items-container');
                    const indicatorsContainer = document.getElementById('carousel-indicators-container');
                    
                    carouselInner.innerHTML = '';
                    indicatorsContainer.innerHTML = '';

                    data.games.forEach((game, index) => {
                        const isActive = index === 0 ? 'active' : '';
                        const priceDisplay = game.price == 0 ? 'Free to Play' : `$${parseFloat(game.price).toFixed(2)} USD`;
                        
                        // Limit tags to 3 to prevent layout breaking on small screens
                        const tagsHTML = game.tags && game.tags.length > 0 
                            ? game.tags.slice(0, 3).map(tag => `<span class="status-badge-blue">${tag}</span>`).join('')
                            : '<span class="status-badge-gray">No Tags</span>';

                        // Generate Screenshots Grid (Limit to 4)
                        let screenshotsHTML = '';
                        if (game.screenshots && game.screenshots.length > 0) {
                            game.screenshots.slice(0, 4).forEach((screenshot, idx) => {
                                screenshotsHTML += `<div><img class="thumbnail-image" src="../${screenshot}" alt="Screenshot ${idx + 1}"></div>`;
                            });
                        } else {
                            // Fallback if no screenshots
                            screenshotsHTML = `<div class="text-white small">No previews available</div>`;
                        }

                        const slide = `
                            <div class="slide-item carousel-item ${isActive}">
                                <div class="row g-0 h-100">
                                    <div class="featured-image-container col-md-8 px-0">
                                        <img src="../${game.header_image}" data-original="../${game.header_image}"
                                            alt="${game.title} Header" class="featured-game-image">
                                    </div>
                                    <div class="col-md-4 p-0">
                                        <div class="game-details-panel">
                                            <div class="game-title-box d-flex align-items-center">
                                                <h3 class="game-title-text">${game.title}</h3>
                                            </div>
                                            <div class="thumbnails-grid">
                                                ${screenshotsHTML}
                                            </div>
                                            <div class="bottom-info-row">
                                                <div class="status-row">
                                                    ${tagsHTML}
                                                </div>
                                                <div class="price-btn">${priceDisplay}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        carouselInner.innerHTML += slide;

                        // Create Indicator Button
                        const indicator = `
                            <button type="button" data-bs-target="#gameCarousel" data-bs-slide-to="${index}" 
                                ${isActive ? 'class="active" aria-current="true"' : ''} aria-label="Slide ${index + 1}"></button>
                        `;
                        indicatorsContainer.innerHTML += indicator;
                    });

                    // Re-initialize carousel functionality from Bootstrap
                    const carouselEl = document.getElementById('gameCarousel');
                    new bootstrap.Carousel(carouselEl, {
                        interval: false, 
                        ride: false
                    });

                    // Call the interaction logic AFTER DOM is ready
                    initInteractions();

                } else {
                    document.getElementById('carousel-items-container').innerHTML = `
                        <div class="d-flex align-items-center justify-content-center h-100 w-100">
                            <h3 class="text-secondary">No recommended games found.</h3>
                        </div>`;
                }
            } catch (error) {
                console.error('Error loading recommended games:', error);
                document.getElementById('carousel-items-container').innerHTML = `
                        <div class="d-flex align-items-center justify-content-center h-100 w-100">
                            <h3 class="text-danger">Error loading data.</h3>
                        </div>`;
            }
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', loadRecommendedGames);
    </script>
    
    
</body>

</html>