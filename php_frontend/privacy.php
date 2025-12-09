<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Privacy Policy - Z Zone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    
    <style>
        /* SCOPED CSS FOR PRIVACY PAGE */
        .privacy-scoped-wrapper {
            background-color: #1b2838; /* Global Steam BG */
            color: #8f98a0;
            min-height: calc(100vh - 56px);
            padding: 40px 0;
        }

        /* Sticky Sidebar */
        .privacy-scoped-wrapper .sidebar-sticky {
            position: sticky;
            top: 20px;
            background-color: #171a21;
            padding: 20px;
            border-radius: 4px;
            border: 1px solid #2a475e;
        }

        .privacy-scoped-wrapper .nav-link {
            color: #8f98a0;
            padding: 8px 15px;
            border-left: 3px solid transparent;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .privacy-scoped-wrapper .nav-link:hover,
        .privacy-scoped-wrapper .nav-link.active {
            color: #ffffff;
            background-color: rgba(102, 192, 244, 0.1);
            border-left-color: #66c0f4;
        }

        /* Main Content Card */
        .privacy-scoped-wrapper .content-card {
            background-color: rgba(0, 0, 0, 0.2);
            padding: 40px;
            border-radius: 4px;
        }

        .privacy-scoped-wrapper h1 {
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 300;
            border-bottom: 1px solid #2a475e;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .privacy-scoped-wrapper h2 {
            color: #66c0f4; /* Steam Blue */
            font-size: 1.5rem;
            margin-top: 40px;
            margin-bottom: 15px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        
        .privacy-scoped-wrapper h2 i {
            margin-right: 10px;
            font-size: 1.2rem;
            opacity: 0.7;
        }

        .privacy-scoped-wrapper p, 
        .privacy-scoped-wrapper ul {
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 15px;
            color: #c7d5e0;
        }

        .privacy-scoped-wrapper ul {
            padding-left: 20px;
        }

        .privacy-scoped-wrapper li {
            margin-bottom: 8px;
        }

        .privacy-scoped-wrapper .contact-box {
            background-color: rgba(102, 192, 244, 0.05);
            border: 1px solid rgba(102, 192, 244, 0.2);
            padding: 20px;
            border-radius: 4px;
            margin-top: 30px;
        }

        /* Scroll offset for sticky header */
        html {
            scroll-padding-top: 20px;
        }

        @media (max-width: 768px) {
            .privacy-scoped-wrapper .sidebar-sticky {
                position: static;
                margin-bottom: 30px;
            }
            .privacy-scoped-wrapper .content-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <?php include 'section-navbar.php'; ?>

    <div class="privacy-scoped-wrapper">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-3">
                    <nav class="sidebar-sticky">
                        <h6 class="text-uppercase text-white mb-3 ps-3 fw-bold" style="font-size: 0.8rem; letter-spacing: 1px;">Contents</h6>
                        <div class="nav flex-column">
                            <a class="nav-link" href="#overview">1. Overview</a>
                            <a class="nav-link" href="#collection">2. Data We Collect</a>
                            <a class="nav-link" href="#usage">3. How We Use Data</a>
                            <a class="nav-link" href="#sharing">4. Data Sharing</a>
                            <a class="nav-link" href="#cookies">5. Cookies & Tracking</a>
                            <a class="nav-link" href="#security">6. Security</a>
                            <a class="nav-link" href="#children">7. Children's Privacy</a>
                            <a class="nav-link" href="#contact">8. Contact Us</a>
                        </div>
                        <div class="mt-4 ps-3">
                            <a href="index.php" class="btn btn-sm btn-outline-secondary w-100">Back to Store</a>
                        </div>
                    </nav>
                </div>

                <div class="col-lg-9">
                    <div class="content-card">
                        <h1><i class="fas fa-user-shield me-3"></i> Privacy Policy</h1>
                        <p class="small text-secondary mb-4">Effective Date: December 6, 2025</p>

                        <p class="lead">At Z Zone, we respect your privacy and are committed to protecting the personal information you share with us. This policy outlines our data practices.</p>

                        <section id="overview">
                            <h2><i class="fas fa-info-circle"></i> 1. Overview</h2>
                            <p>This Privacy Policy explains what information Z Zone Corp ("We", "Us") collects when you visit our website, use our desktop client, or play games downloaded through our service. By using Z Zone, you consent to the data practices described in this policy.</p>
                        </section>

                        <section id="collection">
                            <h2><i class="fas fa-database"></i> 2. Data We Collect</h2>
                            <p>We collect information to provide better services to all our users. This includes:</p>
                            <ul>
                                <li><strong>Account Information:</strong> When you create a Z Zone account, we collect your email address, username, and password.</li>
                                <li><strong>Transaction Data:</strong> If you purchase games, we collect purchase history and billing details (payment processing is handled by third-party secure providers).</li>
                                <li><strong>Hardware & Software Data:</strong> To ensure game compatibility and anti-cheat enforcement, we may collect technical data about your device (OS version, GPU model, RAM).</li>
                                <li><strong>Usage Data:</strong> We track gameplay hours, achievements unlocked, and interactions within the Z Community.</li>
                            </ul>
                        </section>

                        <section id="usage">
                            <h2><i class="fas fa-cogs"></i> 3. How We Use Data</h2>
                            <p>We use the collected data for the following purposes:</p>
                            <ul>
                                <li>To verify your identity and provide access to your purchased content.</li>
                                <li>To improve our games and client software based on crash reports and usage statistics.</li>
                                <li>To provide customer support and respond to your inquiries.</li>
                                <li>To detect and prevent fraud, cheating, and security breaches.</li>
                                <li>To recommend games based on your playtime and preferences.</li>
                            </ul>
                        </section>

                        <section id="sharing">
                            <h2><i class="fas fa-share-alt"></i> 4. Data Sharing</h2>
                            <p>We do not sell your personal data. We may share data only in the following circumstances:</p>
                            <ul>
                                <li><strong>Game Developers:</strong> We share aggregate, anonymous data with developers to help them improve their games.</li>
                                <li><strong>Legal Requirements:</strong> If required by law or in response to valid requests by public authorities (e.g., a court or government agency).</li>
                                <li><strong>Service Providers:</strong> We use trusted third-party companies for payment processing and data hosting.</li>
                            </ul>
                        </section>

                        <section id="cookies">
                            <h2><i class="fas fa-cookie-bite"></i> 5. Cookies & Tracking</h2>
                            <p>We use cookies and similar technologies to keep you logged in, remember your preferences (like language and currency), and track website performance. You can control cookie settings through your browser, but disabling them may affect your ability to use the Store.</p>
                        </section>

                        <section id="security">
                            <h2><i class="fas fa-lock"></i> 6. Security</h2>
                            <p>We implement industry-standard security measures to protect your data, including encryption (SSL/TLS) for data in transit and hashing for passwords. However, no method of transmission over the internet is 100% secure.</p>
                        </section>

                        <section id="children">
                            <h2><i class="fas fa-child"></i> 7. Children's Privacy</h2>
                            <p>Z Zone is not intended for children under the age of 13. We do not knowingly collect personal information from children under 13. If we discover that a child under 13 has provided us with personal information, we will delete such information from our servers immediately.</p>
                        </section>

                        <section id="contact">
                            <h2><i class="fas fa-envelope"></i> 8. Contact Us</h2>
                            <p>If you have any questions about this Privacy Policy or wish to exercise your data rights (such as deletion or access), please contact our Data Protection Officer.</p>
                            
                            <div class="contact-box">
                                <h5 class="text-white">Z Zone Privacy Team</h5>
                                <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i> 123 Gaming Blvd, Tech City, 54000</p>
                                <p class="mb-0"><i class="fas fa-at me-2"></i> privacy@zzone-store.com</p>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'section-footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Scroll Spy Script to highlight sidebar items
        const sections = document.querySelectorAll("section");
        const navLi = document.querySelectorAll(".sidebar-sticky .nav .nav-link");

        window.onscroll = () => {
            var current = "";

            sections.forEach((section) => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 100) {
                    current = section.getAttribute("id");
                }
            });

            navLi.forEach((li) => {
                li.classList.remove("active");
                if (li.getAttribute("href").includes(current)) {
                    li.classList.add("active");
                }
            });
        };
    </script>
</body>
</html>