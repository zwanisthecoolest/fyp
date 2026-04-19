<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonkeyPace - Guides</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.5;
            color: #1f3330;
            background:
                radial-gradient(circle at 14% 12%, rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0) 40%),
                radial-gradient(circle at 86% 10%, rgba(120, 214, 187, 0.26), rgba(120, 214, 187, 0) 38%),
                linear-gradient(140deg, #56cfc8 0%, #9adcc3 42%, #eefcf6 100%);
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
            font-weight: 700;
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
            color: #ffffff;
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

        .page-shell {
            max-width: 1450px;
            width: min(96vw, 1450px);
            margin: 24px auto;
            background: linear-gradient(160deg, rgba(242, 255, 250, 0.84) 0%, rgba(228, 248, 239, 0.78) 100%);
            border: 2px solid rgba(55, 130, 124, 0.22);
            border-radius: 22px;
            box-shadow: 0 20px 44px rgba(12, 70, 79, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(4px);
            padding: 30px;
            flex: 1;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .topbar h1 {
            font-size: clamp(26px, 4vw, 38px);
            color: #153a3e;
        }

        .back-link {
            text-decoration: none;
            padding: 9px 16px;
            border-radius: 999px;
            background: #d7f0e7;
            color: #244943;
            font-weight: 700;
            border: 1px solid #9cdcc1;
        }

        .subtitle {
            margin-bottom: 20px;
            color: #2e5450;
            font-size: clamp(15px, 2vw, 18px);
        }

        .guide-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .guide-card {
            background: #edf8f3;
            border: 1px solid #cfe9dc;
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 8px 18px rgba(24, 78, 73, 0.08);
        }

        .guide-card h2 {
            font-size: 22px;
            color: #173a3e;
            margin-bottom: 10px;
        }

        .steps-list {
            list-style: none;
            display: grid;
            gap: 12px;
        }

        .steps-list li {
            background: #ffffff;
            border: 1px solid #cfe9dc;
            border-radius: 10px;
            padding: 12px;
        }

        .step-title {
            font-weight: 700;
            color: #1a4742;
            margin-bottom: 6px;
        }

        .step-lines {
            color: #2f5f58;
            font-size: 14px;
            white-space: pre-line;
        }

        .troubleshoot-list {
            list-style: none;
            display: grid;
            gap: 10px;
        }

        .troubleshoot-list li {
            background: #ffffff;
            border: 1px solid #cfe9dc;
            border-radius: 10px;
            padding: 12px;
        }

        .problem-title {
            font-weight: 700;
            color: #1a4742;
            margin-bottom: 6px;
        }

        .problem-lines {
            color: #2f5f58;
            font-size: 14px;
            white-space: pre-line;
        }

        .components {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }

        .device-image {
            margin-top: 10px;
            width: min(100%, 280px);
            border-radius: 12px;
            border: 1px solid #cfe9dc;
            background: #ffffff;
            box-shadow: 0 8px 16px rgba(24, 78, 73, 0.12);
            display: block;
        }

        .components li {
            background: #ffffff;
            border: 1px solid #cfe9dc;
            border-radius: 999px;
            padding: 7px 12px;
            color: #1f4c48;
            font-weight: 600;
            font-size: 14px;
        }

        @media (max-width: 900px) {
            .guide-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 560px) {
            .page-shell {
                margin: 14px auto;
                padding: 16px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .logo {
                font-size: 20px;
                gap: 8px;
            }

            .logo-img {
                width: 40px;
                height: 40px;
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

    <main class="page-shell">
        <div class="topbar">
            <h1>Guides</h1>
            <a class="back-link" href="{{ route('home') }}">Back to Home</a>
        </div>
        <p class="subtitle">How to use our product, troubleshoot common issues, and know your device components.</p>

        <section class="guide-grid">
            <article class="guide-card">
                <h2>How to Use Our Product</h2>
                <ol class="steps-list">
                    <li>
                        <div class="step-title">1. Power on the device</div>
                        <div class="step-lines">Press the start button located on the side of the device.</div>
                    </li>
                    <li>
                        <div class="step-title">2. Log in or Register</div>
                        <div class="step-lines">Enter your ID or create an account.</div>
                    </li>
                    <li>
                        <div class="step-title">3. Select a Game Mode</div>
                        <div class="step-lines">Choose from Speed, Accuracy, Memory, or Reflex training modes.</div>
                    </li>
                    <li>
                        <div class="step-title">4. Start Playing</div>
                        <div class="step-lines">Press Start Game on the device.
Follow on-screen instructions for each mini-game.
Use buttons or controls to interact.</div>
                    </li>
                    <li>
                        <div class="step-title">5. Track Your Performance</div>
                        <div class="step-lines">Scores are automatically recorded.
View progress on the website dashboard.
Compare results with previous sessions.</div>
                    </li>
                    <li>
                        <div class="step-title">6. Earn Badges and Achievements</div>
                        <div class="step-lines">Complete tasks to unlock achievements.
Improve speed, accuracy, and consistency.
Check badges in your profile.</div>
                    </li>
                    <li>
                        <div class="step-title">7. Sync With Website</div>
                        <div class="step-lines">Log in to sync your device data.
Access leaderboard, reviews, and stats.
Update profile and settings online.</div>
                    </li>
                </ol>
            </article>

            <article class="guide-card">
                <h2>Trouble-Shooting</h2>
                <ul class="troubleshoot-list">
                    <li>
                        <div class="problem-title">Problem: Device wont turn on?</div>
                        <div class="problem-lines">Check power cable.
Ensure power switch is ON.</div>
                    </li>
                    <li>
                        <div class="problem-title">Problem: Screen not responding</div>
                        <div class="problem-lines">Restart device.</div>
                    </li>
                    <li>
                        <div class="problem-title">Problem: Buttons not responding</div>
                        <div class="problem-lines">Check connections wiring to GPIO pins.
Restart device.</div>
                    </li>
                    <li>
                        <div class="problem-title">Problem: Joystick not responding</div>
                        <div class="problem-lines">Check joystick wiring connections.
Restart device.</div>
                    </li>
                    <li>
                        <div class="problem-title">Problem: Screen is Blank</div>
                        <div class="problem-lines">Adjust brightness settings.
Restart device.
Check power connection.</div>
                    </li>
                </ul>

                <h2 style="margin-top: 16px;">Device Components</h2>
                <img class="device-image" src="{{ asset('images/games/device-components.png') }}" alt="Device components layout">
                <ul class="components">
                    <li>RP board</li>
                    <li>10 inch screen monitor</li>
                    <li>Buttons</li>
                    <li>Joystick</li>
                    <li>Cables</li>
                </ul>
            </article>
        </section>
    </main>

    <script>
        const loginPageUrl = {{ Js::from(route('login.page')) }};
        const trackProgressPageUrl = {{ Js::from(route('track.progress')) }};
        const miniGamesPageUrl = {{ Js::from(route('mini-games')) }};
        const leaderboardPageUrl = {{ Js::from(route('leaderboard')) }};
        const guidesPageUrl = {{ Js::from(route('guides')) }};
        const reviewsPageUrl = {{ Js::from(route('reviews')) }};
        const profilePageUrl = {{ Js::from(route('profile')) }};

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
            displayUsername();
            window.location.reload();
        }

        function displayUsername() {
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

        displayUsername();

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeSideMenu();
            }
        });
    </script>
</body>
</html>
