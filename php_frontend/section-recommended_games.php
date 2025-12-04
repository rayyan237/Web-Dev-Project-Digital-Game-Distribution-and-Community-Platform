<section id="recommended-games-wrapper" class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="section-title text-white fw-bold text-uppercase" style="letter-spacing: 0.05em; font-size: 1.2rem;">Recommended</h2>
    </div>

    <div id="gameCarousel" class="carousel slide" data-bs-ride="false" data-bs-interval="false">

        <div class="store-carousel-box carousel-inner rounded-3 overflow-hidden shadow-lg" id="recommended-carousel-items-container">
            <div class="text-center p-5 text-secondary w-100 h-100 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <div class="carousel-indicators-custom carousel-indicators" id="recommended-carousel-indicators-container"></div>

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

</section>

<script>
    // 1. Define Interaction Logic
    function initRecommendedInteractions() {
        const carouselElement = document.getElementById('gameCarousel');
        const screenshotImages = document.querySelectorAll('#recommended-games-wrapper .thumbnail-image');

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
            const response = await fetch('../php_backend/get_recommended_games.php');
            const data = await response.json();

            if (data.success && data.games.length > 0) {
                const carouselInner = document.getElementById('recommended-carousel-items-container');
                const indicatorsContainer = document.getElementById('recommended-carousel-indicators-container');
                
                carouselInner.innerHTML = '';
                indicatorsContainer.innerHTML = '';

                data.games.forEach((game, index) => {
                    const isActive = index === 0 ? 'active' : '';
                    const priceDisplay = game.price == 0 ? 'Free to Play' : `$${parseFloat(game.price).toFixed(2)} USD`;
                    
                    // Limit tags to 3
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
                        screenshotsHTML = `<div class="text-white small">No previews available</div>`;
                    }

                    const slide = `
                        <div class="slide-item carousel-item ${isActive}">
                            <div class="row g-0 h-100">
                                <div class="featured-image-container col-md-8 px-0">
                                    <a href="game-details.php?game_id=${game.game_id}">
                                        <img src="../${game.header_image}" data-original="../${game.header_image}"
                                            alt="${game.title} Header" class="featured-game-image">
                                    </a>
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
                initRecommendedInteractions();

            } else {
                document.getElementById('recommended-carousel-items-container').innerHTML = `
                    <div class="d-flex align-items-center justify-content-center h-100 w-100">
                        <h3 class="text-secondary">No recommended games found.</h3>
                    </div>`;
            }
        } catch (error) {
            console.error('Error loading recommended games:', error);
            document.getElementById('recommended-carousel-items-container').innerHTML = `
                    <div class="d-flex align-items-center justify-content-center h-100 w-100">
                        <h3 class="text-danger">Error loading data.</h3>
                    </div>`;
        }
    }

    // Initialize on load
    document.addEventListener('DOMContentLoaded', loadRecommendedGames);
</script>