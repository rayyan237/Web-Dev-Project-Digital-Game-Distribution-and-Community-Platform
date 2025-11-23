<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Steam: Browse Special Offers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Motiva+Sans:wght@300;400;500;700;900&family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        /* =========================================
           1. BASE STYLES 
           ========================================= */
        body {
            background: #1b2838 !important;
            color: #fff;
            overflow-x: hidden;
            font-family: "Motiva Sans", "Roboto", "Poppins", sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding-bottom: 80px;
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
           2. BROWSE PAGE SPECIFIC STYLES
           ========================================= */
        .browse-container {
            background-color: #1b2838;
            padding: 40px 0;
            flex-grow: 1;
        }

        .special-offers-heading {
            font-family: "Motiva Sans", "Arial Black", sans-serif;
            font-size: 3rem;
            font-weight: 900;
            color: #fff;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: center;
            text-shadow: 0px 2px 5px #000;
        }

        /* ===============================
           CUSTOM STEAM CAROUSEL STYLES
           =============================== */
        .steam-carousel {
            max-width: 1600px;
            margin: 0 auto 50px auto;
            position: relative;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
            /* Ensure swipe gestures work well */
            touch-action: pan-y; 
        }

        .main-capsule {
            display: flex;
            background-color: #0f1219;
            width: 100%;
            height: 500px;
        }

        .capsule-video-col {
            width: 65%;
            position: relative;
            background: #000;
        }

        .capsule-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .capsule-info-col {
            width: 35%;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: linear-gradient(to bottom, #0f1219 0%, #14181f 100%);
        }

        .capsule-small-img {
            width: 100%;
            height: auto;
            border-radius: 4px;
            margin-bottom: 20px;
            margin-top: -10px;
        }

        .capsule-desc-box {
            font-size: 13px;
            color: #c6d4df;
            margin-bottom: 10px;
            flex-grow: 1;
        }

        .capsule-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-bottom: 10px;
        }

        .capsule-tag {
            background-color: #383b42;
            color: #67c1f5;
            padding: 2px 6px;
            border-radius: 2px;
            font-size: 11px;
            cursor: pointer;
        }

        .capsule-tag:hover {
            background-color: #67c1f5;
            color: #fff;
        }

        .capsule-price-area { margin-top: auto; }
        .review-text { font-size: 12px; color: #66c0f4; margin-bottom: 5px; }

        /* Carousel Controls */
        .carousel-control-prev, .carousel-control-next {
            width: 45px; height: 100px; top: 50%; transform: translateY(-50%);
            opacity: 1; border-radius: 3px;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.01));
        }
        .carousel-control-next { background: linear-gradient(to left, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.01)); }
        .carousel-control-prev:hover, .carousel-control-next:hover { background-color: rgba(171, 171, 171, 0.2); }
        .carousel-control-prev { left: -45px; }
        .carousel-control-next { right: -45px; }

        .carousel-indicators { bottom: -40px; }
        .carousel-indicators button {
            width: 15px; height: 9px; border-radius: 2px; background-color: #3d4450; border: none; margin: 0 4px; transition: background-color 0.2s;
        }
        .carousel-indicators .active { background-color: #c7d5e0; }

        /* --- SHARED PRICE BLOCK STYLES --- */
        .discount-block {
            display: flex; align-items: center; background: #344654; padding: 2px; width: fit-content;
        }
        .discount-pct {
            background: #4c6b22; color: #a4d007; padding: 2px 6px; font-size: 1.2rem; font-weight: 700;
        }
        .discount-prices {
            background: #344654; padding: 0 8px; display: flex; flex-direction: column;
            justify-content: center; line-height: 1.1; text-align: right;
        }
        .original-price { text-decoration: line-through; color: #738895; font-size: 11px; }
        .final-price { color: #acdbf5; font-size: 14px; }

        /* --- MOBILE RESPONSIVE CAROUSEL --- */
        @media (max-width: 992px) {
            .special-offers-heading { font-size: 2rem; margin-bottom: 20px; }
            
            .main-capsule { flex-direction: column; height: auto; }
            
            /* Stack video on top with fixed height for stability */
            .capsule-video-col { width: 100%; height: 220px; }
            
            .capsule-info-col { width: 100%; padding: 15px; }
            .capsule-small-img { display: none; } /* Hide small cover on mobile to save space */
            
            /* Hide navigation arrows on mobile (rely on swipe) */
            .carousel-control-prev, .carousel-control-next { display: none; }
        }

        /* =========================================
           STYLES FOR SPECIAL EVENTS GRID
           ========================================= */
        .events-section-header {
            font-family: "Motiva Sans", sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .event-grid-card {
            position: relative;
            width: 100%;
            background-color: #0a0f1a;
            border-radius: 4px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .event-grid-card:hover { transform: scale(1.03); z-index: 10; box-shadow: 0 0 20px rgba(102, 192, 244, 0.4); }
        
        .event-img {
            width: 100%; height: auto; display: block; aspect-ratio: 16/9; object-fit: cover;
        }

        .event-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(23, 26, 33, 0.95); color: #c6d4df;
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            padding: 15px; text-align: center; opacity: 0; transition: opacity 0.3s ease-in-out;
        }
        
        /* Show overlay on click/touch on mobile instead of hover if desired, or keep hover logic */
        .event-grid-card:hover .event-overlay { opacity: 1; }

        .event-title { color: #fff; font-size: 1rem; font-weight: 700; margin-bottom: 8px; }
        .event-desc { font-size: 0.85rem; line-height: 1.4; }

        /* =========================================
           NEW LIST SECTION STYLES
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
            background: #10161d; border: 1px solid #283c4e; color: #fff; 
            padding: 5px 10px; border-radius: 3px; outline: none; font-size: 0.9rem;
        }
        .search-input:focus { border-color: #66c0f4; }

        .game-card-row {
            display: flex;
            background-color: #16202d; 
            height: 75px;
            margin-bottom: 6px;
            text-decoration: none;
            color: #c6d4df;
            transition: all 0.2s ease;
            border: 1px solid transparent;
            overflow: hidden;
            opacity: 0.9;
        }

        .game-card-row:hover {
            background-color: #2a475e; transform: scale(1.01); opacity: 1; z-index: 5; border-color: rgba(102, 192, 244, 0.3);
        }

        .list-img { width: 160px; height: 100%; flex-shrink: 0; }
        .list-img img { width: 100%; height: 100%; object-fit: cover; }

        .list-info {
            flex-grow: 1; display: flex; align-items: center; justify-content: space-between; padding: 0 20px;
        }

        .list-title-block { display: flex; flex-direction: column; justify-content: center; }
        .list-game-title { font-size: 1.05rem; color: #fff; font-weight: 500; }
        .list-tags { font-size: 0.75rem; color: #627d92; margin-top: 2px; }
        .game-card-row:hover .list-tags { color: #9eb3c2; }

        .list-meta-block { display: flex; align-items: center; gap: 20px; }
        .release-date { font-size: 0.8rem; color: #56707f; }

        .filter-box {
            background-color: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(67, 73, 83, 0.3);
            padding: 15px;
            border-radius: 3px;
            position: sticky;
            top: 20px;
        }

        .filter-option {
            display: flex; align-items: center; padding: 4px 0; color: #8f98a0; cursor: pointer; font-size: 0.9rem; transition: 0.2s;
        }
        .filter-option:hover { color: #fff; }
        .filter-option input { margin-right: 10px; accent-color: #66c0f4; cursor: pointer; }

        .btn-load-more {
            background-color: transparent; color: #66c0f4; border: 1px solid #66c0f4;
            padding: 8px 30px; border-radius: 2px; font-size: 0.9rem; font-weight: 500;
            transition: all 0.2s ease; display: inline-block; cursor: pointer;
        }
        .btn-load-more:hover { background-color: #66c0f4; color: #fff; }

        /* --- MOBILE LIST VIEW ADJUSTMENTS --- */
        @media (max-width: 768px) {
            /* Collapse Filter Sidebar */
            .filter-box { display: none; } 

            /* Stack Sorting Controls */
            .sort-bar-container { flex-direction: column; gap: 10px; align-items: stretch; }
            .search-input { width: 100%; }

            /* Compact List Item */
            .game-card-row { height: auto; align-items: flex-start; }
            .list-img { width: 110px; height: 65px; } /* Smaller image */
            
            .list-info { padding: 8px 12px; flex-direction: column; align-items: flex-start; width: 100%; }
            .list-title-block { margin-bottom: 5px; }
            .list-meta-block { width: 100%; justify-content: space-between; gap: 0; }
            .release-date { display: none; } /* Hide date on mobile to save space */
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

    <!-- NAVBAR (Centralized Include) -->
    <?php include 'navbar_include.php'; ?>

    <section class="browse-container">
        <div class="container">

            <h2 class="special-offers-heading">DISCOUNTS & EVENTS</h2>

            <div id="steamMainCarousel" class="carousel slide steam-carousel" data-bs-ride="carousel" data-bs-touch="true">

                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#steamMainCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#steamMainCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#steamMainCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#steamMainCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>

                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="main-capsule">
                            <div class="capsule-video-col">
                                <video class="capsule-video" autoplay muted loop playsinline>
                                    <source src="../assets/images/Browse More/Trailmakers video.mp4" type="video/mp4">
                                </video>
                            </div>
                            <div class="capsule-info-col">
                                <div>
                                    <img src="../assets/images/Browse More/Trailmakers pic.jpg" class="capsule-small-img" alt="Game Cover">
                                    <div class="capsule-desc-box">
                                        Simulation, Building, Sandbox. <br>
                                        <span class="review-text">Very Positive (12,450 Reviews)</span>
                                    </div>
                                    <div class="capsule-tags">
                                        <span class="capsule-tag">Open World</span>
                                        <span class="capsule-tag">Crafting</span>
                                        <span class="capsule-tag">Co-op</span>
                                        <p class="d-none d-md-block"><b>Frozen Tracks</b> is a snowy, icy adventure on the moon Hoff, built for tank-track vehicles. It adds a multiplayer campaign, new enemies, and unlockable cold-weather gear.</p>
                                    </div>
                                </div>
                                <div class="capsule-price-area">
                                    <div class="discount-block">
                                        <div class="discount-pct">-60%</div>
                                        <div class="discount-prices">
                                            <div class="original-price">$24.99</div>
                                            <div class="final-price">$9.99</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="main-capsule">
                            <div class="capsule-video-col">
                                <video class="capsule-video" autoplay muted loop playsinline>
                                    <source src="../assets/images/Browse More/age of wonders.mp4" type="video/mp4">
                                </video>
                            </div>
                            <div class="capsule-info-col">
                                <div>
                                    <img src="../assets/images/Browse More/age of wonders pic.jpg" class="capsule-small-img" alt="Game Cover">
                                    <div class="capsule-desc-box">
                                        Strategy, 4X, Turn-Based Combat. <br>
                                        <span class="review-text">Very Positive (9,000 Reviews)</span>
                                    </div>
                                    <div class="capsule-tags">
                                        <span class="capsule-tag">Fantasy</span>
                                        <span class="capsule-tag">RPG</span>
                                        <span class="capsule-tag">Tactical</span>
                                        <p class="d-none d-md-block"><b>Age of Wonders</b> is a fantasy strategy game where you build an empire, command armies, and use powerful magic to shape the world.</p>
                                    </div>
                                </div>
                                <div class="capsule-price-area">
                                    <div class="discount-block">
                                        <div class="discount-pct">-50%</div>
                                        <div class="discount-prices">
                                            <div class="original-price">$49.99</div>
                                            <div class="final-price">$24.99</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="main-capsule">
                            <div class="capsule-video-col">
                                <video class="capsule-video" autoplay muted loop playsinline>
                                    <source src="../assets/images/Browse More/asseto corsa.mp4" type="video/mp4">
                                </video>
                            </div>
                            <div class="capsule-info-col">
                                <div>
                                    <img src="../assets/images/Browse More/asseto corsa pic.jpg" class="capsule-small-img" alt="Game Cover">
                                    <div class="capsule-desc-box">
                                        Racing, Simulation, Sports. <br>
                                        <span class="review-text">Very Positive (18,500 Reviews)</span>
                                    </div>
                                    <div class="capsule-tags">
                                        <span class="capsule-tag">Multiplayer</span>
                                        <span class="capsule-tag">Driving</span>
                                        <span class="capsule-tag">Realistic</span>
                                        <p class="d-none d-md-block"><b>Assetto Corsa</b> is a realistic racing simulator known for its precise physics and highly accurate car handling.</p>
                                    </div>
                                </div>
                                <div class="capsule-price-area">
                                    <div class="discount-block">
                                        <div class="discount-pct">-70%</div>
                                        <div class="discount-prices">
                                            <div class="original-price">$39.99</div>
                                            <div class="final-price">$11.99</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="main-capsule">
                            <div class="capsule-video-col">
                                <video class="capsule-video" autoplay muted loop playsinline>
                                    <source src="../assets/images/Browse More/final fantasy rebirth.mp4" type="video/mp4">
                                </video>
                            </div>
                            <div class="capsule-info-col">
                                <div>
                                    <img src="../assets/images/Browse More/final fantasy rebirth pic.jpg" class="capsule-small-img" alt="Game Cover">
                                    <div class="capsule-desc-box">
                                        RPG, Action, Adventure. <br>
                                        <span class="review-text">Very Positive (5,200 Reviews)</span>
                                    </div>
                                    <div class="capsule-tags">
                                        <span class="capsule-tag">Story Rich</span>
                                        <span class="capsule-tag">Fantasy</span>
                                        <span class="capsule-tag">JRPG</span>
                                        <p class="d-none d-md-block"><b>Final Fantasy Rebirth</b> is an action RPG set in a vibrant fantasy world. It features real-time combat, deep storytelling, and stunning visuals.</p>
                                    </div>
                                </div>
                                <div class="capsule-price-area">
                                    <div class="discount-block">
                                        <div class="discount-pct">-25%</div>
                                        <div class="discount-prices">
                                            <div class="original-price">$69.99</div>
                                            <div class="final-price">$52.49</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#steamMainCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#steamMainCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            </div>

            <div class="mt-5 pt-3">
                <h2 class="events-section-header">SPECIAL EVENTS</h2>

                <div id="steamSpecialEventsCarousel" class="carousel slide steam-carousel" data-bs-ride="carousel" data-bs-touch="true">

                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#steamSpecialEventsCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                        <button type="button" data-bs-target="#steamSpecialEventsCarousel" data-bs-slide-to="1"></button>
                    </div>

                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <div class="container-fluid p-0">
                                <div class="row g-3">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="event-grid-card">
                                            <img src="../assets/images/Browse More/capcom black friday sale.jpg" class="event-img" alt="Capcom Sale">
                                            <div class="event-overlay">
                                                <div class="event-title">Capcom Black Friday Sale</div>
                                                <div class="event-desc">Huge discounts on Capcom's best titles including Resident Evil and Street Fighter.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="event-grid-card">
                                            <img src="../assets/images/Browse More/nominees.jpg" class="event-img" alt="Game Awards">
                                            <div class="event-overlay">
                                                <div class="event-title">The Game Awards 2025</div>
                                                <div class="event-desc">Celebrate the best games of the year. Vote for your favorites.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="event-grid-card">
                                            <img src="../assets/images/Browse More/gameloft.png" class="event-img" alt="Gameloft Sale">
                                            <div class="event-overlay">
                                                <div class="event-title">Gameloft Publisher Sale</div>
                                                <div class="event-desc">Explore the world of Gameloft. Find great deals on the entire catalog.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 d-none d-lg-block">
                                        <div class="event-grid-card">
                                            <img src="../assets/images/Browse More/KOEI TEMO.jpg" class="event-img" alt="Koei Tecmo">
                                            <div class="event-overlay">
                                                <div class="event-title">KOEI TECMO SALE</div>
                                                <div class="event-desc">Experience epic historical battles and anime-style action games.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 d-none d-lg-block">
                                        <div class="event-grid-card">
                                            <img src="../assets/images/Browse More/Cozy Quest.jpg" class="event-img" alt="Cozy Quest">
                                            <div class="event-overlay">
                                                <div class="event-title">Cozy Quest 2025</div>
                                                <div class="event-desc">Relax and unwind with the best cozy games.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 d-none d-lg-block">
                                        <div class="event-grid-card">
                                            <img src="../assets/images/Browse More/czech and slovack.png" class="event-img" alt="Czech Games">
                                            <div class="event-overlay">
                                                <div class="event-title">Czech & Slovak Games Week</div>
                                                <div class="event-desc">Celebrating creativity from Central Europe.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="container-fluid p-0">
                                <div class="row g-3">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="event-grid-card">
                                            <img src="../assets/images/Browse More/golden joystick award.jpg" class="event-img" alt="Golden Joystick">
                                            <div class="event-overlay">
                                                <div class="event-title">Golden Joystick Awards</div>
                                                <div class="event-desc">The people's gaming awards are back.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="event-grid-card">
                                            <img src="../assets/images/Browse More/cosmomashia black friday sale.jpg" class="event-img" alt="Cosmo Machia">
                                            <div class="event-overlay">
                                                <div class="event-title">Cosmo Machia Sale</div>
                                                <div class="event-desc">Dive into intense shoot-em-ups and unique action titles.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="event-grid-card">
                                            <img src="../assets/images/Browse More/activision black friday sale.png" class="event-img" alt="Activision">
                                            <div class="event-overlay">
                                                <div class="event-title">Activision Black Friday</div>
                                                <div class="event-desc">Call of Duty, Crash Bandicoot, Spyro and more.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#steamSpecialEventsCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#steamSpecialEventsCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="row mt-5 pt-4">
                
                <div class="col-lg-9">
                    <h2 class="events-section-header">Browse All Specials</h2>
                    
                    <div class="sort-bar-container">
                        <div class="d-flex align-items-center gap-2">
                            <span style="font-size: 0.9rem; color: #8f98a0;">Sort by:</span>
                            <select id="sort-select" class="styled-select">
                                <option value="discount">Discount % (High to Low)</option>
                                <option value="lowest">Price (Lowest First)</option>
                                <option value="highest">Price (Highest First)</option>
                                <option value="newest">Release Date (Newest)</option>
                                <option value="name">Name (A-Z)</option>
                            </select>
                        </div>
                        <input type="text" id="search-input" class="search-input" placeholder="Search titles...">
                    </div>

                    <div id="game-list-container">
                        </div>
                    
                    <div class="text-center mt-4 mb-5">
                        <button id="load-more-btn" class="btn-load-more" style="display: none;">Load More</button>
                        <div id="results-count" class="text-muted mt-2" style="font-size: 0.85rem;"></div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="filter-box">
                        <div class="events-section-header" style="font-size: 0.9rem; border: none; margin-bottom: 10px;">Narrow by Tag</div>
                        <div id="tag-filters">
                            <label class="filter-option"><input type="checkbox" value="Action"> Action</label>
                            <label class="filter-option"><input type="checkbox" value="Adventure"> Adventure</label>
                            <label class="filter-option"><input type="checkbox" value="RPG"> RPG</label>
                            <label class="filter-option"><input type="checkbox" value="Strategy"> Strategy</label>
                            <label class="filter-option"><input type="checkbox" value="Simulation"> Simulation</label>
                            <label class="filter-option"><input type="checkbox" value="Indie"> Indie</label>
                            <label class="filter-option"><input type="checkbox" value="Sci-Fi"> Sci-Fi</label>
                            <label class="filter-option"><input type="checkbox" value="Horror"> Horror</label>
                            <label class="filter-option"><input type="checkbox" value="Fantasy"> Fantasy</label>
                            <label class="filter-option"><input type="checkbox" value="Racing"> Racing</label>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

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
                        <a class="footer-nav-link nav-link px-2 px-md-3" href="community.php">Community</a>
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
        // 1. DATASET (Reduced to 11 items for testing "Load More")
        const gamesData = [
            { id: 1, title: "Trailmakers", img: "../assets/images/Browse More/Trailmakers pic.jpg", tags: ["Simulation", "Building", "Indie"], date: "2020-09-18", original: 24.99, discount: 60 },
            { id: 2, title: "Age of Wonders 4", img: "../assets/images/Browse More/age of wonders pic.jpg", tags: ["Strategy", "RPG", "Fantasy"], date: "2023-05-02", original: 49.99, discount: 50 },
            { id: 3, title: "Assetto Corsa", img: "../assets/images/Browse More/asseto corsa pic.jpg", tags: ["Racing", "Simulation", "Sports"], date: "2014-12-19", original: 39.99, discount: 70 },
            { id: 4, title: "Final Fantasy VII Rebirth", img: "../assets/images/Browse More/final fantasy rebirth pic.jpg", tags: ["RPG", "Action", "Fantasy"], date: "2024-02-29", original: 69.99, discount: 25 },
            { id: 5, title: "Deus Ex: Mankind Divided", img: "../assets/images/Browse More/deusex.JPG", tags: ["Action", "Sci-Fi", "RPG"], date: "2016-08-23", original: 29.99, discount: 85 },
            { id: 6, title: "Thief", img: "../assets/images/Browse More/thief.JPG", tags: ["Action", "Stealth", "Adventure"], date: "2014-02-25", original: 19.99, discount: 75 },
            { id: 7, title: "Borderlands 2", img: "../assets/images/Browse More/borderlands 2.jpeg", tags: ["Action", "FPS", "RPG"], date: "2012-09-18", original: 19.99, discount: 75 },
            { id: 8, title: "Worms W.M.D", img: "../assets/images/Browse More/worms.JPG", tags: ["Strategy", "Action", "Indie"], date: "2016-08-23", original: 29.99, discount: 80 },
            { id: 9, title: "Blood: Fresh Supply", img: "../assets/images/Browse More/blood.JPG", tags: ["Action", "FPS", "Horror"], date: "2019-05-09", original: 9.99, discount: 50 },
            { id: 10, title: "Resident Evil Village", img: "https://placehold.co/160x75/1b2838/fff?text=RE+Village", tags: ["Horror", "Action", "Survival"], date: "2021-05-07", original: 39.99, discount: 60 },
            // The 11th item (To test load more)
            { id: 11, title: "Cyberpunk 2077", img: "https://placehold.co/160x75/1b2838/fff?text=Cyberpunk", tags: ["RPG", "Sci-Fi", "Open World"], date: "2020-12-10", original: 59.99, discount: 50 }
        ];

        // Helper: Calculate Final Price
        function getFinalPrice(original, discount) {
            return (original - (original * (discount / 100))).toFixed(2);
        }

        // 2. DOM ELEMENTS
        const listContainer = document.getElementById('game-list-container');
        const sortSelect = document.getElementById('sort-select');
        const searchInput = document.getElementById('search-input');
        const tagCheckboxes = document.querySelectorAll('#tag-filters input');
        const loadMoreBtn = document.getElementById('load-more-btn');
        const resultsCount = document.getElementById('results-count');

        // 3. STATE VARIABLES
        let itemsToShow = 10; // Initial limit
        const itemsIncrement = 10; // Load 10 more
        let currentFilteredData = []; // Holds the current full list of valid results

        // 4. RENDER FUNCTION
        function renderGames() {
            listContainer.innerHTML = '';

            // Slice data based on current limit
            const visibleList = currentFilteredData.slice(0, itemsToShow);

            if (visibleList.length === 0) {
                listContainer.innerHTML = `<div class="p-4 text-center text-muted">No games found matching your filters.</div>`;
                loadMoreBtn.style.display = 'none';
                resultsCount.innerText = '';
                return;
            }

            visibleList.forEach(game => {
                const finalPrice = getFinalPrice(game.original, game.discount);
                const dateStr = new Date(game.date).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });

                const html = `
                <a href="#" class="game-card-row">
                    <div class="list-img">
                        <img src="${game.img}" alt="${game.title}" onerror="this.src='https://placehold.co/160x75/1b2838/fff?text=${encodeURIComponent(game.title)}'">
                    </div>
                    <div class="list-info">
                        <div class="list-title-block">
                            <div class="list-game-title">${game.title}</div>
                            <div class="list-tags">${game.tags.join(', ')}</div>
                        </div>
                        <div class="list-meta-block">
                            <div class="release-date d-none d-md-block">${dateStr}</div>
                            <div class="discount-block">
                                <div class="discount-pct">-${game.discount}%</div>
                                <div class="discount-prices">
                                    <div class="original-price">$${game.original}</div>
                                    <div class="final-price">$${finalPrice}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                `;
                listContainer.innerHTML += html;
            });

            // Button Visibility Logic
            if (itemsToShow >= currentFilteredData.length) {
                loadMoreBtn.style.display = 'none';
                resultsCount.innerText = `Showing ${currentFilteredData.length} of ${currentFilteredData.length} results`;
            } else {
                loadMoreBtn.style.display = 'inline-block';
                resultsCount.innerText = `Showing ${visibleList.length} of ${currentFilteredData.length} results`;
            }
        }

        // 5. LOGIC CONTROLLER
        function updateDisplay() {
            // A. FILTER
            currentFilteredData = gamesData.filter(game => {
                // 1. Tags (OR Logic)
                const selectedTags = Array.from(tagCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
                if (selectedTags.length > 0) {
                    const hasTag = game.tags.some(t => selectedTags.includes(t));
                    if (!hasTag) return false;
                }
                // 2. Search Text
                const term = searchInput.value.toLowerCase();
                if (term && !game.title.toLowerCase().includes(term)) return false;

                return true;
            });

            // B. SORT
            const mode = sortSelect.value;
            currentFilteredData.sort((a, b) => {
                const priceA = parseFloat(getFinalPrice(a.original, a.discount));
                const priceB = parseFloat(getFinalPrice(b.original, b.discount));
                const dateA = new Date(a.date);
                const dateB = new Date(b.date);

                if (mode === 'lowest') return priceA - priceB;
                if (mode === 'highest') return priceB - priceA;
                if (mode === 'discount') return b.discount - a.discount;
                if (mode === 'newest') return dateB - dateA;
                if (mode === 'name') return a.title.localeCompare(b.title);
                return 0;
            });

            // Reset limit when filter changes
            itemsToShow = 10;
            renderGames();
        }

        // 6. LOAD MORE HANDLER
        loadMoreBtn.addEventListener('click', function() {
            itemsToShow += itemsIncrement;
            renderGames();
        });

        // 7. EVENT LISTENERS
        sortSelect.addEventListener('change', updateDisplay);
        searchInput.addEventListener('input', updateDisplay);
        tagCheckboxes.forEach(cb => cb.addEventListener('change', updateDisplay));

        // Initial Render
        updateDisplay();
    </script>
</body>
</html>