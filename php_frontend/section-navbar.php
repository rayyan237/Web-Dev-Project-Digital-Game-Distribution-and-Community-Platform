<?php

/**
 * Navbar Include File
 * Updated with Profile Dropdown for Logged In Users
 */
?>
<style>
    /* Add specific styles for the profile dropdown to match Steam theme */
    .nav-profile-img {
        object-fit: cover;
        border: 2px solid #57cbde;
        transition: border-color 0.2s;
    }

    .nav-profile-link:hover .nav-profile-img {
        border-color: #ffffff;
    }

    .custom-steam-dropdown {
        background-color: #3d4450;
        border: 1px solid #57cbde;
        min-width: 250px;
        z-index: 1025;
    }

    .dropdown-user-info {
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.5));
    }
</style>

<header class="main-navbar">
    <nav class="navbar navbar-expand-lg navbar-upper-border">

        <div class="container px-3 d-flex justify-content-start align-items-center flex-wrap flex-lg-nowrap">

            <button class="navbar-toggler border-0 me-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#upperNav" aria-controls="upperNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter:invert(1)"></span>
            </button>

            <a class="navbar-brand navbar-brand-desktop d-none d-lg-block" href="index.php" aria-label="Homepage">
                <img src="https://upload.wikimedia.org/wikipedia/commons/8/83/Steam_icon_logo.svg" alt="Company Logo"
                    height="30">
            </a>

            <div class="mobile-search-container d-lg-none ms-auto">
                <form class="header-search-group input-group" role="search" aria-label="Mobile Search" action="games-list.php" method="get">
                    <input class="header-search-input form-control" type="search" placeholder="Search" name="q" aria-label="Search">
                    <button class="header-search-btn btn d-flex align-items-center justify-content-center" type="submit" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                    </button>
                </form>
            </div>

            <div class="collapse navbar-collapse" id="upperNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link nav-link-upper" href="index.php">STORE</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-upper" href="community.php">COMMUNITY</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-upper" href="about.php">ABOUT</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-upper" href="support.php">SUPPORT</a></li>
                </ul>

                <div class="d-none d-lg-flex align-items-center gap-2">

                    <a href="login.php" id="desktopLoginBtn" style="display: none;">
                        <button type="button" class="login-btn btn btn-sm me-3">Login</button>
                    </a>

                    <div class="dropdown" id="desktopProfileContainer" style="display: none;">
                        <a href="#" class="nav-profile-link d-flex align-items-center text-decoration-none dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-2 text-white fw-bold small text-uppercase" id="navHeaderName">User</span>
                            <img id="navHeaderAvatar" src="../assets/images/avatars/default.jpg" class="nav-profile-img rounded" width="34" height="34">
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark custom-steam-dropdown shadow-lg mt-2 p-0 overflow-hidden">
                            <li class="dropdown-user-info p-3 text-center border-bottom border-secondary">
                                <img id="navDropdownAvatar" src="../assets/images/avatars/default.jpg" class="rounded-circle mb-2 border border-2 border-info" width="64" height="64" style="object-fit: cover;">
                                <h6 class="text-white fw-bold mb-0" id="navDropdownName">Username</h6>
                                <small class="text-info">Online</small>
                            </li>

                            <li class="mt-2"><a class="dropdown-item py-2" href="community.php#myzone"><i class="fas fa-user-circle me-2 text-secondary"></i> My Profile</a></li>
                            <li>
                                <hr class="dropdown-divider bg-secondary opacity-50 my-2">
                            </li>
                            <li class="mb-2">
                                <a class="dropdown-item py-2 text-danger fw-bold" href="../php_backend/logout.php">
                                    <i class="fas fa-sign-out-alt me-2"></i> Sign Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="d-lg-none border-top border-secondary pt-3 mt-3 mx-2">

                    <a href="login.php" id="mobileLoginBtn" style="display: none;">
                        <button type="button" class="login-btn btn btn-sm w-100">Login</button>
                    </a>

                    <div id="mobileProfileContainer" style="display: none;">
                        <div class="d-flex align-items-center mb-3 px-2 p-2 bg-dark rounded">
                            <img id="mobileNavAvatar" src="../assets/images/avatars/default.jpg" class="rounded me-3" width="40" height="40" style="object-fit: cover;">
                            <div>
                                <div class="text-white fw-bold" id="mobileNavName">User</div>
                                <small class="text-success" style="font-size: 0.75rem;">Logged In</small>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <a href="community.php#myzone" class="btn btn-sm btn-outline-light w-100">Profile</a>
                            </div>
                            <div class="col-6">
                                <a href="../php_backend/logout.php" class="btn btn-sm btn-danger w-100">Logout</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </nav>
