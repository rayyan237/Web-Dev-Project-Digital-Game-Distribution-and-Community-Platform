<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* --- 1. Global Settings & Steam Colors --- */
        body {
            background-color: #1b2838;
            padding-bottom: 50px;
            font-family: "Motiva Sans", Sans-serif, Arial, sans-serif;
            overflow-x: hidden;
        }

        .steam-container-width {
            max-width: 1100px;
            margin: auto;
        }

        .section-title {
            color: #ffffff;
            font-weight: 700;
            font-size: 1.2rem;
            text-transform: uppercase;
            margin: 0;
            letter-spacing: 0.05em;
        }

        /* --- 2. Carousel Container --- */
        .special-offers-carousel-container {
            position: relative;
            padding: 0 45px; /* Adjusted to 45px to match arrow width */
        }

        /* --- 3. Category Card Styling --- */
        .category-card {
            display: block;
            position: relative;
            overflow: hidden;
            border-radius: 4px;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            height: 180px; 
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .category-card .category-bg {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .category-card .category-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0) 50%);
            transition: background 0.3s ease;
            z-index: 1;
        }

        /* --- 4. BADGE STYLING --- */
        .category-title {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ffffff;
            color: #1b2838;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: 800;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
            z-index: 2;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            transition: all 0.2s ease;
        }

        /* --- 5. HOVER EFFECTS --- */
        .category-card:hover .category-bg { transform: scale(1.08); }
        .category-card:hover .category-overlay { background: linear-gradient(to top, rgba(42, 71, 94, 0.8) 0%, rgba(42, 71, 94, 0.2) 100%); }
        .category-card:hover .category-title { transform: translateX(-50%) scale(1.05); box-shadow: 0 6px 12px rgba(0, 0, 0, 0.6); }
        .category-card:hover { border-color: rgba(255,255,255,0.2); }


        /* ================================================== */
        /* 6. UPDATED BUTTON STYLES (From carousel.html)      */
        /* ================================================== */
        
        /* The Indicators (Dots) */
        #categoryCarousel .carousel-indicators {
            bottom: -40px;
            margin: 0;
        }
        #categoryCarousel .carousel-indicators button {
            width: 30px;
            height: 3px;
            background-color: #3a414b;
            border: none;
            opacity: 0.5;
            transition: opacity 0.6s ease;
        }
        #categoryCarousel .carousel-indicators button.active {
            background-color: #c6d4df;
            opacity: 1;
        }

        /* The Arrows */
        .custom-nav-arrow {
            width: 45px;
            height: 90px; /* Match source height */
            background-color: rgba(0, 0, 0, 0.7); /* Match source color */
            border: none;
            z-index: 10;
            opacity: 0.5;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            /* Remove default Bootstrap border-radius if preferred, or keep slight round */
            border-radius: 4px; 
        }

        /* Arrow Hover State */
        .custom-nav-arrow:hover {
            opacity: 1;
            background-color: rgba(0, 0, 0, 0.9); /* Darker on hover */
        }

        /* Positioning */
        .arrow-prev { left: -45px; }
        .arrow-next { right: -45px; }

        /* Inner Icon Styling */
        .arrow-icon-style {
            filter: none;
            transition: all 0.2s ease;
            opacity: 1;
            width: 2rem;
            height: 2rem;
        }

        /* Icon Glow on Hover */
        .custom-nav-arrow:hover .arrow-icon-style {
            filter: drop-shadow(0 0 3px rgba(255, 255, 255, 0.9));
        }

        /* --- 7. Responsive Adjustments --- */
        @media (max-width: 991.98px) {
            #categoryCarousel .carousel-item .col-md-6 {
                flex: 0 0 50%;
                max-width: 50%;
                margin-bottom: 15px;
            }
        }

        @media (max-width: 767.98px) {
            .special-offers-carousel-container {
                padding: 0 15px;
            }
            
            /* Hide arrows on mobile (per source file logic) */
            .custom-nav-arrow { 
                display: none !important; 
            }
            
            .category-title {
                padding: 4px 10px;
                font-size: 0.75rem;
            }
        }
    </style>
</head>

