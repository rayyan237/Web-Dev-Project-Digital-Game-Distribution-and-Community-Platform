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
            font-family: "Motiva Sans", Sans-serif, Arial, sans-serif;
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

        /* APPLIED YOUR REQUESTED STYLE LOGIC HERE */
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
            /* Dark footer background */
            padding: 4px 8px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            /* Left Align */
            margin-top: auto;
        }

        /* --- DISCOUNTED PRICE BLOCKS --- */
        .discount-wrapper {
            display: inline-flex;
            height: 100%;
            align-items: center;
        }

        .discount-badge {
            background-color: #4c6b22;
            color: #beee11;
            font-size: 15px;
            font-weight: 700;
            padding: 2px 6px;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .price-box {
            background-color: #344654;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-end;
            padding: 0 6px;
            height: 100%;
            min-width: 50px;
        }

        .original-price {
            color: #738895;
            text-decoration: line-through;
            font-size: 9px;
            line-height: 1;
            position: relative;
            top: 1px;
        }

        .final-price {
            color: #beee11;
            font-size: 12px;
            font-weight: 600;
            line-height: 1;
        }

        /* --- REGULAR PRICE BADGE --- */
        .regular-price-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #000000;
            /* Dark Badge Background */
            color: #ffffff;
            font-size: 12px;
            font-weight: 600;
            padding: 0 8px;
            height: 24px;
            border-radius: 1px;
            margin-left: 0;
        }

        /* Live Tag */
        .live-tag {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #d94126;
            color: #fff;
            padding: 1px 6px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            z-index: 2;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .live-dot {
            height: 6px;
            width: 6px;
            background: #fff;
            border-radius: 50%;
            display: inline-block;
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

            <div class="carousel-inner">

                <div class="carousel-item active">
                    <div class="row g-3">

                        <div class="col-md-3 col-6">
                            <div class="steam-card">
                                <img src="../assets/images/s1_header.jpg" alt="Vein">
                                <div class="card-body-steam">
                                    <span class="regular-price-badge">$8.19 USD</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-6">
                            <div class="steam-card">
                                <img src="../assets/images/s2_header.jpg" alt="DMC5">
                                <div class="card-body-steam">
                                    <div class="discount-wrapper">
                                        <div class="discount-badge">-67%</div>
                                        <div class="price-box">
                                            <span class="original-price">$23.99</span>
                                            <span class="final-price">$7.91 USD</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-6">
                            <div class="steam-card">
                                <img src="../assets/images/s3_header.jpg" alt="SpaceBourne">
                                <div class="card-body-steam">
                                    <div class="discount-wrapper">
                                        <div class="discount-badge">-20%</div>
                                        <div class="price-box">
                                            <span class="original-price">$8.19</span>
                                            <span class="final-price">$6.55 USD</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-6">
                            <div class="steam-card">
                                <img src="../assets/images/s4_header.jpg" alt="Moria">
                                <div class="card-body-steam">
                                    <div class="discount-wrapper">
                                        <div class="discount-badge">-50%</div>
                                        <div class="price-box">
                                            <span class="original-price">$10.49</span>
                                            <span class="final-price">$5.24 USD</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="carousel-item">
                    <div class="row g-3">
                        <div class="col-md-3 col-6">
                            <div class="steam-card">
                                <img src="../assets/images/headees.jpg" alt="Hades">
                                <div class="card-body-steam">
                                    <div class="discount-wrapper">
                                        <div class="discount-badge">-20%</div>
                                        <div class="price-box">
                                            <span class="original-price">$10.49</span>
                                            <span class="final-price">$8.39 USD</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="steam-card">
                                <img src="../assets/images/repo.jpg" alt="REPO">
                                <div class="card-body-steam">
                                    <span class="regular-price-badge">$5.49 USD</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="steam-card">
                                <img src="../assets/images/rally.jpg" alt="Rally">
                                <div class="card-body-steam">
                                    <div class="discount-wrapper">
                                        <div class="discount-badge">-20%</div>
                                        <div class="price-box">
                                            <span class="original-price">$10.49</span>
                                            <span class="final-price">$8.39 USD</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="steam-card">
                                <img src="../assets/images/vein.jpg" alt="Vein">
                                <div class="card-body-steam">
                                    <span class="regular-price-badge">$9.99 USD</span>
                                </div>
                            </div>
                        </div>
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

            <div class="carousel-indicators">
                <button type="button" data-bs-target="#steamGameCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true"></button>
                <button type="button" data-bs-target="#steamGameCarousel" data-bs-slide-to="1"></button>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>