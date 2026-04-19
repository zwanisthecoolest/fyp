<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonkeyPace - Mini Games</title>
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

        /* Header */
        header {
            background: linear-gradient(140deg, #b2e7cd  0%, #99d9ba 47%, #eafaf3 100%);
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
            color: #333;
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
            background-color: rgba(51, 51, 51, 0.1);
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
            border: 2px solid #333;
            background-color: transparent;
            color: #333;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .nav-buttons button:hover {
            background-color: #333;
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
            background-color: #333;
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

        /* Main Content */
        main {
            flex: 1;
            max-width: 1500px;
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

        .games-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 32px;
            margin-bottom: 50px;
        }

        .game-card {
            background: linear-gradient(160deg, rgba(242, 255, 250, 0.9) 0%, rgba(228, 248, 239, 0.85) 100%);
            border: 2px solid rgba(55, 130, 124, 0.3);
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 12px 28px rgba(12, 70, 79, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(2px);
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
            display: flex;
            flex-direction: column;
            min-height: 420px;
        }

        .game-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 36px rgba(12, 70, 79, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.6);
            border-color: rgba(55, 130, 124, 0.5);
        }

        .game-title {
            font-size: 26px;
            font-weight: 700;
            color: #173a3e;
            margin-bottom: 12px;
        }

        .game-purpose {
            font-size: 16px;
            color: #3a6259;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .game-preview {
            width: 100%;
            aspect-ratio: 16 / 9;
            border-radius: 12px;
            object-fit: contain;
            object-position: center;
            background: linear-gradient(160deg, #f4fcf8 0%, #eaf7f1 100%);
            padding: 8px;
            border: 1px solid #cfe9dc;
            box-shadow: 0 8px 16px rgba(15, 67, 62, 0.14);
            margin-bottom: 18px;
        }

        .difficulties-section {
            margin-bottom: 22px;
        }

        .difficulties-label {
            font-size: 13px;
            font-weight: 700;
            color: #2a5851;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .difficulty-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .difficulty-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            background: #e8f4f1;
            color: #1f5350;
            border: 1px solid #cfe9dc;
        }

        .difficulty-badge.extreme {
            background: #ffe8e8;
            color: #7f1d1d;
            border-color: #f5c4c4;
        }

        .difficulty-badge.hard {
            background: #ffe8cc;
            color: #7a3d00;
            border-color: #f0d4a8;
        }

        .difficulty-badge.normal {
            background: #f0e8ff;
            color: #4a2e7f;
            border-color: #dccef5;
        }

        .play-button {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #4ecdc4;
            background: linear-gradient(135deg, #4ecdc4 0%, #45b8b0 100%);
            color: white;
            font-size: 16px;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: auto;
        }

        .play-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(78, 205, 196, 0.3);
            border-color: #3ab3a6;
        }

        .play-button:active {
            transform: translateY(0);
        }

        /* Responsive Design */
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

            .games-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .game-card {
                padding: 18px;
                min-height: auto;
            }

            .game-preview {
                border-radius: 10px;
                padding: 6px;
                margin-bottom: 14px;
            }

            .page-header h1 {
                font-size: 28px;
            }

            .page-header p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
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
            </div>            <button type="button" id="sideMenuUserProfile" class="side-menu-user-profile" onclick="handleMenuAction('Profile')" aria-label="View profile">
                <div class="side-menu-user-name" id="sideMenuUserName"></div>
                <div class="side-menu-user-avatar" id="sideMenuUserAvatar"></div>
            </button>            <nav class="side-menu-nav">
                <button type="button" class="side-menu-link" onclick="handleMenuAction('Mini - Games')">Mini - Games</button>
                <button type="button" class="side-menu-link" onclick="handleMenuAction('Track Your Progress')">Track Your Progress</button>
                <button type="button" class="side-menu-link" onclick="handleMenuAction('Leaderboard')">Leaderboard</button>
                <button type="button" class="side-menu-link" onclick="handleMenuAction('Guides')">Guides</button>
                <button type="button" class="side-menu-link" onclick="handleMenuAction('Reviews')">Reviews</button>
            </nav>
            <button type="button" class="side-menu-logout" onclick="handleLogout()">Log Out</button>
        </aside>
    </div>

    <main>
        <div class="page-header">
            <h1>Mini Games</h1>
            <p>Choose a game and test your skills. Available in multiple difficulty levels.</p>
        </div>

        <div class="games-grid">
            <!-- ShapeMatch Hue -->
            <div class="game-card">
                <div class="game-title">ShapeMatch Hue</div>
                <div class="game-purpose">
                    Test your color and shape matching accuracy. Quickly identify and match shapes with corresponding colors in increasingly complex patterns.
                </div>
                <img class="game-preview" src="{{ asset('images/games/shape-hue-cover.png') }}" alt="ShapeMatch Hue tutorial preview">
                <div class="difficulties-section">
                    <div class="difficulties-label">Difficulties</div>
                    <div class="difficulty-badges">
                        <span class="difficulty-badge normal">Easy</span>
                        <span class="difficulty-badge normal">Normal</span>
                        <span class="difficulty-badge hard">Hard</span>
                    </div>
                </div>
                <button class="play-button" onclick="navigateToLeaderboard('shape-match-hue')">View Leaderboard</button>
            </div>

            <!-- Rapid Tiles -->
            <div class="game-card">
                <div class="game-title">Rapid Tiles</div>
                <div class="game-purpose">
                    Challenge your tap-speed and precision. Tap tiles as fast as you can while maintaining accuracy and building combos.
                </div>
                <img class="game-preview" src="{{ asset('images/games/rapid-tile-cover.png') }}" alt="Rapid Tiles tutorial preview">
                <div class="difficulties-section">
                    <div class="difficulties-label">Difficulties</div>
                    <div class="difficulty-badges">
                        <span class="difficulty-badge normal">Easy</span>
                        <span class="difficulty-badge normal">Normal</span>
                        <span class="difficulty-badge hard">Hard</span>
                    </div>
                </div>
                <button class="play-button" onclick="navigateToLeaderboard('rapid-tiles')">View Leaderboard</button>
            </div>

            <!-- MonkeyBall -->
            <div class="game-card">
                <div class="game-title">MonkeyBall</div>
                <div class="game-purpose">
                    Navigate through obstacles and develop hand-eye coordination. Hit the baseballs with your bat depending on the color.
                </div>
                <img class="game-preview" src="{{ asset('images/games/monkeyball-cover.png') }}" alt="MonkeyBall tutorial preview">
                <div class="difficulties-section">
                    <div class="difficulties-label">Difficulties</div>
                    <div class="difficulty-badges">
                        <span class="difficulty-badge normal">Easy</span>
                        <span class="difficulty-badge normal">Normal</span>
                        <span class="difficulty-badge hard">Hard</span>
                        <span class="difficulty-badge extreme">Extreme</span>
                    </div>
                </div>
                <button class="play-button" onclick="navigateToLeaderboard('monkey-ball')">View Leaderboard</button>
            </div>

            <!-- Math Quest -->
            <div class="game-card">
                <div class="game-title">Math Quest</div>
                <div class="game-purpose">
                    Boost your mental arithmetic and problem-solving speed. Solve math challenges against the clock and climb the difficulty ladder.
                </div>
                <img class="game-preview" src="{{ asset('images/games/math-quest-cover.png') }}" alt="Math Quest tutorial preview">
                <div class="difficulties-section">
                    <div class="difficulties-label">Difficulties</div>
                    <div class="difficulty-badges">
                        <span class="difficulty-badge normal">Easy</span>
                        <span class="difficulty-badge normal">Normal</span>
                        <span class="difficulty-badge hard">Hard</span>
                    </div>
                </div>
                <button class="play-button" onclick="navigateToLeaderboard('math-quest')">View Leaderboard</button>
            </div>
        </div>
    </main>

    <script>
        const currentUserRaw = localStorage.getItem('quickstrike_current_user');
        const currentUser = currentUserRaw && currentUserRaw !== 'null' ? JSON.parse(currentUserRaw) : null;
        const loginPageUrl = {{ Js::from(route('login.page')) }};
        const trackProgressPageUrl = {{ Js::from(route('track.progress')) }};
        const miniGamesPageUrl = {{ Js::from(route('mini-games')) }};
        const leaderboardPageUrl = {{ Js::from(route('leaderboard')) }};
        const guidesPageUrl = {{ Js::from(route('guides')) }};
        const reviewsPageUrl = {{ Js::from(route('reviews')) }};
        const profilePageUrl = {{ Js::from(route('profile')) }};

        function navigateToLeaderboard(gameKey) {
            window.location.href = leaderboardPageUrl + '?game=' + encodeURIComponent(gameKey);
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
            initializeHeader();
            window.location.reload();
        }

        // Display username if logged in
        function initializeHeader() {
            const usernameDisplay = document.getElementById('usernameDisplay');
            const loginButton = document.getElementById('loginButton');
            const sideMenuUserProfile = document.getElementById('sideMenuUserProfile');
            const sideMenuUserName = document.getElementById('sideMenuUserName');
            const sideMenuUserAvatar = document.getElementById('sideMenuUserAvatar');
            const currentUserRaw = localStorage.getItem('quickstrike_current_user');
            const profilePictureRaw = localStorage.getItem('quickstrike_profile_picture');
            const hasCurrentUser = currentUserRaw && currentUserRaw !== 'null';

            if (hasCurrentUser) {
                loginButton.style.display = 'none';
                try {
                    const user = JSON.parse(currentUserRaw);
                    const userName = user.name || user.username || 'User';
                    usernameDisplay.textContent = userName;
                    usernameDisplay.style.display = 'block';
                    
                    // Update side menu user profile
                    sideMenuUserName.textContent = userName;
                    sideMenuUserProfile.style.display = 'flex';
                    
                    // Update avatar
                    if (profilePictureRaw && profilePictureRaw !== 'null') {
                        sideMenuUserAvatar.innerHTML = '<img src="' + profilePictureRaw + '" alt="Profile picture">';
                    } else {
                        const initials = userName.charAt(0).toUpperCase();
                        sideMenuUserAvatar.textContent = initials;
                    }
                } catch (error) {
                    usernameDisplay.style.display = 'none';
                    sideMenuUserProfile.style.display = 'none';
                }
            } else {
                loginButton.style.display = '';
                usernameDisplay.style.display = 'none';
                sideMenuUserProfile.style.display = 'none';
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeSideMenu();
            }
        });

        document.addEventListener('DOMContentLoaded', initializeHeader);
    </script>
</body>
</html>
