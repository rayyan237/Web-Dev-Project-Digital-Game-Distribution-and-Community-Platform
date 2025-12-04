<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Steam: Budget Gaming</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Motiva+Sans:wght@300;400;500;700;900&family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* =========================================
           1. GLOBAL THEME
           ========================================= */
        body {
            background: #1b2838;
            color: #c7d5e0;
            font-family: "Motiva Sans", "Roboto", sans-serif;
            overflow-x: hidden;
        }

        a { text-decoration: none; color: inherit; }

        .browse-container {
            padding: 30px 0;
            min-height: 80vh;
        }

        .page-title {
            font-weight: 300;
            font-size: 2rem;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 10px;
        }
        
        /* =========================================
           2. SIDEBAR FILTERS & TOGGLES
           ========================================= */
        .filter-box {
            background-color: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(67, 73, 83, 0.5);
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .filter-header {
            font-size: 1rem;
            color: #fff;
            font-weight: 500;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        /* Price Toggle Switch */
        .price-toggle-group {
            display: flex;
            background: #10151d;
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 15px;
            border: 1px solid #2a475e;
        }

        .price-toggle-label {
            flex: 1;
            text-align: center;
            padding: 8px 0;
            cursor: pointer;
            font-size: 0.9rem;
            color: #67c1f5;
            transition: all 0.2s;
        }

        .price-toggle-label:hover {
            background: rgba(255,255,255,0.05);
            color: #fff;
        }

        /* Logic to style the active radio label */
        input[type="radio"].btn-check:checked + .price-toggle-label {
            background-color: #66c0f4;
            color: #1b2838;
            font-weight: bold;
        }

        /* Standard Checkboxes */
        .filter-option {
            display: flex;
            align-items: center;
            padding: 4px 0;
            color: #8f98a0;
            cursor: pointer;
            font-size: 0.9rem;
            transition: 0.2s;
        }
        .filter-option:hover { color: #fff; }
        .filter-option input { 
            margin-right: 10px; 
            accent-color: #66c0f4; 
            cursor: pointer;
            width: 16px; height: 16px;
        }

        /* =========================================
           3. SORT BAR & CONTROLS
           ========================================= */
        .sort-bar-container {
            background-color: rgba(0, 0, 0, 0.2);
            padding: 10px 15px;
            border-radius: 3px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .styled-select {
            background-color: #2a3f5a;
            color: white;
            border: 1px solid #45556c;
            padding: 5px 10px;
            border-radius: 2px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .search-input {
            background: #10161d; 
            border: 1px solid #283c4e; 
            color: #fff; 
            padding: 5px 10px; 
            border-radius: 3px; 
            outline: none;
            font-size: 0.9rem;
            width: 250px;
        }
        .search-input:focus { border-color: #66c0f4; }

        /* =========================================
           4. LIST ITEM STYLES (Desktop)
           ========================================= */
        .game-card-row {
            display: flex;
            background-color: #16202d; 
            height: 69px; /* Standard Steam small row */
            margin-bottom: 5px;
            text-decoration: none;
            color: #c6d4df;
            transition: all 0.1s ease;
            border: 1px solid transparent;
            overflow: hidden;
            opacity: 0.9;
        }

        .game-card-row:hover {
            background-color: #2a475e; 
            opacity: 1;
            border-color: rgba(102, 192, 244, 0.3);
            transform: scale(1.01);
            z-index: 5;
        }

        .list-img {
            width: 120px; /* Compact image */
            height: 100%;
            flex-shrink: 0;
        }
        .list-img img { width: 100%; height: 100%; object-fit: cover; }

        .list-info {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 15px;
        }

        .list-title-block { display: flex; flex-direction: column; justify-content: center; }
        .list-game-title { font-size: 1rem; color: #fff; font-weight: 500; }
        .list-tags { font-size: 0.75rem; color: #627d92; margin-top: 2px; }
        .game-card-row:hover .list-tags { color: #9eb3c2; }

        .list-meta-block { display: flex; align-items: center; gap: 15px; }
        .release-date { font-size: 0.8rem; color: #56707f; }

        /* --- PRICE BADGES --- */
        .discount-block {
            display: flex;
            align-items: center;
            background: #344654;
            padding: 2px;
            height: 34px;
        }
        .discount-pct {
            background: #4c6b22;
            color: #a4d007;
            padding: 0 6px;
            font-size: 14px;
            font-weight: 700;
            height: 100%;
            display: flex; align-items: center;
        }
        .discount-prices {
            background: #344654;
            padding: 0 8px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            line-height: 1.1;
            text-align: right;
            height: 100%;
        }
        .original-price { text-decoration: line-through; color: #738895; font-size: 11px; }
        .final-price { color: #acdbf5; font-size: 13px; }

        .regular-price-text {
            color: #fff;
            font-size: 13px;
            padding: 0 10px;
        }

        /* =========================================
           5. LOAD MORE BUTTON
           ========================================= */
        .btn-load-more {
            background-color: transparent;
            color: #66c0f4;
            border: 1px solid #66c0f4;
            padding: 8px 30px;
            border-radius: 2px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-block;
            cursor: pointer;
            margin-top: 20px;
        }
        .btn-load-more:hover { background-color: #66c0f4; color: #fff; }

        /* =========================================
           6. MOBILE RESPONSIVENESS
           ========================================= */
        @media (max-width: 992px) {
            /* Move sidebar to top or make collapsible (stacking for simplicity) */
            .filter-box { margin-bottom: 20px; }
            
            .sort-bar-container {
                flex-direction: column;
                gap: 10px;
                align-items: stretch;
            }
            .search-input { width: 100%; }

            .game-card-row { height: auto; padding: 10px; }
            .list-info { flex-direction: row; flex-wrap: wrap; padding: 0 0 0 15px; }
            .list-title-block { width: 60%; }
            .list-meta-block { width: 40%; justify-content: flex-end; }
            .release-date { display: none; } /* Hide date on mobile */
        }
        
        @media (max-width: 576px) {
            .list-title-block { width: 100%; margin-bottom: 5px; }
            .list-meta-block { width: 100%; justify-content: space-between; }
        }
        
    </style>
</head>

<body>
    <?php include 'section-navbar.php'; ?>

    <div class="container browse-container">
        
        <div class="d-flex justify-content-between align-items-end">
            <h1 class="page-title" id="dynamic-title">Under $10 USD</h1>
            <a href="index.php#under" class="text-info text-decoration-none mb-4" style="font-size: 0.9rem;">&larr; Back to Featured</a>
        </div>

        <div class="row">
            
            <div class="col-lg-3 order-lg-1 order-2">
                
                <div class="filter-box">
                    <div class="filter-header">Price Cap</div>
                    <div class="price-toggle-group">
                        <input type="radio" class="btn-check" name="priceLimit" id="cap10" value="10" checked>
                        <label class="price-toggle-label" for="cap10">Under $10</label>

                        <input type="radio" class="btn-check" name="priceLimit" id="cap5" value="5">
                        <label class="price-toggle-label" for="cap5">Under $5</label>
                    </div>
                </div>

                <div class="filter-box">
                    <div class="filter-header">Narrow by Tag</div>
                    <div id="tag-filters">
                        <!-- Genres loaded dynamically -->
                    </div>
                </div>

            </div>

            <div class="col-lg-9 order-lg-2 order-1">
                
                <div class="sort-bar-container">
                    <div class="d-flex align-items-center gap-2">
                        <span style="color: #8f98a0; font-size: 0.9rem;">Sort by:</span>
                        <select id="sort-select" class="styled-select">
                            <option value="lowest">Price: Lowest First</option>
                            <option value="highest">Price: Highest First</option>
                            <option value="name">Name (A-Z)</option>
                            <option value="newest">Release Date</option>
                        </select>
                    </div>
                    <input type="text" id="search-input" class="search-input" placeholder="Search titles...">
                </div>

                <div id="game-list-container">
                    </div>

                <div class="text-center">
                    <button id="load-more-btn" class="btn-load-more" style="display: none;">Load More</button>
                    <div id="results-count" class="text-muted mt-2" style="font-size: 0.8rem;"></div>
                </div>

            </div>
        </div>
    </div>

    <div class="section-spacer"></div>

    <?php include 'section-footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // --- DOM ELEMENTS ---
        const listContainer = document.getElementById('game-list-container');
        const sortSelect = document.getElementById('sort-select');
        const searchInput = document.getElementById('search-input');
        const priceRadios = document.querySelectorAll('input[name="priceLimit"]');
        const loadMoreBtn = document.getElementById('load-more-btn');
        const resultsCount = document.getElementById('results-count');
        const dynamicTitle = document.getElementById('dynamic-title');
        const tagFiltersContainer = document.getElementById('tag-filters');

        // --- STATE ---
        let currentPriceLimit = 10; // Default
        let itemsToShow = 10; // Pagination limit
        let gamesData = [];
        let filteredData = []; // Stores currently filtered results
        let tagCheckboxes = [];

        // --- LOAD DATA FROM DATABASE ---
        async function loadData() {
            try {
                const response = await fetch(`../php_backend/get_cheap_games.php?max_price=${currentPriceLimit}`);
                const data = await response.json();

                if (data.success) {
                    gamesData = data.games;
                    
                    // Load genres and tags as filters
                    tagFiltersContainer.innerHTML = '';
                    
                    // Add genres
                    if (data.filter_genres && data.filter_genres.length > 0) {
                        data.filter_genres.forEach(genre => {
                            const label = document.createElement('label');
                            label.className = 'filter-option';
                            label.innerHTML = `<input type="checkbox" value="${genre.genre_name}" data-type="genre"> ${genre.genre_name}`;
                            tagFiltersContainer.appendChild(label);
                        });
                    }
                    
                    // Add tags
                    if (data.filter_tags && data.filter_tags.length > 0) {
                        data.filter_tags.forEach(tag => {
                            const label = document.createElement('label');
                            label.className = 'filter-option';
                            label.innerHTML = `<input type="checkbox" value="${tag}" data-type="tag"> ${tag}`;
                            tagFiltersContainer.appendChild(label);
                        });
                    }
                    
                    // Re-attach event listeners
                    tagCheckboxes = tagFiltersContainer.querySelectorAll('input');
                    tagCheckboxes.forEach(cb => cb.addEventListener('change', updateData));
                    
                    updateData();
                } else {
                    listContainer.innerHTML = `<div class="text-center py-5 text-danger">Error loading games: ${data.message}</div>`;
                }
            } catch (error) {
                console.error('Error:', error);
                listContainer.innerHTML = `<div class="text-center py-5 text-danger">Error loading games. Please try again.</div>`;
            }
        }

        // --- RENDER FUNCTION ---
        function renderList() {
            listContainer.innerHTML = '';
            
            const visibleItems = filteredData.slice(0, itemsToShow);

            if (visibleItems.length === 0) {
                listContainer.innerHTML = `<div class="text-center py-5 text-muted">No games found for this criteria.</div>`;
                loadMoreBtn.style.display = 'none';
                resultsCount.innerText = '';
                return;
            }

            visibleItems.forEach(game => {
                const dateStr = new Date(game.release_date).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
                const tags = game.tags.length > 0 ? game.tags.join(', ') : 'No tags';

                const priceHTML = `<div class="regular-price-text">$${parseFloat(game.price).toFixed(2)}</div>`;

                const html = `
                <a href="game-details.php?game_id=${game.game_id}" class="game-card-row">
                    <div class="list-img">
                        <img src="../${game.thumbnail_image}" alt="${game.title}" onerror="this.src='https://placehold.co/120x70/1b2838/fff?text=Game'">
                    </div>
                    <div class="list-info">
                        <div class="list-title-block">
                            <div class="list-game-title">${game.title}</div>
                            <div class="list-tags">${tags}</div>
                        </div>
                        <div class="list-meta-block">
                            <div class="release-date d-none d-md-block">${dateStr}</div>
                            ${priceHTML}
                        </div>
                    </div>
                </a>
                `;
                listContainer.innerHTML += html;
            });

            if (itemsToShow >= filteredData.length) {
                loadMoreBtn.style.display = 'none';
                resultsCount.innerText = `Showing all ${filteredData.length} results`;
            } else {
                loadMoreBtn.style.display = 'inline-block';
                resultsCount.innerText = `Showing ${visibleItems.length} of ${filteredData.length} results`;
            }
        }

        // --- CORE LOGIC: Filter & Sort ---
        function updateData() {
            const searchTerm = searchInput.value.toLowerCase();
            const sortMode = sortSelect.value;
            
            // Separate genre and tag filters
            const selectedGenres = [];
            const selectedTags = [];
            
            Array.from(tagCheckboxes).filter(c => c.checked).forEach(checkbox => {
                const type = checkbox.getAttribute('data-type');
                const value = checkbox.value;
                if (type === 'genre') {
                    selectedGenres.push(value);
                } else if (type === 'tag') {
                    selectedTags.push(value);
                }
            });

            filteredData = gamesData.filter(game => {
                // Search filter
                if (searchTerm && !game.title.toLowerCase().includes(searchTerm)) return false;
                
                // Genre filter - check if game has any of the selected genres
                if (selectedGenres.length > 0) {
                    const hasGenre = game.genres && game.genres.some(g => selectedGenres.includes(g));
                    if (!hasGenre) return false;
                }
                
                // Tag filter - check if game has any of the selected tags
                if (selectedTags.length > 0) {
                    const hasTag = game.tags && game.tags.some(t => selectedTags.includes(t));
                    if (!hasTag) return false;
                }
                
                return true;
            });

            filteredData.sort((a, b) => {
                const priceA = parseFloat(a.price);
                const priceB = parseFloat(b.price);
                
                if (sortMode === 'lowest') return priceA - priceB;
                if (sortMode === 'highest') return priceB - priceA;
                if (sortMode === 'newest') return new Date(b.release_date) - new Date(a.release_date);
                if (sortMode === 'name') return a.title.localeCompare(b.title);
                return 0;
            });

            if(filteredData.length <= 10) {
                itemsToShow = 10;
            }
            renderList();
        }

        // --- EVENT LISTENERS ---
        priceRadios.forEach(radio => {
            radio.addEventListener('change', (e) => {
                currentPriceLimit = parseInt(e.target.value);
                dynamicTitle.innerText = `Under $${currentPriceLimit} USD`;
                itemsToShow = 10;
                loadData();
            });
        });

        sortSelect.addEventListener('change', updateData);
        searchInput.addEventListener('input', updateData);
        
        loadMoreBtn.addEventListener('click', () => {
            itemsToShow += 10;
            renderList();
        });

        // --- INITIALIZATION WITH URL PARAMETER ---
        function init() {
            const urlParams = new URLSearchParams(window.location.search);
            const priceParam = urlParams.get('price') || urlParams.get('max_price');

            if (priceParam) {
                const priceVal = parseInt(priceParam);
                if (priceVal === 5 || priceVal === 10) {
                    currentPriceLimit = priceVal;
                    
                    const targetRadio = document.querySelector(`input[name="priceLimit"][value="${priceVal}"]`);
                    if (targetRadio) targetRadio.checked = true;

                    dynamicTitle.innerText = `Under $${priceVal} USD`;
                }
            }

            loadData();
        }

        init();

    </script>
</body>

</html>