<body>

    <?php include 'navbar_include.php'; ?>

    <div class="container mt-5 steam-container-width special-offers-carousel-container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="section-title">BROWSE BY CATEGORY</h2>
        </div>

        <div id="categoryCarousel" class="carousel slide" data-bs-ride="false" data-bs-touch="true">

            <div class="carousel-indicators" id="categoryIndicators">
                <!-- Indicators will be dynamically generated -->
            </div>

            <div class="carousel-inner" id="categoryCarouselInner">
                <!-- Loading spinner -->
                <div class="carousel-item active">
                    <div class="row g-3">
                        <div class="col-12 text-center py-5">
                            <div class="spinner-border text-light" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="text-light mt-2">Loading categories...</p>
                        </div>
                    </div>
                </div>
            </div>

            <button class="custom-nav-arrow arrow-prev carousel-control-prev" type="button" data-bs-target="#categoryCarousel"
                data-bs-slide="prev">
                <span class="arrow-icon-style carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="custom-nav-arrow arrow-next carousel-control-next" type="button" data-bs-target="#categoryCarousel"
                data-bs-slide="next">
                <span class="arrow-icon-style carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Category image mapping (using existing images)
        const categoryImages = {
            'Action': '../assets/images/action.webp',
            'Adventure': '../assets/images/story_rich.webp',
            'Role-Playing (RPG)': '../assets/images/anime.webp',
            'Strategy': '../assets/images/strategy.webp',
            'Simulation': '../assets/images/simulation.webp',
            'Sports': '../assets/images/racing.webp',
            'Racing': '../assets/images/racing.webp',
            'Puzzle': '../assets/images/strategy.webp',
            'Fighting': '../assets/images/fighting_martial_arts.webp',
            'Horror': '../assets/images/survival.webp',
            'MOBA': '../assets/images/multiplayer_coop.webp',
            'Survival': '../assets/images/survival.webp',
            'Sandbox': '../assets/images/freetoplay.webp',
            'Platformer': '../assets/images/anime.webp',
            'Stealth': '../assets/images/science_fiction.webp',
            'Anime': '../assets/images/anime.webp',
            'Sci-Fi': '../assets/images/science_fiction.webp',
            'Visual Novel': '../assets/images/visual_novel.webp',
            'Free to Play': '../assets/images/freetoplay.webp',
            'Multiplayer': '../assets/images/multiplayer_coop.webp'
        };

        // Load categories (genres) carousel from database
        async function loadCategories() {
            try {
                const response = await fetch('../php_backend/get_categories.php');
                const data = await response.json();

                if (data.success && data.categories.length > 0) {
                    const carouselInner = document.getElementById('categoryCarouselInner');
                    const indicatorsContainer = document.getElementById('categoryIndicators');
                    
                    // Clear loading spinner
                    carouselInner.innerHTML = '';
                    indicatorsContainer.innerHTML = '';

                    // Group categories into slides (4 per slide)
                    const categoriesPerSlide = 4;
                    const slides = [];
                    for (let i = 0; i < data.categories.length; i += categoriesPerSlide) {
                        slides.push(data.categories.slice(i, i + categoriesPerSlide));
                    }

                    // Create slides
                    slides.forEach((slideCategories, slideIndex) => {
                        const isActive = slideIndex === 0 ? 'active' : '';
                        
                        let slideHTML = `
                            <div class="carousel-item ${isActive}">
                                <div class="row g-3">
                        `;

                        slideCategories.forEach(category => {
                            const categoryImage = categoryImages[category.genre_name] || '../assets/images/anime.webp';
                            
                            slideHTML += `
                                <div class="col-lg-3 col-md-6">
                                    <a href="category-details.php?genre_id=${category.genre_id}" class="category-card">
                                        <img src="${categoryImage}" alt="${category.genre_name}" class="category-bg">
                                        <div class="category-overlay"></div>
                                        <div class="category-title">${category.genre_name.toUpperCase()}</div>
                                    </a>
                                </div>
                            `;
                        });

                        slideHTML += `
                                </div>
                            </div>
                        `;
                        
                        carouselInner.innerHTML += slideHTML;

                        // Create indicator
                        const indicator = `
                            <button type="button" data-bs-target="#categoryCarousel" data-bs-slide-to="${slideIndex}" 
                                ${isActive ? 'class="active" aria-current="true"' : ''} aria-label="Slide ${slideIndex + 1}"></button>
                        `;
                        indicatorsContainer.innerHTML += indicator;
                    });

                    // Reinitialize carousel
                    const categoryCarousel = document.getElementById('categoryCarousel');
                    if (categoryCarousel) {
                        new bootstrap.Carousel(categoryCarousel, {
                            interval: false,
                            ride: false,
                            touch: true
                        });
                    }
                } else {
                    const carouselInner = document.getElementById('categoryCarouselInner');
                    carouselInner.innerHTML = `
                        <div class="carousel-item active">
                            <div class="row g-3">
                                <div class="col-12 text-center py-5">
                                    <p class="text-light">No categories available</p>
                                </div>
                            </div>
                        </div>
                    `;
                }
            } catch (error) {
                console.error('Error loading categories:', error);
                const carouselInner = document.getElementById('categoryCarouselInner');
                carouselInner.innerHTML = `
                    <div class="carousel-item active">
                        <div class="row g-3">
                            <div class="col-12 text-center py-5">
                                <p class="text-danger">Error loading categories. Please try again later.</p>
                            </div>
                        </div>
                    </div>
                `;
            }
        }

        // Load categories on page load
        document.addEventListener('DOMContentLoaded', loadCategories);
    </script>
</body>

</html>