<section id="under-10-wrapper" class="container mt-5 mb-5">

    <div class="d-flex justify-content-between align-items-end mb-3 steam-header">
        <h2 class="section-title">UNDER $10 USD</h2>
        
        <div class="header-buttons desktop-header-buttons">
            <a href="browse-cheap.php?price=10" class="btn-browse-more">UNDER $10 USD</a>
            <a href="browse-cheap.php?price=5" class="btn-browse-more">UNDER $5 USD</a>
        </div>
    </div>

    <div id="steamGameCarousel" class="carousel slide" data-bs-ride="false">

        <div class="carousel-inner" id="under10CarouselInner">
            <div class="text-center py-5">
                <div class="spinner-border text-light" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#steamGameCarousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#steamGameCarousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

        <div class="carousel-indicators custom-indicators-style" id="under10Indicators"></div>

    </div>

    <div class="mobile-footer-buttons">
        <a href="browse-cheap.php?price=10" class="btn-browse-more">Under $10</a>
        <a href="browse-cheap.php?price=5" class="btn-browse-more">Under $5</a>
    </div>

</section>

<script>
    async function loadUnder10Games() {
        try {
            const response = await fetch('../php_backend/get_under_10_games.php');
            const data = await response.json();

            const carouselInner = document.getElementById('under10CarouselInner');
            const indicatorsContainer = document.getElementById('under10Indicators');

            if (data.success && data.games.length > 0) {
                
                carouselInner.innerHTML = '';
                indicatorsContainer.innerHTML = '';

                // Group games into slides (4 games per slide)
                const gamesPerSlide = 4;
                const slides = [];
                for (let i = 0; i < data.games.length; i += gamesPerSlide) {
                    slides.push(data.games.slice(i, i + gamesPerSlide));
                }

                slides.forEach((slideGames, slideIndex) => {
                    const isActive = slideIndex === 0 ? 'active' : '';

                    let slideHTML = `
                        <div class="carousel-item ${isActive}">
                            <div class="row g-3">
                    `;

                    slideGames.forEach(game => {
                        const finalPrice = parseFloat(game.price).toFixed(2);
                        const priceHTML = `<div class="price-btn">$${finalPrice} USD</div>`;

                        slideHTML += `
                            <div class="col-md-3 col-6">
                                <a href="game-details.php?game_id=${game.game_id}" class="steam-card">
                                    <img src="../${game.header_image}" alt="${game.title}">
                                    <div class="card-body-steam">
                                        ${priceHTML}
                                    </div>
                                </a>
                            </div>
                        `;
                    });

                    slideHTML += `
                            </div>
                        </div>
                    `;

                    carouselInner.innerHTML += slideHTML;

                    // Add Indicator
                    const indicator = `
                        <button type="button" data-bs-target="#steamGameCarousel" data-bs-slide-to="${slideIndex}" 
                            ${isActive ? 'class="active" aria-current="true"' : ''}></button>
                    `;
                    indicatorsContainer.innerHTML += indicator;
                });

                // MOBILE CHECK
                const steamCarousel = document.getElementById('steamGameCarousel');
                if (steamCarousel) {
                    const isMobile = window.innerWidth < 992;
                    new bootstrap.Carousel(steamCarousel, {
                        interval: isMobile ? false : 5000,
                        ride: isMobile ? false : 'carousel',
                        touch: !isMobile 
                    });
                }
                
            } else {
                carouselInner.innerHTML = `
                    <div class="carousel-item active">
                        <div class="row g-3">
                            <div class="col-12 text-center py-5">
                                <h5 style="color: #8f98a0;">No games under $10 available at the moment</h5>
                            </div>
                        </div>
                    </div>
                `;
            }
        } catch (error) {
            console.error('Error loading under $10 games:', error);
            document.getElementById('under10CarouselInner').innerHTML = '<p class="text-center text-danger mt-4">Failed to load games.</p>';
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        loadUnder10Games();
    });
</script>