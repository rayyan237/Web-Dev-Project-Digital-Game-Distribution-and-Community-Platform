<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under $10 Section</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* =========================================
           1. GLOBAL SETTINGS
           ========================================= */
        body {
            background-color: #1b2838;
            color: white;
            overflow-x: hidden;
            padding-bottom: 50px;
        }

        .steam-container-width {
            max-width: 1100px;
            margin: auto;
        }

        /* =========================================
           2. HEADER & BUTTONS
           ========================================= */
        .section-title {
            color: #ffffff;
            font-weight: 700;
            font-size: 1.1rem;
            text-transform: uppercase;
            margin: 0;
            letter-spacing: 0.02em;
        }

        .header-buttons {
            display: flex;
            gap: 10px;
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
            white-space: nowrap;
        }

        .btn-browse-more:hover {
            color: #ffffff;
            border-color: #ffffff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* =========================================
           3. CAROUSEL LAYOUT
           ========================================= */
        #steamGameCarousel {
            position: relative;
            padding: 0 45px;
        }

        /* =========================================
           4. CARD STYLES
           ========================================= */
        .steam-card {
            background-color: #0a141d;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
            position: relative;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            height: 100%;
            display: flex;
            flex-direction: column;
            border: none;
            text-decoration: none;
        }

        .steam-card:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.8);
            z-index: 100;
            outline: none;
        }

        .steam-card img {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: block;
        }

        /* Footer Area */
        .card-body-steam {
            background: #10151d;
            padding: 4px 8px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-top: auto;
        }

        /* NEW PRICE BUTTON STYLE */
        .price-btn {
            background-color: #4c6b22;
            font-size: 13px;
            padding: 4px 12px;
            color: white;
            border-radius: 2px;
            white-space: nowrap;
            display: inline-block;
            font-weight: 500;
        }

        /* =========================================
           5. CONTROLS
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
            border: none;
            z-index: 10;
            position: absolute;
        }

        .carousel-control-next {
            background: linear-gradient(to left, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.01));
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background-color: rgba(171, 171, 171, 0.2);
        }

        .carousel-control-prev {
            left: 0;
        }

        .carousel-control-next {
            right: 0;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 2rem;
            height: 2rem;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.8));
        }

        .carousel-indicators {
            bottom: -35px;
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
            transition: all 0.2s;
        }

        .carousel-indicators button.active {
            background-color: #66c0f4;
            opacity: 1;
        }

        /* Responsive */
        @media (max-width: 767.98px) {
            #steamGameCarousel {
                padding: 0 10px;
            }

            .carousel-control-prev,
            .carousel-control-next {
                display: none;
            }

            .col-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }
    </style>
</head>

<body>

    <div class="container mt-5 mb-5 steam-container-width">

        <div class="d-flex justify-content-between align-items-end mb-2 steam-header">
            <h2 class="section-title">UNDER $10 USD</h2>
            <div class="header-buttons">
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

            <div class="carousel-indicators" id="under10Indicators"></div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            loadUnder10Games();
        });

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
                            // Calculate final price
                            const finalPrice = parseFloat(game.price).toFixed(2);
                            
                            // Render price strictly using .price-btn class
                            const priceHTML = `
                                <div class="price-btn">$${finalPrice} USD</div>
                            `;

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

                    // Reinitialize Bootstrap Carousel
                    const steamCarousel = document.getElementById('steamGameCarousel');
                    const carouselInstance = bootstrap.Carousel.getOrCreateInstance(steamCarousel); 
                    
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
                    indicatorsContainer.innerHTML = '';
                }
            } catch (error) {
                console.error('Error loading under $10 games:', error);
                document.getElementById('under10CarouselInner').innerHTML = '<p class="text-center text-danger mt-4">Failed to load games.</p>';
            }
        }
    </script>
</body>

</html>