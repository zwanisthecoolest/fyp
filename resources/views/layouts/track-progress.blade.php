<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonkeyPace - Track Your Progress</title>
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
                radial-gradient(circle at 12% 14%, rgba(255, 255, 255, 0.42), rgba(255, 255, 255, 0) 40%),
                radial-gradient(circle at 88% 8%, rgba(106, 196, 175, 0.32), rgba(106, 196, 175, 0) 36%),
                linear-gradient(140deg, #52cec5 0%, #9adabd 42%, #ecfbf4 100%);
            min-height: 100vh;
            padding: 0;
            display: flex;
            flex-direction: column;
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

        .game-tabs {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 18px;
        }

        .game-tab {
            border: 0;
            background: #c9ece1;
            color: #173b3f;
            padding: 13px 12px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        }

        .game-tab:hover {
            transform: translateY(-2px);
            background: #bce6d9;
            box-shadow: 0 8px 14px rgba(20, 85, 78, 0.15);
        }

        .game-tab.active {
            background: #4ecdc4;
            box-shadow: 0 10px 18px rgba(20, 93, 100, 0.24);
        }

        .panel-wrap {
            background: linear-gradient(170deg, #ffffff 0%, #f7fdfa 100%);
            border: 2px solid #d8eee5;
            border-radius: 16px;
            padding: 20px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.8);
        }

        .panel {
            display: none;
        }

        .panel.active {
            display: block;
        }

        .panel h2 {
            font-size: clamp(22px, 3.2vw, 30px);
            margin-bottom: 8px;
            color: #173a3e;
        }

        .panel p {
            margin-bottom: 18px;
            color: #355751;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 18px;
        }

        .stat-card {
            background: #edf8f3;
            border: 1px solid #cfe9dc;
            border-radius: 12px;
            padding: 18px;
            min-height: 122px;
        }

        .stat-label {
            font-size: 16px;
            color: #456963;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 36px;
            font-weight: 800;
            color: #194348;
            line-height: 1;
        }

        .progress-row {
            margin-bottom: 10px;
        }

        .progress-head {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #446a63;
            margin-bottom: 5px;
        }

        .progress-track {
            height: 11px;
            border-radius: 999px;
            background: #dbeee5;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #4ecdc4 0%, #6ed8a7 100%);
        }

        .panel-note {
            margin-top: 12px;
            font-size: 13px;
            color: #4a6d67;
        }

        .difficulty-breakdown {
            margin-top: 16px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 14px;
        }

        .difficulty-card {
            background: linear-gradient(160deg, #f7fdf9 0%, #eef9f3 100%);
            border: 1px solid #cfe9dc;
            border-radius: 10px;
            padding: 14px;
            min-height: 170px;
            box-shadow: 0 6px 14px rgba(24, 78, 73, 0.08);
            transition: transform 0.18s ease, box-shadow 0.18s ease;
        }

        .difficulty-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 18px rgba(24, 78, 73, 0.14);
        }

        .difficulty-card.total {
            background: linear-gradient(160deg, #e8f8f0 0%, #ddf1e7 100%);
            border-color: #abd8c4;
        }

        .difficulty-title {
            font-size: 17px;
            color: #2a5851;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .difficulty-line {
            font-size: 15px;
            color: #3a625b;
            margin-bottom: 4px;
        }

        .difficulty-line strong {
            color: #183f44;
        }

        .difficulty-improvements {
            margin-top: 14px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 14px;
        }

        .improvement-card {
            background: linear-gradient(160deg, #f7fdf9 0%, #eef9f3 100%);
            border: 1px solid #cfe9dc;
            border-radius: 10px;
            padding: 14px;
            min-height: 220px;
            box-shadow: 0 6px 14px rgba(24, 78, 73, 0.08);
            transition: transform 0.18s ease, box-shadow 0.18s ease;
        }

        .improvement-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 18px rgba(24, 78, 73, 0.14);
        }

        .improvement-card.total {
            background: linear-gradient(160deg, #e8f8f0 0%, #ddf1e7 100%);
            border-color: #abd8c4;
        }

        .improvement-mini-title {
            font-size: 15px;
            color: #2f5b54;
            margin-bottom: 6px;
            font-weight: 700;
        }

        .attempt-label {
            font-size: 14px;
            color: #3d635c;
            margin-top: 6px;
            margin-bottom: 4px;
        }

        .attempt-metrics {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .attempt-chip {
            background: #edf8f3;
            border: 1px solid #cfe9dc;
            border-radius: 8px;
            padding: 4px 8px;
            font-size: 14px;
            color: #214a47;
        }

        .attempt-separator {
            color: #74a49b;
            font-weight: 700;
        }

        .improvement-graph-wrap {
            margin-top: 14px;
            background: linear-gradient(155deg, #f4fcf8 0%, #e8f7ef 100%);
            border: 1px solid #c7e7d8;
            border-radius: 10px;
            padding: 14px;
            box-shadow: 0 8px 18px rgba(20, 85, 78, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.7);
        }

        .graph-filter-wrap {
            margin-top: 12px;
        }

        .graph-metric-wrap {
            margin-top: 10px;
        }

        .graph-filter-title {
            font-size: 12px;
            font-weight: 700;
            color: #355f59;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .graph-filter-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .graph-filter-button {
            border: 1px solid #9bd5c3;
            border-radius: 8px;
            padding: 9px 14px;
            font-size: 15px;
            color: #1f4744;
            background: #ffffff;
            cursor: pointer;
            transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
        }

        .graph-filter-button:hover {
            transform: translateY(-1px);
            border-color: #72c9bb;
            background: #f4fbf8;
        }

        .graph-filter-button.active {
            background: #4ecdc4;
            color: #ffffff;
            border-color: #4ecdc4;
            box-shadow: 0 6px 12px rgba(20, 85, 78, 0.15);
        }

        .graph-metric-button {
            border: 1px solid #9bd5c3;
            border-radius: 8px;
            padding: 9px 14px;
            font-size: 15px;
            color: #1f4744;
            background: #ffffff;
            cursor: pointer;
            transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
        }

        .graph-metric-button:hover {
            transform: translateY(-1px);
            border-color: #72c9bb;
            background: #f4fbf8;
        }

        .graph-metric-button.active {
            background: #4ecdc4;
            color: #ffffff;
            border-color: #4ecdc4;
            box-shadow: 0 6px 12px rgba(20, 85, 78, 0.15);
        }

        .improvement-graph-title {
            font-size: 16px;
            color: #214f4a;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .improvement-graph-note {
            font-size: 13px;
            color: #3f6760;
        }

        .improvement-graph {
            width: 100%;
            height: 190px;
            display: block;
            border-radius: 8px;
            background:
                repeating-linear-gradient(0deg, rgba(255, 255, 255, 0.18) 0, rgba(255, 255, 255, 0.18) 1px, transparent 1px, transparent 34px),
                linear-gradient(180deg, #8fd0b3 0%, #6dbebb 100%);
            border: 1px solid rgba(92, 162, 146, 0.45);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.28);
        }

        .improvement-graph-labels {
            margin-top: 8px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(42px, 1fr));
            gap: 8px;
        }

        .improvement-graph-label {
            font-size: 11px;
            color: #2f5852;
            text-align: center;
            font-weight: 600;
        }

        .improvement-graph-legend {
            margin-top: 8px;
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            align-items: center;
        }

        .improvement-graph-legend-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #2f5852;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.46);
            border: 1px solid rgba(177, 222, 205, 0.9);
            border-radius: 999px;
            padding: 4px 9px;
        }

        .improvement-graph-legend-swatch {
            width: 12px;
            height: 3px;
            border-radius: 2px;
            display: inline-block;
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

        @media (max-width: 900px) {
            .game-tabs {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .difficulty-breakdown {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .difficulty-improvements {
                grid-template-columns: repeat(2, minmax(0, 1fr));
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

            .game-tabs {
                grid-template-columns: 1fr;
            }

            .difficulty-breakdown {
                grid-template-columns: 1fr;
            }

            .difficulty-improvements {
                grid-template-columns: 1fr;
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
            <h1>Track Your Progress</h1>
            <a class="back-link" href="{{ route('home') }}">Back to Home</a>
        </div>
        <p class="subtitle">Choose a game below to view your latest stats and improvement progress.</p>

        <div class="game-tabs" role="tablist" aria-label="Games">
            <button type="button" class="game-tab active" data-game="jungle-rush" data-game-name="Jungle Rush">Jungle Rush</button>
            <button type="button" class="game-tab" data-game="rapid-tiles" data-game-name="Rapid Tiles">Rapid Tiles</button>
            <button type="button" class="game-tab" data-game="monkey-ball" data-game-name="MonkeyBall">MonkeyBall</button>
            <button type="button" class="game-tab" data-game="math-quest" data-game-name="Math Quest">Math Quest</button>
        </div>

        <section class="panel-wrap">
            <article class="panel active" data-panel="jungle-rush">
                <h2>Jungle Rush</h2>
                <p>Color and shape matching accuracy over your recent sessions.</p>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-label">Best Accuracy</div>
                        <div class="stat-value" data-stat="primary">--</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Avg Reaction</div>
                        <div class="stat-value" data-stat="secondary">--</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Sessions Played</div>
                        <div class="stat-value" data-stat="sessions">--</div>
                    </div>
                </div>
                <div class="difficulty-breakdown" data-monkey-difficulty-breakdown>
                    <div class="difficulty-card">
                        <div class="difficulty-title">Easy</div>
                        <div class="difficulty-line">Sessions: <strong>--</strong></div>
                        <div class="difficulty-line">Total Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>--</strong></div>
                    </div>
                    <div class="difficulty-card">
                        <div class="difficulty-title">Normal</div>
                        <div class="difficulty-line">Sessions: <strong>--</strong></div>
                        <div class="difficulty-line">Total Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>--</strong></div>
                    </div>
                    <div class="difficulty-card">
                        <div class="difficulty-title">Hard</div>
                        <div class="difficulty-line">Sessions: <strong>--</strong></div>
                        <div class="difficulty-line">Total Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>--</strong></div>
                    </div>
                    <div class="difficulty-card total">
                        <div class="difficulty-title">All Difficulties</div>
                        <div class="difficulty-line">Total Sessions: <strong>--</strong></div>
                        <div class="difficulty-line">Total Score: <strong>--</strong></div>
                        <div class="difficulty-line">Average Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>--</strong></div>
                    </div>
                </div>
                <div class="difficulty-improvements" data-monkey-difficulty-improvements>
                    <div class="improvement-card">
                        <div class="difficulty-title">Easy Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    </div>
                    <div class="improvement-card">
                        <div class="difficulty-title">Normal Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    </div>
                    <div class="improvement-card">
                        <div class="difficulty-title">Hard Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    </div>
                    <div class="improvement-card total">
                        <div class="difficulty-title">All Difficulties Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    </div>
                </div>
                <div class="graph-filter-wrap" data-graph-filter>
                    <div class="graph-filter-title">Graph Difficulty</div>
                    <div class="graph-filter-buttons" role="group" aria-label="Graph difficulty filter">
                        <button type="button" class="graph-filter-button active" data-graph-difficulty="all">All Difficulties</button>
                        <button type="button" class="graph-filter-button" data-graph-difficulty="easy">Easy</button>
                        <button type="button" class="graph-filter-button" data-graph-difficulty="normal">Normal</button>
                        <button type="button" class="graph-filter-button" data-graph-difficulty="hard">Hard</button>
                        <button type="button" class="graph-filter-button" data-graph-difficulty="extreme">Extreme</button>
                    </div>
                </div>
                <div class="graph-metric-wrap" data-graph-metric-filter>
                    <div class="graph-filter-title">Graph Metrics</div>
                    <div class="graph-filter-buttons" role="group" aria-label="Graph metric filter">
                        <button type="button" class="graph-metric-button active" data-graph-metric="score">Score</button>
                        <button type="button" class="graph-metric-button active" data-graph-metric="accuracy">Accuracy</button>
                        <button type="button" class="graph-metric-button active" data-graph-metric="reaction">Reaction Time</button>
                    </div>
                </div>
                <div class="improvement-graph-wrap" data-monkey-improvement-graph>
                    <div class="improvement-graph-title">All Difficulties Trend</div>
                    <div class="improvement-graph-note">Loading graph...</div>
                </div>
                <p class="panel-note" data-stat="note">Loading latest sessions...</p>
            </article>

            <article class="panel" data-panel="rapid-tiles">
                <h2>Rapid Tiles</h2>
                <p>Tap-speed consistency and precision from your tile rounds.</p>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-label">Top Score</div>
                        <div class="stat-value" data-stat="primary">--</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Best Combo</div>
                        <div class="stat-value" data-stat="secondary">--</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Sessions Played</div>
                        <div class="stat-value" data-stat="sessions">--</div>
                    </div>
                </div>
                <div class="difficulty-breakdown" data-monkey-difficulty-breakdown>
                    <div class="difficulty-card">
                        <div class="difficulty-title">Easy</div>
                        <div class="difficulty-line">Sessions: <strong>--</strong></div>
                        <div class="difficulty-line">Total Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>--</strong></div>
                    </div>
                    <div class="difficulty-card">
                        <div class="difficulty-title">Normal</div>
                        <div class="difficulty-line">Sessions: <strong>--</strong></div>
                        <div class="difficulty-line">Total Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>--</strong></div>
                    </div>
                    <div class="difficulty-card">
                        <div class="difficulty-title">Hard</div>
                        <div class="difficulty-line">Sessions: <strong>--</strong></div>
                        <div class="difficulty-line">Total Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>--</strong></div>
                    </div>
                    <div class="difficulty-card total">
                        <div class="difficulty-title">All Difficulties</div>
                        <div class="difficulty-line">Total Sessions: <strong>--</strong></div>
                        <div class="difficulty-line">Total Score: <strong>--</strong></div>
                        <div class="difficulty-line">Average Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>--</strong></div>
                    </div>
                </div>
                <div class="difficulty-improvements" data-monkey-difficulty-improvements>
                    <div class="improvement-card">
                        <div class="difficulty-title">Easy Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    </div>
                    <div class="improvement-card">
                        <div class="difficulty-title">Normal Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    </div>
                    <div class="improvement-card">
                        <div class="difficulty-title">Hard Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    </div>
                    <div class="improvement-card total">
                        <div class="difficulty-title">All Difficulties Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    </div>
                </div>
                <div class="graph-filter-wrap" data-graph-filter>
                    <div class="graph-filter-title">Graph Difficulty</div>
                    <div class="graph-filter-buttons" role="group" aria-label="Graph difficulty filter">
                        <button type="button" class="graph-filter-button active" data-graph-difficulty="all">All Difficulties</button>
                        <button type="button" class="graph-filter-button" data-graph-difficulty="easy">Easy</button>
                        <button type="button" class="graph-filter-button" data-graph-difficulty="normal">Normal</button>
                        <button type="button" class="graph-filter-button" data-graph-difficulty="hard">Hard</button>
                        <button type="button" class="graph-filter-button" data-graph-difficulty="extreme">Extreme</button>
                    </div>
                </div>
                <div class="graph-metric-wrap" data-graph-metric-filter>
                    <div class="graph-filter-title">Graph Metrics</div>
                    <div class="graph-filter-buttons" role="group" aria-label="Graph metric filter">
                        <button type="button" class="graph-metric-button active" data-graph-metric="score">Score</button>
                        <button type="button" class="graph-metric-button active" data-graph-metric="accuracy">Accuracy</button>
                        <button type="button" class="graph-metric-button active" data-graph-metric="reaction">Reaction Time</button>
                    </div>
                </div>
                <div class="improvement-graph-wrap" data-monkey-improvement-graph>
                    <div class="improvement-graph-title">All Difficulties Trend</div>
                    <div class="improvement-graph-note">Loading graph...</div>
                </div>
                <p class="panel-note" data-stat="note">Loading latest sessions...</p>
            </article>

            <article class="panel" data-panel="monkey-ball">
                <h2>MonkeyBall</h2>
                <p>Tracking hand-eye coordination and obstacle run performance.</p>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-label">Longest Time</div>
                        <div class="stat-value" data-stat="primary">--</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Best Rank</div>
                        <div class="stat-value" data-stat="secondary">--</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Sessions Played</div>
                        <div class="stat-value" data-stat="sessions">--</div>
                    </div>
                </div>
                <div class="difficulty-breakdown" data-monkey-difficulty-breakdown>
                    <div class="difficulty-card">
                        <div class="difficulty-title">Easy</div>
                        <div class="difficulty-line">Sessions: <strong>--</strong></div>
                        <div class="difficulty-line">Total Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>--</strong></div>
                    </div>
                    <div class="difficulty-card">
                        <div class="difficulty-title">Normal</div>
                        <div class="difficulty-line">Sessions: <strong>--</strong></div>
                        <div class="difficulty-line">Total Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>--</strong></div>
                    </div>
                    <div class="difficulty-card">
                        <div class="difficulty-title">Hard</div>
                        <div class="difficulty-line">Sessions: <strong>--</strong></div>
                        <div class="difficulty-line">Total Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>--</strong></div>
                    </div>
                    <div class="difficulty-card total">
                        <div class="difficulty-title">All Difficulties</div>
                        <div class="difficulty-line">Total Sessions: <strong>--</strong></div>
                        <div class="difficulty-line">Total Score: <strong>--</strong></div>
                        <div class="difficulty-line">Average Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>--</strong></div>
                    </div>
                </div>
                <div class="difficulty-improvements" data-monkey-difficulty-improvements>
                    <div class="improvement-card">
                        <div class="difficulty-title">Easy Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    </div>
                    <div class="improvement-card">
                        <div class="difficulty-title">Normal Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    </div>
                    <div class="improvement-card">
                        <div class="difficulty-title">Hard Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    </div>
                    <div class="improvement-card total">
                        <div class="difficulty-title">All Difficulties Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    </div>
                </div>
                <div class="graph-filter-wrap" data-graph-filter>
                    <div class="graph-filter-title">Graph Difficulty</div>
                    <div class="graph-filter-buttons" role="group" aria-label="Graph difficulty filter">
                        <button type="button" class="graph-filter-button active" data-graph-difficulty="all">All Difficulties</button>
                        <button type="button" class="graph-filter-button" data-graph-difficulty="easy">Easy</button>
                        <button type="button" class="graph-filter-button" data-graph-difficulty="normal">Normal</button>
                        <button type="button" class="graph-filter-button" data-graph-difficulty="hard">Hard</button>
                        <button type="button" class="graph-filter-button" data-graph-difficulty="extreme">Extreme</button>
                    </div>
                </div>
                <div class="graph-metric-wrap" data-graph-metric-filter>
                    <div class="graph-filter-title">Graph Metrics</div>
                    <div class="graph-filter-buttons" role="group" aria-label="Graph metric filter">
                        <button type="button" class="graph-metric-button active" data-graph-metric="score">Score</button>
                        <button type="button" class="graph-metric-button active" data-graph-metric="accuracy">Accuracy</button>
                        <button type="button" class="graph-metric-button active" data-graph-metric="reaction">Reaction Time</button>
                    </div>
                </div>
                <div class="improvement-graph-wrap" data-monkey-improvement-graph>
                    <div class="improvement-graph-title">All Difficulties Trend</div>
                    <div class="improvement-graph-note">Loading graph...</div>
                </div>
                <p class="panel-note" data-stat="note">Loading latest sessions...</p>
            </article>

            <article class="panel" data-panel="math-quest">
                <h2>Math Quest</h2>
                <p>Mental speed and problem-solving trend from challenge mode.</p>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-label">Best Accuracy</div>
                        <div class="stat-value" data-stat="primary">--</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Avg Solve Time</div>
                        <div class="stat-value" data-stat="secondary">--</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Sessions Played</div>
                        <div class="stat-value" data-stat="sessions">--</div>
                    </div>
                </div>
                <div class="difficulty-breakdown" data-monkey-difficulty-breakdown>
                    <div class="difficulty-card">
                        <div class="difficulty-title">Easy</div>
                        <div class="difficulty-line">Sessions: <strong>--</strong></div>
                        <div class="difficulty-line">Total Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>--</strong></div>
                    </div>
                    <div class="difficulty-card">
                        <div class="difficulty-title">Normal</div>
                        <div class="difficulty-line">Sessions: <strong>--</strong></div>
                        <div class="difficulty-line">Total Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>--</strong></div>
                    </div>
                    <div class="difficulty-card">
                        <div class="difficulty-title">Hard</div>
                        <div class="difficulty-line">Sessions: <strong>--</strong></div>
                        <div class="difficulty-line">Total Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>--</strong></div>
                    </div>
                    <div class="difficulty-card">
                        <div class="difficulty-title">Extreme</div>
                        <div class="difficulty-line">Sessions: <strong>--</strong></div>
                        <div class="difficulty-line">Total Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>--</strong></div>
                    </div>
                    <div class="difficulty-card total">
                        <div class="difficulty-title">All Difficulties</div>
                        <div class="difficulty-line">Total Sessions: <strong>--</strong></div>
                        <div class="difficulty-line">Total Score: <strong>--</strong></div>
                        <div class="difficulty-line">Average Score: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>--</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>--</strong></div>
                    </div>
                </div>
                <div class="difficulty-improvements" data-monkey-difficulty-improvements>
                    <div class="improvement-card">
                        <div class="difficulty-title">Easy Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    </div>
                    <div class="improvement-card">
                        <div class="difficulty-title">Normal Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    </div>
                    <div class="improvement-card">
                        <div class="difficulty-title">Hard Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    </div>
                    <div class="improvement-card">
                        <div class="difficulty-title">Extreme Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    </div>
                    <div class="improvement-card total">
                        <div class="difficulty-title">All Difficulties Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    </div>
                </div>
                <div class="graph-filter-wrap" data-graph-filter>
                    <div class="graph-filter-title">Graph Difficulty</div>
                    <div class="graph-filter-buttons" role="group" aria-label="Graph difficulty filter">
                        <button type="button" class="graph-filter-button active" data-graph-difficulty="all">All Difficulties</button>
                        <button type="button" class="graph-filter-button" data-graph-difficulty="easy">Easy</button>
                        <button type="button" class="graph-filter-button" data-graph-difficulty="normal">Normal</button>
                        <button type="button" class="graph-filter-button" data-graph-difficulty="hard">Hard</button>
                        <button type="button" class="graph-filter-button" data-graph-difficulty="extreme">Extreme</button>
                    </div>
                </div>
                <div class="graph-metric-wrap" data-graph-metric-filter>
                    <div class="graph-filter-title">Graph Metrics</div>
                    <div class="graph-filter-buttons" role="group" aria-label="Graph metric filter">
                        <button type="button" class="graph-metric-button active" data-graph-metric="score">Score</button>
                        <button type="button" class="graph-metric-button active" data-graph-metric="accuracy">Accuracy</button>
                        <button type="button" class="graph-metric-button active" data-graph-metric="reaction">Reaction Time</button>
                    </div>
                </div>
                <div class="improvement-graph-wrap" data-monkey-improvement-graph>
                    <div class="improvement-graph-title">All Difficulties Trend</div>
                    <div class="improvement-graph-note">Loading graph...</div>
                </div>
                <p class="panel-note" data-stat="note">Loading latest sessions...</p>
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
        const gameTabs = document.querySelectorAll('.game-tab');
        const gamePanels = document.querySelectorAll('.panel');
        const reactionSessionsApiUrl = {{ Js::from(route('api.reaction-sessions.index')) }};
        const statsCache = new Map();
        const sessionsCache = new Map();
        const graphDifficultyByPanel = new Map();
        const graphMetricsByPanel = new Map();
        const currentUserRaw = localStorage.getItem('quickstrike_current_user');
        let currentUser = null;

        try {
            currentUser = currentUserRaw && currentUserRaw !== 'null' ? JSON.parse(currentUserRaw) : null;
        } catch (error) {
            currentUser = null;
        }

        function getCurrentUserSessionFilters() {
            if (!currentUser || typeof currentUser !== 'object') {
                return [];
            }

            const filters = [];
            const playerId = String(currentUser.playerId || currentUser.player_id || '').trim();
            const userId = String(currentUser.userId || currentUser.user_id || '').trim();
            const username = String(currentUser.username || currentUser.name || '').trim();

            if (playerId) {
                filters.push({ key: 'source_player_id', value: playerId });
            }

            if (userId) {
                filters.push({ key: 'user_id', value: userId });
            }

            return filters;
        }

        function mergeUniqueSessions(sessionGroups) {
            const merged = new Map();

            sessionGroups.flat().forEach((session) => {
                if (!session || typeof session !== 'object') {
                    return;
                }

                const sessionKey = session.id !== undefined && session.id !== null
                    ? 'id:' + String(session.id)
                    : [session.game_name, session.player_name, session.created_at, session.score, session.user_id, session.meta && session.meta.source_player_id]
                        .map((value) => String(value ?? ''))
                        .join('|');

                if (!merged.has(sessionKey)) {
                    merged.set(sessionKey, session);
                }
            });

            return Array.from(merged.values());
        }

        function defaultGraphMetrics() {
            return {
                score: true,
                accuracy: true,
                reaction: true,
            };
        }

        function toNumber(value) {
            if (value === null || value === undefined || value === '') {
                return null;
            }

            const parsed = Number(value);
            return Number.isFinite(parsed) ? parsed : null;
        }

        function average(values) {
            if (!values.length) {
                return null;
            }

            return values.reduce((sum, value) => sum + value, 0) / values.length;
        }

        function formatMillisecondsAsSeconds(ms) {
            if (ms === null || ms === undefined) {
                return '--';
            }

            return (ms / 1000).toFixed(2) + 's';
        }

        function percentFromSession(session) {
            const metaAccuracy = toNumber(session.meta && session.meta.accuracy);
            if (metaAccuracy !== null) {
                return Math.max(0, Math.min(100, metaAccuracy));
            }

            const hits = toNumber(session.hits);
            const attempts = toNumber(session.attempts);

            if (hits === null || attempts === null || attempts <= 0) {
                return null;
            }

            return Math.max(0, Math.min(100, (hits / attempts) * 100));
        }

        function averageFromSessions(sessions, mapper) {
            const values = sessions.map(mapper).filter((value) => value !== null);
            return average(values);
        }

        function formatAvg(value, decimals = 1, suffix = '') {
            if (value === null || value === undefined) {
                return '--';
            }

            return Number(value).toFixed(decimals) + suffix;
        }

        function calculateImprovementByThree(panelKey, sessions) {
            const ordered = [...sessions].sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
            const firstThree = ordered.slice(-6, -3);
            const otherThree = ordered.slice(-3);

            if (otherThree.length < 3 || firstThree.length < 3) {
                return {
                    bar: 0,
                    text: 'Need at least 6 sessions.\nFirst 3 avg: --\nOther 3 avg: --',
                };
            }

            const firstScore = averageFromSessions(firstThree, (session) => toNumber(session.score));
            const otherScore = averageFromSessions(otherThree, (session) => toNumber(session.score));

            if (firstScore === null || otherScore === null) {
                return {
                    bar: 0,
                    text: 'Not enough score data.\nFirst 3 avg: --\nOther 3 avg: --',
                };
            }

            const scoreDelta = otherScore - firstScore;
            const scoreBar = firstScore > 0
                ? Math.min(100, Math.abs((scoreDelta / firstScore) * 100))
                : Math.min(100, Math.abs(scoreDelta));

            const firstParts = [`Score ${formatAvg(firstScore, 1)}`];
            const otherParts = [`Score ${formatAvg(otherScore, 1)}`];

            if (panelKey === 'jungle-rush' || panelKey === 'math-quest' || panelKey === 'monkey-ball') {
                const firstAcc = averageFromSessions(firstThree, percentFromSession);
                const otherAcc = averageFromSessions(otherThree, percentFromSession);
                if (firstAcc !== null && otherAcc !== null) {
                    firstParts.push(`Accuracy ${formatAvg(firstAcc, 1, '%')}`);
                    otherParts.push(`Accuracy ${formatAvg(otherAcc, 1, '%')}`);
                }

                const firstReaction = averageFromSessions(firstThree, (session) => toNumber(session.avg_reaction_time_ms));
                const otherReaction = averageFromSessions(otherThree, (session) => toNumber(session.avg_reaction_time_ms));
                if (firstReaction !== null && otherReaction !== null) {
                    firstParts.push(`Reaction ${formatAvg(firstReaction / 1000, 2, 's')}`);
                    otherParts.push(`Reaction ${formatAvg(otherReaction / 1000, 2, 's')}`);
                }
            }

            if (panelKey === 'rapid-tiles') {
                const firstHits = averageFromSessions(firstThree, (session) => toNumber(session.hits));
                const otherHits = averageFromSessions(otherThree, (session) => toNumber(session.hits));
                if (firstHits !== null && otherHits !== null) {
                    firstParts.push(`Hits ${formatAvg(firstHits, 1)}`);
                    otherParts.push(`Hits ${formatAvg(otherHits, 1)}`);
                }
            }

            return {
                bar: Math.round(scoreBar),
                text: `First 3 avg: ${firstParts.join(' | ')}\nOther 3 avg: ${otherParts.join(' | ')}`,
            };
        }

        function setPanelValues(panelKey, values) {
            const panel = document.querySelector('[data-panel="' + panelKey + '"]');
            panel.querySelector('[data-stat="primary"]').textContent = values.primary;
            panel.querySelector('[data-stat="secondary"]').textContent = values.secondary;
            panel.querySelector('[data-stat="sessions"]').textContent = String(values.sessions);
            const improvementText = panel.querySelector('[data-stat="improvement-text"]');
            if (improvementText) {
                improvementText.textContent = values.improvementText || '--';
                improvementText.style.whiteSpace = 'pre-line';
            }
            panel.querySelector('[data-stat="note"]').textContent = values.note;

            const monkeyBreakdown = panel.querySelector('[data-monkey-difficulty-breakdown]');
            if (monkeyBreakdown && values.monkeyDifficultyBreakdownHtml) {
                monkeyBreakdown.innerHTML = values.monkeyDifficultyBreakdownHtml;
            }

            const monkeyDifficultyImprovements = panel.querySelector('[data-monkey-difficulty-improvements]');
            if (monkeyDifficultyImprovements && values.monkeyDifficultyImprovementHtml) {
                monkeyDifficultyImprovements.innerHTML = values.monkeyDifficultyImprovementHtml;
            }

            const improvementGraph = panel.querySelector('[data-monkey-improvement-graph]');
            if (improvementGraph && values.monkeyImprovementGraphHtml) {
                improvementGraph.innerHTML = values.monkeyImprovementGraphHtml;
            }
        }

        function getSessionDifficulty(session) {
            const value =
                (session.meta && session.meta.difficulty) ||
                (session.meta && session.meta.level) ||
                session.difficulty ||
                null;

            if (!value) {
                return null;
            }

            const normalized = String(value).trim().toLowerCase();
            if (normalized === 'easy' || normalized === 'normal' || normalized === 'hard' || normalized === 'extreme') {
                return normalized;
            }

            return null;
        }

        function getDifficultyKeysForPanel(panelKey) {
            if (panelKey === 'monkey-ball') {
                return ['easy', 'normal', 'hard', 'extreme'];
            }

            return ['easy', 'normal', 'hard'];
        }

        function buildMonkeyDifficultyBreakdownHtml(sessions, panelKey) {
            const difficultyKeys = getDifficultyKeysForPanel(panelKey);
            const grouped = difficultyKeys.reduce((accumulator, key) => {
                accumulator[key] = [];
                return accumulator;
            }, {});

            sessions.forEach((session) => {
                const difficulty = getSessionDifficulty(session);
                if (difficulty) {
                    grouped[difficulty].push(session);
                }
            });

            const sectionHtml = difficultyKeys.map((difficulty) => {
                const rows = grouped[difficulty];
                const scores = rows.map((session) => toNumber(session.score)).filter((value) => value !== null);
                const totalScore = scores.length ? scores.reduce((sum, value) => sum + value, 0) : 0;
                const avgScore = scores.length ? Math.round(average(scores)) : null;
                const accuracies = rows.map(percentFromSession).filter((value) => value !== null);
                const avgAccuracy = accuracies.length ? Math.round(average(accuracies)) : null;
                const reactionTimes = rows
                    .map((session) => toNumber(session.avg_reaction_time_ms))
                    .filter((value) => value !== null && value > 0);
                const avgReaction = reactionTimes.length
                    ? formatMillisecondsAsSeconds(Math.round(average(reactionTimes)))
                    : '--';

                return `
                    <div class="difficulty-card">
                        <div class="difficulty-title">${difficulty.charAt(0).toUpperCase() + difficulty.slice(1)}</div>
                        <div class="difficulty-line">Sessions: <strong>${rows.length}</strong></div>
                        <div class="difficulty-line">Total Score: <strong>${totalScore}</strong></div>
                        <div class="difficulty-line">Avg Score: <strong>${avgScore !== null ? avgScore : '--'}</strong></div>
                        <div class="difficulty-line">Avg Accuracy: <strong>${avgAccuracy !== null ? avgAccuracy + '%' : '--'}</strong></div>
                        <div class="difficulty-line">Avg Reaction: <strong>${avgReaction}</strong></div>
                    </div>
                `;
            }).join('');

            const allScores = sessions.map((session) => toNumber(session.score)).filter((value) => value !== null);
            const allTotalScore = allScores.length ? allScores.reduce((sum, value) => sum + value, 0) : 0;
            const allAverageScore = allScores.length ? Math.round(average(allScores)) : null;
            const allAccuracies = sessions.map(percentFromSession).filter((value) => value !== null);
            const allAverageAccuracy = allAccuracies.length ? Math.round(average(allAccuracies)) : null;
            const allReactionTimes = sessions
                .map((session) => toNumber(session.avg_reaction_time_ms))
                .filter((value) => value !== null && value > 0);
            const allAverageReaction = allReactionTimes.length
                ? formatMillisecondsAsSeconds(Math.round(average(allReactionTimes)))
                : '--';

            const totalHtml = `
                <div class="difficulty-card total">
                    <div class="difficulty-title">All Difficulties</div>
                    <div class="difficulty-line">Total Sessions: <strong>${sessions.length}</strong></div>
                    <div class="difficulty-line">Total Score: <strong>${allTotalScore}</strong></div>
                    <div class="difficulty-line">Average Score: <strong>${allAverageScore !== null ? allAverageScore : '--'}</strong></div>
                    <div class="difficulty-line">Avg Accuracy: <strong>${allAverageAccuracy !== null ? allAverageAccuracy + '%' : '--'}</strong></div>
                    <div class="difficulty-line">Avg Reaction: <strong>${allAverageReaction}</strong></div>
                </div>
            `;

            return sectionHtml + totalHtml;
        }

        function buildMonkeyDifficultyImprovementHtml(sessions, panelKey) {
            function summarizeChunk(chunk) {
                const score = averageFromSessions(chunk, (session) => toNumber(session.score));
                const accuracy = averageFromSessions(chunk, percentFromSession);

                return {
                    score: score !== null ? formatAvg(score, 1) : '--',
                    accuracy: accuracy !== null ? formatAvg(accuracy, 1, '%') : '--',
                };
            }

            function buildDifficultyImprovement(rows) {
                const ordered = [...rows].sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
                const firstThree = ordered.slice(0, 3);

                if (firstThree.length < 3) {
                    return {
                        first: {
                            score: '--',
                            accuracy: '--',
                        },
                        others: [],
                    };
                }

                const remaining = ordered.slice(3);
                const others = [];

                for (let index = 0; index < remaining.length; index += 3) {
                    const chunk = remaining.slice(index, index + 3);
                    if (chunk.length < 3) {
                        break;
                    }

                    const startAttempt = 4 + index;
                    const endAttempt = startAttempt + 2;
                    others.push({
                        label: `Other 3 attempts (${startAttempt}-${endAttempt}):`,
                        ...summarizeChunk(chunk),
                    });
                }

                return {
                    first: summarizeChunk(firstThree),
                    others,
                };
            }

            const difficultyKeys = getDifficultyKeysForPanel(panelKey);
            const grouped = difficultyKeys.reduce((accumulator, key) => {
                accumulator[key] = [];
                return accumulator;
            }, {});

            sessions.forEach((session) => {
                const difficulty = getSessionDifficulty(session);
                if (difficulty) {
                    grouped[difficulty].push(session);
                }
            });

            const sectionHtml = difficultyKeys.map((difficulty) => {
                const improvement = buildDifficultyImprovement(grouped[difficulty]);
                const otherBlocksHtml = improvement.others.length
                    ? improvement.others.map((block) => `
                        <div class="attempt-label">${block.label}</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score ${block.score}</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy ${block.accuracy}</span>
                        </div>
                    `).join('')
                    : `
                        <div class="attempt-label">Other 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score --</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy --</span>
                        </div>
                    `;

                return `
                    <div class="improvement-card">
                        <div class="difficulty-title">${difficulty.charAt(0).toUpperCase() + difficulty.slice(1)} Improvement</div>
                        <div class="attempt-label">First 3 attempts:</div>
                        <div class="attempt-metrics">
                            <span class="attempt-chip">Score ${improvement.first.score}</span>
                            <span class="attempt-separator">|</span>
                            <span class="attempt-chip">Accuracy ${improvement.first.accuracy}</span>
                        </div>
                        ${otherBlocksHtml}
                    </div>
                `;
            }).join('');

            const allImprovement = buildDifficultyImprovement(sessions);
            const allOtherBlocksHtml = allImprovement.others.length
                ? allImprovement.others.map((block) => `
                    <div class="attempt-label">${block.label}</div>
                    <div class="attempt-metrics">
                        <span class="attempt-chip">Score ${block.score}</span>
                        <span class="attempt-separator">|</span>
                        <span class="attempt-chip">Accuracy ${block.accuracy}</span>
                    </div>
                `).join('')
                : `
                    <div class="attempt-label">Other 3 attempts:</div>
                    <div class="attempt-metrics">
                        <span class="attempt-chip">Score --</span>
                        <span class="attempt-separator">|</span>
                        <span class="attempt-chip">Accuracy --</span>
                    </div>
                `;

            const totalHtml = `
                <div class="improvement-card total">
                    <div class="difficulty-title">All Difficulties Improvement</div>
                    <div class="improvement-mini-title"></div>
                    <div class="attempt-label">First 3 attempts:</div>
                    <div class="attempt-metrics">
                        <span class="attempt-chip">Score ${allImprovement.first.score}</span>
                        <span class="attempt-separator">|</span>
                        <span class="attempt-chip">Accuracy ${allImprovement.first.accuracy}</span>
                    </div>
                    ${allOtherBlocksHtml}
                </div>
            `;

            return sectionHtml + totalHtml;
        }

        function formatDifficultyLabel(difficulty) {
            if (difficulty === 'all') {
                return 'All Difficulties';
            }

            return difficulty.charAt(0).toUpperCase() + difficulty.slice(1);
        }

        function buildAllDifficultiesImprovementGraphHtml(sessions, difficulty = 'all', metrics = defaultGraphMetrics()) {
            const filteredSessions = difficulty === 'all'
                ? sessions
                : sessions.filter((session) => getSessionDifficulty(session) === difficulty);

            const ordered = [...filteredSessions].sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
            const attempts = ordered.map((session, index) => ({
                label: String(index + 1),
                score: toNumber(session.score),
                accuracy: percentFromSession(session),
                reactionMs: toNumber(session.avg_reaction_time_ms),
            }));

            const difficultyLabel = formatDifficultyLabel(difficulty);

            const isScoreEnabled = !!metrics.score;
            const isAccuracyEnabled = !!metrics.accuracy;
            const isReactionEnabled = !!metrics.reaction;

            if (!isScoreEnabled && !isAccuracyEnabled && !isReactionEnabled) {
                return `
                    <div class="improvement-graph-title">${difficultyLabel} Trend</div>
                    <div class="improvement-graph-note">Select at least one metric to draw the graph.</div>
                `;
            }

            if (attempts.length < 2) {
                return `
                    <div class="improvement-graph-title">${difficultyLabel} Trend</div>
                    <div class="improvement-graph-note">Need at least 2 sessions to draw trend changes.</div>
                `;
            }

            const width = 100;
            const height = 28;
            const xStep = attempts.length > 1 ? width / (attempts.length - 1) : width;

            const scoreValues = attempts.map((item) => item.score).filter((value) => value !== null);
            const accuracyValues = attempts.map((item) => item.accuracy).filter((value) => value !== null);
            const reactionValues = attempts
                .map((item) => item.reactionMs)
                .filter((value) => value !== null && value > 0);

            if (
                (!isScoreEnabled || !scoreValues.length) &&
                (!isAccuracyEnabled || !accuracyValues.length) &&
                (!isReactionEnabled || !reactionValues.length)
            ) {
                return `
                    <div class="improvement-graph-title">${difficultyLabel} Trend</div>
                    <div class="improvement-graph-note">Not enough score, accuracy, or reaction data to draw trend changes.</div>
                `;
            }

            const scoreMin = scoreValues.length ? Math.min(...scoreValues) : 0;
            const scoreMax = scoreValues.length ? Math.max(...scoreValues) : 0;
            const scoreRange = Math.max(1, scoreMax - scoreMin);

            const accMin = accuracyValues.length ? Math.min(...accuracyValues) : 0;
            const accMax = accuracyValues.length ? Math.max(...accuracyValues) : 0;
            const accRange = Math.max(1, accMax - accMin);

            const reactionMin = reactionValues.length ? Math.min(...reactionValues) : 0;
            const reactionMax = reactionValues.length ? Math.max(...reactionValues) : 0;
            const reactionRange = Math.max(1, reactionMax - reactionMin);

            function normalizeY(value, min, range) {
                if (value === null || value === undefined) {
                    return null;
                }
                return height - ((value - min) / range) * height;
            }

            const scorePoints = attempts.map((item, index) => {
                const x = index * xStep;
                const y = normalizeY(item.score, scoreMin, scoreRange);
                return { x, y };
            });

            const accuracyPoints = attempts.map((item, index) => {
                const x = index * xStep;
                const y = normalizeY(item.accuracy, accMin, accRange);
                return { x, y };
            });

            const reactionPoints = attempts.map((item, index) => {
                const x = index * xStep;
                const y = normalizeY(item.reactionMs, reactionMin, reactionRange);
                return { x, y };
            });

            function pointsToPolyline(points) {
                return points
                    .filter((point) => point.y !== null)
                    .map((point) => `${point.x.toFixed(2)},${point.y.toFixed(2)}`)
                    .join(' ');
            }

            const verticalGuides = attempts.map((_, index) => {
                const x = (index * xStep).toFixed(2);
                return `<line x1="${x}" y1="0" x2="${x}" y2="${height}" stroke="rgba(219, 245, 237, 0.45)" stroke-width="0.35" />`;
            }).join('');

            const horizontalGuides = [0.25, 0.5, 0.75].map((ratio) => {
                const y = (height * ratio).toFixed(2);
                return `<line x1="0" y1="${y}" x2="${width}" y2="${y}" stroke="rgba(219, 245, 237, 0.35)" stroke-width="0.3" />`;
            }).join('');

            const scorePolyline = isScoreEnabled ? pointsToPolyline(scorePoints) : '';
            const accuracyPolyline = isAccuracyEnabled ? pointsToPolyline(accuracyPoints) : '';
            const reactionPolyline = isReactionEnabled ? pointsToPolyline(reactionPoints) : '';

            const scoreValidPoints = scorePoints.filter((point) => point.y !== null);
            const scoreAreaPoints = isScoreEnabled && scoreValidPoints.length > 1
                ? `0,${height} ${scoreValidPoints.map((point) => `${point.x.toFixed(2)},${point.y.toFixed(2)}`).join(' ')} ${width},${height}`
                : '';

            const scoreDots = isScoreEnabled ? scorePoints
                .filter((point) => point.y !== null)
                .map((point) =>
                    `<circle cx="${point.x.toFixed(2)}" cy="${point.y.toFixed(2)}" r="0.75" fill="#e8fff8" />`
                ).join('') : '';

            const accuracyDots = isAccuracyEnabled ? accuracyPoints
                .filter((point) => point.y !== null)
                .map((point) =>
                    `<circle cx="${point.x.toFixed(2)}" cy="${point.y.toFixed(2)}" r="0.75" fill="#fff9e8" />`
                ).join('') : '';

            const reactionDots = isReactionEnabled ? reactionPoints
                .filter((point) => point.y !== null)
                .map((point) =>
                    `<circle cx="${point.x.toFixed(2)}" cy="${point.y.toFixed(2)}" r="0.75" fill="#f9ecff" />`
                ).join('') : '';

            const labels = attempts.map((item) =>
                `<div class="improvement-graph-label">${item.label}</div>`
            ).join('');

            return `
                <div class="improvement-graph-title">${difficultyLabel} Trend (Per Attempt)</div>
                <svg class="improvement-graph" viewBox="0 0 ${width} ${height}" preserveAspectRatio="none" role="img" aria-label="All difficulties improvement trend">
                    ${horizontalGuides}
                    ${verticalGuides}
                    ${scoreAreaPoints ? `<polygon points="${scoreAreaPoints}" fill="rgba(67, 152, 173, 0.25)"></polygon>` : ''}
                    ${scorePolyline ? `<polyline points="${scorePolyline}" fill="none" stroke="#bff8ff" stroke-width="0.58"></polyline>` : ''}
                    ${accuracyPolyline ? `<polyline points="${accuracyPolyline}" fill="none" stroke="#ffe29a" stroke-width="0.58" stroke-dasharray="1.2 1.1"></polyline>` : ''}
                    ${reactionPolyline ? `<polyline points="${reactionPolyline}" fill="none" stroke="#f3b7ff" stroke-width="0.58" stroke-dasharray="1.8 1.1"></polyline>` : ''}
                    ${scoreDots}
                    ${accuracyDots}
                    ${reactionDots}
                </svg>
                <div class="improvement-graph-legend">
                    ${isScoreEnabled ? '<span class="improvement-graph-legend-item"><span class="improvement-graph-legend-swatch" style="background:#bff8ff;"></span>Score</span>' : ''}
                    ${isAccuracyEnabled ? '<span class="improvement-graph-legend-item"><span class="improvement-graph-legend-swatch" style="background:#ffe29a;"></span>Accuracy</span>' : ''}
                    ${isReactionEnabled ? '<span class="improvement-graph-legend-item"><span class="improvement-graph-legend-swatch" style="background:#f3b7ff;"></span>Reaction Time</span>' : ''}
                </div>
                <div class="improvement-graph-labels">${labels}</div>
            `;
        }

        function renderGraphForPanel(panelKey) {
            const panel = document.querySelector('[data-panel="' + panelKey + '"]');
            if (!panel) {
                return;
            }

            const sessions = sessionsCache.get(panelKey) || [];
            const selectedDifficulty = graphDifficultyByPanel.get(panelKey) || 'all';
            const selectedMetrics = graphMetricsByPanel.get(panelKey) || defaultGraphMetrics();
            const graphWrap = panel.querySelector('[data-monkey-improvement-graph]');

            if (!graphWrap) {
                return;
            }

            graphWrap.innerHTML = buildAllDifficultiesImprovementGraphHtml(sessions, selectedDifficulty, selectedMetrics);
        }

        function initializeGraphFilters() {
            document.querySelectorAll('.panel').forEach((panel) => {
                const panelKey = panel.getAttribute('data-panel');
                const filterWrap = panel.querySelector('[data-graph-filter]');

                if (!panelKey || !filterWrap) {
                    return;
                }

                if (!graphDifficultyByPanel.has(panelKey)) {
                    graphDifficultyByPanel.set(panelKey, 'all');
                }

                if (!graphMetricsByPanel.has(panelKey)) {
                    graphMetricsByPanel.set(panelKey, defaultGraphMetrics());
                }

                filterWrap.querySelectorAll('.graph-filter-button').forEach((button) => {
                    button.addEventListener('click', function () {
                        const selectedDifficulty = this.getAttribute('data-graph-difficulty') || 'all';
                        graphDifficultyByPanel.set(panelKey, selectedDifficulty);

                        filterWrap.querySelectorAll('.graph-filter-button').forEach((btn) => {
                            const isActive = btn.getAttribute('data-graph-difficulty') === selectedDifficulty;
                            btn.classList.toggle('active', isActive);
                            btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
                        });

                        renderGraphForPanel(panelKey);
                    });
                });

                const metricFilterWrap = panel.querySelector('[data-graph-metric-filter]');
                if (metricFilterWrap) {
                    metricFilterWrap.querySelectorAll('.graph-metric-button').forEach((button) => {
                        button.setAttribute('aria-pressed', 'true');
                        button.addEventListener('click', function () {
                            const metricKey = this.getAttribute('data-graph-metric');
                            if (!metricKey) {
                                return;
                            }

                            const currentMetrics = graphMetricsByPanel.get(panelKey) || defaultGraphMetrics();
                            const nextMetrics = {
                                score: !!currentMetrics.score,
                                accuracy: !!currentMetrics.accuracy,
                                reaction: !!currentMetrics.reaction,
                            };

                            nextMetrics[metricKey] = !nextMetrics[metricKey];
                            graphMetricsByPanel.set(panelKey, nextMetrics);

                            metricFilterWrap.querySelectorAll('.graph-metric-button').forEach((btn) => {
                                const key = btn.getAttribute('data-graph-metric');
                                const isActive = !!nextMetrics[key];
                                btn.classList.toggle('active', isActive);
                                btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
                            });

                            renderGraphForPanel(panelKey);
                        });
                    });
                }
            });
        }

        function buildJungleRushStats(sessions) {
            const accuracies = sessions.map(percentFromSession).filter((value) => value !== null);
            const avgReactionValues = sessions
                .map((session) => toNumber(session.avg_reaction_time_ms))
                .filter((value) => value !== null);
            const improvement = calculateImprovementByThree('jungle-rush', sessions);

            return {
                primary: accuracies.length ? Math.round(Math.max(...accuracies)) + '%' : '--',
                secondary: avgReactionValues.length ? formatMillisecondsAsSeconds(Math.round(average(avgReactionValues))) : '--',
                sessions: sessions.length,
                improvement: improvement.bar,
                improvementText: improvement.text,
                note: sessions.length ? 'Live data from your saved Jungle Rush sessions.' : 'No sessions recorded yet for this game.',
                monkeyDifficultyBreakdownHtml: buildMonkeyDifficultyBreakdownHtml(sessions, 'jungle-rush'),
                monkeyDifficultyImprovementHtml: buildMonkeyDifficultyImprovementHtml(sessions, 'jungle-rush'),
                monkeyImprovementGraphHtml: buildAllDifficultiesImprovementGraphHtml(sessions),
            };
        }

        function buildRapidTilesStats(sessions) {
            const topScoreValues = sessions.map((session) => toNumber(session.score)).filter((value) => value !== null);
            const combos = sessions.map((session) => {
                const comboFromMeta = toNumber(session.meta && session.meta.best_combo);
                if (comboFromMeta !== null) {
                    return comboFromMeta;
                }

                return toNumber(session.hits);
            }).filter((value) => value !== null);
            const improvement = calculateImprovementByThree('rapid-tiles', sessions);

            return {
                primary: topScoreValues.length ? String(Math.max(...topScoreValues)) : '--',
                secondary: combos.length ? String(Math.max(...combos)) : '--',
                sessions: sessions.length,
                improvement: improvement.bar,
                improvementText: improvement.text,
                note: sessions.length ? 'Live data from your saved Rapid Tiles sessions.' : 'No sessions recorded yet for this game.',
                monkeyDifficultyBreakdownHtml: buildMonkeyDifficultyBreakdownHtml(sessions, 'rapid-tiles'),
                monkeyDifficultyImprovementHtml: buildMonkeyDifficultyImprovementHtml(sessions, 'rapid-tiles'),
                monkeyImprovementGraphHtml: buildAllDifficultiesImprovementGraphHtml(sessions),
            };
        }

        function buildMonkeyBallStats(sessions) {
            const durationValues = sessions.map((session) => toNumber(session.duration_ms)).filter((value) => value !== null && value > 0);
            const bestRanks = sessions
                .map((session) => toNumber(session.meta && session.meta.rank))
                .filter((value) => value !== null);
            const improvement = calculateImprovementByThree('monkey-ball', sessions);

            return {
                primary: durationValues.length ? formatMillisecondsAsSeconds(Math.max(...durationValues)) : '--',
                secondary: bestRanks.length ? '#' + String(Math.min(...bestRanks)) : '--',
                sessions: sessions.length,
                improvement: improvement.bar,
                improvementText: '',
                note: sessions.length ? 'Live data from your saved MonkeyBall sessions with difficulty breakdowns.' : 'No sessions recorded yet for this game.',
                monkeyDifficultyBreakdownHtml: buildMonkeyDifficultyBreakdownHtml(sessions, 'monkey-ball'),
                monkeyDifficultyImprovementHtml: buildMonkeyDifficultyImprovementHtml(sessions, 'monkey-ball'),
                monkeyImprovementGraphHtml: buildAllDifficultiesImprovementGraphHtml(sessions),
            };
        }

        function buildMathQuestStats(sessions) {
            const accuracies = sessions.map(percentFromSession).filter((value) => value !== null);
            const solveTimes = sessions.map((session) => toNumber(session.avg_reaction_time_ms)).filter((value) => value !== null);
            const improvement = calculateImprovementByThree('math-quest', sessions);

            return {
                primary: accuracies.length ? Math.round(Math.max(...accuracies)) + '%' : '--',
                secondary: solveTimes.length ? formatMillisecondsAsSeconds(Math.round(average(solveTimes))) : '--',
                sessions: sessions.length,
                improvement: improvement.bar,
                improvementText: improvement.text,
                note: sessions.length ? 'Live data from your saved Math Quest sessions.' : 'No sessions recorded yet for this game.',
                monkeyDifficultyBreakdownHtml: buildMonkeyDifficultyBreakdownHtml(sessions, 'math-quest'),
                monkeyDifficultyImprovementHtml: buildMonkeyDifficultyImprovementHtml(sessions, 'math-quest'),
                monkeyImprovementGraphHtml: buildAllDifficultiesImprovementGraphHtml(sessions),
            };
        }

        function buildStatsByPanel(panelKey, sessions) {
            if (panelKey === 'jungle-rush') {
                return buildJungleRushStats(sessions);
            }

            if (panelKey === 'rapid-tiles') {
                return buildRapidTilesStats(sessions);
            }

            if (panelKey === 'monkey-ball') {
                return buildMonkeyBallStats(sessions);
            }

            return buildMathQuestStats(sessions);
        }

        async function fetchSessionsByGame(gameName) {
            const filters = getCurrentUserSessionFilters();

            if (!filters.length) {
                return [];
            }

            const responseGroups = await Promise.all(filters.map(async (filter) => {
                const params = new URLSearchParams();
                params.set('game_name', gameName);
                params.set('limit', '100');
                params.set(filter.key, filter.value);

                const response = await fetch(reactionSessionsApiUrl + '?' + params.toString(), {
                    headers: {
                        Accept: 'application/json',
                    },
                });

                if (!response.ok) {
                    throw new Error('Failed to fetch sessions for ' + gameName);
                }

                const payload = await response.json();
                return Array.isArray(payload.data) ? payload.data : [];
            }));

            return mergeUniqueSessions(responseGroups);
        }

        async function loadPanelStats(panelKey, gameName) {
            if (statsCache.has(panelKey)) {
                setPanelValues(panelKey, statsCache.get(panelKey));
                renderGraphForPanel(panelKey);
                return;
            }

            setPanelValues(panelKey, {
                primary: '--',
                secondary: '--',
                sessions: 0,
                improvement: 0,
                improvementText: 'Loading latest sessions...',
                note: 'Loading latest sessions...',
            });

            try {
                const sessions = await fetchSessionsByGame(gameName);
                sessionsCache.set(panelKey, sessions);
                const stats = buildStatsByPanel(panelKey, sessions);
                statsCache.set(panelKey, stats);
                setPanelValues(panelKey, stats);
                renderGraphForPanel(panelKey);
            } catch (error) {
                setPanelValues(panelKey, {
                    primary: '--',
                    secondary: '--',
                    sessions: 0,
                    improvement: 0,
                    improvementText: 'Unable to calculate improvement right now.',
                    note: 'Unable to load game data right now.',
                });
                sessionsCache.set(panelKey, []);
                renderGraphForPanel(panelKey);
            }
        }

        function activateTab(tab) {
            const selectedGame = tab.getAttribute('data-game');
            const selectedGameName = tab.getAttribute('data-game-name');

            gameTabs.forEach(button => button.classList.remove('active'));
            gamePanels.forEach(panel => panel.classList.remove('active'));

            tab.classList.add('active');
            document.querySelector('[data-panel="' + selectedGame + '"]').classList.add('active');
            loadPanelStats(selectedGame, selectedGameName);
        }

        gameTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                activateTab(this);
            });
        });

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
        initializeGraphFilters();

        const initialTab = document.querySelector('.game-tab.active');
        if (initialTab) {
            activateTab(initialTab);
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeSideMenu();
            }
        });
    </script>
</body>
</html>
