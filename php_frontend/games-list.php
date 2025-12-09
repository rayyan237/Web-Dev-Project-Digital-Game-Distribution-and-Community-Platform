<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Games | Professional Distro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    
    <style>
    :root {
        --steam-dark: #1b2838;
        --steam-darker: #171a21;
        --steam-light: #2a475e;
        --steam-blue: #66c0f4;
        --steam-text: #c6d4df;
        --steam-green: #4c6b22; /* Added your green */
    }

    body {
        background: linear-gradient(to bottom, var(--steam-darker) 0%, var(--steam-dark) 100%);
        color: var(--steam-text);
        min-height: 100vh;
        padding-bottom: 50px;
    }

    .page-header {
        background: rgba(0,0,0,0.3);
        padding: 30px 0;
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 32px;
        color: #fff;
        font-weight: normal;
        margin: 0;
    }

    /* --- Filter Section Styles --- */
    .filters-section {
        background: rgba(0,0,0,0.2);
        padding: 20px;
        border-radius: 4px;
        margin-bottom: 30px;
    }

    .filter-group {
        margin-bottom: 15px;
    }

    .filter-group label {
        display: block;
        color: var(--steam-blue);
        margin-bottom: 5px;
        font-size: 13px;
        text-transform: uppercase;
    }

    .filter-group input,
    .filter-group select {
        width: 100%;
        background: #32414f;
        border: 1px solid #417a9b;
        color: #fff;
        padding: 8px 12px;
        border-radius: 3px;
        font-size: 14px;
    }

    .filter-group input:focus,
    .filter-group select:focus {
        outline: none;
        border-color: var(--steam-blue);
    }

    .btn-filter {
        background: linear-gradient(to bottom, #47bfff 0%, #1a44c2 100%);
        border: none;
        color: #fff;
        padding: 10px 20px;
        border-radius: 3px;
        cursor: pointer;
        font-size: 14px;
        transition: 0.3s;
    }

    .btn-filter:hover {
        background: linear-gradient(to bottom, #67c1f5 0%, #417a9b 100%);
    }

    .btn-reset {
        background: #417a9b;
        border: none;
        color: #fff;
        padding: 10px 20px;
        border-radius: 3px;
        cursor: pointer;
        font-size: 14px;
        margin-left: 10px;
    }

    .btn-reset:hover {
        background: #4e95bd;
    }

    /* --- Results Header --- */
    .results-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 10px 0;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .results-count {
        color: var(--steam-blue);
        font-size: 14px;
    }

    /* --- Game Card Styles (Layout Fixes Applied Here) --- */
    .game-card {
        background: rgba(0,0,0,0.3);
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 20px;
        transition: transform 0.2s, box-shadow 0.2s;
        cursor: pointer;
        text-decoration: none;
        display: block;
        color: inherit;
        /* Removed fixed height to allow expansion */
        height: auto; 
    }

    .game-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.5);
    }

    .game-card-horizontal {
        display: flex;
        /* FIX 1: Changed fixed height to min-height so it can grow */
        min-height: 140px; 
        height: auto;
    }

    .game-card-img {
        width: 250px;
        /* FIX 2: Height auto and align-self stretch to match text height */
        min-height: 140px; 
        height: auto;
        object-fit: cover;
        flex-shrink: 0;
        align-self: stretch; 
    }

    .game-card-body {
        padding: 15px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .game-card-title {
        font-size: 18px;
        color: #fff;
        margin: 0 0 5px 0;
        font-weight: normal;
    }

    .game-card-developer {
        font-size: 12px;
        color: #8091a2;
        margin-bottom: 8px;
    }

    .game-card-description {
        font-size: 13px;
        color: var(--steam-text);
        line-height: 1.4;
        margin-bottom: 15px; /* Added slightly more margin */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Shows max 2 lines */
        -webkit-box-orient: vertical;
    }

    .game-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto; /* Pushes footer to bottom */
    }

    .game-genres {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }

    .genre-badge {
        background: rgba(102, 192, 244, 0.2);
        color: var(--steam-blue);
        padding: 2px 8px;
        border-radius: 3px;
        font-size: 11px;
    }

    /* FIX 3: Updated Price Button Style */
    .game-price {
        background-color: #4c6b22;
        font-size: 13px;
        padding: 4px 12px;
        color: white;
        border-radius: 2px;
        white-space: nowrap;
        font-weight: bold;
    }

    .game-rating {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 13px;
        color: #FFD700;
    }

    /* --- Loading & Empty States --- */
    .loading-container {
        text-align: center;
        padding: 50px;
        color: var(--steam-blue);
    }

    .no-results {
        text-align: center;
        padding: 80px 20px;
        color: var(--steam-text);
    }

    .no-results i {
        font-size: 64px;
        color: #417a9b;
        margin-bottom: 20px;
    }

    /* --- Pagination --- */
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 30px;
        gap: 10px;
    }

    .page-btn {
        background: #417a9b;
        border: none;
        color: #fff;
        padding: 10px 20px;
        border-radius: 3px;
        cursor: pointer;
        font-size: 14px;
    }

    .page-btn:hover:not(:disabled) {
        background: #4e95bd;
    }

    .page-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .page-btn.active {
        background: linear-gradient(to bottom, #47bfff 0%, #1a44c2 100%);
    }

    /* --- Mobile Responsive --- */
    @media (max-width: 768px) {
        .game-card-horizontal {
            flex-direction: column;
            height: auto;
        }

        .game-card-img {
            width: 100%;
            height: 200px; /* Fixed height for mobile view image */
            min-height: 0;
        }
        
        .game-card-body {
            /* On mobile, give a bit more space since vertical space is cheaper */
            padding: 20px;
        }
    }
</style>
</head>
<body>

<?php include 'section-navbar.php'; ?>

<div class="page-header">
    <div class="container">
        <h1 class="page-title">Browse Games</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="filters-section">
                <h5 style="color: #fff; margin-bottom: 20px;">
                    <i class="fas fa-filter"></i> Filters
                </h5>
                
                <div class="filter-group">
                    <label>Search</label>
                    <input type="text" id="searchQuery" placeholder="Search games...">
                </div>

                <div class="filter-group">
                    <label>Genre</label>
                    <select id="genreFilter">
                        <option value="">All Genres</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Min Price ($)</label>
                    <input type="number" id="minPrice" min="0" step="0.01" placeholder="0.00">
                </div>

                <div class="filter-group">
                    <label>Max Price ($)</label>
                    <input type="number" id="maxPrice" min="0" step="0.01" placeholder="Any">
                </div>

                <div class="filter-group">
                    <label>Sort By</label>
                    <select id="sortOrder">
                        <option value="title_asc">Title (A-Z)</option>
                        <option value="title_desc">Title (Z-A)</option>
                        <option value="price_asc">Price (Low to High)</option>
                        <option value="price_desc">Price (High to Low)</option>
                        <option value="rating_desc">Rating (High to Low)</option>
                        <option value="release_desc">Release Date (Newest)</option>
                        <option value="release_asc">Release Date (Oldest)</option>
                    </select>
                </div>

                <button class="btn-filter" onclick="applyFilters()">
                    <i class="fas fa-search"></i> Apply Filters
                </button>
                <button class="btn-reset" onclick="resetFilters()">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>
        </div>

        <div class="col-md-9">
            <div class="results-header">
                <div class="results-count" id="resultsCount">Loading...</div>
            </div>

            <div id="gamesContainer">
                <div class="loading-container">
                    <div class="spinner-border text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3">Loading games...</p>
                </div>
            </div>

            <div class="pagination-container" id="paginationContainer"></div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let currentPage = 0;
    const gamesPerPage = 10;

    // Load genres on page load
    async function loadGenres() {
        try {
            const response = await fetch('../php_backend/get_categories.php');
            const data = await response.json();
            
            if (data.success && data.categories) {
                const select = document.getElementById('genreFilter');
                data.categories.forEach(cat => {
                    const option = document.createElement('option');
                    option.value = cat.genre_id;
                    option.textContent = cat.genre_name;
                    select.appendChild(option);
                });
            }
        } catch (error) {
            console.error('Error loading genres:', error);
        }
    }

    // Parse URL parameters
    function getUrlParams() {
        const params = new URLSearchParams(window.location.search);
        return {
            q: params.get('q') || '',
            genre: params.get('genre') || '',
            min_price: params.get('min_price') || '',
            max_price: params.get('max_price') || '',
            sort: params.get('sort') || 'title_asc',
            page: parseInt(params.get('page')) || 0
        };
    }

    // Set filters from URL
    function setFiltersFromUrl() {
        const params = getUrlParams();
        document.getElementById('searchQuery').value = params.q;
        document.getElementById('genreFilter').value = params.genre;
        document.getElementById('minPrice').value = params.min_price;
        document.getElementById('maxPrice').value = params.max_price;
        document.getElementById('sortOrder').value = params.sort;
        currentPage = params.page;
    }

    // Load games
    async function loadGames() {
        const query = document.getElementById('searchQuery').value;
        const genre = document.getElementById('genreFilter').value;
        const minPrice = document.getElementById('minPrice').value;
        const maxPrice = document.getElementById('maxPrice').value;
        const sort = document.getElementById('sortOrder').value;
        const offset = currentPage * gamesPerPage;

        const params = new URLSearchParams({
            limit: gamesPerPage,
            offset: offset,
            sort: sort
        });

        if (query) params.append('q', query);
        if (genre) params.append('genre', genre);
        if (minPrice) params.append('min_price', minPrice);
        if (maxPrice) params.append('max_price', maxPrice);

        // Update URL
        const newUrl = `${window.location.pathname}?${params.toString()}&page=${currentPage}`;
        window.history.pushState({}, '', newUrl);

        try {
            const response = await fetch(`../php_backend/search_games.php?${params.toString()}`);
            const data = await response.json();

            if (data.success) {
                displayGames(data.games, data.total);
                updatePagination(data.total);
            } else {
                document.getElementById('gamesContainer').innerHTML = `
                    <div class="no-results">
                        <i class="fas fa-exclamation-triangle"></i>
                        <h3>Error Loading Games</h3>
                        <p>${data.message}</p>
                    </div>
                `;
            }
        } catch (error) {
            console.error('Error loading games:', error);
            document.getElementById('gamesContainer').innerHTML = `
                <div class="no-results">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h3>Error Loading Games</h3>
                    <p>Please try again later.</p>
                </div>
            `;
        }
    }

    // Display games
    function displayGames(games, total) {
        const container = document.getElementById('gamesContainer');
        const resultsCount = document.getElementById('resultsCount');

        resultsCount.textContent = `Showing ${currentPage * gamesPerPage + 1}-${Math.min((currentPage + 1) * gamesPerPage, total)} of ${total} games`;

        if (games.length === 0) {
            container.innerHTML = `
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <h3>No Games Found</h3>
                    <p>Try adjusting your search or filters.</p>
                </div>
            `;
            return;
        }

        container.innerHTML = games.map(game => `
            <a href="game-details.php?game_id=${game.game_id}" class="game-card">
                <div class="game-card-horizontal">
                    <img src="../${game.header_image}" alt="${game.title}" class="game-card-img">
                    <div class="game-card-body">
                        <div>
                            <h3 class="game-card-title">${game.title}</h3>
                            <div class="game-card-developer">${game.developer_name}</div>
                            <div class="game-card-description">${game.description}</div>
                        </div>
                        <div class="game-card-footer">
                            <div>
                                <div class="game-genres">
                                    ${game.genres.map(g => `<span class="genre-badge">${g}</span>`).join('')}
                                </div>
                                ${game.average_rating ? `
                                    <div class="game-rating mt-2">
                                        <i class="fas fa-star"></i>
                                        <span>${game.average_rating}/5</span>
                                    </div>
                                ` : ''}
                            </div>
                            <div class="game-price">$${parseFloat(game.price).toFixed(2)}</div>
                        </div>
                    </div>
                </div>
            </a>
        `).join('');
    }

    // Update pagination
    function updatePagination(total) {
        const totalPages = Math.ceil(total / gamesPerPage);
        const container = document.getElementById('paginationContainer');

        if (totalPages <= 1) {
            container.innerHTML = '';
            return;
        }

        let pagination = '';

        // Previous button
        pagination += `
            <button class="page-btn" onclick="changePage(${currentPage - 1})" ${currentPage === 0 ? 'disabled' : ''}>
                <i class="fas fa-chevron-left"></i> Previous
            </button>
        `;

        // Page numbers (show max 5 pages)
        let startPage = Math.max(0, currentPage - 2);
        let endPage = Math.min(totalPages - 1, startPage + 4);
        startPage = Math.max(0, endPage - 4);

        for (let i = startPage; i <= endPage; i++) {
            pagination += `
                <button class="page-btn ${i === currentPage ? 'active' : ''}" onclick="changePage(${i})">
                    ${i + 1}
                </button>
            `;
        }

        // Next button
        pagination += `
            <button class="page-btn" onclick="changePage(${currentPage + 1})" ${currentPage >= totalPages - 1 ? 'disabled' : ''}>
                Next <i class="fas fa-chevron-right"></i>
            </button>
        `;

        container.innerHTML = pagination;
    }

    // Change page
    function changePage(page) {
        currentPage = page;
        loadGames();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Apply filters
    function applyFilters() {
        currentPage = 0;
        loadGames();
    }

    // Reset filters
    function resetFilters() {
        document.getElementById('searchQuery').value = '';
        document.getElementById('genreFilter').value = '';
        document.getElementById('minPrice').value = '';
        document.getElementById('maxPrice').value = '';
        document.getElementById('sortOrder').value = 'title_asc';
        currentPage = 0;
        loadGames();
    }

    // Enter key on search
    document.getElementById('searchQuery').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            applyFilters();
        }
    });

    // Initialize page
    window.addEventListener('DOMContentLoaded', function() {
        loadGenres();
        setFiltersFromUrl();
        loadGames();
    });
</script>

</body>
</html>
