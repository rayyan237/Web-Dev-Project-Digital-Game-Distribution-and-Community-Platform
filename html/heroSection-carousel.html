<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Steam Store - Clickable Carousel</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* --- GLOBAL RESET --- */
        body {
            background-color: #1b2838;
            font-family: "Arial", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #c7d5e0;
            overflow-x: hidden;
        }

        .steam-wrapper {
            width: 95%;
            max-width: 1170px;
            margin: auto;
            position: relative;
        }

        /* --- NAVIGATION ARROWS --- */
        .steam-nav-btn {
            position: absolute;
            top: 40%;
            transform: translateY(-50%);
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            z-index: 20;
            opacity: 0.3;
            transition: opacity 0.2s, transform 0.1s;
            width: 50px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            outline: none;
        }

        .steam-nav-btn:hover { opacity: 1; }

        .steam-nav-btn:active svg {
            filter: drop-shadow(0 0 5px #fff) drop-shadow(0 0 10px #66C0F4);
            transform: scale(0.95);
        }

        .prev-btn { left: -60px; }
        .next-btn { right: -60px; }

        .steam-nav-btn svg {
            width: 50px;
            height: 100px;
            fill: #fff;
            transition: filter 0.1s;
        }

        /* --- HERO CARD --- */
        .hero-card {
            background-color: #0f1922;
            height: 450px;
            /* Rounded corners for the card itself */
            border-radius: 0; 
            overflow: visible; 
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
            display: flex;
            text-decoration: none;
            color: inherit;
            transition: filter 0.2s;
        }
        
        .hero-card:hover {
            filter: brightness(1.05);
        }

        .carousel-item { height: 450px; }

        /* --- VIDEO COLUMN --- */
        .col-video {
            background: #000;
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .media-header {
            position: absolute;
            top: 0; left: 0; width: 100%;
            padding: 8px 12px;
            background: linear-gradient(to bottom, rgba(0,0,0,0.8), transparent);
            z-index: 2;
            font-size: 13px;
            pointer-events: none;
        }

        video, .slide-img { width: 100%; height: 100%; object-fit: cover; }

        /* --- INFO COLUMN --- */
        .col-info {
            background-image: url('https://shared.cloudflare.steamstatic.com/store_item_assets/steam/apps/1172470/page_bg_generated_v6b.jpg');
            background-size: cover;
            position: relative;
            height: 100%;
        }

        .col-info::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(21, 32, 43, 0.9) 0%, rgba(11, 18, 25, 1) 100%);
            z-index: 0;
        }

        /* --- OVERLAPPING CAPSULE --- */
        .capsule-overlap {
            position: relative;
            z-index: 10;
            margin-top: 25px;
            margin-bottom: 10px;
            margin-left: -40px; 
            width: 112%;
            transition: transform 0.3s ease;
        }
        .capsule-overlap:hover { transform: scale(1.02); }
        .capsule-overlap img {
            box-shadow: 4px 4px 15px rgba(0,0,0,0.7);
            border: 1px solid #4a5a6a;
        }

        /* --- CONTENT --- */
        .info-content {
            position: relative;
            z-index: 1;
            height: 100%;
            padding: 0 20px 20px 20px;
        }

        .description-truncate {
            display: -webkit-box !important; 
            -webkit-line-clamp: 4; 
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 12px;
            line-height: 1.4;
            max-height: 7em; 
            color: #acb2b8;
            margin-bottom: auto; 
        }

        .steam-badge {
            background: rgba(255, 255, 255, 0.1);
            color: #66C0F4;
            border: 1px solid rgba(102, 192, 244, 0.2);
            font-weight: normal;
            padding: 5px 8px;
            border-radius: 2px;
        }

        .price-btn {
            background-color: #4c6b22; 
            font-size: 13px; 
            padding: 4px 12px;
            color: white;
            border-radius: 2px;
        }

        /* --- INDICATORS CONTAINER --- */
        .indicators-container {
            margin-top: 10px;
            display: flex;
            justify-content: center;
        }

        /* --- CUSTOMIZED BOOTSTRAP INDICATORS --- */
        .carousel-indicators.custom-indicators-style {
            position: static;
            margin: 0;
            justify-content: center;
            gap: 6px;
        }

        .carousel-indicators.custom-indicators-style [data-bs-target] {
            width: 18px;
            height: 10px;
            border: none;
            border-radius: 2px;
            background-color: rgba(255, 255, 255, 0.2);
            opacity: 1;
            transition: all 0.2s;
            margin: 0;
            text-indent: -999px;
        }

        .carousel-indicators.custom-indicators-style .active {
            background-color: #66C0F4;
            box-shadow: 0 0 5px #66C0F4;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 992px) {
            .steam-nav-btn { display: none; } 
            .hero-card, .carousel-item { height: auto; }
            .col-video { height: 250px; }
            .capsule-overlap { display: none !important; }
            .info-content { padding: 20px; }
            
            .description-truncate { 
                -webkit-line-clamp: 6; 
                max-height: 8.4em; 
            }
        }
    </style>
