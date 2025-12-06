<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Refund Policy - Z Zone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    
    <style>
        /* SCOPED CSS FOR REFUND PAGE */
        .refund-scoped-wrapper {
            background-color: #1b2838; /* Global Steam BG */
            color: #8f98a0;
            font-family: "Motiva Sans", "Segoe UI", "Arial", sans-serif;
            min-height: calc(100vh - 56px);
            padding: 40px 0;
        }

        /* Sticky Sidebar */
        .refund-scoped-wrapper .sidebar-sticky {
            position: sticky;
            top: 20px;
            background-color: #171a21;
            padding: 20px;
            border-radius: 4px;
            border: 1px solid #2a475e;
        }

        .refund-scoped-wrapper .nav-link {
            color: #8f98a0;
            padding: 8px 15px;
            border-left: 3px solid transparent;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .refund-scoped-wrapper .nav-link:hover,
        .refund-scoped-wrapper .nav-link.active {
            color: #ffffff;
            background-color: rgba(102, 192, 244, 0.1);
            border-left-color: #66c0f4;
        }

        /* Main Content Card */
        .refund-scoped-wrapper .content-card {
            background-color: rgba(0, 0, 0, 0.2);
            padding: 40px;
            border-radius: 4px;
        }

        .refund-scoped-wrapper h1 {
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 300;
            border-bottom: 1px solid #2a475e;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .refund-scoped-wrapper h2 {
            color: #66c0f4;
            font-size: 1.4rem;
            margin-top: 40px;
            margin-bottom: 15px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .refund-scoped-wrapper h2 i {
            margin-right: 10px;
            opacity: 0.8;
        }

        .refund-scoped-wrapper p, 
        .refund-scoped-wrapper ul {
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 15px;
            color: #c7d5e0;
        }

        .refund-scoped-wrapper ul {
            padding-left: 20px;
        }

        .refund-scoped-wrapper li {
            margin-bottom: 8px;
        }

        /* Quick Summary Box */
        .refund-scoped-wrapper .summary-box {
            background: linear-gradient(135deg, rgba(42, 71, 94, 0.6), rgba(23, 26, 33, 0.9));
            border: 1px solid #66c0f4;
            border-radius: 4px;
            padding: 25px;
            margin-bottom: 30px;
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }

        .refund-scoped-wrapper .summary-icon {
            font-size: 2.5rem;
            color: #66c0f4;
        }

        /* Scroll offset */
        html {
            scroll-padding-top: 20px;
        }

        @media (max-width: 768px) {
            .refund-scoped-wrapper .sidebar-sticky {
                position: static;
                margin-bottom: 30px;
            }
            .refund-scoped-wrapper .content-card {
                padding: 20px;
            }
            .refund-scoped-wrapper .summary-box {
                flex-direction: column;
                text-align: center;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <?php include 'section-navbar.php'; ?>

    <div class="refund-scoped-wrapper">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-3">
                    <nav class="sidebar-sticky">
                        <h6 class="text-uppercase text-white mb-3 ps-3 fw-bold" style="font-size: 0.8rem; letter-spacing: 1px;">Policy Sections</h6>
                        <div class="nav flex-column">
                            <a class="nav-link" href="#overview">1. Refund Overview</a>
                            <a class="nav-link" href="#games">2. Games & Software</a>
                            <a class="nav-link" href="#dlc">3. DLC & In-App</a>
                            <a class="nav-link" href="#preorders">4. Pre-Orders</a>
                            <a class="nav-link" href="#abuse">5. Abuse Policy</a>
                            <a class="nav-link" href="#request">6. How to Request</a>
                        </div>
                        <div class="mt-4 ps-3">
                            <a href="support.php" class="btn btn-sm btn-outline-light w-100"><i class="fas fa-headset me-2"></i> Contact Support</a>
                        </div>
                    </nav>
                </div>

                <div class="col-lg-9">
                    <div class="content-card">
                        <h1><i class="fas fa-undo-alt me-3"></i> Refunds</h1>
                        
                        <div class="summary-box" id="overview">
                            <div class="summary-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h4 class="text-white fw-bold mb-2">The 14 Days / 2 Hours Rule</h4>
                                <p class="mb-0 text-white-50">
                                    You can request a refund for nearly any purchase on Z Zone, for any reason. We will issue a refund if the request is made within <strong>14 days of purchase</strong> and the title has been played for <strong>less than 2 hours</strong>.
                                </p>
                            </div>
                        </div>

                        <p class="lead">Even if you fall outside of the refund rules described below, you can submit a request and we'll take a look.</p>

                        <section id="games">
                            <h2><i class="fas fa-gamepad"></i> 2. Games & Software</h2>
                            <p>Refunds are available for all games and software applications purchased through the Z Zone store. The refund will be issued to your original payment method or your Z Zone Wallet.</p>
                            <p>Please note that refund processing times vary depending on your payment provider, but usually take between 3-7 business days.</p>
                        </section>

                        <section id="dlc">
                            <h2><i class="fas fa-puzzle-piece"></i> 3. Downloadable Content (DLC)</h2>
                            <p>DLC purchased through the Z Zone store is refundable within 14 days of purchase, and if the underlying title has been played for less than 2 hours since the DLC was purchased, so long as the DLC has not been consumed, modified, or transferred.</p>
                            <p class="text-warning small"><i class="fas fa-exclamation-triangle me-1"></i> Note: Some third-party DLC (like in-game currency or level boosts) cannot be refunded. These exceptions are clearly marked on the Store page.</p>
                        </section>

                        <section id="preorders">
                            <h2><i class="fas fa-hourglass-half"></i> 4. Pre-Purchased Titles</h2>
                            <p>When you pre-purchase a title on Z Zone, you can request a refund at any time prior to the release of that title. The standard 14-day/2-hour refund period also applies, starting on the game's release date.</p>
                        </section>

                        <section id="abuse">
                            <h2><i class="fas fa-ban"></i> 5. Abuse Policy</h2>
                            <p>Refunds are designed to remove the risk from purchasing titles on Z Zone—not as a way to get free games. If it appears to us that you are abusing refunds (e.g., buying a game, finishing it, and refunding it repeatedly), we may stop offering them to you.</p>
                            <p>We do not consider it abuse to request a refund on a title that was purchased just before a sale and then immediately rebuying that title for the sale price.</p>
                        </section>

                        <section id="request">
                            <h2><i class="fas fa-question-circle"></i> 6. How to Request a Refund</h2>
                            <p>You can request a refund or get other assistance with your Z Zone purchases by visiting our Support page.</p>
                            <ol>
                                <li>Navigate to the <a href="support.php" class="text-accent text-decoration-none">Support Page</a>.</li>
                                <li>Log in to your Z Zone account.</li>
                                <li>Click on <strong>"Purchases"</strong>.</li>
                                <li>Find the game you would like to refund.</li>
                                <li>Select <strong>"I would like a refund"</strong>.</li>
                            </ol>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'section-footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Scroll Spy Logic
        const sections = document.querySelectorAll("section, .summary-box");
        const navLi = document.querySelectorAll(".sidebar-sticky .nav .nav-link");

        window.onscroll = () => {
            var current = "";

            sections.forEach((section) => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 120) {
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