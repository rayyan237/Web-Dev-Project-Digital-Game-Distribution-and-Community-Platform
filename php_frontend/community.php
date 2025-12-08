<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Steam Connect - Z Zone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* --- Theme Variables --- */
        :root {
            --steam-bg-main: #1b2838;
            --steam-bg-secondary: #171a21;
            --steam-card-bg: #2a475e;
            --steam-card-hover: #31536f;
            --steam-text: #c7d5e0;
            --steam-accent: #66c0f4;
            --z-highlight: #ffffff;
        }

        body {
            background-color: var(--steam-bg-main);
            color: var(--steam-text);
        }

        body.no-scroll {
            overflow: hidden;
            height: 100vh;
        }

        a {
            text-decoration: none;
            color: var(--steam-text);
            cursor: pointer;
        }

        .text-accent {
            color: var(--steam-accent) !important;
        }

        .text-highlight {
            color: var(--z-highlight) !important;
        }

        .bg-steam-secondary {
            background-color: var(--steam-bg-secondary);
        }

        .rounded-steam {
            border-radius: 12px !important;
        }

        /* --- Toggle Navigation --- */
        .z-nav-container {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-bottom: 30px;
            padding-bottom: 10px;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .z-nav-item {
            cursor: pointer;
            color: #6d7783;
            position: relative;
            padding-bottom: 8px;
            transition: 0.3s;
        }

        .z-nav-item:hover {
            color: white;
        }

        .z-nav-item.active {
            color: white;
        }

        .z-nav-item.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 4px;
            background-color: var(--z-highlight);
            border-radius: 10px;
        }

        /* --- Profile Section --- */
        .profile-header-card {
            background: linear-gradient(to bottom, rgba(42, 71, 94, 0.5), rgba(27, 40, 56, 1));
            border: 1px solid rgba(102, 192, 244, 0.2);
        }

        .profile-avatar-lg {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid var(--steam-card-bg);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .profile-avatar-lg:hover {
            border-color: var(--steam-accent);
            opacity: 0.8;
            transform: scale(1.05);
        }

        .avatar-edit-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
            font-size: 0.9rem;
        }

        .position-relative:hover .avatar-edit-overlay {
            opacity: 1;
        }

        .activity-item {
            border-left: 2px solid #3d4d5d;
            padding-left: 20px;
            padding-bottom: 25px;
            position: relative;
        }

        .activity-item::before {
            content: '';
            position: absolute;
            left: -6px;
            top: 0;
            width: 10px;
            height: 10px;
            background: var(--steam-accent);
            border-radius: 50%;
        }

        .activity-item:last-child {
            border-left: none;
        }

        /* --- Standard Elements --- */
        .btn-white {
            background-color: #ffffff;
            color: #171a21;
            font-weight: 700;
            border: none;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: fit-content;
            white-space: nowrap;
        }

        .btn-white:hover {
            background-color: #dcdcdc;
            color: #000;
        }

        .btn-steam-outline {
            border: 2px solid var(--steam-card-bg);
            color: var(--steam-accent);
            background: transparent;
            font-weight: 600;
        }

        .btn-steam-outline:hover,
        .btn-steam-outline.active {
            border-color: var(--steam-accent);
            color: white;
            background: var(--steam-card-bg);
        }

        .btn-action-link {
            padding: 0;
            color: #687987;
            font-size: 0.8rem;
            text-decoration: none;
            background: none;
            border: none;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-action-link:hover,
        .btn-action-link.active {
            color: var(--steam-accent);
        }

        /* --- Inputs --- */
        .form-control-steam {
            background-color: #0e1116;
            border: 1px solid #373f49;
            color: var(--steam-text);
        }

        .form-control-steam:focus {
            background-color: #12151a;
            border-color: var(--steam-accent);
            box-shadow: none;
            color: white;
        }

        .form-select-steam {
            background-color: #0e1116;
            border: 1px solid #373f49;
            color: var(--steam-text);
        }

        .form-select-steam:focus {
            border-color: var(--steam-accent);
            box-shadow: none;
        }

        /* --- Chat --- */
        .chat-container {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
        }

        .chat-window {
            height: 350px;
            overflow-y: auto;
            overflow-x: hidden;
            background-color: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 20px;
            position: relative;
        }

        .chat-window::-webkit-scrollbar {
            width: 8px;
        }

        .chat-window::-webkit-scrollbar-thumb {
            background: var(--steam-card-bg);
            border-radius: 4px;
        }

        .chat-message {
            display: flex;
            margin-bottom: 12px;
            align-items: flex-start;
            max-width: 100%;
        }

        .chat-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            margin-right: 10px;
            flex-shrink: 0;
            border: 2px solid var(--steam-card-bg);
        }

        .chat-bubble {
            background-color: var(--steam-card-bg);
            padding: 8px 14px;
            border-radius: 12px;
            border-top-left-radius: 2px;
            font-size: 0.95rem;
            word-wrap: break-word;
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: pre-wrap;
            max-width: 100%;
        }

        .chat-meta {
            font-size: 0.75rem;
            color: var(--steam-accent);
            margin-bottom: 2px;
            font-weight: bold;
        }

        .btn-hide-chat {
            position: absolute;
            top: -40px;
            right: 0;
            color: #8a9ea7;
            font-size: 0.9rem;
            background: transparent;
            border: none;
        }

        .chat-collapsed-bar {
            display: none;
            width: 100%;
            height: 60px;
            background-color: rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background 0.2s;
            user-select: none;
        }

        .chat-collapsed-text {
            font-weight: bold;
            color: white;
            font-size: 1rem;
        }

        /* --- Sidebar & Posts --- */
        .category-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 20px;
            color: #8a9ea7;
            font-weight: 500;
            transition: 0.2s;
            border-radius: 50px;
            margin-bottom: 5px;
            cursor: pointer;
        }

        .category-link:hover,
        .category-link.active {
            background-color: var(--steam-card-bg);
            color: var(--steam-accent);
        }

        .badge-count {
            background-color: #e6ebf0;
            color: #171a21;
            font-weight: 700;
            border-radius: 50px;
            padding: 5px 10px;
            min-width: 30px;
            text-align: center;
        }

        .post-card-box {
            background-color: var(--steam-card-bg);
            height: 160px;
            padding: 20px;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.2s;
            border: 1px solid rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }

        .post-card-box:hover {
            transform: translateY(-3px);
            background-color: var(--steam-card-hover);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .post-body-truncated {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #a0b5c4;
        }

        /* --- Modals --- */
        .modal-content {
            background-color: var(--steam-bg-main);
            border: 1px solid var(--steam-accent);
        }

        .modal-header,
        .modal-footer {
            border-color: rgba(255, 255, 255, 0.1);
        }

        .reply-box {
            border-left: 3px solid #2a475e;
            padding-left: 15px;
        }

        .tag-highlight {
            color: var(--steam-accent);
            font-weight: 700;
            background-color: rgba(102, 192, 244, 0.1);
            padding: 0 4px;
            border-radius: 4px;
        }

        /* --- Login Required Modal --- */
        .login-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-modal-box {
            background: linear-gradient(135deg, rgba(23, 26, 33, 0.98), rgba(27, 40, 56, 0.98));
            border: 2px solid var(--steam-accent);
            border-radius: 12px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.8);
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-modal-icon {
            font-size: 4rem;
            color: var(--steam-accent);
            margin-bottom: 20px;
        }

        .login-modal-title {
            color: white;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .login-modal-text {
            color: var(--steam-text);
            font-size: 1rem;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .login-modal-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-login-primary {
            background: linear-gradient(90deg, #06bfff 0%, #2d73ff 100%);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-login-primary:hover {
            background: linear-gradient(90deg, #2d73ff 0%, #06bfff 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 192, 244, 0.5);
        }

        .btn-login-secondary {
            background: transparent;
            color: var(--steam-accent);
            padding: 12px 30px;
            border: 2px solid var(--steam-accent);
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-login-secondary:hover {
            background: var(--steam-card-bg);
            color: white;
            border-color: white;
        }

        @media (max-width: 768px) {
            .chat-container {
                margin-bottom: 2rem;
            }

            .btn-hide-chat {
                top: -30px;
                font-size: 0.8rem;
            }

            .col-md-3.mb-4 {
                margin-bottom: 1rem !important;
            }

            .profile-avatar-lg {
                width: 80px;
                height: 80px;
            }

            .login-modal-box {
                padding: 30px 20px;
            }

            .login-modal-title {
                font-size: 1.5rem;
            }

            .login-modal-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body<?php if (!$isLoggedIn) echo ' class="no-scroll"'; ?>>

    <?php if (!$isLoggedIn): ?>
        <!-- Login Required Overlay -->
        <div class="login-overlay" id="loginOverlay">
            <div class="login-modal-box">
                <div class="login-modal-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h2 class="login-modal-title">Login Required</h2>
                <p class="login-modal-text">
                    You must be logged in to access the Z Community. Join our community to chat, create posts, and connect with other gamers!
                </p>
                <div class="login-modal-buttons">
                    <a href="login.php" class="btn-login-primary">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                    <a href="signup.php" class="btn-login-secondary">
                        <i class="fas fa-user-plus me-2"></i>Create Account
                    </a>
                </div>
                <p class="text-secondary mt-4 mb-0" style="font-size: 0.85rem;">
                    <a href="index.php" class="text-accent text-decoration-none"><i class="fas fa-home me-1"></i>Return to Homepage</a>
                </p>
            </div>
        </div>
    <?php endif; ?>

    <?php include 'section-navbar.php'; ?>

    <div class="container pb-5">

        <div class="z-nav-container">
            <div class="z-nav-item active" id="tab-community" onclick="switchTab('community')">Z Community</div>
            <div class="z-nav-item" id="tab-myzone" onclick="switchTab('myzone')">My Zone</div>
        </div>

        <div id="section-community">
            <h1 class="display-5 fw-bold text-white text-center mb-4">Global Hub</h1>

            <div class="chat-container mb-5">
                <div id="chat-interface-wrapper">
                    <div class="position-relative">
                        <button class="btn-hide-chat" onclick="toggleChat()"><i class="fa-solid fa-eye-slash me-1"></i> Hide Chatbox</button>
                    </div>
                    <div class="chat-window rounded-steam mb-3" id="chat-box">
                        <!-- Messages will be loaded from database -->
                    </div>
                    <div class="input-group">
                        <input type="text" id="chat-input" class="form-control form-control-steam py-3 px-4 rounded-start-pill" placeholder="Send a message... (Text only)">
                        <button class="btn btn-white px-5 rounded-end-pill" type="button" id="send-btn">Send <i class="fa-solid fa-paper-plane ms-2"></i></button>
                    </div>
                </div>
                <div id="chat-collapsed-bar" class="chat-collapsed-bar rounded-pill" onclick="toggleChat()">
                    <span class="chat-collapsed-text"><i class="fa-solid fa-circle-plus me-2"></i> Show Chatbox</span>
                </div>
            </div>

            <div class="row mb-4 align-items-center border-top border-secondary pt-4">
                <div class="col-md-3 d-none d-md-block"></div>
                <div class="col-md-9 d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div class="d-flex gap-2">
                        <button class="btn btn-white rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#createPostModal">
                            <i class="fa-solid fa-plus me-2"></i> Create
                        </button>
                        <button class="btn btn-steam-outline rounded-pill px-4" id="my-posts-btn" onclick="filterPosts('mine')">
                            <i class="fa-solid fa-layer-group me-2"></i>My Posts
                        </button>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-link text-secondary text-decoration-none dropdown-toggle" type="button" data-bs-toggle="dropdown" id="sortDropdownBtn">
                            Sort by: <span class="text-accent" id="sortLabel">Newest</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark bg-steam-secondary">
                            <li><a class="dropdown-item" onclick="sortPosts('newest')">Newest</a></li>
                            <li><a class="dropdown-item" onclick="sortPosts('popular')">Popular</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="d-flex flex-column gap-2 sticky-top" style="top: 20px; z-index: 1;">
                        <a onclick="filterPosts('all')" class="category-link active" id="cat-all">
                            <span><i class="fa-solid fa-hashtag me-2"></i>all</span> <span class="badge badge-count" id="count-all">0</span>
                        </a>
                        <a onclick="filterPosts('general')" class="category-link" id="cat-general">
                            <span class="text-accent"><i class="fa-solid fa-hashtag me-2"></i>general</span> <span class="badge badge-count" id="count-general">0</span>
                        </a>
                        <a onclick="filterPosts('guide')" class="category-link" id="cat-guide">
                            <span class="text-success"><i class="fa-solid fa-hashtag me-2"></i>guide</span> <span class="badge badge-count" id="count-guide">0</span>
                        </a>
                        <a onclick="filterPosts('help')" class="category-link" id="cat-help">
                            <span class="text-warning"><i class="fa-solid fa-hashtag me-2"></i>help</span> <span class="badge badge-count" id="count-help">0</span>
                        </a>
                        <a onclick="filterPosts('feedback')" class="category-link" id="cat-feedback">
                            <span class="text-danger"><i class="fa-solid fa-hashtag me-2"></i>feedback</span> <span class="badge badge-count" id="count-feedback">0</span>
                        </a>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="row g-3" id="posts-container">
                    </div>
                </div>
            </div>
        </div>

        <div id="section-myzone" class="d-none">
            <div class="row">
                <div class="col-lg-4 col-md-5 mb-4">
                    <div class="profile-header-card p-4 rounded-steam text-center shadow-lg">
                        <div class="position-relative d-inline-block mb-3" style="cursor: pointer;" onclick="document.getElementById('avatarInput').click()">
                            <img id="profile-avatar" src="../assets/images/avatars/default.jpg" class="profile-avatar-lg shadow">
                            <div class="avatar-edit-overlay">
                                <i class="fas fa-camera me-1"></i> Change Photo
                            </div>
                            <div class="position-absolute bottom-0 end-0 bg-success border border-dark rounded-circle p-2" style="width: 20px; height: 20px;"></div>
                        </div>
                        <input type="file" id="avatarInput" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" style="display: none;">
                        <h2 class="text-white fw-bold mb-1" id="profile-display-name">Loading...</h2>
                        <p class="text-accent mb-3" id="profile-username">@username</p>

                        <div class="d-flex justify-content-center gap-3 mb-4">
                            <div class="text-center">
                                <h5 class="text-white fw-bold mb-0" id="profile-posts-count">0</h5>
                                <small class="text-secondary">Posts</small>
                            </div>
                            <div class="text-center">
                                <h5 class="text-white fw-bold mb-0" id="profile-likes-count">0</h5>
                                <small class="text-secondary">Likes</small>
                            </div>
                            <div class="text-center">
                                <h5 class="text-white fw-bold mb-0" id="profile-games-count">0</h5>
                                <small class="text-secondary">Games</small>
                            </div>
                        </div>

                        <div class="text-start bg-steam-secondary p-3 rounded mb-3">
                            <h6 class="text-uppercase text-secondary small fw-bold mb-2">About Me</h6>
                            <p class="small text-light mb-0" id="profile-about-text">No about information yet.</p>
                            <textarea class="form-control form-control-steam small d-none" id="profile-about-input" maxlength="1000" rows="4" placeholder="Tell us about yourself..."></textarea>
                        </div>

                        <button class="btn btn-steam-outline w-100 py-2 mb-2" id="edit-about-btn">Edit About</button>
                        <?php if ($isAdmin): ?>
                        <a href="admin.php" class="btn w-100 py-2 mb-2" style="background: linear-gradient(90deg, #06bfff 0%, #2d73ff 100%); color: white; font-weight: 500; transition: all 0.3s ease; text-decoration: none; display: block;" onmouseover="this.style.background='linear-gradient(90deg, #2d73ff 0%, #06bfff 100%)'" onmouseout="this.style.background='linear-gradient(90deg, #06bfff 0%, #2d73ff 100%)'">
                            <i class="fas fa-cogs"></i> Manage Games
                        </a>
                        <?php endif; ?>
                        <button class="btn w-100 py-2" id="delete-account-btn" style="background: rgba(255, 107, 107, 0.1); border: 1px solid rgba(255, 107, 107, 0.4); color: #ff6b6b; font-weight: 500; transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255, 107, 107, 0.2)'" onmouseout="this.style.background='rgba(255, 107, 107, 0.1)'"><i class="fas fa-trash-alt"></i> Delete Account</button>
                    </div>
                </div>

                <div class="col-lg-8 col-md-7">
                    <h4 class="text-white mb-4 ps-2 border-start border-4" style="border-color: var(--z-highlight) !important;">Recent Activity</h4>
                    <div class="bg-steam-secondary rounded-steam p-4" id="activity-log-container">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="fullPostModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-steam">
                <div class="modal-header">
                    <div>
                        <span class="badge bg-accent me-2" id="modal-category">#category</span>
                        <small class="text-secondary" id="modal-timestamp">time</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-4">
                    <div class="d-flex align-items-center mb-3">
                        <img id="modal-author-avatar" src="../assets/images/avatars/default.jpg" class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid var(--steam-accent);">
                        <div>
                            <h5 class="modal-title text-white mb-0" id="modal-title">Post Title</h5>
                            <small class="text-secondary" id="modal-author-name">Author</small>
                        </div>
                    </div>
                    <p class="text-light lead fs-6" id="modal-body-text">Text</p>

                    <div class="d-flex align-items-center py-3 border-top border-bottom border-secondary my-4" id="post-actions-bar">
                    </div>

                    <h6 class="text-accent mb-4">Replies</h6>
                    <div id="modal-replies-container"></div>
                </div>
                <div class="modal-footer bg-steam-secondary justify-content-start">
                    <div class="input-group w-100">
                        <input type="text" id="reply-input" class="form-control form-control-steam rounded-start-pill" placeholder="Write a reply...">
                        <button class="btn btn-white rounded-end-pill" type="button" id="reply-btn">Post Reply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createPostModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-steam">
                <div class="modal-header">
                    <h5 class="modal-title text-white">Create New Post</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="text-secondary small mb-1">Title</label>
                        <input type="text" id="new-post-title" class="form-control form-control-steam" placeholder="What's on your mind?">
                    </div>
                    <div class="mb-3">
                        <label class="text-secondary small mb-1">Category</label>
                        <select id="new-post-category" class="form-select form-select-steam">
                            <option value="general">General</option>
                            <option value="guide">Guide</option>
                            <option value="help">Help</option>
                            <option value="feedback">Feedback</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="text-secondary small mb-1">Content</label>
                        <textarea id="new-post-content" class="form-control form-control-steam" rows="5" placeholder="Write your post here..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-steam-secondary">
                    <button type="button" class="btn btn-steam-outline" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-white" onclick="submitNewPost()">Post Now</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Check if user is logged in
        const isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;

        // Prevent all interactions if not logged in
        if (!isLoggedIn) {
            // Disable all interactions
            document.addEventListener('DOMContentLoaded', function() {
                // Prevent scrolling
                document.body.style.overflow = 'hidden';

                // Prevent any clicks on the page content
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.login-overlay')) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                }, true);

                // Prevent keyboard navigation
                document.addEventListener('keydown', function(e) {
                    e.preventDefault();
                }, true);

                // Prevent mouse wheel scrolling
                document.addEventListener('wheel', function(e) {
                    e.preventDefault();
                }, {
                    passive: false
                });

                // Prevent touch scrolling
                document.addEventListener('touchmove', function(e) {
                    e.preventDefault();
                }, {
                    passive: false
                });
            });

            // Stop execution of other scripts
            throw new Error('Login required');
        }

        // --- DATA STORE ---
        let postsData = [];

        // Helper: Update everything in My Zone
        function refreshMyZoneUI() {
            renderActivityLog();
            loadProfileData(); // Refresh the stats (Posts/Likes count)
        }

        // Load posts from database
        function loadPosts() {
            fetch('../php_backend/get_community_posts.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.posts) {
                        // Transform database posts to match frontend format
                        postsData = data.posts.map(post => ({
                            id: post.post_id,
                            realTimestamp: new Date(post.created_at).getTime(),
                            title: post.title,
                            content: post.content,
                            category: post.category,
                            author: post.is_own_post ? 'You' : post.display_name,
                            authorId: post.user_id,
                            likes: post.likes,
                            dislikes: post.dislikes,
                            userAction: post.user_reaction, // 'like', 'dislike', or null
                            replies: [], // Will be loaded separately if needed
                            replyCount: post.reply_count,
                            avatarUrl: post.avatar_url.startsWith('assets/') ? '../' + post.avatar_url : post.avatar_url
                        }));
                        renderPosts();
                        updateSidebarCounts();
                        renderActivityLog();
                    } else {
                        console.error('Failed to load posts:', data.error);
                        postsData = [];
                        renderPosts();
                    }
                })
                .catch(error => {
                    console.error('Error loading posts:', error);
                    postsData = [];
                    renderPosts();
                });
        }

        // --- Z NAVIGATION LOGIC ---
        function switchTab(tabName) {
            const commDiv = document.getElementById('section-community');
            const zoneDiv = document.getElementById('section-myzone');
            const tabComm = document.getElementById('tab-community');
            const tabZone = document.getElementById('tab-myzone');

            if (tabName === 'community') {
                commDiv.classList.remove('d-none');
                zoneDiv.classList.add('d-none');
                tabComm.classList.add('active');
                tabZone.classList.remove('active');
            } else {
                commDiv.classList.add('d-none');
                zoneDiv.classList.remove('d-none');
                tabComm.classList.remove('active');
                tabZone.classList.add('active');
                renderActivityLog();
            }
        }

        // --- ACTIVITY LOG GENERATOR ---
        function renderActivityLog() {
            const container = document.getElementById('activity-log-container');
            let activities = [];

            postsData.forEach(post => {
                // 1. Posts by You
                if (post.author === 'You') {
                    activities.push({
                        type: 'post',
                        time: post.realTimestamp,
                        data: post
                    });
                }

                // 2. Likes & Dislikes (Check Generic userAction)
                if (post.userAction) {
                    // Uses the capture timestamp if available, else fallback to post time
                    let actionTime = post.actionTimestamp || post.realTimestamp;
                    activities.push({
                        type: 'reaction',
                        time: actionTime,
                        actionType: post.userAction,
                        data: post
                    });
                }

                // 3. Replies by You
                post.replies.forEach(rep => {
                    if (rep.user === 'You') {
                        activities.push({
                            type: 'reply',
                            time: rep.timestamp,
                            data: {
                                postTitle: post.title,
                                text: rep.text
                            }
                        });
                    }
                });
            });

            // Strict Numeric Sort: Descending (Newest first)
            activities.sort((a, b) => b.time - a.time);

            let html = '';
            if (activities.length === 0) {
                html = '<p class="text-secondary text-center">No recent activity.</p>';
            } else {
                activities.forEach(act => {
                    const timeStr = timeAgo(act.time);

                    if (act.type === 'post') {
                        html += `
                        <div class="activity-item">
                            <small class="text-secondary mb-1 d-block">${timeStr}</small>
                            <span class="text-white">You created a post: </span>
                            <a class="text-accent fw-bold text-decoration-none" onclick="switchToPost(${act.data.id})">${act.data.title}</a>
                            <div class="mt-2 p-2 bg-dark rounded border border-secondary text-secondary small fst-italic">"${act.data.content.substring(0,60)}..."</div>
                        </div>`;
                    } else if (act.type === 'reaction') {
                        // Determine text based on action type (like/dislike)
                        const actionText = act.actionType === 'like' ? 'liked' : 'disliked';
                        const colorClass = act.actionType === 'like' ? 'text-accent' : 'text-danger'; // Blue for like, Red for dislike

                        html += `
                        <div class="activity-item">
                            <small class="text-secondary mb-1 d-block">${timeStr}</small>
                            <span class="text-white">You ${actionText} a post: </span>
                            <span class="${colorClass} fw-bold">${act.data.title}</span>
                        </div>`;
                    } else if (act.type === 'reply') {
                        html += `
                        <div class="activity-item">
                            <small class="text-secondary mb-1 d-block">${timeStr}</small>
                            <span class="text-white">You replied to <span class="text-accent">${act.data.postTitle}</span></span>
                            <div class="mt-2 p-2 bg-dark rounded border border-secondary text-white small">"${act.data.text}"</div>
                        </div>`;
                    }
                });
            }
            container.innerHTML = html;
        }

        function switchToPost(id) {
            switchTab('community');
            openPostView(id);
        }

        // --- EXISTING JS LOGIC ---
        let currentFilter = 'all';
        let currentSort = 'newest';
        const postsContainer = document.getElementById('posts-container');

        function timeAgo(timestamp) {
            const seconds = Math.floor((Date.now() - timestamp) / 1000);
            let interval = seconds / 31536000;
            if (interval > 1) return Math.floor(interval) + "y ago";
            interval = seconds / 2592000;
            if (interval > 1) return Math.floor(interval) + "mo ago";
            interval = seconds / 86400;
            if (interval > 1) return Math.floor(interval) + "d ago";
            interval = seconds / 3600;
            if (interval > 1) return Math.floor(interval) + "h ago";
            interval = seconds / 60;
            if (interval > 1) return Math.floor(interval) + "m ago";
            return "Just now";
        }

        function formatReplyText(text) {
            let cleanText = text.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
            return cleanText.replace(/(@\w+)/g, '<span class="tag-highlight">$1</span>');
        }

        function sortPosts(type) {
            currentSort = type;
            document.getElementById('sortLabel').innerText = type === 'newest' ? 'Newest' : 'Popular';
            renderPosts();
        }

        function renderPosts() {
            postsContainer.innerHTML = '';
            let filteredPosts = [];
            if (currentFilter === 'all') filteredPosts = [...postsData];
            else if (currentFilter === 'mine') filteredPosts = postsData.filter(p => p.author === 'You');
            else filteredPosts = postsData.filter(p => p.category === currentFilter);

            if (currentSort === 'newest') {
                filteredPosts.sort((a, b) => b.realTimestamp - a.realTimestamp);
            } else if (currentSort === 'popular') {
                filteredPosts.sort((a, b) => {
                    if (b.replies.length !== a.replies.length) return b.replies.length - a.replies.length;
                    return b.realTimestamp - a.realTimestamp;
                });
            }

            filteredPosts.forEach((post, index) => {
                let badgeClass = 'bg-secondary';
                if (post.category === 'general') badgeClass = 'bg-info text-dark';
                if (post.category === 'feedback') badgeClass = 'bg-danger';
                if (post.category === 'help') badgeClass = 'bg-warning text-dark';
                if (post.category === 'guide') badgeClass = 'bg-success';

                const colClass = (index === 0) ? 'col-12' : 'col-md-6 col-12';
                const displayTime = timeAgo(post.realTimestamp);
                const replyCount = post.replyCount !== undefined ? post.replyCount : post.replies.length;

                const cardHTML = `
                    <div class="${colClass}">
                        <div class="post-card-box rounded-steam" onclick="openPostView(${post.id})">
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge ${badgeClass} me-2">#${post.category}</span>
                                <small class="text-secondary">${displayTime}</small>
                                <small class="text-secondary ms-2"><i class="fa-solid fa-comment me-1"></i>${replyCount}</small>
                                ${post.author === 'You' ? '<span class="badge bg-secondary ms-auto">Me</span>' : ''}
                            </div>
                            <h5 class="text-white mb-2">${post.title}</h5>
                            <p class="post-body-truncated mb-0 small">${post.content}</p>
                        </div>
                    </div>
                `;
                postsContainer.innerHTML += cardHTML;
            });

            if (filteredPosts.length === 0) {
                postsContainer.innerHTML = '<div class="col-12 text-center text-secondary py-5">No posts found.</div>';
            }
            updateSidebarCounts();
        }

        function filterPosts(category) {
            currentFilter = category;
            document.querySelectorAll('.category-link').forEach(link => link.classList.remove('active'));
            if (category !== 'mine' && category !== 'all') document.getElementById(`cat-${category}`).classList.add('active');
            else if (category === 'all') document.getElementById('cat-all').classList.add('active');
            const myPostBtn = document.getElementById('my-posts-btn');
            category === 'mine' ? myPostBtn.classList.add('active') : myPostBtn.classList.remove('active');
            renderPosts();
        }

        function updateSidebarCounts() {
            document.getElementById('count-all').innerText = postsData.length;
            document.getElementById('count-general').innerText = postsData.filter(p => p.category === 'general').length;
            document.getElementById('count-guide').innerText = postsData.filter(p => p.category === 'guide').length;
            document.getElementById('count-help').innerText = postsData.filter(p => p.category === 'help').length;
            document.getElementById('count-feedback').innerText = postsData.filter(p => p.category === 'feedback').length;
        }

        const createModalObj = new bootstrap.Modal(document.getElementById('createPostModal'));

        function submitNewPost() {
            const title = document.getElementById('new-post-title').value.trim();
            const cat = document.getElementById('new-post-category').value;
            const content = document.getElementById('new-post-content').value.trim();

            if (!title || !content) {
                alert("Please fill in all fields");
                return;
            }

            // Disable the submit button to prevent double submission
            const submitBtn = event.target;
            submitBtn.disabled = true;
            submitBtn.textContent = 'Posting...';

            // Send post to backend via AJAX
            fetch('../php_backend/create_post.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        title: title,
                        content: content,
                        category: cat
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Add new post to local data array
                        const newPost = {
                            id: data.data.post_id,
                            realTimestamp: Date.now(),
                            title: data.data.title,
                            content: data.data.content,
                            category: data.data.category,
                            author: 'You',
                            authorId: data.data.user_id,
                            likes: 0,
                            dislikes: 0,
                            userAction: null,
                            replies: [],
                            replyCount: 0,
                            avatarUrl: data.data.avatar_url.startsWith('assets/') ? '../' + data.data.avatar_url : data.data.avatar_url
                        };
                        postsData.unshift(newPost);

                        // Clear form fields
                        document.getElementById('new-post-title').value = '';
                        document.getElementById('new-post-content').value = '';

                        // Close modal
                        createModalObj.hide();

                        // Refresh posts display
                        filterPosts('all');
                        renderActivityLog();
                    } else {
                        alert(data.error || 'Failed to create post. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error creating post:', error);
                    alert('Failed to create post. Please check your connection and try again.');
                })
                .finally(() => {
                    // Re-enable submit button
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Post Now';
                });
        }

        const fullPostModal = new bootstrap.Modal(document.getElementById('fullPostModal'));
        let currentPostId = null;

        function openPostView(id) {
            currentPostId = id;
            const post = postsData.find(p => p.id === id);
            if (!post) return;
            document.getElementById('modal-title').innerText = post.title;
            document.getElementById('modal-body-text').innerText = post.content;
            document.getElementById('modal-category').innerText = "#" + post.category;
            document.getElementById('modal-timestamp').innerText = timeAgo(post.realTimestamp);
            document.getElementById('modal-author-avatar').src = post.avatarUrl || '../assets/images/avatars/default.jpg';
            document.getElementById('modal-author-name').innerText = post.author;
            updatePostActionsUI(post);

            // Load replies from database
            loadRepliesForPost(id);

            fullPostModal.show();
        }

        // Load replies from database
        function loadRepliesForPost(postId) {
            const container = document.getElementById('modal-replies-container');
            container.innerHTML = '<p class="text-secondary small">Loading replies...</p>';

            fetch(`../php_backend/get_post_replies.php?post_id=${postId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const post = postsData.find(p => p.id === postId);
                        if (post) {
                            // Transform database replies to match frontend format
                            post.replies = data.replies.map(reply => ({
                                reply_id: reply.reply_id,
                                user: reply.is_own_reply ? 'You' : reply.display_name,
                                text: reply.content,
                                likes: reply.likes,
                                userLiked: reply.userLiked,
                                timestamp: new Date(reply.created_at).getTime(),
                                avatarUrl: reply.avatar_url.startsWith('assets/') ? '../' + reply.avatar_url : reply.avatar_url,
                                userId: reply.user_id
                            }));
                            renderReplies(post.replies);
                            renderActivityLog();
                        }
                    } else {
                        container.innerHTML = '<p class="text-secondary small">Failed to load replies.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error loading replies:', error);
                    container.innerHTML = '<p class="text-secondary small">Error loading replies.</p>';
                });
        }

        function updatePostActionsUI(post) {
            const container = document.getElementById('post-actions-bar');
            const likeActive = post.userAction === 'like' ? 'active' : '';
            const dislikeActive = post.userAction === 'dislike' ? 'active' : '';
            container.innerHTML = `
                <button class="btn btn-action-link me-3 ${likeActive}" onclick="handlePostReaction(${post.id}, 'like')">
                    <i class="fa-solid fa-thumbs-up me-2"></i> ${post.likes}
                </button>
                <button class="btn btn-action-link ${dislikeActive}" onclick="handlePostReaction(${post.id}, 'dislike')">
                    <i class="fa-solid fa-thumbs-down me-2"></i> ${post.dislikes}
                </button>
            `;
        }

        function handlePostReaction(id, action) {
            const post = postsData.find(p => p.id === id);
            if (!post) return;

            // Determine what reaction to send to backend
            let reactionType = action;
            if (post.userAction === action) {
                // User clicked same reaction - remove it
                reactionType = 'remove';
            }

            // Send reaction to backend
            fetch('../php_backend/react_to_post.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        post_id: id,
                        reaction_type: reactionType
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update local post data with response from server
                        post.likes = data.likes;
                        post.dislikes = data.dislikes;
                        post.userAction = data.current_reaction; // 'like', 'dislike', or null
                        post.actionTimestamp = data.current_reaction ? Date.now() : null;
                        updatePostActionsUI(post);
                        renderActivityLog();
                    } else {
                        alert(data.error || 'Failed to update reaction.');
                    }
                })
                .catch(error => {
                    console.error('Error updating reaction:', error);
                    alert('Failed to update reaction. Please try again.');
                });
        }

        function renderReplies(replies) {
            const container = document.getElementById('modal-replies-container');
            container.innerHTML = '';
            if (replies.length === 0) {
                container.innerHTML = '<p class="text-secondary small fst-italic">No replies yet. Be the first!</p>';
                return;
            }
            replies.forEach((rep, index) => {
                const formattedText = formatReplyText(rep.text);
                const likeActive = rep.userLiked ? 'active' : '';
                const likeCount = rep.likes || 0;
                const timeDisplay = rep.timestamp ? timeAgo(rep.timestamp) : 'Just now';
                container.innerHTML += `
                    <div class="reply-box mt-3">
                        <div class="d-flex justify-content-between">
                            <strong><span class="text-accent">${rep.user}</span></strong>
                            <small class="text-secondary">${timeDisplay}</small>
                        </div>
                        <p class="small mt-2 mb-0">${formattedText}</p>
                        <div class="d-flex gap-3 mb-2 mt-2 align-items-center">
                            <button class="btn-action-link ${likeActive}" onclick="handleReplyLike(${index})">
                                <i class="fa-solid fa-thumbs-up me-1"></i> ${likeCount} Like
                            </button>
                            <button class="btn-action-link" onclick="replyToUser('${rep.user}')"><i class="fa-solid fa-reply me-1"></i>Reply</button>
                        </div>
                    </div>
                `;
            });
        }

        function handleReplyLike(replyIndex) {
            const post = postsData.find(p => p.id === currentPostId);
            const reply = post.replies[replyIndex];
            if (reply.userLiked) {
                reply.likes--;
                reply.userLiked = false;
            } else {
                reply.likes = (reply.likes || 0) + 1;
                reply.userLiked = true;
            }
            renderReplies(post.replies);
        }

        const replyInput = document.getElementById('reply-input');
        const replyBtn = document.getElementById('reply-btn');

        function replyToUser(username) {
            replyInput.value = `@${username} ` + replyInput.value;
            replyInput.focus();
        }

        replyBtn.addEventListener('click', () => {
            const text = replyInput.value.trim();
            if (!text || !currentPostId) return;

            // Disable button during submission
            replyBtn.disabled = true;
            replyBtn.textContent = 'Posting...';

            // Send reply to backend
            fetch('../php_backend/post_reply.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        post_id: currentPostId,
                        content: text
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const post = postsData.find(p => p.id === currentPostId);
                        if (post) {
                            // Increment reply count locally
                            post.replyCount = (post.replyCount || 0) + 1;
                            // Reload replies from database to get the new one
                            loadRepliesForPost(currentPostId);
                            replyInput.value = '';
                            renderPosts(); // Update reply count in post cards
                        }
                    } else {
                        alert(data.error || 'Failed to post reply.');
                    }
                })
                .catch(error => {
                    console.error('Error posting reply:', error);
                    alert('Failed to post reply. Please try again.');
                })
                .finally(() => {
                    replyBtn.disabled = false;
                    replyBtn.textContent = 'Post Reply';
                });
        });

        function toggleChat() {
            const ui = document.getElementById('chat-interface-wrapper');
            const bar = document.getElementById('chat-collapsed-bar');
            if (ui.style.display === 'none') {
                ui.style.display = 'block';
                bar.style.display = 'none';
            } else {
                ui.style.display = 'none';
                bar.style.display = 'flex';
            }
        }

        const chatInput = document.getElementById('chat-input');
        const sendBtn = document.getElementById('send-btn');
        const chatBox = document.getElementById('chat-box');

        // Load chat messages from database
        function loadChatMessages() {
            fetch('../php_backend/get_chat_messages.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.messages.length > 0) {
                        chatBox.innerHTML = ''; // Clear existing messages
                        data.messages.forEach(msg => {
                            const div = document.createElement('div');
                            div.className = 'chat-message';
                            const avatarUrl = msg.avatar_url.startsWith('assets/') ? '../' + msg.avatar_url : msg.avatar_url;
                            div.innerHTML = `<img src="${avatarUrl}" class="chat-avatar" alt="user"><div class="chat-content-wrapper"><div class="chat-meta text-accent">${msg.display_name}</div><div class="chat-bubble">${msg.message}</div></div>`;
                            chatBox.appendChild(div);
                        });
                        chatBox.scrollTop = chatBox.scrollHeight; // Scroll to bottom
                    } else if (data.messages && data.messages.length === 0) {
                        // No messages yet - show welcome message
                        chatBox.innerHTML = '<div class="chat-message"><img src="../assets/images/avatars/default.jpg" class="chat-avatar" alt="system"><div class="chat-content-wrapper"><div class="chat-meta">System</div><div class="chat-bubble">Welcome to global chat! Be the first to send a message.</div></div></div>';
                    }
                })
                .catch(error => {
                    console.error('Error loading messages:', error);
                    chatBox.innerHTML = '<div class="chat-message"><img src="../assets/images/avatars/default.jpg" class="chat-avatar" alt="system"><div class="chat-content-wrapper"><div class="chat-meta">System</div><div class="chat-bubble">Unable to load messages. Please refresh the page.</div></div></div>';
                });
        }

        function sendMessage() {
            const text = chatInput.value.trim();
            if (!text) return;

            // Disable send button to prevent double-sending
            sendBtn.disabled = true;
            chatInput.disabled = true;

            // Send message to backend via AJAX
            fetch('../php_backend/send_chat_message.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        message: text
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Display the message in the chat box
                        const div = document.createElement('div');
                        div.className = 'chat-message';
                        const avatarUrl = data.data.avatar_url.startsWith('assets/') ? '../' + data.data.avatar_url : data.data.avatar_url;
                        div.innerHTML = `<img src="${avatarUrl}" class="chat-avatar" alt="user"><div class="chat-content-wrapper"><div class="chat-meta text-accent">${data.data.display_name}</div><div class="chat-bubble">${data.data.message}</div></div>`;
                        chatBox.appendChild(div);
                        chatInput.value = '';
                        chatBox.scrollTop = chatBox.scrollHeight;
                    } else {
                        // Show error message
                        alert(data.error || 'Failed to send message. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                    alert('Failed to send message. Please check your connection and try again.');
                })
                .finally(() => {
                    // Re-enable send button
                    sendBtn.disabled = false;
                    chatInput.disabled = false;
                    chatInput.focus();
                });
        }

        sendBtn.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });

        // Load profile data
        function loadProfileData() {
            fetch('../php_backend/get_profile_data.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const profile = data.data;

                        // Update avatar
                        const avatarUrl = (profile.avatar_url && profile.avatar_url.startsWith('assets/')) ?
                            '../' + profile.avatar_url :
                            (profile.avatar_url || '../assets/images/avatars/default.jpg');
                        document.getElementById('profile-avatar').src = avatarUrl;

                        // Update display name and username
                        document.getElementById('profile-display-name').textContent = profile.display_name || 'User';
                        document.getElementById('profile-username').textContent = '@' + (profile.username || 'username');

                        // Update stats
                        document.getElementById('profile-posts-count').textContent = profile.posts_count || 0;
                        document.getElementById('profile-likes-count').textContent = profile.total_likes || 0;
                        document.getElementById('profile-games-count').textContent = profile.games_count || 0;

                        // Update about
                        const aboutText = profile.about || 'No about information yet.';
                        document.getElementById('profile-about-text').textContent = aboutText;
                        document.getElementById('profile-about-input').value = profile.about || '';
                    }
                })
                .catch(error => {
                    console.error('Error loading profile:', error);
                });
        }



        // Edit About functionality
        const editAboutBtn = document.getElementById('edit-about-btn');
        const aboutText = document.getElementById('profile-about-text');
        const aboutInput = document.getElementById('profile-about-input');
        let isEditingAbout = false;

        editAboutBtn.addEventListener('click', () => {
            if (!isEditingAbout) {
                // Switch to edit mode
                aboutText.classList.add('d-none');
                aboutInput.classList.remove('d-none');
                aboutInput.focus();
                editAboutBtn.textContent = 'Save About';
                editAboutBtn.classList.remove('btn-steam-outline');
                editAboutBtn.classList.add('btn-white');
                isEditingAbout = true;
            } else {
                // Save changes
                const newAbout = aboutInput.value.trim();
                editAboutBtn.disabled = true;
                editAboutBtn.textContent = 'Saving...';

                fetch('../php_backend/update_about.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            about: newAbout
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            aboutText.textContent = newAbout || 'No about information yet.';
                            aboutText.classList.remove('d-none');
                            aboutInput.classList.add('d-none');
                            editAboutBtn.textContent = 'Edit About';
                            editAboutBtn.classList.add('btn-steam-outline');
                            editAboutBtn.classList.remove('btn-white');
                            isEditingAbout = false;
                        } else {
                            alert(data.message || 'Failed to update about');
                        }
                    })
                    .catch(error => {
                        console.error('Error updating about:', error);
                        alert('Failed to update about. Please try again.');
                    })
                    .finally(() => {
                        editAboutBtn.disabled = false;
                    });
            }
        });


        // Handle avatar upload
        document.getElementById('avatarInput').addEventListener('change', async function(e) {
            const file = e.target.files[0];
            if (!file) return;
            
            // Validate file type
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
            if (!validTypes.includes(file.type)) {
                alert('Please select a valid image file (JPEG, PNG, GIF, or WEBP)');
                return;
            }
            
            // Validate file size (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('Image size must be less than 5MB');
                return;
            }
            
            // Create form data
            const formData = new FormData();
            formData.append('avatar', file);
            
            try {
                // Show loading state
                const avatarImg = document.getElementById('profile-avatar');
                const originalSrc = avatarImg.src;
                avatarImg.style.opacity = '0.5';
                
                const response = await fetch('../php_backend/update_avatar.php', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Update avatar image
                    avatarImg.src = '../' + data.avatar_url + '?t=' + new Date().getTime();
                    avatarImg.style.opacity = '1';
                    alert('Profile picture updated successfully!');
                } else {
                    avatarImg.style.opacity = '1';
                    alert(data.message || 'Failed to update profile picture');
                }
            } catch (error) {
                console.error('Error uploading avatar:', error);
                alert('Failed to upload profile picture. Please try again.');
                document.getElementById('profile-avatar').style.opacity = '1';
            }
            
            // Reset input
            e.target.value = '';
        });

        // Load chat messages and posts on page load
        loadChatMessages();
        loadPosts();
        loadProfileData();
        

        // Check URL for #myzone hash and switch tabs automatically
        function handleHashChange() {
            if (window.location.hash === '#myzone') {
                // Call your existing switchTab function
                switchTab('myzone');
                
                

                // Optional: Scroll slightly to ensure the profile is visible
                const profileCard = document.querySelector('.profile-header-card');
                if (profileCard) {
                    profileCard.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
        }

        // Run on page load
        window.addEventListener('DOMContentLoaded', handleHashChange);

        // Run if the hash changes while already on the page
        window.addEventListener('hashchange', handleHashChange);
    </script>

    <!-- Delete Account Confirmation Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-steam" style="background: linear-gradient(135deg, rgba(23, 26, 33, 0.98), rgba(27, 40, 56, 0.98)); border: 1px solid rgba(255, 107, 107, 0.3);">
                <div class="modal-header border-bottom" style="border-color: rgba(255, 107, 107, 0.2) !important;">
                    <h5 class="modal-title text-white"><i class="fas fa-exclamation-triangle text-danger"></i> Delete Account</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert" style="background-color: rgba(255, 107, 107, 0.1); border: 1px solid rgba(255, 107, 107, 0.3); color: #ff6b6b;">
                        <i class="fas fa-exclamation-circle"></i>
                        <strong>Warning:</strong> This action cannot be undone!
                    </div>
                    <p class="text-light mb-3">Are you sure you want to delete your account? This will permanently remove:</p>
                    <ul class="text-secondary" style="font-size: 0.9rem;">
                        <li>Your profile and account information</li>
                        <li>All your posts and comments</li>
                        <li>All your reactions and replies</li>
                        <li>Your chat messages</li>
                        <li>All associated data</li>
                    </ul>
                    <p class="text-danger fw-bold mt-3">Type "DELETE" to confirm:</p>
                    <input type="text" id="delete-confirmation-input" class="form-control form-control-steam" placeholder="Type DELETE" autocomplete="off">
                </div>
                <div class="modal-footer border-top" style="border-color: rgba(255, 107, 107, 0.2) !important;">
                    <button type="button" class="btn btn-steam-outline" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn" id="confirm-delete-btn" disabled style="background: rgba(255, 107, 107, 0.2); border: 1px solid rgba(255, 107, 107, 0.4); color: #ff6b6b; font-weight: 500;">Delete My Account</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Delete Account Modal functionality
        const deleteAccountBtn = document.getElementById('delete-account-btn');
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
        const deleteConfirmationInput = document.getElementById('delete-confirmation-input');
        const confirmDeleteBtn = document.getElementById('confirm-delete-btn');

        deleteAccountBtn.addEventListener('click', () => {
            deleteModal.show();
            deleteConfirmationInput.value = '';
            confirmDeleteBtn.disabled = true;
        });

        deleteConfirmationInput.addEventListener('input', (e) => {
            if (e.target.value === 'DELETE') {
                confirmDeleteBtn.disabled = false;
            } else {
                confirmDeleteBtn.disabled = true;
            }
        });

        confirmDeleteBtn.addEventListener('click', async () => {
            confirmDeleteBtn.disabled = true;
            confirmDeleteBtn.textContent = 'Deleting...';

            try {
                const response = await fetch('../php_backend/delete_account.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    alert('Your account has been successfully deleted.');
                    window.location.href = 'index.php';
                } else {
                    alert(data.message || 'Failed to delete account. Please try again.');
                    confirmDeleteBtn.disabled = false;
                    confirmDeleteBtn.textContent = 'Delete My Account';
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while deleting your account. Please try again.');
                confirmDeleteBtn.disabled = false;
                confirmDeleteBtn.textContent = 'Delete My Account';
            }
        });
    </script>
    </body>

</html>