<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Steam Connect - Z Zone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
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

        body { background-color: var(--steam-bg-main); color: var(--steam-text); font-family: sans-serif; }
        a { text-decoration: none; color: var(--steam-text); cursor: pointer; }
        .text-accent { color: var(--steam-accent) !important; }
        .text-highlight { color: var(--z-highlight) !important; }
        .bg-steam-secondary { background-color: var(--steam-bg-secondary); }
        .rounded-steam { border-radius: 12px !important; }

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

        .z-nav-item:hover { color: white; }

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
        .profile-avatar-lg { width: 120px; height: 120px; border-radius: 50%; border: 4px solid var(--steam-card-bg); }
        .activity-item {
            border-left: 2px solid #3d4d5d;
            padding-left: 20px;
            padding-bottom: 25px;
            position: relative;
        }
        .activity-item::before {
            content: ''; position: absolute; left: -6px; top: 0; width: 10px; height: 10px;
            background: var(--steam-accent); border-radius: 50%;
        }
        .activity-item:last-child { border-left: none; }

        /* --- Standard Elements --- */
        .btn-white {
            background-color: #ffffff; color: #171a21; font-weight: 700; border: none; transition: 0.2s;
            display: inline-flex; align-items: center; justify-content: center; width: fit-content; white-space: nowrap;
        }
        .btn-white:hover { background-color: #dcdcdc; color: #000; }

        .btn-steam-outline {
            border: 2px solid var(--steam-card-bg); color: var(--steam-accent); background: transparent; font-weight: 600;
        }
        .btn-steam-outline:hover, .btn-steam-outline.active { 
            border-color: var(--steam-accent); color: white; background: var(--steam-card-bg); 
        }

        .btn-action-link {
            padding: 0; color: #687987; font-size: 0.8rem; text-decoration: none; background: none; border: none; font-weight: 600; transition: 0.2s;
        }
        .btn-action-link:hover, .btn-action-link.active { color: var(--steam-accent); }

        /* --- Inputs --- */
        .form-control-steam { background-color: #0e1116; border: 1px solid #373f49; color: var(--steam-text); }
        .form-control-steam:focus { background-color: #12151a; border-color: var(--steam-accent); box-shadow: none; color: white; }
        .form-select-steam { background-color: #0e1116; border: 1px solid #373f49; color: var(--steam-text); }
        .form-select-steam:focus { border-color: var(--steam-accent); box-shadow: none; }

        /* --- Chat --- */
        .chat-container { max-width: 900px; margin: 0 auto; position: relative; }
        .chat-window {
            height: 350px; overflow-y: auto; overflow-x: hidden; background-color: rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.05); padding: 20px; position: relative;
        }
        .chat-window::-webkit-scrollbar { width: 8px; }
        .chat-window::-webkit-scrollbar-thumb { background: var(--steam-card-bg); border-radius: 4px; }
        .chat-message { display: flex; margin-bottom: 12px; align-items: flex-start; max-width: 100%; }
        .chat-avatar { width: 36px; height: 36px; border-radius: 50%; margin-right: 10px; flex-shrink: 0; border: 2px solid var(--steam-card-bg); }
        .chat-bubble {
            background-color: var(--steam-card-bg); padding: 8px 14px; border-radius: 12px; border-top-left-radius: 2px;
            font-size: 0.95rem; word-wrap: break-word; word-break: break-word; overflow-wrap: break-word; white-space: pre-wrap; max-width: 100%;
        }
        .chat-meta { font-size: 0.75rem; color: var(--steam-accent); margin-bottom: 2px; font-weight: bold; }
        .btn-hide-chat { position: absolute; top: -40px; right: 0; color: #8a9ea7; font-size: 0.9rem; background: transparent; border: none; }
        .chat-collapsed-bar {
            display: none; width: 100%; height: 60px; background-color: rgba(255, 255, 255, 0.08);
            border-radius: 12px; justify-content: center; align-items: center; cursor: pointer; transition: background 0.2s; user-select: none;
        }
        .chat-collapsed-text { font-weight: bold; color: white; font-size: 1rem; }

        /* --- Sidebar & Posts --- */
        .category-link {
            display: flex; justify-content: space-between; align-items: center; padding: 12px 20px;
            color: #8a9ea7; font-weight: 500; transition: 0.2s; border-radius: 50px; margin-bottom: 5px; cursor: pointer;
        }
        .category-link:hover, .category-link.active { background-color: var(--steam-card-bg); color: var(--steam-accent); }
        .badge-count { background-color: #e6ebf0; color: #171a21; font-weight: 700; border-radius: 50px; padding: 5px 10px; min-width: 30px; text-align: center;}

        .post-card-box {
            background-color: var(--steam-card-bg); height: 160px; padding: 20px; cursor: pointer;
            transition: transform 0.2s, background-color 0.2s; border: 1px solid rgba(0,0,0,0.1); overflow: hidden; position: relative;
        }
        .post-card-box:hover { transform: translateY(-3px); background-color: var(--steam-card-hover); box-shadow: 0 10px 20px rgba(0,0,0,0.3); }
        .post-body-truncated {
            display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; color: #a0b5c4;
        }

        /* --- Modals --- */
        .modal-content { background-color: var(--steam-bg-main); border: 1px solid var(--steam-accent); }
        .modal-header, .modal-footer { border-color: rgba(255,255,255,0.1); }
        .reply-box { border-left: 3px solid #2a475e; padding-left: 15px; }
        
        .tag-highlight {
            color: var(--steam-accent);
            font-weight: 700;
            background-color: rgba(102, 192, 244, 0.1);
            padding: 0 4px;
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .chat-container { margin-bottom: 2rem; }
            .btn-hide-chat { top: -30px; font-size: 0.8rem; }
            .col-md-3.mb-4 { margin-bottom: 1rem !important; }
            .profile-avatar-lg { width: 80px; height: 80px; }
        }

    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-steam-secondary py-3 mb-4 shadow">
        <div class="container">
            <a class="navbar-brand text-uppercase fw-bold text-accent" href="#"><i class="fa-brands fa-steam me-2"></i>SteamConnect</a>
        </div>
    </nav>

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
                        <div class="chat-message">
                            <img src="https://i.pravatar.cc/40?img=1" class="chat-avatar" alt="user">
                            <div class="chat-content-wrapper">
                                <div class="chat-meta">System</div>
                                <div class="chat-bubble">Welcome to global chat!</div>
                            </div>
                        </div>
                        <div class="chat-message">
                            <img src="https://i.pravatar.cc/40?img=12" class="chat-avatar" alt="user">
                            <div class="chat-content-wrapper">
                                <div class="chat-meta text-accent">GamerOne</div>
                                <div class="chat-bubble">Anyone up for a match?</div>
                            </div>
                        </div>
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
                        <div class="position-relative d-inline-block mb-3">
                            <img src="https://i.pravatar.cc/150?img=70" class="profile-avatar-lg shadow">
                            <div class="position-absolute bottom-0 end-0 bg-success border border-dark rounded-circle p-2" style="width: 20px; height: 20px;"></div>
                        </div>
                        <h2 class="text-white fw-bold mb-1">You</h2>
                        <p class="text-accent mb-3">@CodeMaster_99</p>
                        
                        <div class="d-flex justify-content-center gap-3 mb-4">
                            <div class="text-center">
                                <h5 class="text-white fw-bold mb-0">12</h5>
                                <small class="text-secondary">Level</small>
                            </div>
                            <div class="text-center">
                                <h5 class="text-white fw-bold mb-0">4</h5>
                                <small class="text-secondary">Badges</small>
                            </div>
                            <div class="text-center">
                                <h5 class="text-white fw-bold mb-0">142</h5>
                                <small class="text-secondary">Games</small>
                            </div>
                        </div>

                        <div class="text-start bg-steam-secondary p-3 rounded mb-3">
                            <h6 class="text-uppercase text-secondary small fw-bold mb-2">About Me</h6>
                            <p class="small text-light mb-0">Full stack developer and FPS enthusiast. Always looking for new teammates for CS2 and Apex Legends. Building cool web things.</p>
                        </div>
                        
                        <button class="btn btn-steam-outline w-100 py-2">Edit Profile</button>
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
                        <img src="https://i.pravatar.cc/40?img=3" class="rounded-circle me-3" border="2px solid var(--steam-accent)">
                        <h5 class="modal-title text-white mb-0" id="modal-title">Post Title</h5>
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
        // --- DATA STORE ---
        const now = Date.now();
        
        let postsData = [
            {
                id: 102,
                realTimestamp: now - (45 * 60 * 1000),
                title: "Best settings for low-end PCs?",
                content: "I'm trying to run recent AAA titles on a GTX 1050ti. Any tweaks?",
                category: "help",
                author: "LaggyGamer_23",
                likes: 56, dislikes: 2, userAction: null,
                replies: [ { user: "TechHelper", text: "Try FSR mods.", likes: 5, userLiked: false, timestamp: now - (40 * 60 * 1000) } ]
            },
            {
                id: 103,
                realTimestamp: now - (60 * 60 * 1000),
                title: "Hidden gems in the Summer Sale",
                content: "Forget the big titles, what are some indie gems?",
                category: "general",
                author: "IndieHunter",
                likes: 89, dislikes: 1, userAction: null,
                replies: []
            },
            {
                id: 101,
                realTimestamp: now - (120 * 60 * 1000),
                title: "Community Guidelines Update",
                content: "Hello everyone. We have updated our community guidelines...",
                category: "feedback",
                author: "Valve_Admin",
                likes: 424, dislikes: 12, userAction: 'like',
                // IMPORTANT: Pre-loaded action timestamp so it doesn't break sort
                actionTimestamp: now - (115 * 60 * 1000),
                replies: []
            },
            {
                id: 104,
                realTimestamp: now - (24 * 60 * 60 * 1000),
                title: "My Awesome Guide to CS2 Smokes",
                content: "Here is a compilation of the best smokes for Mirage A site...",
                category: "guide",
                author: "You",
                likes: 12, dislikes: 0, userAction: null,
                replies: []
            }
        ];

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
                if(post.author === 'You') {
                    activities.push({ type: 'post', time: post.realTimestamp, data: post });
                }
                
                // 2. Likes & Dislikes (Check Generic userAction)
                if(post.userAction) {
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
                    if(rep.user === 'You') {
                        activities.push({ type: 'reply', time: rep.timestamp, data: { postTitle: post.title, text: rep.text } });
                    }
                });
            });

            // Strict Numeric Sort: Descending (Newest first)
            activities.sort((a,b) => b.time - a.time);

            let html = '';
            if(activities.length === 0) {
                html = '<p class="text-secondary text-center">No recent activity.</p>';
            } else {
                activities.forEach(act => {
                    const timeStr = timeAgo(act.time);
                    
                    if(act.type === 'post') {
                        html += `
                        <div class="activity-item">
                            <small class="text-secondary mb-1 d-block">${timeStr}</small>
                            <span class="text-white">You created a post: </span>
                            <a class="text-accent fw-bold text-decoration-none" onclick="switchToPost(${act.data.id})">${act.data.title}</a>
                            <div class="mt-2 p-2 bg-dark rounded border border-secondary text-secondary small fst-italic">"${act.data.content.substring(0,60)}..."</div>
                        </div>`;
                    } 
                    else if(act.type === 'reaction') {
                        // Determine text based on action type (like/dislike)
                        const actionText = act.actionType === 'like' ? 'liked' : 'disliked';
                        const colorClass = act.actionType === 'like' ? 'text-accent' : 'text-danger'; // Blue for like, Red for dislike
                        
                        html += `
                        <div class="activity-item">
                            <small class="text-secondary mb-1 d-block">${timeStr}</small>
                            <span class="text-white">You ${actionText} a post: </span>
                            <span class="${colorClass} fw-bold">${act.data.title}</span>
                        </div>`;
                    } 
                    else if(act.type === 'reply') {
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
                if(post.category === 'general') badgeClass = 'bg-info text-dark';
                if(post.category === 'feedback') badgeClass = 'bg-danger';
                if(post.category === 'help') badgeClass = 'bg-warning text-dark';
                if(post.category === 'guide') badgeClass = 'bg-success';

                const colClass = (index === 0) ? 'col-12' : 'col-md-6 col-12';
                const displayTime = timeAgo(post.realTimestamp);

                const cardHTML = `
                    <div class="${colClass}">
                        <div class="post-card-box rounded-steam" onclick="openPostView(${post.id})">
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge ${badgeClass} me-2">#${post.category}</span>
                                <small class="text-secondary">${displayTime}</small>
                                <small class="text-secondary ms-2"><i class="fa-solid fa-comment me-1"></i>${post.replies.length}</small>
                                ${post.author === 'You' ? '<span class="badge bg-secondary ms-auto">Me</span>' : ''}
                            </div>
                            <h5 class="text-white mb-2">${post.title}</h5>
                            <p class="post-body-truncated mb-0 small">${post.content}</p>
                        </div>
                    </div>
                `;
                postsContainer.innerHTML += cardHTML;
            });

            if(filteredPosts.length === 0) {
                postsContainer.innerHTML = '<div class="col-12 text-center text-secondary py-5">No posts found.</div>';
            }
            updateSidebarCounts();
        }

        function filterPosts(category) {
            currentFilter = category;
            document.querySelectorAll('.category-link').forEach(link => link.classList.remove('active'));
            if(category !== 'mine' && category !== 'all') document.getElementById(`cat-${category}`).classList.add('active');
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
            const title = document.getElementById('new-post-title').value;
            const cat = document.getElementById('new-post-category').value;
            const content = document.getElementById('new-post-content').value;
            if(!title || !content) return alert("Please fill in all fields");
            const newPost = {
                id: Date.now(), realTimestamp: Date.now(),
                title: title, content: content, category: cat,
                author: "You", likes: 0, dislikes: 0, userAction: null, replies: []
            };
            postsData.unshift(newPost);
            document.getElementById('new-post-title').value = '';
            document.getElementById('new-post-content').value = '';
            createModalObj.hide();
            filterPosts('all');
        }

        const fullPostModal = new bootstrap.Modal(document.getElementById('fullPostModal'));
        let currentPostId = null;

        function openPostView(id) {
            currentPostId = id;
            const post = postsData.find(p => p.id === id);
            if(!post) return;
            document.getElementById('modal-title').innerText = post.title;
            document.getElementById('modal-body-text').innerText = post.content;
            document.getElementById('modal-category').innerText = "#" + post.category;
            document.getElementById('modal-timestamp').innerText = timeAgo(post.realTimestamp);
            updatePostActionsUI(post);
            renderReplies(post.replies);
            fullPostModal.show();
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
            if (action === 'like') {
                if (post.userAction === 'like') { 
                    post.likes--; 
                    post.userAction = null; 
                    post.actionTimestamp = null; // Clear timestamp on undo
                } 
                else { 
                    if (post.userAction === 'dislike') { post.dislikes--; } 
                    post.likes++; 
                    post.userAction = 'like'; 
                    post.actionTimestamp = Date.now(); // NEW: Capture time of click
                }
            } else { 
                if (post.userAction === 'dislike') { 
                    post.dislikes--; 
                    post.userAction = null; 
                    post.actionTimestamp = null; // Clear timestamp on undo
                } 
                else { 
                    if (post.userAction === 'like') { post.likes--; } 
                    post.dislikes++; 
                    post.userAction = 'dislike'; 
                    post.actionTimestamp = Date.now(); // NEW: Capture time of click
                }
            }
            updatePostActionsUI(post);
        }

        function renderReplies(replies) {
            const container = document.getElementById('modal-replies-container');
            container.innerHTML = '';
            if(replies.length === 0) {
                container.innerHTML = '<p class="text-secondary small fst-italic">No replies yet. Be the first!</p>';
                return;
            }
            replies.forEach((rep, index) => {
                const formattedText = formatReplyText(rep.text);
                const likeActive = rep.userLiked ? 'active' : '';
                const likeCount = rep.likes || 0;
                container.innerHTML += `
                    <div class="reply-box mt-3">
                        <div class="d-flex justify-content-between">
                            <strong><span class="text-accent">${rep.user}</span></strong>
                            <small class="text-secondary">Just now</small>
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
            if (reply.userLiked) { reply.likes--; reply.userLiked = false; } 
            else { reply.likes = (reply.likes || 0) + 1; reply.userLiked = true; }
            renderReplies(post.replies);
        }

        const replyInput = document.getElementById('reply-input');
        const replyBtn = document.getElementById('reply-btn');
        function replyToUser(username) { replyInput.value = `@${username} ` + replyInput.value; replyInput.focus(); }

        replyBtn.addEventListener('click', () => {
            const text = replyInput.value.trim();
            if(!text || !currentPostId) return;
            const post = postsData.find(p => p.id === currentPostId);
            post.replies.push({ user: "You", text: text, likes: 0, userLiked: false, timestamp: Date.now() });
            renderReplies(post.replies);
            replyInput.value = '';
            renderPosts(); 
        });

        function toggleChat() {
            const ui = document.getElementById('chat-interface-wrapper');
            const bar = document.getElementById('chat-collapsed-bar');
            if(ui.style.display==='none'){ ui.style.display='block'; bar.style.display='none'; } 
            else { ui.style.display='none'; bar.style.display='flex'; }
        }

        const chatInput = document.getElementById('chat-input');
        const sendBtn = document.getElementById('send-btn');
        const chatBox = document.getElementById('chat-box');
        function sendMessage() {
            const text = chatInput.value.trim();
            if(!text) return;
            const div = document.createElement('div');
            div.className = 'chat-message';
            div.innerHTML = `<img src="https://i.pravatar.cc/40?img=70" class="chat-avatar"><div class="chat-content-wrapper"><div class="chat-meta text-accent">You</div><div class="chat-bubble">${text}</div></div>`;
            chatBox.appendChild(div);
            chatInput.value = '';
            chatBox.scrollTop = chatBox.scrollHeight;
        }
        sendBtn.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', (e) => { if(e.key==='Enter') sendMessage(); });

        renderPosts();
    </script>
</body>
</html>