<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Steam: The Ultimate Online Game Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (using version from your custom footer request for consistency) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts (Added Poppins for the footer) -->
    <link href="https://fonts.googleapis.com/css2?family=Motiva+Sans:wght@300;400;500;700;900&family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        /* =========================================
           1. BASE STYLES (User Provided)
           ========================================= */
        body {
            background: #171a21 !important;
            color: #fff;
            overflow-x: hidden;
            /* Combined font families: Poppins added for footer */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* =========================================
           2. NAVBAR STYLES (Unchanged)
           ========================================= */
        .main-navbar { background: #171a21 !important; }
        .navbar-upper-border { border-bottom: 1px solid #2f3642; }
        .nav-link-upper { color: #c6d4df !important; transition: color 0.2s; }
        .nav-link-upper:hover { color: #fff !important; }
        
        @media (min-width: 768px) {
            .nav-link-upper {
                position: relative;
                padding-bottom: 15px !important;
                padding-top: 0.5rem !important;
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
            .nav-link-upper::after {
                content: ''; position: absolute; bottom: 5px; left: 0; width: 0; height: 2px;
                background-color: #fff; transition: width 0.2s ease-in-out;
            }
            .nav-link-upper:hover::after { width: 100%; }
        }
        
        @media (max-width: 767.98px) { .navbar-brand-desktop { display: none !important; } }

        .login-btn {
            background: rgba(0, 200, 255, 0.1); border: 1px solid rgba(0, 200, 255, 0.4);
            backdrop-filter: blur(6px); color: #00b4d8; padding: 8px 20px; border-radius: 8px;
            font-weight: 500; cursor: pointer; transition: all 0.3s ease; font-size: 0.95rem; box-shadow: none;
        }
        .login-btn:hover {
            background: rgba(0, 200, 255, 0.1); border-color: rgba(0, 200, 255, 0.4); color: #00b4d8;
            backdrop-filter: blur(6px); box-shadow: 0 0 15px rgba(0, 180, 216, 0.6);
        }

        .secondary-navbar { background: #1b2838 !important; z-index: 1020; }
        @media (min-width: 768px) { .secondary-navbar { position: sticky; top: 0; } }

        .subnav-link { font-weight: 500; font-size: 0.95rem; color: #c6d4df !important; padding-top: 0.5rem; padding-bottom: 0.5rem; }
        .subnav-link:hover { color: #fff !important; }

        .custom-dropdown-menu { background: #1b2838 !important; border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, .5); }
        .custom-dropdown-item { color: #c6d4df !important; padding: .5rem 1rem; font-weight: 500; font-size: 0.95rem; }
        .custom-dropdown-item:hover { background: #2a475e !important; color: #fff !important; }

        .header-search-group { border: 1px solid #1a2035; border-radius: 0.375rem; transition: border-color 0.3s, box-shadow 0.3s; height: 40px; }
        .header-search-group:focus-within { border-color: #00f0ff; box-shadow: 0 0 15px rgba(0, 240, 255, 0.6); }
        @media (min-width: 768px) { .desktop-search-form { width: 360px; } }
        .header-search-input { background: rgba(255, 255, 255, 0.05); border: none; color: #fff; height: 100%; border-radius: 0.375rem 0 0 0.375rem !important; }
        .header-search-input:focus { background: rgba(255, 255, 255, 0.1); box-shadow: none; color: #fff; }
        .header-search-input::placeholder { color: #8a94a6 !important; opacity: 1; }
        .header-search-btn { background: #00f0ff; color: #0a0f1a; border: none; width: 50px; height: 100%; font-weight: 700; transition: background 0.3s, box-shadow 0.3s, color 0.3s; border-radius: 0 0.375rem 0.375rem 0 !important; }
        .header-search-btn:hover { background: #fff; color: #0a0f1a; box-shadow: 0 0 20px #00f0ff; }

        /* =========================================
           3. HERO & GENERAL STYLES
           ========================================= */
        .steam-section { padding: 80px 0; position: relative; }
        .about-hero { background: radial-gradient(circle at 30% 20%, #2a475e 0%, #171a21 80%); padding-top: 80px; padding-bottom: 80px; overflow: hidden; }
        .hero-title { font-size: 4rem; font-weight: 900; text-transform: uppercase; line-height: 1; margin-bottom: 20px; }
        .hero-desc { color: #c6d4df; font-size: 1.25rem; max-width: 500px; margin-bottom: 30px; line-height: 1.5; }
        .stats-row { display: flex; gap: 40px; margin-bottom: 30px; }
        .stat-number { font-size: 2.5rem; font-weight: 700; line-height: 1; }
        .stat-label { color: #66c0f4; font-size: 0.8rem; text-transform: uppercase; font-weight: 700; display: flex; align-items: center; gap: 6px; }
        .dot-online { width: 8px; height: 8px; background: #1ac2f8; border-radius: 50%; }
        .dot-ingame { width: 8px; height: 8px; background: #6dc015; border-radius: 50%; }

        .btn-install-steam {
            background: linear-gradient(to bottom, #47bfff 5%, #1a44c2 60%, #1a44c2 100%);
            color: #ffffff; padding: 15px 30px; font-size: 1.2rem; border-radius: 2px; border: none;
            text-transform: capitalize; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; transition: all 0.2s;
        }
        .btn-install-steam:hover { background: linear-gradient(to bottom, #47bfff 5%, #1a44c2 40%, #1a44c2 100%); color: #fff; transform: scale(1.02); }

        .platform-icons { margin-top: 10px; color: #8f98a0; font-size: 1.4rem; }
        .platform-icons i { margin-right: 10px; }
        .hero-video-container { position: relative; transform: perspective(1000px) rotateY(-5deg); box-shadow: 0 20px 50px rgba(0,0,0,0.5); border: 5px solid #000; border-radius: 5px; }
        @media (max-width: 992px) { .hero-video-container { transform: none; margin-top: 40px; } .about-hero { text-align: center; } .hero-desc { margin: 0 auto 30px; } .stats-row { justify-content: center; } }

        /* =========================================
           4. ACCESS GAMES SECTION (FIXED LAYOUT)
           ========================================= */
        .access-games-section {
            background: radial-gradient(circle at 50% 40%, #1b2838 0%, #171a21 90%);
            height: 850px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .access-content {
            position: relative;
            z-index: 10; 
            max-width: 600px;
            padding: 40px;
        }

        .access-title {
            font-weight: 700; font-size: 3.5rem; color: #ffffff; margin-bottom: 15px;
            text-shadow: 0 4px 20px rgba(0,0,0,0.9);
        }

        .access-subtitle {
            font-size: 1.2rem; color: #c6d4df; line-height: 1.6; margin-bottom: 30px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.9);
        }

        .access-link {
            font-size: 1.2rem; color: #66c0f4; text-decoration: none; font-weight: 500;
            text-shadow: 0 2px 5px rgba(0,0,0,0.5);
        }
        .access-link:hover { color: #ffffff; }

        /* --- CAPSULE STYLING --- */
        .capsule-img {
            position: absolute;
            width: 231px !important;
            height: 87px !important;
            object-fit: cover;
            box-shadow: 0 15px 35px rgba(0,0,0,0.6);
            border-radius: 2px;
            transition: transform 0.3s ease, filter 0.3s ease, box-shadow 0.3s ease;
            z-index: 1;
            filter: brightness(0.85);
            max-width: none !important;
        }

        .capsule-img:hover {
            transform: scale(1.1);
            z-index: 5;
            filter: brightness(1.1);
            box-shadow: 0 20px 50px rgba(0,0,0,0.8);
        }

        /* --- POSITIONING --- */
        /* Battlefield */
        .pos-1 {
            top: 8%;
            left: 8%;
        }

        /* Battleground (PUBG) */
        .pos-2 {
            top: 5%;
            left: 32%;
        }

        /* Bridge */
        .pos-3 {
            top: 5%;
            right: 32%;
        }

        /* Destiny 2 */

        .pos-4 {
            top: 8%;
            right: 8%;
        }

        /* Apex */
        .pos-5 {
            top: 35%;
            left: 2%;
        }

        /* Galaxy Commanders (Big Center Left) */

        .pos-6 {
            top: 60%;
            left: 8%;
        }

        /* Ties (Big Center Right) */
        .pos-7 {
            top: 60%;
            right: 8%;
        }

        /* Anno */
        .pos-8 {
            top: 35%;
            right: 2%;
        }

    

        /* Vona */
        .pos-9 {
            bottom: 2%;
            left: 20%;
        }

        /* CS 2 */
        .pos-15 {
            bottom: 2%;
            left: 60%;
            transform: none;
        }

        /* CS2 (Center) */

        /* Hide layout on smaller screens to prevent text overlap */
        @media (max-width:992px) {
            .access-games-section {
                height: auto;
                padding: 100px 20px;
            }

            .capsule-img {
                display: none;
            }
        }


        /* Other Sections */
        .section-dark { background-color: #0f1219; }
        .section-blue-dark { background-color: #1b2838; }
        .feature-title { font-size: 3rem; font-weight: 700; margin-bottom: 1rem; }
        .feature-text { color: #acb2b8; font-size: 1.1rem; margin-bottom: 2rem; }
        .feature-link { color: #fff; text-decoration: none; font-size: 1.1rem; border-bottom: 1px solid rgba(255,255,255,0); transition: border-bottom 0.2s; }
        .feature-link:hover { color: #66c0f4; border-bottom: 1px solid #66c0f4; }
        .icon-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 40px; text-align: center; margin-top: 50px; }
        .icon-box i { font-size: 4rem; color: #fff; margin-bottom: 20px; }
        .icon-box h4 { font-weight: 700; font-size: 1.5rem; margin-bottom: 15px; }
        .icon-box p { color: #8f98a0; font-size: 0.95rem; line-height: 1.5; }

        /* =========================================
           5. CUSTOM FOOTER STYLES (INTEGRATED)
           ========================================= */
        
        /* Main Container Background */
        .main-footer-section {
            background-image: radial-gradient(ellipse at 70% 120%, #1a2035 0%, #0a0f1a 60%);
            padding-top: 3rem;
            padding-bottom: 3rem;
            /* Ensure it respects dark theme context */
            color: #E0E0E0;
            font-family: 'Poppins', sans-serif; /* Specific font for footer as requested */
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

        /* Newsletter Form */
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

        /* Footer Nav Links */
        .footer-nav-link {
            color: #8a94a6 !important; /* Override BS nav-link color */
            position: relative;
            padding-bottom: 5px !important;
            font-weight: 600;
            transition: color 0.3s;
        }

        .footer-nav-link:hover {
            color: #fff !important;
        }

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

        /* Social Icons */
        .footer-social-icon {
            color: #8a94a6;
            font-size: 1.5rem;
            transition: color 0.3s, transform 0.3s, text-shadow 0.3s;
            text-decoration: none;
        }

        .footer-social-icon:hover {
            transform: scale(1.1) translateY(-2px);
        }

        .icon-discord:hover { color: #5865F2; text-shadow: 0 0 10px #5865F2; }
        .icon-reddit:hover { color: #FF4500; text-shadow: 0 0 10px #FF4500; }
        .icon-youtube:hover { color: #FF0000; text-shadow: 0 0 10px #FF0000; }
        .icon-twitter:hover { color: #1DA1F2; text-shadow: 0 0 10px #1DA1F2; }
        .icon-tiktok:hover { color: #fff; text-shadow: 0 0 10px #00f0ff, 0 0 15px #fe2c55; }

        /* Bottom Bar & Animation */
        .footer-bottom-bar {
            position: relative;
            background-color: #000;
            color: #8a94a6;
            font-family: 'Poppins', sans-serif;
        }

        .footer-glow-border {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #00f0ff, #a040ff, transparent);
            background-size: 300% 100%;
            animation: glow-animation 8s linear infinite;
        }

        @keyframes glow-animation {
            0% { background-position: 150% 0; }
            100% { background-position: -150% 0; }
        }

        .footer-copyright { color: #8a94a6; }

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
    <?php include 'section-navbar.php'; ?>

    <!-- HERO (Unchanged) -->
    <section class="about-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-title"><i class="fa-brands fa-steam"></i> STEAM®</div>
                    <p class="hero-desc">Steam is the ultimate destination for playing, discussing, and creating games.</p>
                    <div class="stats-row">
                        <div><div class="stat-label"><span class="dot-online"></span> ONLINE</div><div class="stat-number">23,870,400</div></div>
                        <div><div class="stat-label"><span class="dot-ingame"></span> PLAYING NOW</div><div class="stat-number">5,497,741</div></div>
                    </div>
                    <a href="https://cdn.fastly.steamstatic.com/client/installer/SteamSetup.exe" class="btn-install-steam">
                        INSTALL STEAM <i class="fa-brands fa-windows ms-2"></i> <i class="fa-brands fa-apple ms-2" style="opacity: 0.7;"></i>
                    </a>
                    <div class="platform-icons"><span>Also available on:</span><i class="fa-brands fa-steam"></i></div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-video-container">
                        <video width="100%" height="auto" autoplay muted loop playsinline poster="https://cdn.fastly.steamstatic.com/store/about/videos/about_hero_loop_web.png">
                            <source src="https://cdn.fastly.steamstatic.com/store/about/videos/about_hero_loop_web.webm" type="video/webm">
                            <source src="https://cdn.fastly.steamstatic.com/store/about/videos/about_hero_loop_web.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ACCESS GAMES SECTION (Unchanged) -->
    <section class="access-games-section">
        <div class="d-block">
            <!-- Top Row -->
            <img src="../assets/images/about/battlefield.jpg" class="capsule-img pos-1" alt="Battlefield">
            <img src="../assets/images/about/battleground.jpg" class="capsule-img pos-2" alt="PUBG">
            <img src="../assets/images/about/bridge.jpg" class="capsule-img pos-3" alt="The Bridge">
            <img src="../assets/images/about/destiny 2.jpg" class="capsule-img pos-4" alt="Destiny 2">

            <!-- Mid Row -->
            <img src="../assets/images/about/apex.jpg" class="capsule-img pos-5" alt="Apex">
            <img src="../assets/images/about/galaxy commanders.jpg" class="capsule-img pos-6" alt="Galaxy Commanders">
            <img src="../assets/images/about/ties.jpg" class="capsule-img pos-7" alt="Ties">
            <img src="../assets/images/about/anno.jpg" class="capsule-img pos-8" alt="Steam Deck">

            <!-- Bottom Row -->
            <img src="../assets/images/about/vona.jpg" class="capsule-img pos-9" alt="Vona">
            <img src="../assets/images/about/counter strike 2.jpg" class="capsule-img pos-15" alt="CS2">
        </div>

        <div class="access-content">
            <h2 class="access-title">Access Games Instantly</h2>
            <p class="access-subtitle">With nearly 30,000 games from AAA to indie and everything in-between. Enjoy exclusive deals, automatic game updates, and other great perks.</p>
            <a href="index.php" class="access-link">Browse the Store &rightarrow;</a>
        </div>
    </section>

    <!-- COMMUNITY SECTION (Unchanged) -->
    <section class="steam-section section-dark">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 order-2 order-lg-1">
                    <h2 class="feature-title">Join the Community</h2>
                    <p class="feature-text">Meet new people, join groups, form clans, chat in-game and more! With over 100 million potential friends (or enemies), the fun never stops.</p>
                </div>
                <div class="col-lg-7 order-1 order-lg-2 mb-4 mb-lg-0 community-img-container">
                    <img src="../assets/images/about/c1.png" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- HARDWARE SECTION (Unchanged) -->
    <section class="steam-section section-blue-dark">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-4 mb-lg-0"><img src="../assets/images/about/steam_deck-removebg-preview.png" class="img-fluid rounded shadow"></div>
                <div class="col-lg-5">
                    <h2 class="feature-title">Discover & Buy Your Favorite Games</h2>
                    <p class="feature-text">Browse a wide selection of popular games with great discounts and instant access after purchase.</p>
                    
                </div>
            </div>
        </div>
    </section>

    <!-- STEAMWORKS SECTION (Unchanged) -->
    <section class="steam-section section-dark">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 order-2 order-lg-1">
                    <h2 class="feature-title">Release your Game</h2>
                    <p class="feature-text">Steamworks is the set of tools and services that help game developers and publishers get the most out of distributing games on Steam.</p>
                    
                </div>
                <div class="col-lg-7 order-1 order-lg-2 mb-4 mb-lg-0 text-center"><img src="../assets/images/about/game-removebg-preview.png" class="img-fluid"></div>
            </div>
        </div>
    </section>

    <!-- FEATURES GRID (Unchanged) -->
    <section class="steam-section section-blue-dark text-center pb-5">
        <div class="container">
            <h2 class="feature-title">Features</h2>
            <p class="feature-text">We are constantly working to bring new updates and features to Steam, such as:</p>
            <div class="icon-grid">
                <div class="icon-box"><i class="fa-solid fa-comments"></i><h4>Steam Community</h4><p>Talk with people through Steam Community via text or voice without leaving Steam.</p></div>
                <div class="icon-box"><i class="fa-solid fa-gamepad"></i><h4>Game Hubs</h4><p>Everything about your game, all in one place. Join discussions and more.</p></div>
                <div class="icon-box"><i class="fa-solid fa-video"></i><h4>Featured Trailers</h4><p>Watch the latest gameplay trailers and previews for upcoming and trending games.</p></div>
                <div class="icon-box"><i class="fa-solid fa-screwdriver-wrench"></i><h4>Game Add-ons & DLCs</h4><p>Discover, install, and manage downloadable content, expansions, and add-ons for your favorite games.</p></div>
                <div class="icon-box"><i class="fa-solid fa-mobile-screen"></i><h4>Available on Mobile</h4><p>Access Steam anywhere from your iOS or Android device.</p></div>
                <div class="icon-box"><i class="fa-solid fa-rocket"></i><h4>Early Access</h4><p>Discover, play, and get involved with games as they evolve.</p></div>
                <div class="icon-box"><i class="fa-solid fa-language"></i><h4>Global Support</h4><p>Our platform supports customers worldwide, offering help and services.</p></div>
                <div class="icon-box"><i class="fa-solid fa-credit-card"></i><h4>Purchases Made Easy</h4><p>Support for 100+ payment methods across over 35 currencies.</p></div>
                <div class="icon-box"><i class="fa-solid fa-gamepad"></i><h4>Play Your Way</h4><p>Enjoy seamless compatibility with controllers, keyboards, and gaming accessories of your choice.</p></div>
            </div>
        </div>
    </section>

    <!-- NEW CUSTOM FOOTER -->
    <footer data-bs-theme="dark">

        <div class="main-footer-section">
            <div class="container">

                <div class="row align-items-center gy-4">
                    <div class="col-lg-6">
                        <div>
                            <h2 class="footer-brand-heading">[Steam Clone]</h2>
                            <p class="footer-tagline mb-0">Where Worlds Collide.</p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div>
                            <label for="newsletter-email" class="newsletter-label mb-2">Join our Newsletter</label>
                            <div class="newsletter-input-group input-group">
                                <input type="email" id="newsletter-email" class="newsletter-input form-control"
                                    placeholder="your.email@universe.com" required>
                                <button class="newsletter-submit-btn btn" type="submit"
                                    aria-label="Subscribe">→</button>
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
                    </nav>

                    <div class="d-flex gap-4 mt-4 mt-md-0">
                        <a href="#" aria-label="Discord" class="footer-social-icon icon-discord fab fa-discord"></a>
                        <a href="#" aria-label="Reddit" class="footer-social-icon icon-reddit fab fa-reddit-alien"></a>
                        <a href="#" aria-label="YouTube" class="footer-social-icon icon-youtube fab fa-youtube"></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom-bar">
            <div class="footer-glow-border"></div>

            <div class="container">
                <div class="row align-items-center py-3 gy-2">
                    <div class="col-md-6 text-center text-md-start">
                        <small class="footer-copyright">© 2025 [Steam Clone]. All Rights Reserved.</small>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3 gap-md-4 justify-content-center justify-content-md-end">
                            <a class="footer-legal-link" href="#"><small>Terms</small></a>
                            <a class="footer-legal-link" href="#"><small>Privacy</small></a>
                            <a class="footer-legal-link" href="#"><small>Refunds</small></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>