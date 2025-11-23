<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Steam Navbar - Simple CSS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* =========================================
           1. BASE STYLES
           ========================================= */
        body {
            background: #171a21 !important;
            color: #fff;
            overflow-x: hidden;
        }

        /* =========================================
           2. MAIN NAVBAR (UPPER)
           ========================================= */
        .main-navbar {
            background: #171a21 !important;
        }

        .navbar-upper-border {
            border-bottom: 1px solid #2f3642;
        }

        /* Desktop Link Styles */
        .nav-link-upper {
            color: #c6d4df !important;
            transition: color 0.2s;
        }

        .nav-link-upper:hover {
            color: #fff !important;
        }

        /* Desktop Underline Effect */
        @media (min-width: 768px) {
            .nav-link-upper {
                position: relative;
                padding-bottom: 15px !important; /* 0.5rem + 2px + 5px */
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

        /* Brand Logo */
        @media (max-width: 767.98px) {
            .navbar-brand-desktop {
                display: none !important;
            }
        }

        /* Login Button (Specific to Header) */
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

        /* =========================================
           3. SECONDARY NAVBAR (LOWER)
           ========================================= */
        .secondary-navbar {
            background: #1b2838 !important; 
            z-index: 1020;
        }

        /* Desktop Sticky Behavior */
        @media (min-width: 768px) {
            .secondary-navbar {
                position: sticky;
                top: 0;
            }
        }

        /* Links */
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

        /* Dropdowns */
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

        /* Mobile Lists */
        .mobile-subnav-list .subnav-link,
        .mobile-subnav-list .dropdown-toggle {
            font-size: 0.85rem;
            padding: 0.5rem 0.5rem !important;
        }

        /* Mobile Arrow Rotation Logic */
        .mobile-subnav-list .dropdown-toggle::after {
            content: "";
            display: inline-block;
            width: 0;
            height: 0;
            margin-left: .3rem;
            vertical-align: middle;
            border-top: 5px solid #c6d4df;
            border-right: 4px solid transparent;
            border-left: 4px solid transparent;
            transition: transform .2s;
        }

        .mobile-subnav-list .dropdown-toggle.show::after {
            transform: rotate(180deg);
        }

        /* Visibility Toggles */
        @media (min-width: 768px) {
            .mobile-subnav-list { display: none !important; }
            .mobile-search-container { display: none !important; }
        }

        @media (max-width: 767.98px) {
            .desktop-subnav-list { display: none !important; }
            .desktop-search-form { display: none !important; }
        }

        /* =========================================
           4. SEARCH BAR (Specific)
           ========================================= */
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

        /* Desktop width specific */
        @media (min-width: 768px) {
            .desktop-search-form { width: 360px; }
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
    </style>
</head>

<body>

    <header class="main-navbar">
        <nav class="navbar navbar-expand-md navbar-upper-border">
            <div class="container px-3 d-flex justify-content-start align-items-center">

                <button class="navbar-toggler border-0 me-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#upperNav" aria-controls="upperNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style="filter:invert(1)"></span>
                </button>

                <a class="navbar-brand navbar-brand-desktop d-none d-md-block" href="#" aria-label="Homepage">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/83/Steam_icon_logo.svg" alt="Company Logo"
                        height="30">
                </a>

                <div class="mobile-search-container d-md-none ms-auto">
                    <form class="header-search-group input-group" role="search" aria-label="Mobile Search">
                        <input class="header-search-input form-control" type="search" placeholder="Search"
                            aria-label="Search" style="width: 240px;">
                        <button class="header-search-btn btn d-flex align-items-center justify-content-center" type="submit"
                            aria-label="Search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="collapse navbar-collapse" id="upperNav">

                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link nav-link-upper" href="#" aria-current="page">STORE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-upper" href="#">COMMUNITY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-upper" href="">ABOUT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-upper" href="#">SUPPORT</a>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center gap-2 d-md-flex d-none" id="desktopAuthButtons">
                        <!-- Logged Out State -->
                        <a href="login.php" id="desktopLoginBtn" style="display: none;">
                            <button type="button" class="login-btn btn btn-sm me-3">Login</button>
                        </a>
                        <!-- Logged In State -->
                        <div id="desktopUserButtons" style="display: none;" class="d-flex align-items-center gap-2">
                            <a href="profile.php">
                                <button type="button" class="login-btn btn btn-sm"><i class="fas fa-user"></i> Profile</button>
                            </a>
                            <a href="../php_backend/logout.php">
                                <button type="button" class="btn btn-sm" style="background: rgba(255, 107, 107, 0.1); border: 1px solid rgba(255, 107, 107, 0.4); color: #ff6b6b; padding: 8px 20px; border-radius: 8px; font-weight: 500; transition: all 0.3s ease;"><i class="fas fa-sign-out-alt"></i> Logout</button>
                            </a>
                        </div>
                    </div>

                    <div class="d-flex flex-column align-items-stretch gap-2 d-md-none border-top border-secondary pt-3 mt-3 mx-2" id="mobileAuthButtons">
                        <!-- Logged Out State -->
                        <div id="mobileLoginBtn" style="display: none;">
                            <a href="login.php">
                                <button type="button" class="login-btn btn btn-sm w-100">Login</button>
                            </a>
                        </div>
                        <!-- Logged In State -->
                        <div id="mobileUserButtons" style="display: none;">
                            <a href="profile.php">
                                <button type="button" class="login-btn btn btn-sm w-100 mb-2"><i class="fas fa-user"></i> Profile</button>
                            </a>
                            <a href="../php_backend/logout.php">
                                <button type="button" class="btn btn-sm w-100" style="background: rgba(255, 107, 107, 0.1); border: 1px solid rgba(255, 107, 107, 0.4); color: #ff6b6b; padding: 8px 20px; border-radius: 8px; font-weight: 500;"><i class="fas fa-sign-out-alt"></i> Logout</button>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </nav>
    </header>

    <nav class="secondary-navbar py-2" aria-label="Secondary Navigation">
        <div class="container d-flex align-items-center">

            <ul class="desktop-subnav-list d-flex flex-nowrap gap-4 me-auto mb-0 list-unstyled">
                <li class="nav-item dropdown">
                    <a class="nav-link subnav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button"
                        aria-expanded="false">Browse</a>
                    <ul class="dropdown-menu custom-dropdown-menu">
                        <li><a class="dropdown-item custom-dropdown-item" href="#">New Releases</a></li>
                        <li><a class="dropdown-item custom-dropdown-item" href="#">Discovery Queue</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link subnav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button"
                        aria-expanded="false">Recommendations</a>
                    <ul class="dropdown-menu custom-dropdown-menu">
                        <li><a class="dropdown-item custom-dropdown-item" href="#">By Friends</a></li>
                        <li><a class="dropdown-item custom-dropdown-item" href="#">By Curators</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link subnav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button"
                        aria-expanded="false">Categories</a>
                    <ul class="dropdown-menu custom-dropdown-menu">
                        <li><a class="dropdown-item custom-dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item custom-dropdown-item" href="#">RPG</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link subnav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button"
                        aria-expanded="false">More</a>
                    <ul class="dropdown-menu custom-dropdown-menu">
                        <li><a class="dropdown-item custom-dropdown-item" href="#">Free to Play</a></li>
                        <li><a class="dropdown-item custom-dropdown-item" href="#">Hardware</a></li>
                    </ul>
                </li>
            </ul>

            <form class="header-search-group desktop-search-form d-none d-md-flex input-group" role="search" aria-label="Desktop Search">
                <input class="header-search-input form-control" type="search" placeholder="Search"
                    aria-label="Search">
                <button class="header-search-btn btn d-flex align-items-center justify-content-center" type="submit"
                    aria-label="Search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </button>
            </form>

            <ul class="mobile-subnav-list d-md-none w-100 ps-0 mb-0 list-unstyled d-flex flex-nowrap justify-content-start">
                <li class="nav-item dropdown">
                    <a class="nav-link subnav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button"
                        aria-expanded="false">Browse</a>
                    <ul class="dropdown-menu custom-dropdown-menu">
                        <li><a class="dropdown-item custom-dropdown-item" href="#">New Releases</a></li>
                        <li><a class="dropdown-item custom-dropdown-item" href="#">Discovery Queue</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link subnav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button"
                        aria-expanded="false">Recommendations</a>
                    <ul class="dropdown-menu custom-dropdown-menu">
                        <li><a class="dropdown-item custom-dropdown-item" href="#">By Friends</a></li>
                        <li><a class="dropdown-item custom-dropdown-item" href="#">By Curators</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link subnav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button"
                        aria-expanded="false">Categories</a>
                    <ul class="dropdown-menu custom-dropdown-menu">
                        <li><a class="dropdown-item custom-dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item custom-dropdown-item" href="#">RPG</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link subnav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button"
                        aria-expanded="false">More</a>
                    <ul class="dropdown-menu custom-dropdown-menu">
                        <li><a class="dropdown-item custom-dropdown-item" href="#">Free to Play</a></li>
                        <li><a class="dropdown-item custom-dropdown-item" href="#">Hardware</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </nav>

    <div class="container mt-5 text-center">
        <h1>Body Content Goes Here</h1>
        <p style="color: #c6d4df;">This is the area where content specific to each page will be added.</p>
        <p style="height:150vh;">Scroll to test the desktop-only sticky navbar.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Check session status and update navbar buttons
        async function checkSessionStatus() {
            try {
                const response = await fetch('../config/check_session_status.php');
                const data = await response.json();
                
                // Desktop buttons
                const desktopLoginBtn = document.getElementById('desktopLoginBtn');
                const desktopUserButtons = document.getElementById('desktopUserButtons');
                
                // Mobile buttons
                const mobileLoginBtn = document.getElementById('mobileLoginBtn');
                const mobileUserButtons = document.getElementById('mobileUserButtons');
                
                if (data.logged_in) {
                    // User is logged in - show profile and logout buttons
                    if (desktopLoginBtn) desktopLoginBtn.style.display = 'none';
                    if (desktopUserButtons) desktopUserButtons.style.display = 'flex';
                    if (mobileLoginBtn) mobileLoginBtn.style.display = 'none';
                    if (mobileUserButtons) mobileUserButtons.style.display = 'block';
                } else {
                    // User is not logged in - show login button
                    if (desktopLoginBtn) desktopLoginBtn.style.display = 'block';
                    if (desktopUserButtons) desktopUserButtons.style.display = 'none';
                    if (mobileLoginBtn) mobileLoginBtn.style.display = 'block';
                    if (mobileUserButtons) mobileUserButtons.style.display = 'none';
                }
            } catch (error) {
                console.error('Error checking session:', error);
                // On error, show login button by default
                const desktopLoginBtn = document.getElementById('desktopLoginBtn');
                const mobileLoginBtn = document.getElementById('mobileLoginBtn');
                if (desktopLoginBtn) desktopLoginBtn.style.display = 'block';
                if (mobileLoginBtn) mobileLoginBtn.style.display = 'block';
            }
        }
        
        // Check session when page loads
        document.addEventListener('DOMContentLoaded', checkSessionStatus);
    </script>
</body>

</html>