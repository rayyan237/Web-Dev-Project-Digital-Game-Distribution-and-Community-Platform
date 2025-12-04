<section id="hero-carousel-wrapper">

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
            <div class="d-flex justify-content-center align-items-center" style="height: 450px;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <div class="indicators-container">
            <div class="carousel-indicators custom-indicators-style" id="carousel-indicators-container">
            </div>
        </div>

    </div>

</section>

<script>
    async function loadHeroCarousel() {
        try {
            // FIX 1: Path to backend
            const response = await fetch('../php_backend/get_hero_games.php');
            
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

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
                    const hasVideo = game.video_url && game.video_url !== null && game.video_url !== "";

                    // FIX 2: Image Paths (Assuming they are one level up)
                    
                    // Media Logic
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

                    // Trailer Label
                    const trailerText = hasVideo ?
                        `<span class="text-info fw-bold">Trailer Preview</span> &nbsp;|&nbsp; ${game.title}` :
                        `<span class="text-info fw-bold">Featured Game</span> &nbsp;|&nbsp; ${game.title}`;

                    // Dynamic Background
                    const bgStyle = `background-image: url('../${game.header_image}');`;

                    // Badges
                    const badgesHtml = `
                        <span class="badge steam-badge">${game.developer_name}</span>
                        ${game.price == 0 ? '<span class="badge steam-badge">Free to Play</span>' : ''}
                        <span class="badge steam-badge">Featured</span>
                    `;

                    // HTML Structure
                    const slide = `
                        <div class="carousel-item ${isActive}">
                            <a href="game-details.php?game_id=${game.game_id}" class="hero-card row g-0 rounded-top-1 text-decoration-none">
                                
                                <div class="col-lg-8 hero-col-video">
                                    <div class="hero-media-header text-white">
                                        ${trailerText}
                                    </div>
                                    ${mediaContentHtml}
                                </div>

                                <div class="col-lg-4 hero-col-info" style="${bgStyle}">
                                    <div class="hero-info-content">
                                        
                                        <div class="capsule-overlap">
                                            <img src="../${game.thumbnail_image}" class="img-fluid rounded-1" alt="${game.title} Thumb">
                                        </div>

                                        <h2 class="text-white fw-light mb-2 text-truncate" style="font-size: 28px;">${game.title}</h2>
                                        
                                        <div class="hero-badge-container">
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

                // MOBILE SLIDER LOGIC
                // Check if screen is small (mobile breakpoint matching CSS)
                const isMobile = window.innerWidth < 992;
                
                const heroCarouselEl = document.getElementById('heroCarousel');
                if (heroCarouselEl) {
                    new bootstrap.Carousel(heroCarouselEl, {
                        // If mobile, disable auto-interval so manual scrolling works smoothly
                        // If desktop, use 5000ms
                        interval: isMobile ? false : 5000, 
                        
                        // If mobile, disable the 'carousel' behavior logic (since we use CSS scroll)
                        ride: isMobile ? false : 'carousel',
                        
                        // Disable touch swiping on mobile because native scroll handles it better
                        touch: !isMobile 
                    });
                }

            } else {
                console.error('No games found for hero carousel');
                document.getElementById('carousel-items-container').innerHTML = '<p class="text-center text-white pt-5">No games found.</p>';
            }
        } catch (error) {
            console.error('Error loading hero carousel:', error);
            document.getElementById('carousel-items-container').innerHTML = '<p class="text-center text-danger pt-5">Error loading data.</p>';
        }
    }

    document.addEventListener('DOMContentLoaded', loadHeroCarousel);
</script>