</header>

<nav class="secondary-navbar py-2" aria-label="Secondary Navigation">
    <div class="container d-flex align-items-center">
        <ul class="desktop-subnav-list d-none d-lg-flex flex-nowrap gap-4 me-auto mb-0 list-unstyled">
            <li class="nav-item dropdown">
                <a class="nav-link subnav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Browse</a>
                <ul class="dropdown-menu custom-dropdown-menu">
                    <li><a class="dropdown-item custom-dropdown-item" href="index.php#dis">Discounts and Offers</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="index.php#rec">Recommended Games</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="index.php#under">Browse Cheap</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link subnav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Categories</a>
                <ul class="dropdown-menu custom-dropdown-menu">
                    <li><a class="dropdown-item custom-dropdown-item" href="category-details.php?genre_id=1">Action</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="category-details.php?genre_id=2">Adventure</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="category-details.php?genre_id=8">Fighting</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="category-details.php?genre_id=9">Horror</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="category-details.php?genre_id=10">MOBA</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="category-details.php?genre_id=13">Platformer</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="category-details.php?genre_id=7">Puzzle</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="category-details.php?genre_id=3">Role Playing</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="category-details.php?genre_id=12">Sandbox</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="category-details.php?genre_id=5">Simulation</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="category-details.php?genre_id=6">Sports</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="category-details.php?genre_id=14">Stealth</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="category-details.php?genre_id=4">Strategy</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="category-details.php?genre_id=11">Survival</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link subnav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">More</a>
                <ul class="dropdown-menu custom-dropdown-menu">
                    <li><a class="dropdown-item custom-dropdown-item" href="browse-cheap.php?price=5">Under 5$</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="browse-cheap.php?price=10">Under 10$</a></li>
                </ul>
            </li>
        </ul>

        <form class="header-search-group desktop-search-form d-none d-lg-flex input-group position-relative" role="search" action="games-list.php" method="get">
            <input id="search-bar" class="header-search-input form-control" type="search" placeholder="Search" name="q" autocomplete="off">

    <!-- Live Search Results Box -->
                    <div id="search-results"
                         style="position:absolute; top:100%; left:0; width:100%; background:#2a2f38; border:1px solid #57cbde; display:none; z-index:9999;"
                          class="text-white">
                    </div>

            <button class="header-search-btn btn d-flex align-items-center justify-content-center" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
            </button>
        </form>

        <ul class="mobile-subnav-list d-lg-none w-100 ps-0 mb-0 list-unstyled d-flex flex-nowrap justify-content-start overflow-auto pb-2">
            <li class="nav-item dropdown me-3"><a class="nav-link subnav-link" href="#">Browse</a></li>
        </ul>
    </div>
</nav>

