<section id="category-browse-wrapper" class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="section-title">BROWSE BY CATEGORY</h2>
    </div>

    <div id="categoryCarousel" class="carousel slide" data-bs-ride="false" data-bs-touch="true">

        <div class="carousel-indicators" id="categoryIndicators">
            </div>

        <div class="carousel-inner" id="categoryCarouselInner">
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

</section>

<script>
    // Category image mapping
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

                // MOBILE CHECK & INITIALIZATION
                const categoryCarousel = document.getElementById('categoryCarousel');
                if (categoryCarousel) {
                    const isMobile = window.innerWidth < 992;
                    new bootstrap.Carousel(categoryCarousel, {
                        interval: isMobile ? false : 5000,
                        ride: isMobile ? false : 'carousel',
                        touch: !isMobile 
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