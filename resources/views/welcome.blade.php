<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonkeyPace - Reaction Time Training Game</title>
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
            background: linear-gradient(140deg, #4ecdc4 0%, #99d9ba 45%, #eafaf3 100%);
            min-height: 100vh;
            overflow-x: hidden;
            overflow-y: auto;
            display: grid;
            grid-template-rows: auto auto auto auto;
        }

        /* Header */
        header {
            background: linear-gradient(140deg, #b2e7cd  0%, #99d9ba 47%, #eafaf3 100%);;
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 -6px 16px rgba(0, 0, 0, 0.08), 0 10px 24px rgba(0, 0, 0, 0.12);
            position: sticky;
            top: 0;
            z-index: 1000;
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

        /* Purpose Section */
        .purpose-section {
            background-color: #dbeee5;
            padding: 16px 26px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            align-items: center;
            border: 1px solid #cfe9dc;
            box-shadow: 0 14px 32px rgba(0, 0, 0, 0.16);
        }

        .purpose-content h1 {
            font-size: clamp(28px, 3.3vw, 42px);
            margin-bottom: 8px;
            color: #153a3e;
        }

        .purpose-content p {
            font-size: clamp(13px, 1.1vw, 16px);
            margin-bottom: 8px;
            line-height: 1.45;
            color: #1f3330;
        }

        .cta-button {
            display: inline-block;
            background-color: #4ecdc4;
            color: #153a3e;
            padding: 10px 30px;
            border: none;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #99d9ba;
        }

        .arcade-cabinet {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            margin-left: 0;
        }

        .arcade-cabinet img {
            max-width: 100%;
            height: auto;
            max-height: min(32vh, 300px);
        }

        /* Features Grid */
        .features-section {
            padding: 16px 26px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.14);
        }

        .features-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
            height: 100%;
        }

        .feature-box {
            background-color: #dbeee5;
            padding: 16px 14px;
            min-height: 110px;
            border-radius: 15px;
            text-align: center;
            border: 1px solid #cfe9dc;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.14);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.2);
        }

        .feature-box h3 {
            font-size: clamp(18px, 2vw, 24px);
            margin-bottom: 4px;
            color: #153a3e;
        }

        .feature-box p {
            font-size: clamp(12px, 0.95vw, 14px);
            color: #1f3330;
        }

        .full-width-box {
            grid-column: 1 / -1;
            max-width: 50%;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }

        /* Reviews Section */
        .reviews-section {
            padding: 60px 40px;
        }

        .reviews-content {
            text-align: center;
        }

        /* Footer */
        footer {
            background-color: #dbeee5;
            padding: 12px 24px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            border: 1px solid #cfe9dc;
            box-shadow: 0 -8px 24px rgba(0, 0, 0, 0.14);
        }

        .footer-links {
            display: flex;
            gap: 30px;
        }

        .footer-links a {
            color: #153a3e;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #1f3330;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                height: auto;
                min-height: 100vh;
                overflow: auto;
                display: block;
            }

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

            .purpose-section {
                grid-template-columns: 1fr;
                padding: 40px 20px;
            }

            .purpose-content h1 {
                font-size: 36px;
            }

            .purpose-content p {
                font-size: 16px;
            }

            .features-grid {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 40px 20px;
            }

            .full-width-box {
                max-width: 100%;
            }

            footer {
                flex-direction: column;
                gap: 20px;
                text-align: center;
                padding: 20px;
            }

            .arcade-cabinet {
                font-size: 80px;
                margin-top: 20px;
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
            <button id="usernameDisplay" type="button" style="display: none; border: none; background: transparent;" onclick="handleMenuAction('Profile')" aria-label="View profile"></button>
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

    <!-- Purpose Section -->
    <section class="purpose-section">
        <div class="purpose-content">
            <h1>PURPOSE</h1>
            <p>This project focuses on a simple reaction-time training game using Raspberry Pi. The system measures how quickly users respond to visual cues and records their performance as well as display results and track improvement over multiple sessions.</p>
            <p>The project aims to support learning by enhancing attention, decision-making speed, and coordination.</p>
            <button class="cta-button" onclick="handleLogin()">Buy Our Product</button>
        </div>
        <div class="arcade-cabinet">
            <img src="{{ asset('arcade.png') }}" alt="">
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="features-grid">
            <div class="feature-box">
                <h3>Mini - Games</h3>
                <p>Diverse yourselves with challenges</p>
            </div>
            <div class="feature-box">
                <h3>Track Your Progress</h3>
                <p>Monitor Your Improvements</p>
            </div>
            <div class="feature-box">
                <h3>Leaderboard</h3>
                <p>Compete With Others</p>
            </div>
            <div class="feature-box">
                <h3>Guides</h3>
                <p>How to use our Product</p>
            </div>
            <div class="feature-box full-width-box">
                <h3>Reviews</h3>
                <p>Share Your Feedback</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-links">
            <a href="{{ route('contact') }}">Contact Us</a>
        </div>
    </footer>

    <script>
        const loginPageUrl = {{ Js::from(route('login.page')) }};
        const trackProgressPageUrl = {{ Js::from(route('track.progress')) }};
        const miniGamesPageUrl = {{ Js::from(route('mini-games')) }};
        const leaderboardPageUrl = {{ Js::from(route('leaderboard')) }};
        const guidesPageUrl = {{ Js::from(route('guides')) }};
        const reviewsPageUrl = {{ Js::from(route('reviews')) }};
        const profilePageUrl = {{ Js::from(route('profile')) }};
        const contactPageUrl = {{ Js::from(route('contact')) }};

        function updateAuthButtonsVisibility() {
            const loginButton = document.getElementById('loginButton');
            const usernameDisplay = document.getElementById('usernameDisplay');
            const sideMenuUserProfile = document.getElementById('sideMenuUserProfile');
            const sideMenuUserName = document.getElementById('sideMenuUserName');
            const sideMenuUserAvatar = document.getElementById('sideMenuUserAvatar');
            const currentUserRaw = localStorage.getItem('quickstrike_current_user');
            const profilePictureRaw = localStorage.getItem('quickstrike_profile_picture');
            const hasCurrentUser = currentUserRaw && currentUserRaw !== 'null';

            if (hasCurrentUser) {
                loginButton.style.display = 'none';
                try {
                    const currentUser = JSON.parse(currentUserRaw);
                    const userName = currentUser.name || currentUser.username || 'User';
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

        function handleLogin() {
            window.location.href = loginPageUrl;
        }

        function handleContact() {
            window.location.href = contactPageUrl;
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

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeSideMenu();
            }
        });

        // Feature boxes click handlers
        document.querySelectorAll('.feature-box').forEach(box => {
            box.addEventListener('click', function() {
                const title = this.querySelector('h3').textContent;
                if (title.trim() === 'Mini - Games') {
                    window.location.href = miniGamesPageUrl;
                    return;
                }
                if (title.trim() === 'Track Your Progress') {
                    const currentUserRaw = localStorage.getItem('quickstrike_current_user');
                    const hasCurrentUser = currentUserRaw && currentUserRaw !== 'null';

                    if (!hasCurrentUser) {
                        showTrackAccessPopup();
                        return;
                    }

                    window.location.href = trackProgressPageUrl;
                    return;
                }
                if (title.trim() === 'Leaderboard') {
                    window.location.href = leaderboardPageUrl;
                    return;
                }
                if (title.trim() === 'Guides') {
                    window.location.href = guidesPageUrl;
                    return;
                }
                if (title.trim() === 'Reviews') {
                    window.location.href = reviewsPageUrl;
                    return;
                }
                alert('Opening ' + title + '...');
            });
        });

        updateAuthButtonsVisibility();
    </script>
</body>
</html>