<script>
    // 3. UPDATED JAVASCRIPT LOGIC
    async function checkSessionStatus() {
        try {
            const response = await fetch('../config/check_session_status.php');
            const data = await response.json();

            // Elements
            const desktopLoginBtn = document.getElementById('desktopLoginBtn');
            const desktopProfileContainer = document.getElementById('desktopProfileContainer');
            const mobileLoginBtn = document.getElementById('mobileLoginBtn');
            const mobileProfileContainer = document.getElementById('mobileProfileContainer');

            // Profile Data Elements
            const navHeaderAvatar = document.getElementById('navHeaderAvatar');
            const navHeaderName = document.getElementById('navHeaderName');
            const navDropdownAvatar = document.getElementById('navDropdownAvatar');
            const navDropdownName = document.getElementById('navDropdownName');
            const mobileNavAvatar = document.getElementById('mobileNavAvatar');
            const mobileNavName = document.getElementById('mobileNavName');

            if (data.logged_in) {
                const displayName = data.user_data.display_name || 'User';
                let avatarSrc = data.user_data.avatar_url || 'assets/images/avatars/default.jpg';
                
                if (avatarSrc.startsWith('assets/')) {
                    avatarSrc = '../' + avatarSrc;
                }

                // Update UI Text & Images
                if (navHeaderName) navHeaderName.textContent = displayName;
                if (navDropdownName) navDropdownName.textContent = displayName;
                if (navHeaderAvatar) navHeaderAvatar.src = avatarSrc;
                if (navDropdownAvatar) navDropdownAvatar.src = avatarSrc;
                if (mobileNavName) mobileNavName.textContent = displayName;
                if (mobileNavAvatar) mobileNavAvatar.src = avatarSrc;

                // Toggle Visibility
                if (desktopLoginBtn) desktopLoginBtn.style.display = 'none';
                if (desktopProfileContainer) desktopProfileContainer.style.display = 'block';
                if (mobileLoginBtn) mobileLoginBtn.style.display = 'none';
                if (mobileProfileContainer) mobileProfileContainer.style.display = 'block';

            } else {
                if (desktopLoginBtn) desktopLoginBtn.style.display = 'block';
                if (desktopProfileContainer) desktopProfileContainer.style.display = 'none';
                if (mobileLoginBtn) mobileLoginBtn.style.display = 'block';
                if (mobileProfileContainer) mobileProfileContainer.style.display = 'none';
            }
        } catch (error) {
            console.error('Error checking session:', error);
            if (document.getElementById('desktopLoginBtn')) document.getElementById('desktopLoginBtn').style.display = 'block';
        }
    }

    document.addEventListener('DOMContentLoaded', checkSessionStatus);

    // ==========================================
    // ✅ LIVE SEARCH LOGIC (UPDATED)
    // ==========================================
    let searchInput = document.getElementById("search-bar");
    let resultsBox = document.getElementById("search-results");

    if (searchInput) {
        searchInput.addEventListener("keyup", async function () {
            let query = this.value.trim();

            if (query.length < 2) {
                resultsBox.style.display = "none";
                return;
            }

            try {
                const response = await fetch("../php_backend/live_search.php?q=" + query);
                const data = await response.json();

                let html = "";

                if (data.length > 0) {
                    data.forEach(game => {
                        // ✅ FIX: Using 'game_id' and 'thumbnail_image' from DB
                        html += `
                            <a href="game-details.php?game_id=${game.game_id}" style="text-decoration:none;">
                                <div class="p-2 border-bottom border-secondary d-flex align-items-center hover-bg-dark">
                                    <img src="../${game.thumbnail_image}" width="50" height="50" class="me-2 rounded" style="object-fit:cover;">
                                    <span class="text-white">${game.title}</span>
                                </div>
                            </a>
                        `;
                    });
                } else {
                    html = `<div class="p-2 text-center text-secondary">No Results Found</div>`;
                }

                resultsBox.innerHTML = html;
                resultsBox.style.display = "block";
                
            } catch (error) {
                console.error("Search Error:", error);
            }
        });

        // Hide results on click outside
        document.addEventListener("click", function (event) {
            if (!resultsBox.contains(event.target) && event.target !== searchInput) {
                resultsBox.style.display = "none";
            }
        });
    }
</script>