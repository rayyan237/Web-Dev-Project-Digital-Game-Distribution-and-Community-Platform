<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer - Simple CSS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* =========================================
           1. BASE STYLES
           ========================================= */
        body {
            background-color: #0F172A;
            color: #E0E0E0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-placeholder {
            flex-grow: 1;
            padding: 2rem;
            text-align: center;
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

<body data-bs-theme="dark">

    <div class="content-placeholder">
        <h1>Simple CSS Footer</h1>
        <p>No BEM. No generic utility classes. All styles are scoped directly to descriptive class names.</p>
    </div>

    <footer data-bs-theme="dark">

        <div class="main-footer-section">
            <div class="container">

                <div class="row align-items-center gy-4">
                    <div class="col-lg-6">
                        <div>
                            <h2 class="footer-brand-heading">JAMEEL'S J.</h2>
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
</body>

</html>