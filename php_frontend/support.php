<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Steam: The Ultimate Online Game Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Motiva+Sans:wght@300;400;500;700;900&family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        /* =========================================
           1. BASE STYLES (Inherited from about.html)
           ========================================= */
        body {
            background: #171a21 !important;
            color: #fff;
            overflow-x: hidden;
            font-family: "Motiva Sans", "Roboto", "Poppins", sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* =========================================
           2. NAVBAR STYLES (Inherited)
           ========================================= */
        .main-navbar { background: #171a21 !important; }
        .navbar-upper-border { border-bottom: 1px solid #2f3642; }
        .nav-link-upper { color: #c6d4df !important; transition: color 0.2s; }
        .nav-link-upper:hover { color: #fff !important; }
        
        @media (min-width: 768px) {
            .nav-link-upper { position: relative; padding-bottom: 15px !important; padding-top: 0.5rem !important; padding-left: 1rem !important; padding-right: 1rem !important; }
            .nav-link-upper::after { content: ''; position: absolute; bottom: 5px; left: 0; width: 0; height: 2px; background-color: #fff; transition: width 0.2s ease-in-out; }
            .nav-link-upper:hover::after { width: 100%; }
        }
        
        @media (max-width: 767.98px) { .navbar-brand-desktop { display: none !important; } }

        .login-btn { background: rgba(0, 200, 255, 0.1); border: 1px solid rgba(0, 200, 255, 0.4); backdrop-filter: blur(6px); color: #00b4d8; padding: 8px 20px; border-radius: 8px; font-weight: 500; cursor: pointer; transition: all 0.3s ease; font-size: 0.95rem; box-shadow: none; }
        .login-btn:hover { background: rgba(0, 200, 255, 0.1); border-color: rgba(0, 200, 255, 0.4); color: #00b4d8; backdrop-filter: blur(6px); box-shadow: 0 0 15px rgba(0, 180, 216, 0.6); }

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
           3. SUPPORT PAGE SPECIFIC STYLES
           ========================================= */
        .support-container {
            background-color: #000; 
            padding: 80px 0;
            flex-grow: 1; 
        }

        .contact-info h1, .contact-form h1 {
            font-size: 2.5rem;
            font-weight: 500;
            color: #fff;
            margin-bottom: 1.5rem;
        }

        .contact-desc {
            color: #acb2b8;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 3rem;
        }

        .info-item {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-icon-wrapper {
            width: 40px;
            display: flex;
            justify-content: center;
            padding-top: 5px;
        }

        .info-icon-wrapper i {
            font-size: 1.5rem;
            color: #fff;
        }

        .info-content h4 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: #fff;
        }

        .info-content p {
            margin: 0;
            color: #acb2b8;
            font-size: 1rem;
            line-height: 1.5;
        }

        .form-desc {
            color: #acb2b8;
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        .form-control-dark {
            background-color: #000;
            border: 1px solid #333;
            color: #acb2b8;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 1rem;
        }

        .form-control-dark:focus {
            background-color: #000;
            border-color: #666;
            color: #fff;
            box-shadow: none;
        }

        .form-control-dark::placeholder {
            color: #666;
        }

        /* UPDATED BUTTON STYLE */
        .btn-send-message {
            background-color: #00f0ff; /* Matching search icon color */
            color: #0a0f1a;
            border: none;
            font-size: 1rem;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 4px;
            display: inline-block;
            width: auto;
            margin-top: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-send-message:hover {
            background-color: #fff;
            color: #0a0f1a;
            box-shadow: 0 0 15px #00f0ff;
        }

        /* =========================================
           4. FOOTER STYLES (Inherited)
           ========================================= */
        .main-footer-section { background-image: radial-gradient(ellipse at 70% 120%, #1a2035 0%, #0a0f1a 60%); padding-top: 3rem; padding-bottom: 3rem; color: #E0E0E0; font-family: 'Poppins', sans-serif; }
        .footer-brand-heading { font-size: 2.25rem; font-weight: 700; color: #fff; margin: 0; text-shadow: 0 0 10px rgba(0, 240, 255, 0.5); }
        .footer-tagline { color: #8a94a6; }
        .newsletter-label { font-weight: 600; color: #00f0ff; }
        .newsletter-input-group { border: 1px solid #1a2035; border-radius: 0.375rem; transition: border-color 0.3s, box-shadow 0.3s; }
        .newsletter-input-group:focus-within { border-color: #00f0ff; box-shadow: 0 0 15px rgba(0, 240, 255, 0.6); }
        .newsletter-input { background: rgba(255, 255, 255, 0.05) !important; color: #fff !important; border: 0 !important; }
        .newsletter-input:focus { box-shadow: none !important; }
        .newsletter-submit-btn { background: #00f0ff; color: #0a0f1a; font-size: 1.25rem; font-weight: 700; transition: background 0.3s, box-shadow 0.3s, color 0.3s; border: none; }
        .newsletter-submit-btn:hover { background: #fff; color: #0a0f1a; box-shadow: 0 0 20px #00f0ff; }
        .footer-nav-link { color: #8a94a6 !important; position: relative; padding-bottom: 5px !important; font-weight: 600; transition: color 0.3s; }
        .footer-nav-link:hover { color: #fff !important; }
        .footer-nav-link::after { content: ''; position: absolute; bottom: 0; left: 0.5rem; width: 0; height: 2px; background: #a040ff; transition: width 0.3s ease-out; }
        .footer-nav-link:hover::after { width: calc(100% - 1rem); }
        @media (min-width: 768px) { .footer-nav-link.px-md-3:hover::after { width: calc(100% - 2rem); } .footer-nav-link.px-md-3::after { left: 1rem; } }
        .footer-social-icon { color: #8a94a6; font-size: 1.5rem; transition: color 0.3s, transform 0.3s, text-shadow 0.3s; text-decoration: none; }
        .footer-social-icon:hover { transform: scale(1.1) translateY(-2px); }
        .icon-discord:hover { color: #5865F2; text-shadow: 0 0 10px #5865F2; }
        .icon-reddit:hover { color: #FF4500; text-shadow: 0 0 10px #FF4500; }
        .icon-youtube:hover { color: #FF0000; text-shadow: 0 0 10px #FF0000; }
        .icon-twitter:hover { color: #1DA1F2; text-shadow: 0 0 10px #1DA1F2; }
        .icon-tiktok:hover { color: #fff; text-shadow: 0 0 10px #00f0ff, 0 0 15px #fe2c55; }
        .footer-bottom-bar { position: relative; background-color: #000; color: #8a94a6; font-family: 'Poppins', sans-serif; }
        .footer-glow-border { position: absolute; top: 0; left: 0; width: 100%; height: 2px; background: linear-gradient(90deg, transparent, #00f0ff, #a040ff, transparent); background-size: 300% 100%; animation: glow-animation 8s linear infinite; }
        @keyframes glow-animation { 0% { background-position: 150% 0; } 100% { background-position: -150% 0; } }
        .footer-copyright { color: #8a94a6; }
        .footer-legal-link { color: #8a94a6; text-decoration: none; transition: color 0.3s; }
        .footer-legal-link:hover { color: #fff; text-decoration: underline; }
    </style>
</head>

<body>

    <!-- NAVBAR (Centralized Include) -->
    <?php include 'section-navbar.php'; ?>

    <!-- SUPPORT SECTION -->
    <section class="support-container">
        <div class="container">
            <div class="row">
                <!-- Left Column: Get In Touch -->
                <div class="col-lg-5 mb-5 mb-lg-0 contact-info">
                    <h1>Get In Touch</h1>
                    <p class="contact-desc">
                        We are here to assist you with any questions or issues you may have. Reach out to us through any of the following methods, and our support team will get back to you as soon as possible.
                    </p>

                    <div class="info-item">
                        <div class="info-icon-wrapper">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="info-content">
                            <h4>Location</h4>
                            <p>Lahore, Pakistan</p>
                           
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon-wrapper">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="info-content">
                            <h4>Phone Number</h4>
                            <p>+92 300 1234567</p> <!-- Placeholder as per image layout -->
                            <p>Available: Mon - Fri, 9AM - 6PM</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon-wrapper">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h4>Email Address</h4>
                            <p>support@steampowered.com</p> <!-- Placeholder -->
                            <p>Response within 24 hours</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Start a Project -->
                <div class="col-lg-7 ps-lg-5 contact-form">
                    <h1>Ask a Question</h1>
                    <p class="form-desc">
                        We’re here to help with anything related to your gaming purchases, orders, downloads, or account issues.
                    </p>
                    
                    <!-- UPDATED FORM WITH MAILTO -->
                    <form action="mailto:hmsk606@gmail.com" method="post" enctype="text/plain">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <input type="text" name="name" id="nameField" class="form-control form-control-dark" placeholder="Your Name">
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control form-control-dark" placeholder="Your Email">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="subject" id="subjectField" class="form-control form-control-dark" placeholder="Subject">
                        </div>
                        <div class="mb-3">
                            <textarea name="message" class="form-control form-control-dark" rows="6" placeholder="Message"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn-send-message">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER (Inherited) -->
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
                                <input type="email" id="newsletter-email" class="newsletter-input form-control" placeholder="your.email@universe.com" required>
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
    
    <script>
        // Check if subject parameter is present in URL and pre-fill the subject field
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const subject = urlParams.get('subject');
            
            if (subject) {
                const subjectField = document.getElementById('subjectField');
                if (subjectField) {
                    subjectField.value = decodeURIComponent(subject);
                    
                    // Focus on the name field after pre-filling subject
                    const nameField = document.getElementById('nameField');
                    if (nameField) {
                        nameField.focus();
                    }
                }
            }
        });
    </script>
</body>
</html>