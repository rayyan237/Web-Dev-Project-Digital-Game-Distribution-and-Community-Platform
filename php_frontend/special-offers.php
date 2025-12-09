<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Steam Special Offers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* =========================================
           1. GLOBAL SETTINGS
           ========================================= */
        body {
            background-color: #1b2838;
            color: #c6d4df;
            padding-bottom: 50px;
            overflow-x: hidden;
        }

        .steam-container-width {
            max-width: 1100px;
            margin: auto;
        }

        /* =========================================
           2. HEADER & BUTTON
           ========================================= */
        .section-title {
            color: #ffffff;
            font-weight: 700;
            font-size: 1.1rem;
            text-transform: uppercase;
            margin: 0;
            letter-spacing: 0.02em;
        }

        .btn-browse-more {
            display: inline-block;
            color: #c6d4df;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            padding: 4px 12px;
            background-color: transparent;
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 3px;
            transition: all 0.2s ease;
        }

        .btn-browse-more:hover {
            color: #ffffff;
            border-color: #ffffff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* =========================================
           3. CAROUSEL LAYOUT
           ========================================= */
        .special-offers-carousel-container {
            position: relative;
            padding: 0 45px;
        }

        .carousel-height {
            height: 450px;
        }

        /* =========================================
           4. CAPSULE STYLES (Cards)
           ========================================= */
        .capsule {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
            overflow: hidden;
            position: relative;
            background-color: #0f151d;
            display: flex;
            flex-direction: column;
            height: 100%;
            border: none;
        }

        .capsule:hover {
            transform: scale(1.01);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.7);
            z-index: 5;
        }

        .capsule-img-container {
            position: relative;
            overflow: hidden;
            background-color: #0f151d;
            width: 100%;
        }

        .capsule img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center center;
            display: block;
        }

        /* --- LARGE CARDS --- */
        .capsule-lg {
            height: 100%;
        }

        .capsule-lg .capsule-img-container {
            height: 60%;
        }

        .capsule-lg .info-block {
            height: 40%;
            flex-shrink: 0;
            padding: 16px 18px;
            background: linear-gradient(to right, #1e4e75 0%, #103451 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-start;
        }

        /* --- STACKED CARDS --- */
        .mobile-stack-container {
            display: flex;
            flex-direction: column;
            height: 100%;
            gap: 1rem;
        }

        .capsule-sm {
            flex: 1;
            height: auto;
            min-height: 0;
        }

        .capsule-sm .capsule-img-container {
            height: 75%;
        }

        .capsule-sm .info-block {
            height: 25%;
            background: #b0d4f0;
            padding: 0 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* =========================================
           5. BADGES & TEXT
           ========================================= */
        .discount-block-unified {
            display: inline-flex;
            align-items: center;
            height: 34px;
            background-color: #344654;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .discount-percent-unified {
            background-color: #4c6b22;
            color: #beee11;
            font-size: 1.4rem;
            font-weight: 700;
            padding: 0 8px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .price-box-unified {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-end;
            padding: 0 8px;
            height: 100%;
        }

        .original-price {
            font-size: 0.7rem;
            color: #738895;
            text-decoration: line-through;
            line-height: 1.1;
        }

        .final-price {
            font-size: 0.9rem;
            color: #beee11;
            font-weight: 600;
            line-height: 1.1;
        }

        .discount-upto {
            background-color: #4c6b22;
            color: #beee11;
            font-size: 1.1rem;
            font-weight: 700;
            padding: 4px 10px;
            display: inline-block;
            border-radius: 1px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* --- Typography --- */
        .deal-header {
            font-size: 1.1rem;
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 4px;
            text-transform: uppercase;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
            line-height: 1.2;
        }

        .deal-timer {
            font-size: 0.85rem;
            color: #82a3ba;
        }

        .todays-deal-text {
            font-size: 0.95rem;
            font-weight: 500;
            color: #253646;
        }

        /* =========================================
           6. CONTROLS & RESPONSIVE
           ========================================= */
        .carousel-control-prev,
        .carousel-control-next {
            width: 45px;
            height: 100px;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.01));
            top: 50%;
            transform: translateY(-50%);
            opacity: 1;
            border-radius: 3px;
        }

        .carousel-control-next {
            background: linear-gradient(to left, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.01));
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background-color: rgba(171, 171, 171, 0.2);
        }

        .carousel-control-prev {
            left: -45px;
        }

        .carousel-control-next {
            right: -45px;
        }

        .carousel-indicators {
            bottom: -40px;
            margin: 0;
        }

        .carousel-indicators button {
            width: 14px;
            height: 9px;
            border-radius: 2px;
            background-color: #3a414b;
            border: none;
            opacity: 0.6;
            margin: 0 4px;
        }

        .carousel-indicators button.active {
            background-color: #66c0f4;
            opacity: 1;
        }

        @media (max-width: 991.98px) {
            .special-offers-carousel-container {
                padding: 0 15px;
            }

            .carousel-height {
                display: flex;
                flex-wrap: nowrap;
                overflow-x: auto;
                scroll-snap-type: x mandatory;
                padding-bottom: 10px;
                gap: 15px;
                height: 450px;
                -webkit-overflow-scrolling: touch;
            }

            .carousel-height::-webkit-scrollbar {
                display: none;
            }

            .col-lg-4 {
                flex: 0 0 85%;
                max-width: 85%;
                scroll-snap-align: center;
                height: 100%;
            }

            .mobile-stack-container {
                height: 100% !important;
            }

            .carousel-control-prev,
            .carousel-control-next {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="container mt-5 steam-container-width special-offers-carousel-container">

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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        async function loadSpecialOffers() {
            try {
                // Fetch data from backend
                const response = await fetch('../php_backend/get_special_offers.php');
                const data = await response.json();

                if (data.success && data.games.length > 0) {
                    const carouselInner = document.getElementById('specialOffersCarouselInner');
                    const indicatorsContainer = document.getElementById('specialOffersIndicators');

                    // Clear loading spinner
                    carouselInner.innerHTML = '';
                    indicatorsContainer.innerHTML = '';

                    // Logic: Group games into slides (4 games per slide)
                    const gamesPerSlide = 4;
                    const slides = [];
                    for (let i = 0; i < data.games.length; i += gamesPerSlide) {
                        slides.push(data.games.slice(i, i + gamesPerSlide));
                    }

                    // Render Slides
                    slides.forEach((slideGames, slideIndex) => {
                        const isActive = slideIndex === 0 ? 'active' : '';

                        // 1. Build Indicator
                        const indicatorHtml = `
                            <button type="button" data-bs-target="#specialOffersCarousel" 
                                data-bs-slide-to="${slideIndex}" 
                                class="${isActive}"></button>`;
                        indicatorsContainer.innerHTML += indicatorHtml;

                        // 2. Start Slide HTML
                        let slideHTML = `
                            <div class="carousel-item ${isActive}">
                                <div class="row gx-3 gy-0 carousel-height">
                        `;

                        // 3. Loop through the 4 games in this slide
                        slideGames.forEach((game, gameIndex) => {
                            // Calculate discount percentage based on your data variables
                            const discountPercent = Math.round(((game.fake_price - game.actual_price) / game.fake_price) * 100);
                            
                            // Determine Layout: Index 0 & 1 are Large Columns. Index 2 & 3 are Small Stacked.
                            const isLargeCard = gameIndex < 2;

                            if (isLargeCard) {
                                // --- RENDER LARGE CARD (Index 0 or 1) ---
                                slideHTML += `
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
                                                <div class="discount-percent-unified">-${discountPercent}%</div>
                                                <div class="price-box-unified">
                                                    <div class="original-price">$${game.fake_price}</div>
                                                    <div class="final-price">$${game.actual_price}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>`;
                            } else {
                                // --- RENDER SMALL STACKED CARDS (Index 2 & 3) ---
                                
                                // If this is the 3rd item (index 2), open the container column
                                if (gameIndex === 2) {
                                    slideHTML += `<div class="col-lg-4 h-100"><div class="mobile-stack-container">`;
                                }

                                slideHTML += `
                                <a href="game-details.php?game_id=${game.game_id}" class="capsule capsule-sm text-decoration-none">
                                    <div class="capsule-img-container">
                                        <img src="../${game.thumbnail_image}" alt="${game.title}">
                                    </div>
                                    <div class="info-block">
                                        <div class="todays-deal-text" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">${game.title}</div>
                                        <div class="discount-block-unified">
                                            <div class="discount-percent-unified">-${discountPercent}%</div>
                                            <div class="price-box-unified">
                                                <div class="original-price">$${game.fake_price}</div>
                                                <div class="final-price">$${game.actual_price}</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>`;
                            }
                        });

                        // 4. Close the stacked container if it was opened
                        if (slideGames.length > 2) {
                            slideHTML += `</div></div>`; // Close .mobile-stack-container and .col-lg-4
                        }

                        // 5. Close Row and Carousel Item
                        slideHTML += `
                                </div>
                            </div>
                        `;

                        carouselInner.innerHTML += slideHTML;
                    });

                    // Reinitialize Bootstrap Carousel
                    const specialOffersCarousel = document.getElementById('specialOffersCarousel');
                    if (specialOffersCarousel) {
                        new bootstrap.Carousel(specialOffersCarousel, {
                            interval: false, // Steam usually doesn't auto-rotate specials quickly
                            ride: false
                        });
                    }

                } else {
                    document.getElementById('specialOffersCarouselInner').innerHTML = `
                        <div class="carousel-item active">
                            <div class="row gx-3 gy-0 carousel-height align-items-center justify-content-center">
                                <div class="col-12 text-center py-5">
                                    <h3 style="color: #4c6b22;">No special offers available. Check back soon!</h3>
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
</body>

</html>