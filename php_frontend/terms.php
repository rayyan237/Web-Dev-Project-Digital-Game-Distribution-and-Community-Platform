<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terms of Service - Z Zone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    
    <style>
        /* SCOPED CSS FOR TERMS PAGE */
        .tos-scoped-wrapper {
            background-color: #1b2838; /* Global Steam BG */
            color: #8f98a0;
            min-height: calc(100vh - 56px);
            padding: 40px 0;
        }

        /* The Sticky Sidebar */
        .tos-scoped-wrapper .sidebar-sticky {
            position: sticky;
            top: 20px;
            background-color: #171a21;
            padding: 20px;
            border-radius: 4px;
            border: 1px solid #2a475e;
        }

        .tos-scoped-wrapper .nav-link {
            color: #8f98a0;
            padding: 8px 15px;
            border-left: 3px solid transparent;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .tos-scoped-wrapper .nav-link:hover,
        .tos-scoped-wrapper .nav-link.active {
            color: #ffffff;
            background-color: rgba(102, 192, 244, 0.1);
            border-left-color: #66c0f4;
        }

        /* Main Content Card */
        .tos-scoped-wrapper .content-card {
            background-color: rgba(0, 0, 0, 0.2);
            padding: 40px;
            border-radius: 4px;
        }

        .tos-scoped-wrapper h1 {
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 300;
            border-bottom: 1px solid #2a475e;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .tos-scoped-wrapper h2 {
            color: #66c0f4; /* Steam Blue */
            font-size: 1.5rem;
            margin-top: 40px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .tos-scoped-wrapper p, 
        .tos-scoped-wrapper ul {
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 15px;
            color: #c7d5e0;
        }

        .tos-scoped-wrapper ul {
            padding-left: 20px;
        }

        .tos-scoped-wrapper li {
            margin-bottom: 8px;
        }

        .tos-scoped-wrapper .last-updated {
            font-size: 0.85rem;
            color: #66c0f4;
            margin-bottom: 20px;
            display: block;
        }

        /* Scroll offset for sticky header */
        html {
            scroll-padding-top: 20px;
        }

        @media (max-width: 768px) {
            .tos-scoped-wrapper .sidebar-sticky {
                position: static;
                margin-bottom: 30px;
            }
            .tos-scoped-wrapper .content-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <?php include 'section-navbar.php'; ?>

    <div class="tos-scoped-wrapper">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-3">
                    <nav class="sidebar-sticky">
                        <h6 class="text-uppercase text-white mb-3 ps-3 fw-bold" style="font-size: 0.8rem; letter-spacing: 1px;">Table of Contents</h6>
                        <div class="nav flex-column">
                            <a class="nav-link" href="#introduction">1. Introduction</a>
                            <a class="nav-link" href="#accounts">2. Your Account</a>
                            <a class="nav-link" href="#license">3. License & Access</a>
                            <a class="nav-link" href="#conduct">4. Online Conduct</a>
                            <a class="nav-link" href="#virtual-goods">5. Virtual Goods & Wallet</a>
                            <a class="nav-link" href="#ugc">6. User Generated Content</a>
                            <a class="nav-link" href="#termination">7. Termination</a>
                            <a class="nav-link" href="#disclaimer">8. Disclaimer</a>
                        </div>
                        <div class="mt-4 ps-3">
                            <a href="index.php" class="btn btn-sm btn-outline-secondary w-100">Back to Store</a>
                        </div>
                    </nav>
                </div>

                <div class="col-lg-9">
                    <div class="content-card">
                        <h1>Z Zone Subscriber Agreement</h1>
                        <span class="last-updated">Last Updated: December 2025</span>

                        <p class="lead">Please read this Subscriber Agreement ("Agreement") carefully before using the Z Zone platform.</p>

                        <section id="introduction">
                            <h2>1. Introduction</h2>
                            <p>Welcome to Z Zone. By creating an account, downloading software, or using our services, you agree to be bound by these terms. If you do not agree to these terms, please do not use our services.</p>
                            <p>Z Zone is an online service offered by Z Zone Corp. ("We", "Us"). This agreement governs your use of the Z Zone client software, the online community, and all games/content downloaded through the platform.</p>
                        </section>

                        <section id="accounts">
                            <h2>2. Your Account</h2>
                            <p>To access certain features, you must create a Z Zone account. You are responsible for:</p>
                            <ul>
                                <li>Maintaining the confidentiality of your login credentials.</li>
                                <li>All activities that occur under your account.</li>
                                <li>Ensuring your account information is accurate and up-to-date.</li>
                            </ul>
                            <p>You may not share your account with others or allow others to access your account. We reserve the right to suspend accounts that exhibit suspicious activity.</p>
                        </section>

                        <section id="license">
                            <h2>3. License & Access</h2>
                            <p>Z Zone grants you a personal, non-exclusive, non-transferable, revocable license to use the platform and the content you purchase/download for personal, non-commercial entertainment purposes only.</p>
                            <p>You obtain no ownership rights in the software. You are purchasing a license to access and use the content.</p>
                        </section>

                        <section id="conduct">
                            <h2>4. Online Conduct</h2>
                            <p>You agree to behave appropriately when using Z Zone's community features (chat, forums, reviews). You are prohibited from:</p>
                            <ul>
                                <li>Harassing, threatening, or bullying other users.</li>
                                <li>Using cheats, automation software (bots), hacks, or mods designed to modify the Z Zone experience unauthorizedly.</li>
                                <li>Posting content that is illegal, offensive, or violates intellectual property rights.</li>
                                <li>Impersonating Z Zone staff or other users.</li>
                            </ul>
                        </section>

                        <section id="virtual-goods">
                            <h2>5. Virtual Goods & Wallet</h2>
                            <p>Z Zone may include virtual currency ("Z-Points") or virtual items (skins, cards). These items have no real-world value and cannot be exchanged for cash.</p>
                            <p>Refunds for digital purchases are governed by our Refund Policy (generally, within 14 days of purchase and less than 2 hours of playtime).</p>
                        </section>

                        <section id="ugc">
                            <h2>6. User Generated Content (UGC)</h2>
                            <p>If you upload content to the Z Zone Workshop or Community (screenshots, guides, mods), you grant Z Zone a worldwide, non-exclusive right to use, reproduce, and display that content in connection with the service.</p>
                            <p>You represent that you have all necessary rights to the content you upload.</p>
                        </section>

                        <section id="termination">
                            <h2>7. Termination</h2>
                            <p>We may terminate your access to Z Zone, without cause or notice, which may result in the forfeiture and destruction of all information associated with your account. All provisions of this Agreement that by their nature should survive termination shall survive termination.</p>
                        </section>

                        <section id="disclaimer">
                            <h2>8. Disclaimer of Warranties</h2>
                            <p>The Z Zone service is provided "as is" and "as available" without warranties of any kind, either express or implied. We do not guarantee that the service will be uninterrupted or error-free.</p>
                        </section>

                        <div class="mt-5 pt-4 border-top border-secondary">
                            <p class="small text-secondary">
                                &copy; 2025 Z Zone Corporation. All rights reserved. All trademarks are property of their respective owners in the US and other countries.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <?php include 'section-footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple script to highlight active section in sidebar
        const sections = document.querySelectorAll("section");
        const navLi = document.querySelectorAll(".sidebar-sticky .nav .nav-link");

        window.onscroll = () => {
            var current = "";

            sections.forEach((section) => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 60) {
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