</head>
<body>

    <div class="steam-wrapper">
        
        <button class="steam-nav-btn prev-btn" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <svg viewBox="0 0 50 100" style="transform: rotate(180deg);">
                <polygon points="0,0.093 0,25.702 24.323,50.026 0,74.349 0,99.955 49.929,50.026 "></polygon>
            </svg>
        </button>

        <button class="steam-nav-btn next-btn" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <svg viewBox="0 0 50 100">
                <polygon points="0,0.093 0,25.702 24.323,50.026 0,74.349 0,99.955 49.929,50.026 "></polygon>
            </svg>
        </button>

        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            
            <div class="carousel-inner shadow-lg">
                
                <div class="carousel-item active">
                    <a href="https://store.steampowered.com/app/1172470/Apex_Legends/" target="_blank" class="hero-card row g-0 rounded-top-1 text-decoration-none">
                        
                        <div class="col-lg-8 col-video">
                            <div class="media-header text-white">
                                <span class="text-info fw-bold">Trailer Preview</span> &nbsp;|&nbsp; Apex Legends™
                            </div>
                            <video autoplay muted loop playsinline poster="\assets\images\s1_header.jpg">
                                <source src="\assets\videos\microtrailer-cs.mp4" type="video/mp4">
                            </video>
                        </div>

                        <div class="col-lg-4 col-info">
                            <div class="info-content d-flex flex-column">
                                <div class="capsule-overlap">
                                    <img src="\assets\images\s1_header.jpg" class="img-fluid rounded-1" alt="Apex Header">
                                </div>

                                <h2 class="text-white fw-light mb-2" style="font-size: 28px;">Counter-Strike Go</h2>
                                
                                <div class="d-flex flex-wrap gap-1 mb-3">
                                    <span class="badge steam-badge">Action</span>
                                    <span class="badge steam-badge">Free to Play</span>
                                    <span class="badge steam-badge">Battle Royale</span>
                                </div>

                                <p class="description-truncate">
                                    For over two decades, Counter-Strike has offered an elite competitive experience, one shaped by millions of players from across the globe. And now the next chapter in the CS story is about to begin. This is Counter-Strike 2.
                                </p>

                                <div class="mt-3">
                                    <p class="text-secondary m-0" style="font-size: 10px;">Release date: Nov 5, 2020</p>
                                </div>

                                <div class="mt-auto ms-auto pb-2">
                                    <span class="price-btn">Free To Play</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="carousel-item">
                    <a href="https://store.steampowered.com/app/570/Dota_2/" target="_blank" class="hero-card row g-0 rounded-top-1 text-decoration-none">
                        
                        <div class="col-lg-8 col-video">
                            <div class="media-header text-white">
                                <span class="text-info fw-bold">Trailer Preview</span>
                            </div>
                            <video autoplay muted loop playsinline poster="\assets\images\s2_header.jpg">
                                <source src="\assets\videos\microtrailer-dota2.mp4" type="video/mp4">
                            </video>
                        </div>
                        
                        <div class="col-lg-4 col-info">
                            <div class="info-content d-flex flex-column">
                                <div class="capsule-overlap">
                                    <img src="\assets\images\s2_header.jpg" class="img-fluid rounded-1" alt="Dota Header">
                                </div>
                                <h2 class="text-white fw-light mb-2" style="font-size: 28px;">Dota 2</h2>
                                <div class="d-flex flex-wrap gap-1 mb-3">
                                    <span class="badge steam-badge">MOBA</span>
                                    <span class="badge steam-badge">Strategy</span>
                                </div>
                                <p class="description-truncate">
                                    Every day, millions of players worldwide enter battle as one of over a hundred Dota heroes. And no matter if it's their 10th hour of play or 1,000th, there's always something new to discover. With regular updates that ensure a constant evolution of gameplay, features, and heroes, Dota 2 has taken on a life of its own. Join the battle and defend your ancient.
                                </p>
                                <div class="mt-3">
                                    <p class="text-secondary m-0" style="font-size: 10px;">Release date: Jul 9, 2013</p>
                                </div>
                                <div class="mt-auto ms-auto pb-2">
                                    <span class="price-btn">Free To Play</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="carousel-item">
                    <a href="https://store.steampowered.com/app/578080/PUBG_BATTLEGROUNDS/" target="_blank"
                        class="hero-card row g-0 rounded-top-1 text-decoration-none">

                        <div class="col-lg-8 col-video">
                            <div class="media-header text-white">
                                <span class="text-info fw-bold">Trailer Preview</span>
                            </div>
                            <video autoplay muted loop playsinline poster="\assets\images\s4_header.jpg">
                                <source src="\assets\videos\microtrailer-pubg.mp4" type="video/mp4">
                            </video>
                        </div>

                        <div class="col-lg-4 col-info">
                            <div class="info-content d-flex flex-column">
                                <div class="capsule-overlap">
                                    <img src="\assets\images\s4_header.jpg" class="img-fluid rounded-1" alt="">
                                </div>

                                <h2 class="text-white fw-light mb-2" style="font-size: 28px;">PUBG BATTLEGROUNDS</h2>

                                <div class="d-flex flex-wrap gap-1 mb-3">
                                    <span class="badge steam-badge">Action</span>
                                    <span class="badge steam-badge">Free to Play</span>
                                    <span class="badge steam-badge">Battle Royale</span>
                                </div>

                                <p class="description-truncate">
                                    PUBG: BATTLEGROUNDS, the high-stakes winner-take-all shooter that started the Battle Royale craze, is free-to-play! Drop into diverse maps, loot unique weapons and supplies, and survive in an ever-shrinking zone where every turn could be your last.
                                </p>

                                <div class="mt-3">
                                    <p class="text-secondary m-0" style="font-size: 10px;">Release date: Nov 5, 2020</p>
                                </div>

                                <div class="mt-auto ms-auto pb-2">
                                    <span class="price-btn">Free To Play</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="carousel-item">
                    <a href="https://store.steampowered.com/app/578080/PUBG_BATTLEGROUNDS/" target="_blank"
                        class="hero-card row g-0 rounded-top-1 text-decoration-none">

                        <div class="col-lg-8 col-video">
                            <div class="media-header text-white">
                                <span class="text-info fw-bold">Trailer Preview</span>
                            </div>
                            <video autoplay muted loop playsinline poster="\assets\images\s6_header.jpg">
                                <source src="\assets\videos\microtrailer-battlefield.mp4" type="video/mp4">
                            </video>
                        </div>

                        <div class="col-lg-4 col-info">
                            <div class="info-content d-flex flex-column">
                                <div class="capsule-overlap">
                                    <img src="\assets\images\s6_header.jpg" class="img-fluid rounded-1" alt="">
                                </div>

                                <h2 class="text-white fw-light mb-2" style="font-size: 28px;">Battlefield REDSEC</h2>

                                <div class="d-flex flex-wrap gap-1 mb-3">
                                    <span class="badge steam-badge">Action</span>
                                    <span class="badge steam-badge">Free to Play</span>
                                    <span class="badge steam-badge">Battle Royale</span>
                                </div>

                                <p class="description-truncate">
                                    Now entering REDSEC, the ultimate free-to-play FPS destination built on Battlefield’s iconic DNA. Featuring Battle Royale, Gauntlet, & the power of Portal.
                                </p>

                                <div class="mt-3">
                                    <p class="text-secondary m-0" style="font-size: 10px;">Release date: Nov 5, 2020</p>
                                </div>

                                <div class="mt-auto ms-auto pb-2">
                                    <span class="price-btn">Free To Play</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

            <div class="indicators-container">
                <div class="carousel-indicators custom-indicators-style">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>
            </div>

        </div> </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>