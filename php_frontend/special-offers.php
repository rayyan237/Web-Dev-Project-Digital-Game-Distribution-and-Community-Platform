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
            font-family: "Motiva Sans", Sans-serif, Arial, sans-serif;
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
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
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
            box-shadow: 0 5px 15px rgba(0,0,0,0.7);
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
            /* Focus closer to center for landscape-in-portrait */
            object-position: center center; 
            display: block;
        }

        /* --- LARGE CARDS (Updated for Landscape Images) --- */
        .capsule-lg {
            height: 100%;
        }
        
        /* REDUCED IMAGE HEIGHT:
           By giving the image 60% instead of 80%, we reduce the aspect ratio strain.
           The image won't look as zoomed in.
        */
        .capsule-lg .capsule-img-container {
            height: 60%; 
        }

        /* EXPANDED INFO:
           The info block now takes 40% of the height.
           This creates a "Poster" look where the text body supports the image.
        */
        .capsule-lg .info-block {
            height: 40%;
            flex-shrink: 0;
            padding: 16px 18px; /* More padding for the larger area */
            background: linear-gradient(to right, #1e4e75 0%, #103451 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Pushes Title Up, Price Down */
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        /* --- Typography --- */
        /* Updated Deal Header for Large Cards to fill space better */
        .deal-header {
            font-size: 1.1rem; /* Larger title for large cards */
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 4px;
            text-transform: uppercase;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
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

        .live-badge {
            position: absolute;
            top: 8px;
            left: 8px;
            background-color: #d94126;
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 2px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 6px;
            z-index: 5;
            pointer-events: none;
            letter-spacing: 0.5px;
        }
        .live-dot { width: 6px; height: 6px; background-color: #fff; border-radius: 50%; }

        /* =========================================
           6. CONTROLS & RESPONSIVE
           ========================================= */
        .carousel-control-prev, .carousel-control-next {
            width: 45px;
            height: 100px;
            background: linear-gradient(to right, rgba(0,0,0,0.5), rgba(0,0,0,0.01));
            top: 50%;
            transform: translateY(-50%);
            opacity: 1;
            border-radius: 3px;
        }
        .carousel-control-next { background: linear-gradient(to left, rgba(0,0,0,0.5), rgba(0,0,0,0.01)); }
        .carousel-control-prev:hover, .carousel-control-next:hover { background-color: rgba(171, 171, 171, 0.2); }
        .carousel-control-prev { left: -45px; }
        .carousel-control-next { right: -45px; }
        
        .carousel-indicators { bottom: -40px; margin: 0; }
        .carousel-indicators button {
            width: 14px; height: 9px; border-radius: 2px; background-color: #3a414b; border: none; opacity: 0.6; margin: 0 4px;
        }
        .carousel-indicators button.active { background-color: #66c0f4; opacity: 1; }

        @media (max-width: 991.98px) {
            .special-offers-carousel-container { padding: 0 15px; }
            .carousel-height {
                display: flex; flex-wrap: nowrap; overflow-x: auto; scroll-snap-type: x mandatory; 
                padding-bottom: 10px; gap: 15px; height: 450px; -webkit-overflow-scrolling: touch;
            }
            .carousel-height::-webkit-scrollbar { display: none; }
            .col-lg-4 { flex: 0 0 85%; max-width: 85%; scroll-snap-align: center; height: 100%; }
            .mobile-stack-container { height: 100% !important; }
            .carousel-control-prev, .carousel-control-next { display: none; }
        }
    </style>
</head>

<body>

    <?php include 'navbar_include.php'; ?>

    <div class="container mt-5 steam-container-width special-offers-carousel-container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="section-title">DISCOUNTS & EVENTS</h2>
            <a href="browse-more.php" class="btn-browse-more">Browse More</a>
        </div>

        <div id="specialOffersCarousel" class="carousel slide" data-bs-ride="false">

            <div class="carousel-indicators">
                <button type="button" data-bs-target="#specialOffersCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#specialOffersCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#specialOffersCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner">

                <div class="carousel-item active">
                    <div class="row gx-3 gy-0 carousel-height">

                        <div class="col-lg-4 h-100">
                            <div class="capsule capsule-lg">
                                <div class="capsule-img-container">
                                    <img src="\assets\images\s4_header.jpg" alt="Cozy Quest">
                                </div>
                                <div class="info-block">
                                    <div>
                                        <div class="deal-header">Midweek Deal</div>
                                        <div class="deal-timer">Offer ends 24 Nov @ 11:00pm</div>
                                    </div>
                                    <div>
                                        <div class="discount-upto">Up to -85%</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 h-100">
                            <div class="capsule capsule-lg">
                                <div class="capsule-img-container">
                                    <img src="\assets\images\s2_header.jpg" alt="Ace Attorney">
                                </div>
                                <div class="info-block">
                                    <div>
                                        <div class="deal-header">Midweek Deal</div>
                                        <div class="deal-timer">Offer ends 1 Dec @ 11:00pm</div>
                                    </div>
                                    <div class="discount-block-unified">
                                        <div class="discount-percent-unified">-67%</div>
                                        <div class="price-box-unified">
                                            <div class="original-price">$23.99</div>
                                            <div class="final-price">$7.91 USD</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 h-100">
                            <div class="mobile-stack-container">
                                
                                <div class="capsule capsule-sm">
                                    <div class="capsule-img-container">
                                        <img src="\assets\images\s3_header.jpg" alt="Commandos">
                                    </div>
                                    <div class="info-block">
                                        <div class="todays-deal-text">Today's deal!</div>
                                        <div class="discount-block-unified">
                                            <div class="discount-percent-unified">-20%</div>
                                            <div class="price-box-unified">
                                                <div class="original-price">$32.99</div>
                                                <div class="final-price">$26.39</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="capsule capsule-sm">
                                    <div class="capsule-img-container">
                                        <img src="\assets\images\s1_header.jpg" alt="News Tower">
                                    </div>
                                    <div class="info-block">
                                        <div class="todays-deal-text">Today's deal!</div>
                                        <div class="discount-block-unified">
                                            <div class="discount-percent-unified">-20%</div>
                                            <div class="price-box-unified">
                                                <div class="original-price">$11.99</div>
                                                <div class="final-price">$9.59</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="carousel-item">
                    <div class="row gx-3 gy-0 carousel-height">
                        <div class="col-lg-4 h-100">
                            <div class="capsule capsule-lg">
                                <div class="capsule-img-container">
                                    <img src="\assets\images\s8_header.jpg" alt="Game A">
                                </div>
                                <div class="info-block">
                                    <div>
                                        <div class="deal-header">Weekend Deal</div>
                                        <div class="deal-timer">Ends Monday</div>
                                    </div>
                                    <div class="discount-block-unified">
                                        <div class="discount-percent-unified">-50%</div>
                                        <div class="price-box-unified">
                                            <div class="original-price">$59.99</div>
                                            <div class="final-price">$29.99</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="col-lg-4 h-100">
                            <div class="capsule capsule-lg">
                                <div class="capsule-img-container">
                                    <img src="\assets\images\s6_header.jpg" alt="Game B">
                                </div>
                                <div class="info-block">
                                    <div>
                                        <div class="deal-header">Midweek Deal</div>
                                        <div class="deal-timer">Ends Thursday</div>
                                    </div>
                                    <div class="discount-upto">Up to -75%</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 h-100">
                            <div class="mobile-stack-container">
                                <div class="capsule capsule-sm">
                                    <div class="capsule-img-container">
                                        <img src="\assets\images\s7_header.jpg" alt="Game C">
                                    </div>
                                    <div class="info-block">
                                        <div class="todays-deal-text">Today's deal!</div>
                                        <div class="discount-block-unified">
                                            <div class="discount-percent-unified">-33%</div>
                                            <div class="price-box-unified">
                                                <div class="original-price">$14.99</div>
                                                <div class="final-price">$9.99</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="capsule capsule-sm">
                                    <div class="capsule-img-container">
                                        <img src="\assets\images\s5_header.jpg" alt="Game D">
                                    </div>
                                    <div class="info-block">
                                        <div class="todays-deal-text">Today's deal!</div>
                                        <div class="discount-block-unified">
                                            <div class="discount-percent-unified">-10%</div>
                                            <div class="price-box-unified">
                                                <div class="original-price">$29.99</div>
                                                <div class="final-price">$26.99</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="row gx-3 gy-0 carousel-height">
                         <div class="col-12 text-center py-5 d-flex align-items-center justify-content-center">
                             <h3 style="color: #4c6b22;">More deals coming soon...</h3>
                         </div>
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
</body>
</html>