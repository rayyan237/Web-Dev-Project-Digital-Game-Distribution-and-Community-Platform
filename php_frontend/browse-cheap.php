<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Steam: Budget Gaming</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Motiva+Sans:wght@300;400;500;700;900&family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        /* =========================================
           1. GLOBAL THEME
           ========================================= */
        body {
            background: #1b2838;
            color: #c7d5e0;
            font-family: "Motiva Sans", "Roboto", sans-serif;
            padding-bottom: 50px;
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
           2. MAIN NAVBAR (UPPER)
           ========================================= */
        .main-navbar {
            background: #171a21 !important;
        }

        .navbar-upper-border {
            border-bottom: 1px solid #2f3642;
        }

        /* Desktop Link Styles */
        .nav-link-upper {
            color: #c6d4df !important;
            transition: color 0.2s;
        }

        .nav-link-upper:hover {
            color: #fff !important;
        }

        /* Desktop Underline Effect */
        @media (min-width: 768px) {
            .nav-link-upper {
                position: relative;
                padding-bottom: 15px !important; /* 0.5rem + 2px + 5px */
                padding-top: 0.5rem !important;
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }

            .nav-link-upper::after {
                content: '';
                position: absolute;
                bottom: 5px;
                left: 0;
                width: 0;
                height: 2px;
                background-color: #fff;
                transition: width 0.2s ease-in-out;
            }

            .nav-link-upper:hover::after {
                width: 100%;
            }
        }

        /* Brand Logo */
        @media (max-width: 767.98px) {
            .navbar-brand-desktop {
                display: none !important;
            }
        }

        /* Login Button (Specific to Header) */
        .login-btn {
            background: rgba(0, 200, 255, 0.1);
            border: 1px solid rgba(0, 200, 255, 0.4);
            backdrop-filter: blur(6px);
            color: #00b4d8;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            box-shadow: none;
        }

        .login-btn:hover {
            background: rgba(0, 200, 255, 0.1);
            border-color: rgba(0, 200, 255, 0.4);
            color: #00b4d8;
            backdrop-filter: blur(6px);
            box-shadow: 0 0 15px rgba(0, 180, 216, 0.6);
        }

        /* =========================================
           3. SECONDARY NAVBAR (LOWER)
           ========================================= */
        .secondary-navbar {
            background: #1b2838 !important; 
            z-index: 1020;
        }

        /* Desktop Sticky Behavior */
        @media (min-width: 768px) {
            .secondary-navbar {
                position: sticky;
                top: 0;
            }
        }

        /* Links */
        .subnav-link {
            font-weight: 500;
            font-size: 0.95rem;
            color: #c6d4df !important;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .subnav-link:hover {
            color: #fff !important;
        }

        /* Dropdowns */
        .custom-dropdown-menu {
            background: #1b2838 !important;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .5);
        }

        .custom-dropdown-item {
            color: #c6d4df !important;
            padding: .5rem 1rem;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .custom-dropdown-item:hover {
            background: #2a475e !important;
            color: #fff !important;
        }

        /* Mobile Lists */
        .mobile-subnav-list .subnav-link,
        .mobile-subnav-list .dropdown-toggle {
            font-size: 0.85rem;
            padding: 0.5rem 0.5rem !important;
        }

        /* Mobile Arrow Rotation Logic */
        .mobile-subnav-list .dropdown-toggle::after {
            content: "";
            display: inline-block;
            width: 0;
            height: 0;
            margin-left: .3rem;
            vertical-align: middle;
            border-top: 5px solid #c6d4df;
            border-right: 4px solid transparent;
            border-left: 4px solid transparent;
            transition: transform .2s;
        }

        .mobile-subnav-list .dropdown-toggle.show::after {
            transform: rotate(180deg);
        }

        /* Visibility Toggles */
        @media (min-width: 768px) {
            .mobile-subnav-list { display: none !important; }
            .mobile-search-container { display: none !important; }
        }

        @media (max-width: 767.98px) {
            .desktop-subnav-list { display: none !important; }
            .desktop-search-form { display: none !important; }
        }

        /* =========================================
           4. SEARCH BAR (Specific)
           ========================================= */
        .header-search-group {
            border: 1px solid #1a2035;
            border-radius: 0.375rem;
            transition: border-color 0.3s, box-shadow 0.3s;
            height: 40px;
        }

        .header-search-group:focus-within {
            border-color: #00f0ff;
            box-shadow: 0 0 15px rgba(0, 240, 255, 0.6);
        }

        /* Desktop width specific */
        @media (min-width: 768px) {
            .desktop-search-form { width: 360px; }
        }

        .header-search-input {
            background: rgba(255, 255, 255, 0.05);
            border: none;
            color: #fff;
            height: 100%;
            border-radius: 0.375rem 0 0 0.375rem !important;
        }

        .header-search-input:focus {
            background: rgba(255, 255, 255, 0.1);
            box-shadow: none;
            color: #fff;
        }

        .header-search-input::placeholder {
            color: #8a94a6 !important;
            opacity: 1;
        }

        .header-search-btn {
            background: #00f0ff;
            color: #0a0f1a;
            border: none;
            width: 50px;
            height: 100%;
            font-weight: 700;
            transition: background 0.3s, box-shadow 0.3s, color 0.3s;
            border-radius: 0 0.375rem 0.375rem 0 !important;
        }

        .header-search-btn:hover {
            background: #fff;
            color: #0a0f1a;
            box-shadow: 0 0 20px #00f0ff;
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
        /* =========================================
           2. MAIN FOOTER SECTION
           ========================================= */
        
        /* Main Container Background */
        .main-footer-section {
            /* Hardcoded gradient values previously in variables */
            background-image: radial-gradient(ellipse at 70% 120%, #1a2035 0%, #0a0f1a 60%);
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        /* Branding */
        .footer-brand-heading {
            font-size: 2.25rem;
            font-weight: 700;
            color: #fff;
            margin: 0;
            text-shadow: 0 0 10px rgba(0, 240, 255, 0.5);
        }

        .footer-tagline {
            color: #8a94a6;
        }

        /* =========================================
           3. NEWSLETTER FORM (Specific to Footer)
           ========================================= */
        
        .newsletter-label {
            font-weight: 600;
            color: #00f0ff; /* Cyan Accent */
        }

        .newsletter-input-group {
            border: 1px solid #1a2035;
            border-radius: 0.375rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .newsletter-input-group:focus-within {
            border-color: #00f0ff;
            box-shadow: 0 0 15px rgba(0, 240, 255, 0.6);
        }

        .newsletter-input {
            background: rgba(255, 255, 255, 0.05) !important;
            color: #fff !important;
            border: 0 !important;
        }

        .newsletter-input:focus {
            box-shadow: none !important;
        }

        /* Submit Button (Formerly .btn-accent-glow) */
        .newsletter-submit-btn {
            background: #00f0ff;
            color: #0a0f1a;
            font-size: 1.25rem;
            font-weight: 700;
            transition: background 0.3s, box-shadow 0.3s, color 0.3s;
            border: none;
        }

        .newsletter-submit-btn:hover {
            background: #fff;
            color: #0a0f1a;
            box-shadow: 0 0 20px #00f0ff;
        }

        /* =========================================
           4. NAVIGATION LINKS
           ========================================= */
        
        .footer-nav-link {
            color: #8a94a6;
            position: relative;
            padding-bottom: 5px !important;
            font-weight: 600;
            transition: color 0.3s;
        }

        .footer-nav-link:hover {
            color: #fff;
        }

        /* Animated underline (Hardcoded Purple) */
        .footer-nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0.5rem;
            width: 0;
            height: 2px;
            background: #a040ff; /* Purple Accent */
            transition: width 0.3s ease-out;
        }
        
        .footer-nav-link:hover::after {
             width: calc(100% - 1rem);
        }
        
        @media (min-width: 768px) {
             .footer-nav-link.px-md-3:hover::after {
                width: calc(100% - 2rem);
             }
             .footer-nav-link.px-md-3::after {
                left: 1rem;
             }
        }

        /* =========================================
           5. SOCIAL ICONS
           ========================================= */
        
        .footer-social-icon {
            color: #8a94a6;
            font-size: 1.5rem;
            transition: color 0.3s, transform 0.3s, text-shadow 0.3s;
            text-decoration: none;
        }

        .footer-social-icon:hover {
            transform: scale(1.1) translateY(-2px);
        }

        /* Specific Hover Colors */
        .icon-discord:hover {
            color: #5865F2;
            text-shadow: 0 0 10px #5865F2;
        }
        .icon-reddit:hover {
            color: #FF4500;
            text-shadow: 0 0 10px #FF4500;
        }
        .icon-youtube:hover {
            color: #FF0000;
            text-shadow: 0 0 10px #FF0000;
        }
        .icon-twitter:hover {
            color: #1DA1F2;
            text-shadow: 0 0 10px #1DA1F2;
        }
        .icon-tiktok:hover {
            color: #fff;
            text-shadow: 0 0 10px #00f0ff, 0 0 15px #fe2c55;
        }

        /* =========================================
           6. BOTTOM BAR & ANIMATION
           ========================================= */
        
        .footer-bottom-bar {
            position: relative;
            background-color: #000;
        }

        /* Animated Border (Formerly .util-glow-line-animated) */
        .footer-glow-border {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg,
                    transparent,
                    #00f0ff,
                    #a040ff,
                    transparent);
            background-size: 300% 100%;
            animation: glow-animation 8s linear infinite;
        }

        @keyframes glow-animation {
            0% { background-position: 150% 0; }
            100% { background-position: -150% 0; }
        }

        .footer-copyright {
            color: #8a94a6;
        }

        .footer-legal-link {
            color: #8a94a6;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-legal-link:hover {
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php include 'navbar_include.php'; ?>

    <div class="container browse-container">
        
        <div class="d-flex justify-content-between align-items-end">
            <h1 class="page-title" id="dynamic-title">Under $10 USD</h1>
            <a href="under-10.php" class="text-info text-decoration-none mb-4" style="font-size: 0.9rem;">&larr; Back to Featured</a>
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

    <footer data-bs-theme="dark">

        <div class="main-footer-section">
            <div class="container">

                <div class="row align-items-center gy-4">
                    <div class="col-lg-6">
                        <div>
                            <h2 class="footer-brand-heading">[Game Platform Name]</h2>
                            <p class="footer-tagline mb-0">Where Worlds Collide.</p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div>
                            <label for="newsletter-email" class="newsletter-label mb-2">Join our Newsletter</label>
                            <div class="newsletter-input-group input-group">
                                <input type="email" id="newsletter-email" class="newsletter-input form-control"
                                    placeholder="your.email@universe.com" required>
                                <button class="newsletter-submit-btn btn" type="submit" aria-label="Subscribe">→</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center border-top border-secondary-subtle mt-5 pt-5">
                    
                    <nav class="nav flex-wrap justify-content-center">
                        <a class="footer-nav-link nav-link px-2 px-md-3" href="index.php">Store</a>
                        <a class="footer-nav-link nav-link px-2 px-md-3" href="about.php">About</a>
                        <a class="footer-nav-link nav-link px-2 px-md-3" href="#">Community</a>
                        <a class="footer-nav-link nav-link px-2 px-md-3" href="support.php">Support</a>
                        <a class="footer-nav-link nav-link px-2 px-md-3" href="#">News</a>
                        <a class="footer-nav-link nav-link px-2 px-md-3" href="#">Developers</a>
                    </nav>

                    <div class="d-flex gap-4 mt-4 mt-md-0">
                        <a href="#" aria-label="Discord" class="footer-social-icon icon-discord fab fa-discord"></a>
                        <a href="#" aria-label="Reddit" class="footer-social-icon icon-reddit fab fa-reddit-alien"></a>
                        <a href="#" aria-label="YouTube" class="footer-social-icon icon-youtube fab fa-youtube"></a>
                        <a href="#" aria-label="Twitter" class="footer-social-icon icon-twitter fab fa-twitter"></a>
                        <a href="#" aria-label="TikTok" class="footer-social-icon icon-tiktok fab fa-tiktok"></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom-bar">
            <div class="footer-glow-border"></div>
            
            <div class="container">
                <div class="row align-items-center py-3 gy-2">
                    <div class="col-md-6 text-center text-md-start">
                        <small class="footer-copyright">© 2025 [Game Platform Name]. All Rights Reserved.</small>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3 gap-md-4 justify-content-center justify-content-md-end">
                            <a class="footer-legal-link" href="#"><small>Terms of Service</small></a>
                            <a class="footer-legal-link" href="#"><small>Privacy Policy</small></a>
                            <a class="footer-legal-link" href="#"><small>Refund Policy</small></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

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