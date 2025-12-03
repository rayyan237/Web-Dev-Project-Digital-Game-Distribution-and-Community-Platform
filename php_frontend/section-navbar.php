<header class="main-navbar">
    <nav class="navbar navbar-expand-lg navbar-upper-border">
        
        <div class="container px-3 d-flex justify-content-start align-items-center flex-wrap flex-lg-nowrap">

            <button class="navbar-toggler border-0 me-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#upperNav" aria-controls="upperNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter:invert(1)"></span>
            </button>

            <a class="navbar-brand navbar-brand-desktop d-none d-lg-block" href="#" aria-label="Homepage">
                <img src="https://upload.wikimedia.org/wikipedia/commons/8/83/Steam_icon_logo.svg" alt="Company Logo"
                    height="30">
            </a>

            <div class="mobile-search-container d-lg-none ms-auto">
                <form class="header-search-group input-group" role="search" aria-label="Mobile Search">
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

                <div class="d-flex align-items-center gap-2 d-lg-flex d-none">
                    <button type="button" class="login-btn btn btn-sm me-3">Login</button>
                </div>

                <div class="d-flex flex-column align-items-stretch gap-2 d-lg-none border-top border-secondary pt-3 mt-3 mx-2">
                    <div>
                        <button type="button" class="login-btn btn btn-sm w-100">Login</button>
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

        <form class="header-search-group desktop-search-form d-none d-lg-flex input-group" role="search" aria-label="Desktop Search">
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

        <ul class="mobile-subnav-list d-lg-none w-100 ps-0 mb-0 list-unstyled d-flex flex-nowrap justify-content-start overflow-auto pb-2">
            <li class="nav-item dropdown me-3">
                <a class="nav-link subnav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button"
                    aria-expanded="false">Browse</a>
                <ul class="dropdown-menu custom-dropdown-menu">
                    <li><a class="dropdown-item custom-dropdown-item" href="#">New Releases</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="#">Discovery Queue</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown me-3">
                <a class="nav-link subnav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button"
                    aria-expanded="false">Recommendations</a>
                <ul class="dropdown-menu custom-dropdown-menu">
                    <li><a class="dropdown-item custom-dropdown-item" href="#">By Friends</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="#">By Curators</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown me-3">
                <a class="nav-link subnav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button"
                    aria-expanded="false">Categories</a>
                <ul class="dropdown-menu custom-dropdown-menu">
                    <li><a class="dropdown-item custom-dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item custom-dropdown-item" href="#">RPG</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown me-3">
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