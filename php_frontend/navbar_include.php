<?php
/**
 * Navbar Include File
 * This file contains the complete navbar HTML structure with session-aware authentication buttons.
 * Include this file in other pages using: <?php include 'navbar_include.php'; ?>
 */
?>
<header class="main-navbar">
    <nav class="navbar navbar-expand-md navbar-upper-border">
        <div class="container px-3 d-flex justify-content-start align-items-center">

            <button class="navbar-toggler border-0 me-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#upperNav" aria-controls="upperNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter:invert(1)"></span>
            </button>

            <a class="navbar-brand navbar-brand-desktop d-none d-md-block" href="index.php" aria-label="Homepage">
                <img src="https://upload.wikimedia.org/wikipedia/commons/8/83/Steam_icon_logo.svg" alt="Company Logo"
                    height="30">
            </a>

            <div class="mobile-search-container d-md-none ms-auto">
                <form class="header-search-group input-group" role="search" aria-label="Mobile Search" action="games-list.php" method="get">
                    <input class="header-search-input form-control" type="search" placeholder="Search" name="q"
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
                        <a class="nav-link nav-link-upper" href="index.php" aria-current="page">STORE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-upper" href="community.php">COMMUNITY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-upper" href="about.php">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-upper" href="support.php">SUPPORT</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2 d-md-flex d-none" id="desktopAuthButtons">
                    <!-- Logged Out State -->
                    <a href="login.php" id="desktopLoginBtn" style="display: none;">
                        <button type="button" class="login-btn btn btn-sm me-3">Login</button>
                    </a>
                    <!-- Logged In State -->
                    <a href="../php_backend/logout.php" id="desktopLogoutBtn" style="display: none;">
                        <button type="button" class="btn btn-sm" style="background: rgba(255, 107, 107, 0.1); border: 1px solid rgba(255, 107, 107, 0.4); color: #ff6b6b; padding: 8px 20px; border-radius: 8px; font-weight: 500; transition: all 0.3s ease;"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </a>
                </div>

                <div class="d-flex flex-column align-items-stretch gap-2 d-md-none border-top border-secondary pt-3 mt-3 mx-2" id="mobileAuthButtons">
                    <!-- Logged Out State -->
                    <a href="login.php" id="mobileLoginBtn" style="display: none;">
                        <button type="button" class="login-btn btn btn-sm w-100">Login</button>
                    </a>
                    <!-- Logged In State -->
                    <a href="../php_backend/logout.php" id="mobileLogoutBtn" style="display: none;">
                        <button type="button" class="btn btn-sm w-100" style="background: rgba(255, 107, 107, 0.1); border: 1px solid rgba(255, 107, 107, 0.4); color: #ff6b6b; padding: 8px 20px; border-radius: 8px; font-weight: 500;"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </a>
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
                    <li><a class="dropdown-item custom-dropdown-item" href="games-list.php">All Games</a></li>
                    <!-- <li><a class="dropdown-item custom-dropdown-item" href="browse-more.php">Browse More</a></li> -->
                    <li><a class="dropdown-item custom-dropdown-item" href="browse-cheap.php?max_price=10">Under $10</a></li>
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
                    <li><a class="dropdown-item custom-dropdown-item" href="category.php">All Categories</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="category-details.php">Action</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link subnav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button"
                    aria-expanded="false">More</a>
                <ul class="dropdown-menu custom-dropdown-menu">
                    <!-- <li><a class="dropdown-item custom-dropdown-item" href="special-offers.php">Special Offers</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="#">Hardware</a></li> -->
                    <li><a class="dropdown-item custom-dropdown-item" href="support.php?subject=Game%20Request">Request a Game</a></li>
                </ul>
            </li>
        </ul>

        <form class="header-search-group desktop-search-form d-none d-md-flex input-group" role="search" aria-label="Desktop Search" action="games-list.php" method="get">
            <input class="header-search-input form-control" type="search" placeholder="Search" name="q"
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
                    <li><a class="dropdown-item custom-dropdown-item" href="games-list.php">All Games</a></li>
                    <!-- <li><a class="dropdown-item custom-dropdown-item" href="browse-more.php">Browse More</a></li> -->
                    <li><a class="dropdown-item custom-dropdown-item" href="browse-cheap.php?max_price=10">Under $10</a></li>
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
                    <li><a class="dropdown-item custom-dropdown-item" href="category.php">All Categories</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="category-details.php">Action</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link subnav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button"
                    aria-expanded="false">More</a>
                <ul class="dropdown-menu custom-dropdown-menu">
                    <!-- <li><a class="dropdown-item custom-dropdown-item" href="special-offers.php">Special Offers</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="#">Hardware</a></li> -->
                    <li><a class="dropdown-item custom-dropdown-item" href="support.php?subject=Game%20Request">Request a Game</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>

<script>
    // Check session status and update navbar buttons
    async function checkSessionStatus() {
        try {
            const response = await fetch('../config/check_session_status.php');
            const data = await response.json();
            
            // Desktop buttons
            const desktopLoginBtn = document.getElementById('desktopLoginBtn');
            const desktopLogoutBtn = document.getElementById('desktopLogoutBtn');
            
            // Mobile buttons
            const mobileLoginBtn = document.getElementById('mobileLoginBtn');
            const mobileLogoutBtn = document.getElementById('mobileLogoutBtn');
            
            if (data.logged_in) {
                // User is logged in - show logout button
                if (desktopLoginBtn) desktopLoginBtn.style.display = 'none';
                if (desktopLogoutBtn) desktopLogoutBtn.style.display = 'block';
                if (mobileLoginBtn) mobileLoginBtn.style.display = 'none';
                if (mobileLogoutBtn) mobileLogoutBtn.style.display = 'block';
            } else {
                // User is not logged in - show login button
                if (desktopLoginBtn) desktopLoginBtn.style.display = 'block';
                if (desktopLogoutBtn) desktopLogoutBtn.style.display = 'none';
                if (mobileLoginBtn) mobileLoginBtn.style.display = 'block';
                if (mobileLogoutBtn) mobileLogoutBtn.style.display = 'none';
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
