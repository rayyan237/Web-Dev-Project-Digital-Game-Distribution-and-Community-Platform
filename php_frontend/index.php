<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Steam Store - Integrated Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* =========================================
           GLOBAL / SHARED STYLES
           ========================================= */
        body {
            background-color: #1b2838;
            /* Core Steam Blue-Black */
            color: #c7d5e0;
            font-family: "Motiva Sans", "Segoe UI", "Arial", sans-serif;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex-grow: 1;
            /* Pushes footer down */
        }

        /* Standardizing container widths slightly for visual consistency */
        .steam-section-wrapper {
            max-width: 1170px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Section Spacers */
        .section-spacer {
            margin-top: 60px;
            margin-bottom: 20px;
        }

        /* Shared Section Titles */
        .common-section-title {
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
            white-space: nowrap;
        }

        .btn-browse-more:hover {
            color: #ffffff;
            border-color: #ffffff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* =========================================
           NAVBAR STYLES
           ========================================= */
        .main-navbar {
            background: #171a21 !important;
        }

        .navbar-upper-border {
            border-bottom: 1px solid #2f3642;
        }

        .nav-link-upper {
            color: #c6d4df !important;
            transition: color 0.2s;
        }

        .nav-link-upper:hover {
            color: #fff !important;
        }

        @media (min-width: 768px) {
            .nav-link-upper {
                position: relative;
                padding-bottom: 15px !important;
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

        .secondary-navbar {
            background: #1b2838 !important;
            z-index: 1020;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        @media (min-width: 768px) {
            .secondary-navbar {
                position: sticky;
                top: 0;
            }
        }

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

        @media (min-width: 768px) {
            .desktop-search-form {
                width: 360px;
            }
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
           HERO SECTION STYLES
           ========================================= */
        .hero-section-wrapper {
            position: relative;
            margin-top: 20px;
        }

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

        .steam-nav-btn:hover {
            opacity: 1;
        }

        .steam-nav-btn:active svg {
            filter: drop-shadow(0 0 5px #fff) drop-shadow(0 0 10px #66C0F4);
            transform: scale(0.95);
        }

        .hero-prev {
            left: -60px;
        }

        .hero-next {
            right: -60px;
        }

        .steam-nav-btn svg {
            width: 50px;
            height: 100px;
            fill: #fff;
            transition: filter 0.1s;
        }

        .hero-card {
            background-color: #0f1922;
            height: 450px;
            border-radius: 0;
            overflow: visible;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            display: flex;
            text-decoration: none;
            color: inherit;
            transition: filter 0.2s;
        }

        .hero-card:hover {
            filter: brightness(1.05);
        }

        .hero-carousel-item {
            height: 450px;
        }

        .col-video {
            background: #000;
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .media-header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            padding: 8px 12px;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.8), transparent);
            z-index: 2;
            font-size: 13px;
            pointer-events: none;
        }

        video.hero-video,
        .slide-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

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

        .capsule-overlap {
            position: relative;
            z-index: 10;
            margin-top: 25px;
            margin-bottom: 10px;
            margin-left: -40px;
            width: 112%;
            transition: transform 0.3s ease;
        }

        .capsule-overlap:hover {
            transform: scale(1.02);
        }

        .capsule-overlap img {
            box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.7);
            border: 1px solid #4a5a6a;
        }

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

        .indicators-container {
            margin-top: 10px;
            display: flex;
            justify-content: center;
        }

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

        [data-bs-theme=dark] .carousel .carousel-indicators [data-bs-target],
        [data-bs-theme=dark].carousel .carousel-indicators [data-bs-target] {
            background-color: #66C0F4;
        }

        @media (max-width: 992px) {
            .steam-nav-btn {
                display: none;
            }

            .hero-card,
            .hero-carousel-item {
                height: auto;
            }

            .col-video {
                height: 250px;
            }

            .capsule-overlap {
                display: none !important;
            }

            .info-content {
                padding: 20px;
            }

            .description-truncate {
                -webkit-line-clamp: 6;
                max-height: 8.4em;
            }
        }

        /* =========================================
           SPECIAL OFFERS STYLES
           ========================================= */
        .carousel-height {
            height: 450px;
        }

        .capsule {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.7);
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
            object-position: center center;
            display: block;
        }

        .capsule-lg {
            height: 100%;
        }

        .capsule-lg .capsule-img-container {
            height: 60%;
        }

        .capsule-lg .info-block {
            height: 40%;
            flex-shrink: 0;
            padding: 16px 18px;
            background: linear-gradient(to right, #1e4e75 0%, #103451 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-start;
        }

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

        .discount-block-unified {
            display: inline-flex;
            align-items: center;
            height: 34px;
            background-color: #344654;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .deal-header {
            font-size: 1.1rem;
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 4px;
            text-transform: uppercase;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
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

        /* Scoped Carousel Controls for Special Offers and Under 10 */
        #specialOffersCarousel .carousel-control-prev,
        #specialOffersCarousel .carousel-control-next,
        #steamGameCarousel .carousel-control-prev,
        #steamGameCarousel .carousel-control-next {
            width: 45px;
            height: 100px;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.01));
            top: 50%;
            transform: translateY(-50%);
            opacity: 1;
            border-radius: 3px;
        }

        #specialOffersCarousel .carousel-control-next,
        #steamGameCarousel .carousel-control-next {
            background: linear-gradient(to left, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.01));
        }

        #specialOffersCarousel .carousel-control-prev:hover,
        #specialOffersCarousel .carousel-control-next:hover,
        #steamGameCarousel .carousel-control-prev:hover,
        #steamGameCarousel .carousel-control-next:hover {
            background-color: rgba(171, 171, 171, 0.2);
        }

        #specialOffersCarousel .carousel-control-prev,
        #steamGameCarousel .carousel-control-prev {
            left: -45px;
        }

        #specialOffersCarousel .carousel-control-next,
        #steamGameCarousel .carousel-control-next {
            right: -45px;
        }

        #specialOffersCarousel .carousel-indicators,
        #steamGameCarousel .carousel-indicators {
            bottom: -40px;
            margin: 0;
        }

        #specialOffersCarousel .carousel-indicators button,
        #steamGameCarousel .carousel-indicators button {
            width: 14px;
            height: 9px;
            border-radius: 2px;
            background-color: #3a414b;
            border: none;
            opacity: 0.6;
            margin: 0 4px;
        }

        #specialOffersCarousel .carousel-indicators button.active,
        #steamGameCarousel .carousel-indicators button.active {
            background-color: #66c0f4;
            opacity: 1;
        }

        /* Responsive specific for offers */
        @media (max-width: 991.98px) {
            #specialOffersCarousel .carousel-height {
                display: flex;
                flex-wrap: nowrap;
                overflow-x: auto;
                scroll-snap-type: x mandatory;
                padding-bottom: 10px;
                gap: 15px;
                height: 450px;
                -webkit-overflow-scrolling: touch;
            }

            #specialOffersCarousel .carousel-height::-webkit-scrollbar {
                display: none;
            }

            #specialOffersCarousel .col-lg-4 {
                flex: 0 0 85%;
                max-width: 85%;
                scroll-snap-align: center;
                height: 100%;
            }

            #specialOffersCarousel .mobile-stack-container {
                height: 100% !important;
            }

            #specialOffersCarousel .carousel-control-prev,
            #specialOffersCarousel .carousel-control-next {
                display: none;
            }
        }


        /* =========================================
           CATEGORY STYLES
           ========================================= */
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

        .category-card:hover .category-bg {
            transform: scale(1.08);
        }

        .category-card:hover .category-overlay {
            background: linear-gradient(to top, rgba(42, 71, 94, 0.8) 0%, rgba(42, 71, 94, 0.2) 100%);
        }

        .category-card:hover .category-title {
            transform: translateX(-50%) scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.6);
        }

        .category-card:hover {
            border-color: rgba(255, 255, 255, 0.2);
        }

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

        /* Generic Nav Arrow Shared by Category and Featured Carousel */
        .custom-nav-arrow {
            width: 45px;
            height: 90px;
            background-color: rgba(0, 0, 0, 0.7);
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
            border-radius: 4px;
        }

        .custom-nav-arrow:hover {
            opacity: 1;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .arrow-prev {
            left: -45px;
        }

        .arrow-next {
            right: -45px;
        }

        .arrow-icon-style {
            filter: none;
            transition: all 0.2s ease;
            opacity: 1;
            width: 2rem;
            height: 2rem;
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 16 16'%3E%3Cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
        }

        .carousel-control-next .arrow-icon-style {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 16 16'%3E%3Cpath d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
        }

        .custom-nav-arrow:hover .arrow-icon-style {
            filter: drop-shadow(0 0 3px rgba(255, 255, 255, 0.9));
        }

        @media (max-width: 991.98px) {
            #categoryCarousel .carousel-item .col-md-6 {
                flex: 0 0 50%;
                max-width: 50%;
                margin-bottom: 15px;
            }
        }


        /* =========================================
           FEATURED CAROUSEL STYLES
           ========================================= */
        .store-carousel-box {
            height: 385px;
            background-color: #171a21;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8), 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .featured-image-container {
            background-color: #171a21;
        }

        .featured-game-image {
            object-fit: fill;
            max-height: 385px;
            min-height: 385px;
            height: 100%;
            width: 100%;
            background-color: #171a21;
        }

        .game-details-panel {
            background-color: #0d121c;
            color: white;
            padding: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            box-shadow: none;
        }

        .game-title-box {
            height: 3.9em;
            margin-bottom: 0.5rem;
        }

        .game-title-text {
            color: #fff;
            font-size: 1.5em;
            font-weight: 600;
            margin: 0;
            padding: 0;
            text-align: left;
            line-height: 1.3;
        }

        .thumbnails-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 5px;
            padding: 5px 0;
            background-color: #0d121c;
            margin-top: 0;
            margin-left: -20px;
            margin-right: -20px;
        }

        .thumbnail-image {
            width: 100%;
            height: 85px;
            object-fit: cover;
            border-radius: 3px;
            opacity: 0.6;
            transition: opacity 0.3s, transform 0.2s ease-in-out;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .thumbnail-image:hover {
            opacity: 1;
            cursor: pointer;
            transform: scale(1.03);
        }

        .bottom-info-row {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            flex-grow: 1;
        }

        .status-row {
            display: flex;
            align-items: center;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .status-text {
            color: #c7d5e0;
            font-size: 0.9rem;
            margin-right: 8px;
            margin-bottom: 0;
        }

        .price-text {
            font-size: 1.2rem;
            font-weight: bold;
            color: #fff;
            margin-bottom: 0;
        }

        .status-badge-blue {
            background-color: #3b5a7e;
            color: #e0e6e9;
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 0.75em;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-badge-gray {
            background-color: #797979;
            color: #e0e6e9;
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 0.75em;
            font-weight: 600;
            text-transform: uppercase;
        }

        #gameCarousel .carousel-indicators-custom {
            position: relative;
            margin-top: 15px;
            margin-bottom: 0;
            gap: 5px;
        }

        @media (max-width: 767.98px) {

            .custom-nav-arrow,
            .carousel-indicators-custom {
                display: none;
            }

            .store-carousel-box.overflow-hidden {
                overflow: auto !important;
                overflow-x: scroll !important;
            }

            .store-carousel-box {
                height: auto;
                box-shadow: none;
                display: flex;
                flex-wrap: nowrap;
                -webkit-overflow-scrolling: touch;
                scroll-snap-type: x mandatory;
            }

            .slide-item {
                min-width: 90%;
                margin: 0 5%;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
                scroll-snap-align: center;
                background-color: #171a21;
                display: flex;
                flex-shrink: 0;
            }

            .slide-item.active {
                display: flex;
            }

            .slide-item .row {
                flex-direction: column;
                height: auto;
                width: 100%;
            }

            .featured-game-image {
                max-height: 200px;
                min-height: 200px;
                object-fit: cover;
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
            }

            .game-details-panel {
                padding: 15px;
                height: auto;
                min-height: 250px;
                background-color: #0d121c;
                border-bottom-left-radius: 8px;
                border-bottom-right-radius: 8px;
            }

            .game-title-text {
                font-size: 1.3em;
            }

            .thumbnails-grid {
                display: none;
            }

            .bottom-info-row {
                flex-grow: 0;
                margin-top: 10px;
            }
        }


        /* =========================================
           UNDER $10 STYLES
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

        .card-body-steam {
            background: #10151d;
            padding: 4px 8px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-top: auto;
        }

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

        .regular-price-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #000000;
            color: #ffffff;
            font-size: 12px;
            font-weight: 600;
            padding: 0 8px;
            height: 24px;
            border-radius: 1px;
            margin-left: 0;
        }

        @media (max-width: 767.98px) {
            #steamGameCarousel .col-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            #steamGameCarousel .carousel-control-prev,
            #steamGameCarousel .carousel-control-next {
                display: none;
            }
        }


        /* =========================================
           FOOTER STYLES
           ========================================= */
        .main-footer-section {
            background-image: radial-gradient(ellipse at 70% 120%, #1a2035 0%, #0a0f1a 60%);
            padding-top: 3rem;
            padding-bottom: 3rem;
            margin-top: 50px;
        }

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

        .newsletter-label {
            font-weight: 600;
            color: #00f0ff;
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

        .footer-nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0.5rem;
            width: 0;
            height: 2px;
            background: #a040ff;
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

        .footer-social-icon {
            color: #8a94a6;
            font-size: 1.5rem;
            transition: color 0.3s, transform 0.3s, text-shadow 0.3s;
            text-decoration: none;
        }

        .footer-social-icon:hover {
            transform: scale(1.1) translateY(-2px);
        }

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

        .footer-bottom-bar {
            position: relative;
            background-color: #000;
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
            0% {
                background-position: 150% 0;
            }

            100% {
                background-position: -150% 0;
            }
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

<body data-bs-theme="dark">

    <!-- =========================
         NAVBAR (Centralized Include)
         ========================= -->
    <?php include 'navbar_include.php'; ?>


    <!-- =========================
         MAIN CONTENT
         ========================= -->
    <main>

        <!-- 1. HERO SECTION (CAROUSEL) -->
        <div class="steam-section-wrapper hero-section-wrapper">
            <button class="steam-nav-btn hero-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <svg viewBox="0 0 50 100" style="transform: rotate(180deg);">
                    <polygon points="0,0.093 0,25.702 24.323,50.026 0,74.349 0,99.955 49.929,50.026 "></polygon>
                </svg>
            </button>

            <button class="steam-nav-btn hero-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <svg viewBox="0 0 50 100">
                    <polygon points="0,0.093 0,25.702 24.323,50.026 0,74.349 0,99.955 49.929,50.026 "></polygon>
                </svg>
            </button>

            <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner shadow-lg" id="heroCarouselInner">
                    <!-- Dynamic slides will be loaded here -->
                    <div class="carousel-item active hero-carousel-item">
                        <div class="hero-card row g-0 rounded-top-1 text-decoration-none">
                            <div class="col-lg-8 col-video d-flex align-items-center justify-content-center" style="background: #0e141b;">
                                <div class="spinner-border text-info" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-info">
                                <div class="info-content d-flex flex-column align-items-center justify-content-center">
                                    <p class="text-white">Loading games...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="indicators-container">
                    <div class="carousel-indicators custom-indicators-style" id="heroIndicators">
                        <!-- Dynamic indicators will be loaded here -->
                    </div>
                </div>
            </div>
        </div>


        <!-- 2. SPECIAL OFFERS SECTION -->
        <div class="section-spacer steam-section-wrapper">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="common-section-title">SPECIAL OFFERS 50% OFF!</h2>
                <a href="browse-more.php" class="btn-browse-more">Browse More</a>
            </div>

            <div id="specialOffersCarousel" class="carousel slide" data-bs-ride="false">
                <div class="carousel-indicators" id="specialOffersIndicators">
                    <!-- Indicators will be generated dynamically -->
                </div>

                <div class="carousel-inner" id="specialOffersCarouselInner">
                    <!-- Carousel items will be generated dynamically -->
                    <div class="loading-spinner text-center py-5">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-light mt-3">Loading special offers...</p>
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#specialOffersCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#specialOffersCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>


        <!-- 3. BROWSE BY CATEGORY -->
        <div class="section-spacer steam-section-wrapper">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="common-section-title">BROWSE BY CATEGORY</h2>
            </div>

            <div id="categoryCarousel" class="carousel slide" data-bs-ride="false" data-bs-touch="true">
                <div class="carousel-indicators" id="categoryIndicators">
                    <!-- Indicators will be generated dynamically -->
                </div>

                <div class="carousel-inner" id="categoryCarouselInner">
                    <!-- Carousel items will be generated dynamically -->
                    <div class="loading-spinner text-center py-5">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-light mt-3">Loading categories...</p>
                    </div>
                </div>

                <button class="custom-nav-arrow arrow-prev carousel-control-prev" type="button"
                    data-bs-target="#categoryCarousel" data-bs-slide="prev">
                    <span class="arrow-icon-style carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="custom-nav-arrow arrow-next carousel-control-next" type="button"
                    data-bs-target="#categoryCarousel" data-bs-slide="next">
                    <span class="arrow-icon-style carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>


        <!-- 4. FEATURED & RECOMMENDED (Carousel with screenshots) -->
        <div class="section-spacer steam-section-wrapper">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="common-section-title">FEATURED & RECOMMENDED</h2>
            </div>

            <div id="gameCarousel" class="carousel slide" data-bs-ride="false" data-bs-interval="false">
                <div class="store-carousel-box carousel-inner rounded-3 overflow-hidden shadow-lg" id="recommendedCarouselInner">
                    <!-- Carousel items will be generated dynamically -->
                    <div class="loading-spinner text-center py-5">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-light mt-3">Loading featured games...</p>
                    </div>
                </div>

                <div class="carousel-indicators-custom carousel-indicators" id="recommendedIndicators">
                    <!-- Indicators will be generated dynamically -->
                </div>

                <button class="custom-nav-arrow arrow-prev carousel-control-prev" type="button"
                    data-bs-target="#gameCarousel" data-bs-slide="prev">
                    <span class="arrow-icon-style carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="custom-nav-arrow arrow-next carousel-control-next" type="button"
                    data-bs-target="#gameCarousel" data-bs-slide="next">
                    <span class="arrow-icon-style carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>


        <!-- 5. UNDER $10 SECTION -->
        <div class="section-spacer steam-section-wrapper">
            <div class="d-flex justify-content-between align-items-end mb-2">
                <h2 class="common-section-title">UNDER $10 USD</h2>
                <div class="d-flex gap-2">
                    <a href="browse-cheap.php?price=10" class="btn-browse-more">UNDER $10 USD</a>
                    <a href="browse-cheap.php?price=5" class="btn-browse-more">UNDER $5 USD</a>
                </div>
            </div>

            <div id="steamGameCarousel" class="carousel slide" data-bs-ride="false">
                <div class="carousel-inner" id="under10CarouselInner">
                    <!-- Carousel items will be generated dynamically -->
                    <div class="loading-spinner text-center py-5">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-light mt-3">Loading games...</p>
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#steamGameCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#steamGameCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
                <div class="carousel-indicators" id="under10Indicators">
                    <!-- Indicators will be generated dynamically -->
                        class="active"></button>
                    <button type="button" data-bs-target="#steamGameCarousel" data-bs-slide-to="1"></button>
                </div>
            </div>
        </div>

    </main>

    <!-- =========================
         FOOTER
         ========================= -->
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
                                <button class="newsletter-submit-btn btn" type="submit">→</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-center border-top border-secondary-subtle mt-5 pt-5">
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
        document.addEventListener('DOMContentLoaded', () => {
            // Logic for the "Featured & Recommended" Carousel (Hover screenshots)
            const carouselElement = document.getElementById('gameCarousel');
            const screenshotImages = document.querySelectorAll('.thumbnail-image');

            screenshotImages.forEach(screenshotImg => {
                const carouselItem = screenshotImg.closest('.carousel-item');
                const mainImage = carouselItem ? carouselItem.querySelector('.featured-game-image') : null;

                if (mainImage) {
                    const originalSrc = mainImage.getAttribute('data-original');

                    screenshotImg.addEventListener('mouseover', function () {
                        if (window.innerWidth >= 768) {
                            mainImage.src = this.src;
                        }
                    });

                    screenshotImg.addEventListener('mouseout', function () {
                        if (window.innerWidth >= 768) {
                            mainImage.src = originalSrc;
                        }
                    });
                }
            });

            if (carouselElement) {
                carouselElement.addEventListener('slid.bs.carousel', function (event) {
                    const activeItem = event.relatedTarget;
                    const mainImage = activeItem.querySelector('.featured-game-image');
                    if (mainImage) {
                        mainImage.src = mainImage.getAttribute('data-original');
                    }
                });

                // Stop auto-cycling for this specific carousel on mobile if preferred
                if (window.innerWidth < 768) {
                    const carouselInstance = bootstrap.Carousel.getInstance(carouselElement);
                    if (carouselInstance) carouselInstance.pause();
                }
            }
        });

        // Load hero carousel games from database
        async function loadHeroCarousel() {
            try {
                const response = await fetch('../php_backend/get_hero_games.php');
                const data = await response.json();

                if (data.success && data.games.length > 0) {
                    const carouselInner = document.getElementById('heroCarouselInner');
                    const indicatorsContainer = document.getElementById('heroIndicators');
                    
                    // Clear existing content
                    carouselInner.innerHTML = '';
                    indicatorsContainer.innerHTML = '';

                    // Create slides
                    data.games.forEach((game, index) => {
                        const isActive = index === 0 ? 'active' : '';
                        const priceDisplay = game.price == 0 ? 'Free To Play' : `$${parseFloat(game.price).toFixed(2)}`;
                        
                        // Truncate description to ~150 characters
                        const shortDescription = game.description.length > 150 
                            ? game.description.substring(0, 150) + '...' 
                            : game.description;

                        // Check if game has video, otherwise use header image
                        const hasVideo = game.video_url && game.video_url !== null;

                        const slide = `
                            <div class="carousel-item ${isActive} hero-carousel-item">
                                <a href="#" class="hero-card row g-0 rounded-top-1 text-decoration-none">
                                    <div class="col-lg-8 col-video">
                                        <div class="media-header text-white">
                                            <span class="text-info fw-bold">${hasVideo ? 'Trailer Preview' : 'Featured Game'}</span> &nbsp;|&nbsp; ${game.title}
                                        </div>
                                        ${hasVideo ? `
                                            <video class="hero-video" autoplay muted loop playsinline poster="../${game.header_image}">
                                                <source src="../${game.video_url}" type="video/mp4">
                                            </video>
                                        ` : `
                                            <img src="../${game.header_image}" class="hero-video" alt="${game.title}" style="object-fit: cover;">
                                        `}
                                    </div>
                                    <div class="col-lg-4 col-info">
                                        <div class="info-content d-flex flex-column">
                                            <div class="capsule-overlap">
                                                <img src="../${game.thumbnail_image}" class="img-fluid rounded-1" alt="${game.title}">
                                            </div>
                                            <h2 class="text-white fw-light mb-2" style="font-size: 28px;">${game.title}</h2>
                                            <div class="d-flex flex-wrap gap-1 mb-3">
                                                <span class="badge steam-badge">${game.developer_name}</span>
                                            </div>
                                            <p class="description-truncate">${shortDescription}</p>
                                            <div class="mt-auto ms-auto pb-2">
                                                <span class="price-btn">${priceDisplay}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        `;
                        
                        carouselInner.innerHTML += slide;

                        // Create indicator
                        const indicator = `
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="${index}" 
                                ${isActive ? 'class="active"' : ''} aria-label="Slide ${index + 1}"></button>
                        `;
                        indicatorsContainer.innerHTML += indicator;
                    });

                    // Reinitialize carousel
                    const heroCarousel = document.getElementById('heroCarousel');
                    if (heroCarousel) {
                        const carousel = new bootstrap.Carousel(heroCarousel, {
                            interval: 5000,
                            ride: 'carousel'
                        });
                    }
                } else {
                    console.error('No games found for hero carousel');
                }
            } catch (error) {
                console.error('Error loading hero carousel:', error);
            }
        }

        // Load hero carousel on page load
        document.addEventListener('DOMContentLoaded', loadHeroCarousel);

        // Load special offers carousel from database
        async function loadSpecialOffers() {
            try {
                const response = await fetch('../php_backend/get_special_offers.php');
                const data = await response.json();

                if (data.success && data.games.length > 0) {
                    const carouselInner = document.getElementById('specialOffersCarouselInner');
                    const indicatorsContainer = document.getElementById('specialOffersIndicators');
                    
                    // Clear loading spinner
                    carouselInner.innerHTML = '';
                    indicatorsContainer.innerHTML = '';

                    // Group games into slides (4 games per slide)
                    const gamesPerSlide = 4;
                    const slides = [];
                    for (let i = 0; i < data.games.length; i += gamesPerSlide) {
                        slides.push(data.games.slice(i, i + gamesPerSlide));
                    }

                    // Create slides
                    slides.forEach((slideGames, slideIndex) => {
                        const isActive = slideIndex === 0 ? 'active' : '';
                        
                        let slideHTML = `
                            <div class="carousel-item ${isActive}">
                                <div class="row gx-3 gy-0 carousel-height">
                        `;

                        slideGames.forEach((game, gameIndex) => {
                            const isFirstTwo = gameIndex < 2;
                            const colClass = isFirstTwo ? 'col-lg-4 h-100' : '';
                            const capsuleClass = isFirstTwo ? 'capsule-lg' : 'capsule-sm';

                            if (gameIndex === 2) {
                                // Start stacked container for remaining games
                                slideHTML += `<div class="col-lg-4 h-100"><div class="mobile-stack-container">`;
                            }

                            slideHTML += `
                                ${isFirstTwo ? `<div class="${colClass}">` : ''}
                                <div class="capsule ${capsuleClass}">
                                    <div class="capsule-img-container">
                                        <img src="../${game.thumbnail_image}" alt="${game.title}">
                                    </div>
                                    <div class="info-block">
                                        <div>
                                            <div class="deal-header">${game.title}</div>
                                        </div>
                                        <div class="discount-block-unified">
                                            <div class="discount-percent-unified">-50%</div>
                                            <div class="price-box-unified">
                                                <div class="original-price">$${game.fake_price}</div>
                                                <div class="final-price">$${game.actual_price}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ${isFirstTwo ? `</div>` : ''}
                            `;
                        });

                        // Close stacked container if there were small cards
                        if (slideGames.length > 2) {
                            slideHTML += `</div></div>`;
                        }

                        slideHTML += `
                                </div>
                            </div>
                        `;
                        
                        carouselInner.innerHTML += slideHTML;

                        // Create indicator
                        const indicator = `
                            <button type="button" data-bs-target="#specialOffersCarousel" data-bs-slide-to="${slideIndex}" 
                                ${isActive ? 'class="active"' : ''} aria-label="Slide ${slideIndex + 1}"></button>
                        `;
                        indicatorsContainer.innerHTML += indicator;
                    });

                    // Reinitialize carousel
                    const specialOffersCarousel = document.getElementById('specialOffersCarousel');
                    if (specialOffersCarousel) {
                        new bootstrap.Carousel(specialOffersCarousel, {
                            interval: false,
                            ride: false
                        });
                    }
                } else {
                    const carouselInner = document.getElementById('specialOffersCarouselInner');
                    carouselInner.innerHTML = `
                        <div class="carousel-item active">
                            <div class="row gx-3 gy-0 carousel-height">
                                <div class="col-12 text-center py-5 d-flex align-items-center justify-content-center">
                                    <h3 style="color: #4c6b22;">No special offers available. Check back soon!</h3>
                                </div>
                            </div>
                        </div>
                    `;
                }
            } catch (error) {
                console.error('Error loading special offers:', error);
            }
        }

        // Load special offers on page load
        document.addEventListener('DOMContentLoaded', loadSpecialOffers);

        // Category image mapping (using existing images)
        const categoryImages = {
            'Action': '../assets/images/action.webp',
            'Adventure': '../assets/images/story_rich.webp',
            'Role-Playing (RPG)': '../assets/images/anime.webp',
            'Strategy': '../assets/images/strategy.webp',
            'Simulation': '../assets/images/simulation.webp',
            'Sports': '../assets/images/racing.webp',
            'Puzzle': '../assets/images/strategy.webp',
            'Fighting': '../assets/images/fighting_martial_arts.webp',
            'Horror': '../assets/images/survival.webp',
            'MOBA': '../assets/images/multiplayer_coop.webp',
            'Survival': '../assets/images/survival.webp',
            'Sandbox': '../assets/images/freetoplay.webp',
            'Platformer': '../assets/images/anime.webp',
            'Stealth': '../assets/images/science_fiction.webp'
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
                            const categorySlug = category.genre_name.toLowerCase().replace(/\s+/g, '-').replace(/[()]/g, '');
                            
                            slideHTML += `
                                <div class="col-lg-3 col-md-6">
                                    <a href="category-details.php?cat=${categorySlug}&genre_id=${category.genre_id}" class="category-card">
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
                                ${isActive ? 'class="active"' : ''} aria-label="Slide ${slideIndex + 1}"></button>
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
                                    <h3 style="color: #8f98a0;">No categories available</h3>
                                </div>
                            </div>
                        </div>
                    `;
                }
            } catch (error) {
                console.error('Error loading categories:', error);
            }
        }

        // Load categories on page load
        document.addEventListener('DOMContentLoaded', loadCategories);

        // Load recommended games for Featured & Recommended section
        async function loadRecommendedGames() {
            try {
                const response = await fetch('../php_backend/get_recommended_games.php');
                const data = await response.json();

                if (data.success && data.games.length > 0) {
                    const carouselInner = document.getElementById('recommendedCarouselInner');
                    const indicatorsContainer = document.getElementById('recommendedIndicators');
                    
                    // Clear loading spinner
                    carouselInner.innerHTML = '';
                    indicatorsContainer.innerHTML = '';

                    // Create slides
                    data.games.forEach((game, index) => {
                        const isActive = index === 0 ? 'active' : '';
                        const priceDisplay = game.price == 0 ? 'Free to Play' : `$${parseFloat(game.price).toFixed(2)} USD`;
                        
                        // Create tags HTML (limit to first 5 tags to avoid overflow)
                        const tagsHTML = game.tags && game.tags.length > 0 
                            ? game.tags.slice(0, 5).map(tag => `<span class="status-badge-blue">${tag}</span>`).join(' ')
                            : '<span class="status-badge-blue">No tags available</span>';

                        const slide = `
                            <div class="slide-item carousel-item ${isActive}">
                                <div class="row g-0 h-100">
                                    <div class="featured-image-container col-md-8 px-0">
                                        <img src="../${game.header_image}" data-original="../${game.header_image}"
                                            alt="${game.title}" class="featured-game-image">
                                    </div>
                                    <div class="col-md-4 p-0">
                                        <div class="game-details-panel">
                                            <div class="game-title-box d-flex align-items-center">
                                                <h3 class="game-title-text">${game.title}</h3>
                                            </div>
                                            <div class="thumbnails-grid">
                                                ${game.screenshots.map((screenshot, idx) => `
                                                    <div><img class="thumbnail-image" src="../${screenshot}" alt="${idx + 1}"></div>
                                                `).join('')}
                                            </div>
                                            <div class="bottom-info-row">
                                                <div class="status-row">
                                                    ${tagsHTML}
                                                </div>
                                                <p class="price-text">${priceDisplay}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        carouselInner.innerHTML += slide;

                        // Create indicator
                        const indicator = `
                            <button type="button" data-bs-target="#gameCarousel" data-bs-slide-to="${index}" 
                                ${isActive ? 'class="active" aria-current="true"' : ''}></button>
                        `;
                        indicatorsContainer.innerHTML += indicator;
                    });

                    // Reinitialize carousel
                    const gameCarousel = document.getElementById('gameCarousel');
                    if (gameCarousel) {
                        new bootstrap.Carousel(gameCarousel, {
                            interval: false,
                            ride: false
                        });
                    }
                } else {
                    const carouselInner = document.getElementById('recommendedCarouselInner');
                    carouselInner.innerHTML = `
                        <div class="slide-item carousel-item active">
                            <div class="row g-0 h-100">
                                <div class="col-12 text-center py-5 d-flex align-items-center justify-content-center">
                                    <h3 style="color: #8f98a0;">No featured games available. Check back soon!</h3>
                                </div>
                            </div>
                        </div>
                    `;
                    document.getElementById('recommendedIndicators').innerHTML = '';
                }
            } catch (error) {
                console.error('Error loading recommended games:', error);
            }
        }

        // Load recommended games on page load
        document.addEventListener('DOMContentLoaded', loadRecommendedGames);

        // Load games under $10
        async function loadUnder10Games() {
            try {
                const response = await fetch('../php_backend/get_under_10_games.php');
                const data = await response.json();

                if (data.success && data.games.length > 0) {
                    const carouselInner = document.getElementById('under10CarouselInner');
                    const indicatorsContainer = document.getElementById('under10Indicators');
                    
                    // Clear loading spinner
                    carouselInner.innerHTML = '';
                    indicatorsContainer.innerHTML = '';

                    // Group games into slides (4 games per slide)
                    const gamesPerSlide = 4;
                    const slides = [];
                    for (let i = 0; i < data.games.length; i += gamesPerSlide) {
                        slides.push(data.games.slice(i, i + gamesPerSlide));
                    }

                    // Create slides
                    slides.forEach((slideGames, slideIndex) => {
                        const isActive = slideIndex === 0 ? 'active' : '';
                        
                        let slideHTML = `
                            <div class="carousel-item ${isActive}">
                                <div class="row g-3">
                        `;

                        slideGames.forEach(game => {
                            const priceDisplay = `$${parseFloat(game.price).toFixed(2)} USD`;
                            
                            slideHTML += `
                                <div class="col-md-3 col-6">
                                    <div class="steam-card">
                                        <img src="../${game.header_image}" alt="${game.title}">
                                        <div class="card-body-steam">
                                            <span class="regular-price-badge">${priceDisplay}</span>
                                        </div>
                                    </div>
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
                            <button type="button" data-bs-target="#steamGameCarousel" data-bs-slide-to="${slideIndex}" 
                                ${isActive ? 'class="active" aria-current="true"' : ''}></button>
                        `;
                        indicatorsContainer.innerHTML += indicator;
                    });

                    // Reinitialize carousel
                    const steamCarousel = document.getElementById('steamGameCarousel');
                    if (steamCarousel) {
                        new bootstrap.Carousel(steamCarousel, {
                            interval: false,
                            ride: false
                        });
                    }
                } else {
                    const carouselInner = document.getElementById('under10CarouselInner');
                    carouselInner.innerHTML = `
                        <div class="carousel-item active">
                            <div class="row g-3">
                                <div class="col-12 text-center py-5">
                                    <h3 style="color: #8f98a0;">No games under $10 available at the moment</h3>
                                </div>
                            </div>
                        </div>
                    `;
                    document.getElementById('under10Indicators').innerHTML = '';
                }
            } catch (error) {
                console.error('Error loading under $10 games:', error);
            }
        }

        // Load under $10 games on page load
        document.addEventListener('DOMContentLoaded', loadUnder10Games);
    </script>
</body>

</html>