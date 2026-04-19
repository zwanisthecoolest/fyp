<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonkeyPace - Game Reviews</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #1f3330;
            background:
                radial-gradient(circle at 12% 14%, rgba(255, 255, 255, 0.42), rgba(255, 255, 255, 0) 40%),
                radial-gradient(circle at 88% 8%, rgba(106, 196, 175, 0.32), rgba(106, 196, 175, 0) 36%),
                linear-gradient(140deg, #52cec5 0%, #9adabd 42%, #ecfbf4 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: linear-gradient(140deg, #b2e7cd 0%, #99d9ba 47%, #eafaf3 100%);
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 -6px 16px rgba(0, 0, 0, 0.08), 0 10px 24px rgba(0, 0, 0, 0.12);
            width: 100%;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: bold;
            color: #153a3e;
            text-decoration: none;
        }

        .logo-img {
            width: 46px;
            height: 46px;
            object-fit: contain;
            border-radius: 50%;
        }

        #usernameDisplay {
            font-weight: 700;
            color: #153a3e;
            font-size: 18px;
            margin-right: 16px;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 6px;
            border: none;
            background: transparent;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        #usernameDisplay:hover {
            background-color: rgba(21, 58, 62, 0.1);
            transform: translateY(-1px);
        }

        .side-menu-user-profile {
            background: linear-gradient(135deg, #4ecdc4 0%, #99d9ba 100%);
            border-radius: 12px;
            padding: 14px;
            margin-bottom: 16px;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            border: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .side-menu-user-profile:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(78, 205, 196, 0.3);
        }

        .side-menu-user-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            display: grid;
            place-items: center;
            color: white;
            font-weight: 800;
            font-size: 20px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            flex: 0 0 auto;
            overflow: hidden;
        }

        .side-menu-user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .side-menu-user-name {
            font-size: 18px;
            font-weight: 700;
            color: white;
            line-height: 1.2;
            word-break: break-word;
        }

        .nav-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .nav-buttons button {
            padding: 8px 18px;
            border: 2px solid #153a3e;
            background-color: transparent;
            color: #153a3e;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .nav-buttons button:hover {
            background-color: #153a3e;
            color: white;
        }

        .menu-icon {
            width: 24px;
            height: 16px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            cursor: pointer;
        }

        .menu-icon span {
            width: 100%;
            height: 2px;
            background-color: #153a3e;
            border-radius: 2px;
        }

        .side-menu-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(11, 31, 29, 0.35);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease;
            z-index: 1200;
        }

        .side-menu-backdrop.show {
            opacity: 1;
            pointer-events: auto;
        }

        .side-menu {
            position: absolute;
            top: 0;
            right: -320px;
            width: min(300px, 88vw);
            height: 100vh;
            background: linear-gradient(165deg, #eafaf3 0%, #dbeee5 100%);
            border-left: 1px solid #cfe9dc;
            box-shadow: -8px 0 24px rgba(0, 0, 0, 0.18);
            transition: right 0.25s ease;
            display: flex;
            flex-direction: column;
            padding: 18px 16px;
        }

        .side-menu-backdrop.show .side-menu {
            right: 0;
        }

        .side-menu-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }

        .side-menu-title {
            color: #153a3e;
            font-size: 20px;
            font-weight: 700;
        }

        .side-menu-close {
            border: 0;
            background: transparent;
            color: #153a3e;
            font-size: 28px;
            line-height: 1;
            cursor: pointer;
            padding: 0 4px;
        }

        .side-menu-nav {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .side-menu-link {
            width: 100%;
            text-align: left;
            border: 1px solid #cfe9dc;
            background: #ffffff;
            color: #1f3330;
            border-radius: 10px;
            padding: 11px 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease, color 0.2s ease, transform 0.2s ease;
        }

        .side-menu-link:hover {
            background: #c9ece1;
            color: #153a3e;
            transform: translateX(-2px);
        }

        .side-menu-logout {
            margin-top: auto;
            width: 100%;
            border: 1px solid #cfe9dc;
            background: #ffffff;
            color: #7f1d1d;
            border-radius: 10px;
            padding: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }

        .side-menu-logout:hover {
            background: #d62828;
            color: #ffffff;
            border-color: #d62828;
        }

        .access-popup-backdrop {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1100;
            background: rgba(21, 53, 50, 0.28);
            backdrop-filter: blur(2px);
            padding: 20px;
        }

        .access-popup-backdrop.show {
            display: flex;
            animation: popupBackdropIn 0.22s ease-out;
        }

        .access-popup-panel {
            position: relative;
            width: min(500px, 95vw);
            border-radius: 16px;
            background: linear-gradient(145deg, #eafaf3 0%, #d9f3e6 100%);
            border: 2px solid #99d9ba;
            box-shadow: 0 14px 28px rgba(17, 76, 86, 0.22);
            padding: 28px 26px 24px;
            color: #2c3e3b;
            animation: popupPanelIn 0.22s ease-out;
        }

        .access-popup-close {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 34px;
            height: 34px;
            border: 0;
            border-radius: 50%;
            background: #dbeee5;
            color: #2b4b45;
            font-size: 20px;
            line-height: 1;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .access-popup-close:hover {
            background: #bce6d9;
            transform: scale(1.06);
        }

        .access-popup-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 5px 11px;
            border-radius: 999px;
            background: #4ECDC4;
            color: #153a3e;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.02em;
        }

        .access-popup-title {
            margin: 14px 0 10px;
            font-size: clamp(24px, 4vw, 30px);
            line-height: 1.2;
            color: #1f3330;
        }

        .access-popup-text {
            margin: 0;
            font-size: clamp(15px, 2.8vw, 17px);
            line-height: 1.55;
            color: #395652;
        }

        .access-popup-actions {
            margin-top: 22px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .access-popup-primary,
        .access-popup-secondary {
            border: 0;
            border-radius: 10px;
            padding: 11px 18px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        }

        .access-popup-primary {
            background: #4ECDC4;
            color: #173a3d;
            box-shadow: 0 7px 14px rgba(37, 118, 113, 0.32);
        }

        .access-popup-primary:hover {
            transform: translateY(-1px);
            background: #3fbdb4;
            box-shadow: 0 9px 16px rgba(30, 98, 94, 0.38);
        }

        .access-popup-secondary {
            background: #cdebdc;
            color: #2c4a45;
        }

        .access-popup-secondary:hover {
            background: #bde4d1;
        }

        @keyframes popupBackdropIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes popupPanelIn {
            from {
                opacity: 0;
                transform: translateY(8px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        main {
            flex: 1;
            max-width: 1200px;
            width: 98%;
            margin: 40px auto;
            padding: 0;
        }

        .page-header {
            margin-bottom: 36px;
        }

        .page-header h1 {
            font-size: clamp(32px, 5.5vw, 52px);
            color: #153a3e;
            margin-bottom: 10px;
        }

        .page-header p {
            font-size: clamp(16px, 2.2vw, 22px);
            color: #2e5450;
        }

        .game-tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .game-tab {
            padding: 12px 20px;
            border: 2px solid #4ecdc4;
            background: #f0fffe;
            color: #173a3e;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .game-tab:hover {
            transform: translateY(-2px);
            background: #bce6d9;
            box-shadow: 0 8px 14px rgba(20, 85, 78, 0.15);
        }

        .game-tab.active {
            background: #4ecdc4;
            color: white;
            box-shadow: 0 10px 18px rgba(20, 93, 100, 0.24);
        }

        .content-shell {
            background: linear-gradient(160deg, rgba(242, 255, 250, 0.9) 0%, rgba(228, 248, 239, 0.85) 100%);
            border: 2px solid rgba(55, 130, 124, 0.3);
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 12px 28px rgba(12, 70, 79, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(2px);
        }

        .rating-summary {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(78, 205, 196, 0.2);
        }

        .stars {
            font-size: 28px;
            color: #ffc107;
            letter-spacing: 4px;
        }

        .rating-info h3 {
            font-size: 18px;
            color: #153a3e;
            margin-bottom: 4px;
        }

        .rating-info p {
            font-size: 14px;
            color: #5a7f7b;
        }

        .review-form {
            background: linear-gradient(160deg, #f7fdfa 0%, #eaf7f1 100%);
            border: 2px solid rgba(78, 205, 196, 0.3);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 30px;
        }

        .review-form h3 {
            font-size: 18px;
            color: #153a3e;
            margin-bottom: 16px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #355f59;
            margin-bottom: 8px;
        }

        .star-rating {
            display: flex;
            gap: 8px;
        }

        .star-btn {
            font-size: 32px;
            background: none;
            border: none;
            cursor: pointer;
            transition: transform 0.2s ease;
            color: #ddd;
        }

        .star-btn:hover,
        .star-btn.active {
            color: #ffc107;
            transform: scale(1.2);
        }

        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid rgba(78, 205, 196, 0.3);
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            color: #1f3330;
            resize: vertical;
            min-height: 100px;
        }

        textarea:focus {
            outline: none;
            border-color: #4ecdc4;
            box-shadow: 0 0 8px rgba(78, 205, 196, 0.2);
        }

        .form-buttons {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn {
            padding: 10px 24px;
            border: 2px solid #4ecdc4;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: #4ecdc4;
            color: white;
        }

        .btn-primary:hover {
            background: #45b8b0;
            box-shadow: 0 4px 12px rgba(78, 205, 196, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: #4ecdc4;
        }

        .btn-secondary:hover {
            background: rgba(78, 205, 196, 0.1);
        }

        .login-prompt {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
            color: #856404;
            text-align: center;
        }

        .login-prompt a {
            color: #004085;
            font-weight: 600;
            text-decoration: none;
        }

        .reviews-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .review-item {
            background: white;
            border: 1px solid rgba(78, 205, 196, 0.2);
            border-radius: 8px;
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .review-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .review-player {
            font-weight: 700;
            color: #153a3e;
        }

        .review-rating {
            font-size: 14px;
            color: #ffc107;
            letter-spacing: 2px;
        }

        .review-date {
            font-size: 12px;
            color: #7a9a95;
        }

        .review-comment {
            font-size: 14px;
            color: #3f6760;
            line-height: 1.5;
            margin-top: 8px;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #7a9a95;
        }

        @media (max-width: 768px) {
            header {
                padding: 15px 20px;
                gap: 10px;
            }

            .logo {
                font-size: 20px;
                gap: 8px;
            }

            .logo-img {
                width: 40px;
                height: 40px;
            }

            main {
                width: 100%;
                margin: 20px auto;
                padding: 0 16px;
            }

            .content-shell {
                padding: 16px;
            }

            .review-form {
                padding: 16px;
            }

            .rating-summary {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <header>
        <a class="logo" href="{{ route('home') }}" aria-label="Go to homepage">
            <img src="{{ asset('logo.png') }}?v={{ @filemtime(public_path('logo.png')) }}" alt="MonkeyPace Logo" class="logo-img">
            <span>MonkeyPace</span>
        </a>
        <nav class="nav-buttons">
            <button id="loginButton" onclick="handleLogin()">Log In</button>
            <button id="usernameDisplay" type="button" style="display: none;" onclick="handleMenuAction('Profile')" aria-label="View profile"></button>
            <div class="menu-icon" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>

    <div id="sideMenuBackdrop" class="side-menu-backdrop" aria-hidden="true" onclick="closeSideMenu()">
        <aside class="side-menu" role="dialog" aria-modal="true" aria-label="Side menu" onclick="event.stopPropagation()">
            <div class="side-menu-head">
                <span class="side-menu-title">Menu</span>
                <button type="button" class="side-menu-close" onclick="closeSideMenu()" aria-label="Close menu">&times;</button>
            </div>
            <button type="button" id="sideMenuUserProfile" class="side-menu-user-profile" onclick="handleMenuAction('Profile')" aria-label="View profile">
                <div class="side-menu-user-name" id="sideMenuUserName"></div>
                <div class="side-menu-user-avatar" id="sideMenuUserAvatar"></div>
            </button>
            <nav class="side-menu-nav">
                <button type="button" class="side-menu-link" onclick="handleMenuAction('Mini - Games')">Mini - Games</button>
                <button type="button" class="side-menu-link" onclick="handleMenuAction('Track Your Progress')">Track Your Progress</button>
                <button type="button" class="side-menu-link" onclick="handleMenuAction('Leaderboard')">Leaderboard</button>
                <button type="button" class="side-menu-link" onclick="handleMenuAction('Guides')">Guides</button>
                <button type="button" class="side-menu-link" onclick="handleMenuAction('Reviews')">Reviews</button>
            </nav>
            <button type="button" class="side-menu-logout" onclick="handleLogout()">Log Out</button>
        </aside>
    </div>

    <div id="accessPopup" class="access-popup-backdrop" aria-hidden="true">
        <div class="access-popup-panel" role="dialog" aria-modal="true" aria-labelledby="accessPopupTitle">
            <button type="button" class="access-popup-close" onclick="hideTrackAccessPopup()" aria-label="Close popup">&times;</button>
            <span class="access-popup-badge">Members only</span>
            <h2 id="accessPopupTitle" class="access-popup-title">You need to log in first</h2>
            <p class="access-popup-text">Want to track your progress? Please sign in and we will unlock your stats and game history.</p>
            <div class="access-popup-actions">
                <button type="button" class="access-popup-primary" onclick="handleLogin()">Log In Now</button>
                <button type="button" class="access-popup-secondary" onclick="hideTrackAccessPopup()">Not Now</button>
            </div>
        </div>
    </div>

    <main>
        <div class="page-header">
            <h1>Game Reviews</h1>
            <p>Share your feedback and read what other players think about our games.</p>
        </div>

        <div class="game-tabs" id="gameTabs"></div>

        <div class="content-shell">
            <!-- Rating Summary -->
            <div class="rating-summary" id="ratingSummary">
                <div class="stars" id="ratingStars">★★★★★</div>
                <div class="rating-info">
                    <h3 id="avgRatingText">4.5 out of 5</h3>
                    <p id="reviewCountText">Based on 128 reviews</p>
                </div>
            </div>

            <!-- Review Form -->
            <div class="review-form" id="reviewForm" style="display: none;">
                <h3>Share Your Review</h3>
                <div class="login-prompt" id="loginPrompt" style="display: none;">
                    <p>You need to <a href="{{ route('login.page') }}">log in</a> to write a review.</p>
                </div>
                <form id="reviewFormElement" style="display: none;">
                    <div class="form-group">
                        <label>Your Rating</label>
                        <div class="star-rating" id="starRating"></div>
                    </div>
                    <div class="form-group">
                        <label>Your Comment (optional)</label>
                        <textarea id="commentInput" placeholder="Share your thoughts about this game..."></textarea>
                    </div>
                    <div class="form-buttons">
                        <button type="button" class="btn btn-secondary" onclick="resetForm()">Cancel</button>
                        <button type="submit" class="btn btn-primary">Post Review</button>
                    </div>
                </form>
            </div>

            <!-- Reviews List -->
            <div class="reviews-list" id="reviewsList"></div>
        </div>
    </main>

    <script>
        const loginPageUrl = {{ Js::from(route('login.page')) }};
        const trackProgressPageUrl = {{ Js::from(route('track.progress')) }};
        const miniGamesPageUrl = {{ Js::from(route('mini-games')) }};
        const leaderboardPageUrl = {{ Js::from(route('leaderboard')) }};
        const guidesPageUrl = {{ Js::from(route('guides')) }};
        const reviewsPageUrl = {{ Js::from(route('reviews')) }};
        const profilePageUrl = {{ Js::from(route('profile')) }};
        const reviewsApiUrl = {{ Js::from(route('api.reviews.index', ['gameName' => 'GAME'])) }}.replace('GAME', '');
        const storeReviewApiUrl = {{ Js::from(route('api.reviews.store')) }};
        const gameOrder = ['shape-match-hue', 'rapid-tiles', 'monkey-ball', 'math-quest'];
        let currentGame = 'shape-match-hue';
        let selectedRating = 0;
        let currentUser = null;

        function initializeUser() {
            const currentUserRaw = localStorage.getItem('quickstrike_current_user');
            currentUser = currentUserRaw && currentUserRaw !== 'null' ? JSON.parse(currentUserRaw) : null;
            updateAuthButtonsVisibility();
        }

        function toTitleCase(text) {
            return String(text || '')
                .split('-')
                .map((part) => part.charAt(0).toUpperCase() + part.slice(1))
                .join(' ');
        }

        function renderGameTabs() {
            const tabsRoot = document.getElementById('gameTabs');
            tabsRoot.innerHTML = gameOrder.map((game) => {
                const isActive = game === currentGame;
                return '<button type="button" class="game-tab' + (isActive ? ' active' : '') + '" onclick="switchGame(\'' + game + '\')">' + toTitleCase(game) + '</button>';
            }).join('');
        }

        function switchGame(gameName) {
            currentGame = gameName;
            selectedRating = 0;
            resetForm();
            renderGameTabs();
            loadReviews();
        }

        function renderStarRating() {
            const container = document.getElementById('starRating');
            container.innerHTML = '';
            for (let i = 1; i <= 5; i++) {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'star-btn' + (i <= selectedRating ? ' active' : '');
                btn.textContent = '★';
                btn.onclick = (e) => {
                    e.preventDefault();
                    selectedRating = i;
                    renderStarRating();
                };
                container.appendChild(btn);
            }
        }

        function resetForm() {
            selectedRating = 0;
            document.getElementById('commentInput').value = '';
            renderStarRating();
        }

        async function loadReviews() {
            try {
                const response = await fetch(reviewsApiUrl + currentGame);
                const data = await response.json();

                // Update rating summary
                const avgRating = data.avg_rating || 0;
                const totalReviews = data.total_reviews || 0;
                const fullStars = Math.round(avgRating);
                
                document.getElementById('ratingStars').textContent = '★'.repeat(fullStars) + '☆'.repeat(5 - fullStars);
                document.getElementById('avgRatingText').textContent = avgRating > 0 ? avgRating.toFixed(1) + ' out of 5' : 'No ratings yet';
                document.getElementById('reviewCountText').textContent = 'Based on ' + totalReviews + ' review' + (totalReviews !== 1 ? 's' : '');

                // Update form visibility
                const formContainer = document.getElementById('reviewForm');
                if (currentUser) {
                    formContainer.style.display = 'block';
                    document.getElementById('loginPrompt').style.display = 'none';
                    document.getElementById('reviewFormElement').style.display = 'block';
                } else {
                    formContainer.style.display = 'block';
                    document.getElementById('loginPrompt').style.display = 'block';
                    document.getElementById('reviewFormElement').style.display = 'none';
                }

                // Render reviews
                const reviewsList = document.getElementById('reviewsList');
                if (data.reviews.length === 0) {
                    reviewsList.innerHTML = '<div class="empty-state">No reviews yet. Be the first to review this game!</div>';
                    return;
                }

                reviewsList.innerHTML = data.reviews.map((review) => {
                    const date = new Date(review.created_at).toLocaleDateString();
                    const stars = '★'.repeat(review.rating) + '☆'.repeat(5 - review.rating);
                    return '<div class="review-item">' +
                        '<div>' +
                            '<div class="review-header">' +
                                '<span class="review-player">' + (review.player_name || 'Anonymous') + '</span>' +
                                '<span class="review-rating">' + stars + '</span>' +
                            '</div>' +
                            '<div class="review-date">' + date + '</div>' +
                            (review.comment ? '<div class="review-comment">' + review.comment + '</div>' : '') +
                        '</div>' +
                    '</div>';
                }).join('');
            } catch (error) {
                console.error('Error loading reviews:', error);
                document.getElementById('reviewsList').innerHTML = '<div class="empty-state">Unable to load reviews.</div>';
            }
        }

        async function handleSubmitReview(e) {
            e.preventDefault();

            if (!currentUser) {
                window.location.href = loginPageUrl;
                return;
            }

            if (selectedRating === 0) {
                alert('Please select a rating');
                return;
            }

            const comment = document.getElementById('commentInput').value.trim();

            try {
                const response = await fetch(storeReviewApiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    },
                    body: JSON.stringify({
                        game_name: currentGame,
                        player_name: currentUser.username || currentUser.name || 'Player',
                        rating: selectedRating,
                        comment: comment || null,
                    }),
                });

                if (response.ok) {
                    resetForm();
                    loadReviews();
                    alert('Review posted successfully!');
                } else {
                    alert('Failed to post review');
                }
            } catch (error) {
                console.error('Error posting review:', error);
                alert('An error occurred while posting your review');
            }
        }

        function updateAuthButtonsVisibility() {
            const loginButton = document.getElementById('loginButton');
            const usernameDisplay = document.getElementById('usernameDisplay');
            const sideMenuUserProfile = document.getElementById('sideMenuUserProfile');
            const sideMenuUserName = document.getElementById('sideMenuUserName');
            const sideMenuUserAvatar = document.getElementById('sideMenuUserAvatar');

            if (currentUser) {
                loginButton.style.display = 'none';
                const userName = currentUser.username || currentUser.name || 'User';
                usernameDisplay.textContent = userName;
                usernameDisplay.style.display = 'block';
                
                // Update side menu user profile
                sideMenuUserName.textContent = userName;
                sideMenuUserProfile.style.display = 'flex';
                
                // Update avatar
                const profilePictureRaw = localStorage.getItem('quickstrike_profile_picture');
                if (profilePictureRaw && profilePictureRaw !== 'null') {
                    sideMenuUserAvatar.innerHTML = '<img src="' + profilePictureRaw + '" alt="Profile picture">';
                } else {
                    const initials = userName.charAt(0).toUpperCase();
                    sideMenuUserAvatar.textContent = initials;
                }
            } else {
                loginButton.style.display = '';
                usernameDisplay.style.display = 'none';
                sideMenuUserProfile.style.display = 'none';
            }
        }

        function handleLogin() {
            window.location.href = loginPageUrl;
        }

        function openSideMenu() {
            const sideMenu = document.getElementById('sideMenuBackdrop');
            sideMenu.classList.add('show');
            sideMenu.setAttribute('aria-hidden', 'false');
        }

        function closeSideMenu() {
            const sideMenu = document.getElementById('sideMenuBackdrop');
            sideMenu.classList.remove('show');
            sideMenu.setAttribute('aria-hidden', 'true');
        }

        function toggleMenu() {
            const sideMenu = document.getElementById('sideMenuBackdrop');
            if (sideMenu.classList.contains('show')) {
                closeSideMenu();
                return;
            }
            openSideMenu();
        }

        function handleMenuAction(title) {
            closeSideMenu();

            if (title === 'Mini - Games') {
                window.location.href = miniGamesPageUrl;
                return;
            }

            if (title === 'Track Your Progress') {
                const currentUserRaw = localStorage.getItem('quickstrike_current_user');
                const hasCurrentUser = currentUserRaw && currentUserRaw !== 'null';

                if (!hasCurrentUser) {
                    showTrackAccessPopup();
                    return;
                }

                window.location.href = trackProgressPageUrl;
                return;
            }

            if (title === 'Leaderboard') {
                window.location.href = leaderboardPageUrl;
                return;
            }

            if (title === 'Guides') {
                window.location.href = guidesPageUrl;
                return;
            }

            if (title === 'Reviews') {
                window.location.href = reviewsPageUrl;
                return;
            }

            if (title === 'Profile') {
                window.location.href = profilePageUrl;
                return;
            }

            alert('Opening ' + title + '...');
        }

        function handleLogout() {
            localStorage.removeItem('quickstrike_current_user');
            closeSideMenu();
            updateAuthButtonsVisibility();
            window.location.reload();
        }

        function showTrackAccessPopup() {
            const popup = document.getElementById('accessPopup');
            popup.classList.add('show');
            popup.setAttribute('aria-hidden', 'false');
            document.addEventListener('keydown', handleAccessPopupKeydown);
        }

        function hideTrackAccessPopup() {
            const popup = document.getElementById('accessPopup');
            popup.classList.remove('show');
            popup.setAttribute('aria-hidden', 'true');
            document.removeEventListener('keydown', handleAccessPopupKeydown);
        }

        function handleAccessPopupKeydown(event) {
            if (event.key === 'Escape') {
                hideTrackAccessPopup();
            }
        }

        document.getElementById('accessPopup').addEventListener('pointerdown', function(event) {
            if (event.target === this) {
                hideTrackAccessPopup();
            }
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            initializeUser();
            renderGameTabs();
            renderStarRating();
            loadReviews();
            
            const formElement = document.getElementById('reviewFormElement');
            if (formElement) {
                formElement.addEventListener('submit', handleSubmitReview);
            }

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeSideMenu();
                }
            });
        });
    </script>
</body>
</html>
