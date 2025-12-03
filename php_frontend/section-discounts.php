<section id="special-offers-wrapper" class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="section-title">DISCOUNTS & EVENTS</h2>
        <a href="browse-more.php" class="btn-browse-more">Browse More</a>
    </div>

    <div id="specialOffersCarousel" class="carousel slide" data-bs-ride="false">

        <div class="carousel-indicators" id="specialOffersIndicators"></div>

        <div class="carousel-inner" id="specialOffersCarouselInner">
            <div class="carousel-item active">
                <div class="row gx-3 gy-0 carousel-height align-items-center justify-content-center">
                    <div class="text-center text-white">Loading Special Offers...</div>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#specialOffersCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#specialOffersCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>

</section>

<script>
    async function loadSpecialOffers() {
        try {
            const response = await fetch('../php_backend/get_special_offers.php');
            const data = await response.json();

            if (data.success && data.games.length > 0) {
                const carouselInner = document.getElementById('specialOffersCarouselInner');
                const indicatorsContainer = document.getElementById('specialOffersIndicators');

                carouselInner.innerHTML = '';
                indicatorsContainer.innerHTML = '';

                // Group games: 4 games per group
                // 2 Big cards + 1 Stack of 2 Small cards
                const gamesPerSlide = 4;
                const slides = [];
                for (let i = 0; i < data.games.length; i += gamesPerSlide) {
                    slides.push(data.games.slice(i, i + gamesPerSlide));
                }

                slides.forEach((slideGames, slideIndex) => {
                    const isActive = slideIndex === 0 ? 'active' : '';

                    // Indicator
                    const indicatorHtml = `
                        <button type="button" data-bs-target="#specialOffersCarousel" 
                            data-bs-slide-to="${slideIndex}" 
                            class="${isActive}"></button>`;
                    indicatorsContainer.innerHTML += indicatorHtml;

                    // Start Slide
                    let slideHTML = `
                        <div class="carousel-item ${isActive}">
                            <div class="row gx-3 gy-0 carousel-height">
                    `;

                    // Generate Columns
                    // Col 1 (Big)
                    if (slideGames[0]) {
                        slideHTML += renderBigCard(slideGames[0]);
                    }
                    // Col 2 (Big)
                    if (slideGames[1]) {
                        slideHTML += renderBigCard(slideGames[1]);
                    }
                    // Col 3 (Stack)
                    if (slideGames[2] || slideGames[3]) {
                        slideHTML += `<div class="col-lg-4 h-100"><div class="mobile-stack-container">`;
                        if (slideGames[2]) slideHTML += renderSmallCard(slideGames[2]);
                        if (slideGames[3]) slideHTML += renderSmallCard(slideGames[3]);
                        slideHTML += `</div></div>`;
                    }

                    // Close Slide
                    slideHTML += `</div></div>`;
                    carouselInner.innerHTML += slideHTML;
                });

                // Helper: Render Big Card
                function renderBigCard(game) {
                    const discount = Math.round(((game.fake_price - game.actual_price) / game.fake_price) * 100);
                    return `
                    <div class="col-lg-4 h-100">
                        <a href="game-details.php?game_id=${game.game_id}" class="capsule capsule-lg text-decoration-none">
                            <div class="capsule-img-container">
                                <img src="../${game.thumbnail_image}" alt="${game.title}">
                            </div>
                            <div class="info-block">
                                <div>
                                    <div class="deal-header">${game.title}</div>
                                    <div class="deal-timer">Limited Time Offer</div>
                                </div>
                                <div class="discount-block-unified">
                                    <div class="discount-percent-unified">-${discount}%</div>
                                    <div class="price-box-unified">
                                        <div class="original-price">$${game.fake_price}</div>
                                        <div class="final-price">$${game.actual_price}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>`;
                }

                // Helper: Render Small Card
                function renderSmallCard(game) {
                    const discount = Math.round(((game.fake_price - game.actual_price) / game.fake_price) * 100);
                    return `
                    <a href="game-details.php?game_id=${game.game_id}" class="capsule capsule-sm text-decoration-none">
                        <div class="capsule-img-container">
                            <img src="../${game.thumbnail_image}" alt="${game.title}">
                        </div>
                        <div class="info-block">
                            <div class="todays-deal-text" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">${game.title}</div>
                            <div class="discount-block-unified">
                                <div class="discount-percent-unified">-${discount}%</div>
                                <div class="price-box-unified">
                                    <div class="original-price">$${game.fake_price}</div>
                                    <div class="final-price">$${game.actual_price}</div>
                                </div>
                            </div>
                        </div>
                    </a>`;
                }

                // Initialize Bootstrap Carousel
                const specialOffersCarousel = document.getElementById('specialOffersCarousel');
                if (specialOffersCarousel) {
                    const isMobile = window.innerWidth < 992;
                    new bootstrap.Carousel(specialOffersCarousel, {
                        interval: isMobile ? false : 5000,
                        ride: isMobile ? false : 'carousel',
                        touch: !isMobile 
                    });
                }

            } else {
                document.getElementById('specialOffersCarouselInner').innerHTML = `
                    <div class="carousel-item active">
                        <div class="row gx-3 gy-0 carousel-height align-items-center justify-content-center">
                            <div class="col-12 text-center py-5">
                                <h3 style="color: #4c6b22;">No special offers available.</h3>
                            </div>
                        </div>
                    </div>`;
            }
        } catch (error) {
            console.error('Error loading special offers:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', loadSpecialOffers);
</script>