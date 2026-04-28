<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonkeyPace - Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1f3330;
            background:
                radial-gradient(circle at 12% 14%, rgba(255, 255, 255, 0.42), rgba(255, 255, 255, 0) 40%),
                radial-gradient(circle at 88% 8%, rgba(106, 196, 175, 0.32), rgba(106, 196, 175, 0) 36%),
                linear-gradient(140deg, #52cec5 0%, #9adabd 42%, #ecfbf4 100%);
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

        .page-shell {
            max-width: 1320px;
            width: min(96vw, 1320px);
            margin: 24px auto;
            background: linear-gradient(160deg, rgba(242, 255, 250, 0.88) 0%, rgba(228, 248, 239, 0.82) 100%);
            border: 2px solid rgba(55, 130, 124, 0.22);
            border-radius: 22px;
            box-shadow: 0 20px 44px rgba(12, 70, 79, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(4px);
            padding: 28px;
            flex: 1;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 22px;
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

        .profile-grid {
            display: grid;
            grid-template-columns: minmax(280px, 0.9fr) minmax(0, 1.1fr);
            gap: 18px;
        }

        .profile-column {
            display: grid;
            gap: 18px;
        }

        .profile-card,
        .summary-card,
        .sessions-card {
            background: #edf8f3;
            border: 1px solid #cfe9dc;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 8px 18px rgba(24, 78, 73, 0.08);
        }

        .summary-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }

        .summary-head .section-title {
            margin-bottom: 0;
        }

        .profile-header {
            display: flex;
            gap: 16px;
            align-items: center;
            margin-bottom: 18px;
        }

        .profile-avatar {
            width: 82px;
            height: 82px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: linear-gradient(145deg, #4ecdc4 0%, #99d9ba 100%);
            color: #153a3e;
            font-size: 30px;
            font-weight: 800;
            border: 3px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 10px 18px rgba(20, 85, 78, 0.18);
            overflow: hidden;
            flex: 0 0 auto;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-name {
            font-size: 26px;
            color: #173a3e;
            font-weight: 800;
            line-height: 1.1;
        }

        .profile-subtitle {
            margin-top: 6px;
            color: #3f6760;
            font-size: 14px;
        }

        .detail-list {
            list-style: none;
            display: grid;
            gap: 10px;
        }

        .detail-item {
            background: #ffffff;
            border: 1px solid #cfe9dc;
            border-radius: 12px;
            padding: 12px 14px;
        }

        .detail-label {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            color: #5c807a;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .detail-value {
            font-size: 15px;
            color: #1f3330;
            font-weight: 700;
            word-break: break-word;
        }

        .settings-form {
            display: grid;
            gap: 14px;
        }

        .field-row {
            display: grid;
            gap: 6px;
        }

        .field-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            color: #5c807a;
            font-weight: 700;
        }

        .field-input,
        .field-textarea,
        .field-file {
            width: 100%;
            border: 1px solid #b8d9cc;
            border-radius: 10px;
            background: #ffffff;
            color: #1f3330;
            font: inherit;
            padding: 11px 12px;
        }

        .field-input:focus,
        .field-textarea:focus,
        .field-file:focus {
            outline: none;
            border-color: #4ecdc4;
            box-shadow: 0 0 0 3px rgba(78, 205, 196, 0.14);
        }

        .field-help {
            font-size: 12px;
            color: #5c807a;
        }

        .avatar-upload-row {
            display: flex;
            gap: 14px;
            align-items: center;
            flex-wrap: wrap;
        }

        .avatar-preview {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            overflow: hidden;
            background: linear-gradient(145deg, #4ecdc4 0%, #99d9ba 100%);
            border: 3px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 10px 18px rgba(20, 85, 78, 0.18);
            display: grid;
            place-items: center;
            color: #153a3e;
            font-weight: 800;
            font-size: 26px;
            flex: 0 0 auto;
        }

        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .settings-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .action-button {
            border: 0;
            border-radius: 999px;
            padding: 11px 16px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, background-color 0.2s ease, box-shadow 0.2s ease;
        }

        .action-button:hover {
            transform: translateY(-1px);
        }

        .action-primary {
            background: #4ecdc4;
            color: #153a3e;
            box-shadow: 0 8px 14px rgba(20, 85, 78, 0.15);
        }

        .action-primary:hover {
            background: #41bbb2;
        }

        .action-secondary {
            background: #d7f0e7;
            color: #244943;
            border: 1px solid #9cdcc1;
        }

        .action-danger {
            background: #ffe1e1;
            color: #8a1f1f;
            border: 1px solid #f2b7b7;
        }

        .save-status {
            font-size: 13px;
            color: #3f6760;
            min-height: 1.2em;
        }

        .edit-panel {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #cfe9dc;
        }

        .edit-panel[hidden] {
            display: none;
        }

        .toggle-edit-button {
            border: 1px solid #9cdcc1;
            background: #d7f0e7;
            color: #244943;
            border-radius: 999px;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, background-color 0.2s ease, box-shadow 0.2s ease;
            white-space: nowrap;
        }

        .toggle-edit-button:hover {
            transform: translateY(-1px);
            background: #c7ebdd;
            box-shadow: 0 6px 12px rgba(20, 85, 78, 0.12);
        }

        .section-title {
            font-size: 20px;
            color: #173a3e;
            margin-bottom: 14px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 18px;
        }

        .stat-box {
            background: #ffffff;
            border: 1px solid #cfe9dc;
            border-radius: 12px;
            padding: 14px;
        }

        .stat-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            color: #5c807a;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .stat-value {
            font-size: 26px;
            font-weight: 800;
            color: #194348;
            line-height: 1;
        }

        .stat-note {
            margin-top: 6px;
            font-size: 13px;
            color: #446a63;
        }

        .stat-source {
            margin-top: 4px;
            font-size: 12px;
            color: #5c807a;
            font-weight: 700;
        }

        .sessions-list {
            list-style: none;
            display: grid;
            gap: 10px;
        }

        .session-item {
            background: #ffffff;
            border: 1px solid #cfe9dc;
            border-radius: 12px;
            padding: 12px 14px;
        }

        .session-top {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 6px;
        }

        .session-game {
            font-weight: 800;
            color: #173a3e;
        }

        .session-meta {
            color: #5c807a;
            font-size: 13px;
        }

        .session-details {
            color: #2f5f58;
            font-size: 14px;
            white-space: pre-line;
        }

        .empty-state,
        .logged-out-state {
            padding: 20px;
            background: #ffffff;
            border: 1px solid #cfe9dc;
            border-radius: 12px;
            color: #3f6760;
        }

        .logged-out-state a {
            color: #1f5d5a;
            font-weight: 700;
            text-decoration: none;
        }

        .logged-out-state a:hover {
            text-decoration: underline;
        }

        @media (max-width: 960px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 560px) {
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

            .page-shell {
                margin: 14px auto;
                padding: 16px;
            }

            .topbar {
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

    <main class="page-shell">
        <div class="topbar">
            <h1>Account Profile</h1>
            <a class="back-link" href="{{ route('home') }}">Back to Home</a>
        </div>

        <div id="loggedOutState" class="logged-out-state" style="display:none;">
            <strong>You are not logged in.</strong> Sign in to see your account profile, player ID, and recent sessions.
            <div style="margin-top:10px;">
                <a href="{{ route('login.page') }}">Go to Log In</a>
            </div>
        </div>

        <section id="profileContent" class="profile-grid" style="display:none;">
            <article class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar" id="profileAvatar">U</div>
                    <div>
                        <div class="profile-name" id="profileName">User</div>
                        <div class="profile-subtitle" id="profileSubtitle">Player account overview</div>
                    </div>
                </div>

                <ul class="detail-list">
                    <li class="detail-item">
                        <span class="detail-label">Username</span>
                        <span class="detail-value" id="profileUsername">--</span>
                    </li>
                    <li class="detail-item">
                        <span class="detail-label">Player ID</span>
                        <span class="detail-value" id="profilePlayerId">--</span>
                    </li>
                    <li class="detail-item">
                        <span class="detail-label">Logged In At</span>
                        <span class="detail-value" id="profileLoggedInAt">--</span>
                    </li>
                </ul>

                <div class="summary-card" style="margin-top:18px;">
                    <div class="summary-head">
                        <h2 class="section-title">Edit Account</h2>
                        <button type="button" class="toggle-edit-button" id="toggleEditAccountButton" aria-expanded="false">Edit Account</button>
                    </div>
                    <div id="editAccountPanel" class="edit-panel" hidden>
                        <form id="profileSettingsForm" class="settings-form">
                        <div class="field-row">
                            <label class="field-label" for="usernameInput">Username</label>
                            <input id="usernameInput" class="field-input" type="text" maxlength="100" placeholder="Enter a display name">
                            <div class="field-help">This updates the name shown across the website.</div>
                        </div>

                        <div class="field-row">
                            <label class="field-label" for="profilePictureInput">Profile Picture</label>
                            <div class="avatar-upload-row">
                                <div class="avatar-preview" id="avatarPreview">U</div>
                                <div style="flex:1; min-width: 240px;">
                                    <input id="profilePictureInput" class="field-file" type="file" accept="image/png,image/jpeg,image/webp,image/gif">
                                    <div class="field-help">Upload an image to replace the avatar. The image is stored in your browser for this device.</div>
                                </div>
                            </div>
                        </div>

                        <div class="field-row">
                            <label class="field-label" for="profileNoteInput">Profile Note</label>
                            <textarea id="profileNoteInput" class="field-textarea" rows="3" maxlength="180" placeholder="Optional note or bio"></textarea>
                        </div>

                        <div class="settings-actions">
                            <button type="submit" class="action-button action-primary">Save Changes</button>
                            <button type="button" class="action-button action-secondary" id="resetAvatarButton">Remove Photo</button>
                            <button type="button" class="action-button action-danger" id="resetNameButton">Reset Username</button>
                        </div>

                        <div class="save-status" id="saveStatus"></div>
                        </form>
                    </div>
                </div>

            </article>

            <div class="profile-column">
                <article class="summary-card">
                    <h2 class="section-title">Performance Summary</h2>
                    <div class="stats-grid">
                        <div class="stat-box">
                            <div class="stat-label">Sessions</div>
                            <div class="stat-value" id="summarySessions">--</div>
                            <div class="stat-note">Recent saved sessions</div>
                        </div>
                        <div class="stat-box">
                            <div class="stat-label">Best Score</div>
                            <div class="stat-value" id="summaryBestScore">--</div>
                            <div class="stat-note">Highest score recorded</div>
                            <div class="stat-source" id="summaryBestScoreGame">Game: --</div>
                        </div>
                        <div class="stat-box">
                            <div class="stat-label">Best Accuracy</div>
                            <div class="stat-value" id="summaryBestAccuracy">--</div>
                            <div class="stat-note">Top accuracy recorded</div>
                            <div class="stat-source" id="summaryBestAccuracyGame">Game: --</div>
                        </div>
                    </div>
                    <div class="stats-grid" style="margin-bottom:0;">
                        <div class="stat-box">
                            <div class="stat-label">Fastest Reaction</div>
                            <div class="stat-value" id="summaryAvgReaction">--</div>
                            <div class="stat-note">Fastest reaction time recorded</div>
                            <div class="stat-source" id="summaryAvgReactionGame">Game: --</div>
                        </div>
                        <div class="stat-box">
                            <div class="stat-label">Last Game</div>
                            <div class="stat-value" id="summaryLastGame">--</div>
                            <div class="stat-note">Most recent activity</div>
                        </div>
                        <div class="stat-box">
                            <div class="stat-label">Account Type</div>
                            <div class="stat-value" id="summaryAccountType">Player</div>
                            <div class="stat-note">Website account view</div>
                        </div>
                    </div>
                </article>

                <article class="sessions-card">
                    <h2 class="section-title">Recent Sessions</h2>
                    <ul id="recentSessions" class="sessions-list"></ul>
                    <div id="noSessionsState" class="empty-state" style="display:none; margin-top: 0;">No saved sessions were found for this account yet.</div>
                </article>
            </div>
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
        const reactionSessionsApiUrl = {{ Js::from(route('api.reaction-sessions.index')) }};
        const profileStorageKey = 'quickstrike_current_user';
        const profilePictureKey = 'quickstrike_profile_picture';
        const profileNoteKey = 'quickstrike_profile_note';

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
            localStorage.removeItem(profileStorageKey);
            localStorage.removeItem(profilePictureKey);
            localStorage.removeItem(profileNoteKey);
            closeSideMenu();
            updateAuthButtonsVisibility();
            window.location.reload();
        }

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

        function formatDateTime(value) {
            if (!value) {
                return '--';
            }

            const date = new Date(value);
            if (Number.isNaN(date.getTime())) {
                return '--';
            }

            return date.toLocaleString();
        }

        function formatMilliseconds(ms) {
            if (ms === null || ms === undefined || ms === '') {
                return '--';
            }

            return (Number(ms) / 1000).toFixed(2) + 's';
        }

        function formatAccuracy(session) {
            if (session.meta && session.meta.accuracy !== undefined && session.meta.accuracy !== null) {
                return Number(session.meta.accuracy).toFixed(1) + '%';
            }

            if (session.attempts && session.hits !== undefined && session.hits !== null) {
                const accuracy = session.attempts > 0 ? (Number(session.hits) / Number(session.attempts)) * 100 : null;
                return accuracy === null ? '--' : accuracy.toFixed(1) + '%';
            }

            return '--';
        }

        function getSessionDifficulty(session) {
            const value = (session.meta && session.meta.difficulty) || session.difficulty || null;
            return value ? String(value).charAt(0).toUpperCase() + String(value).slice(1) : 'Unknown';
        }

        function formatGameName(gameName) {
            if (!gameName) {
                return '--';
            }

            return String(gameName).replace(/-/g, ' ');
        }

        function getAccuracyValue(session) {
            if (session.meta && session.meta.accuracy !== undefined && session.meta.accuracy !== null) {
                const accuracy = Number(session.meta.accuracy);
                return Number.isFinite(accuracy) ? accuracy : null;
            }

            if (session.attempts && session.hits !== undefined && session.hits !== null) {
                return session.attempts > 0 ? (Number(session.hits) / Number(session.attempts)) * 100 : null;
            }

            return null;
        }

        function getSessionReactionTime(session) {
            const reactionTime = Number(session.avg_reaction_time_ms);
            return Number.isFinite(reactionTime) ? reactionTime : null;
        }

        function getBestMetricSessions(sessions) {
            const bestScoreSession = sessions.reduce((bestSession, session) => {
                const bestScore = Number(bestSession?.score);
                const currentScore = Number(session.score);

                if (!Number.isFinite(currentScore)) {
                    return bestSession;
                }

                if (!bestSession || !Number.isFinite(bestScore) || currentScore > bestScore) {
                    return session;
                }

                return bestSession;
            }, null);

            const bestAccuracySession = sessions.reduce((bestSession, session) => {
                const bestAccuracy = getAccuracyValue(bestSession || {});
                const currentAccuracy = getAccuracyValue(session);

                if (currentAccuracy === null) {
                    return bestSession;
                }

                if (!bestSession || bestAccuracy === null || currentAccuracy > bestAccuracy) {
                    return session;
                }

                return bestSession;
            }, null);

            const fastestReactionSession = sessions.reduce((bestSession, session) => {
                const bestReaction = getSessionReactionTime(bestSession || {});
                const currentReaction = getSessionReactionTime(session);

                if (currentReaction === null) {
                    return bestSession;
                }

                if (!bestSession || bestReaction === null || currentReaction < bestReaction) {
                    return session;
                }

                return bestSession;
            }, null);

            return {
                bestScoreSession,
                bestAccuracySession,
                fastestReactionSession,
            };
        }

        function getStoredProfilePicture() {
            const storedValue = localStorage.getItem(profilePictureKey);
            return storedValue && storedValue !== 'null' ? storedValue : '';
        }

        function getStoredProfileNote() {
            const storedValue = localStorage.getItem(profileNoteKey);
            return storedValue && storedValue !== 'null' ? storedValue : '';
        }

        function buildDefaultAvatar(initials) {
            return `<span>${initials}</span>`;
        }

        function renderAvatarPreview(displayName, avatarDataUrl) {
            const preview = document.getElementById('avatarPreview');
            const initials = displayName ? displayName.charAt(0).toUpperCase() : 'U';

            if (avatarDataUrl) {
                preview.innerHTML = `<img src="${avatarDataUrl}" alt="Profile picture preview">`;
                return;
            }

            preview.innerHTML = buildDefaultAvatar(initials);
        }

        function setSaveStatus(message, isError = false) {
            const saveStatus = document.getElementById('saveStatus');
            saveStatus.textContent = message;
            saveStatus.style.color = isError ? '#8a1f1f' : '#3f6760';
        }

        function setEditPanelVisibility(isVisible) {
            const editPanel = document.getElementById('editAccountPanel');
            const toggleButton = document.getElementById('toggleEditAccountButton');

            editPanel.hidden = !isVisible;
            toggleButton.setAttribute('aria-expanded', isVisible ? 'true' : 'false');
            toggleButton.textContent = isVisible ? 'Cancel' : 'Edit Account';
        }
        function normalizeProfileUser(currentUser) {
            return {
                ...currentUser,
                username: currentUser.username || currentUser.name || 'User',
                name: currentUser.name || currentUser.username || 'User',
                avatarDataUrl: currentUser.avatarDataUrl || getStoredProfilePicture(),
                profileNote: currentUser.profileNote || getStoredProfileNote(),
            };
        }

        function persistProfileUser(nextUser) {
            localStorage.setItem(profileStorageKey, JSON.stringify(nextUser));
            if (nextUser.avatarDataUrl) {
                localStorage.setItem(profilePictureKey, nextUser.avatarDataUrl);
            } else {
                localStorage.removeItem(profilePictureKey);
            }

            if (nextUser.profileNote) {
                localStorage.setItem(profileNoteKey, nextUser.profileNote);
            } else {
                localStorage.removeItem(profileNoteKey);
            }
        }

        async function loadProfileSessions(currentUser) {
            const params = new URLSearchParams();
            params.set('limit', '12');

            if (currentUser.playerId) {
                params.set('source_player_id', String(currentUser.playerId));
            } else if (currentUser.userId) {
                params.set('user_id', String(currentUser.userId));
            } else {
                return [];
            }

            const response = await fetch(reactionSessionsApiUrl + '?' + params.toString(), {
                headers: {
                    Accept: 'application/json',
                },
            });

            if (!response.ok) {
                throw new Error('Unable to load sessions.');
            }

            const payload = await response.json();
            return Array.isArray(payload.data) ? payload.data : [];
        }

        function renderProfile(currentUser, sessions) {
            const profileContent = document.getElementById('profileContent');
            const loggedOutState = document.getElementById('loggedOutState');
            const settingsForm = document.getElementById('profileSettingsForm');

            if (!currentUser) {
                loggedOutState.style.display = '';
                profileContent.style.display = 'none';
                return;
            }

            const normalizedUser = normalizeProfileUser(currentUser);
            loggedOutState.style.display = 'none';
            profileContent.style.display = '';

            const displayName = normalizedUser.name || normalizedUser.username || 'User';
            const playerId = normalizedUser.playerId || '--';
            settingsForm.dataset.originalUsername = normalizedUser.username || '';
            document.getElementById('usernameInput').value = normalizedUser.username || '';
            document.getElementById('profileNoteInput').value = normalizedUser.profileNote || '';
            renderAvatarPreview(displayName, normalizedUser.avatarDataUrl || '');
            document.getElementById('profileAvatar').innerHTML = normalizedUser.avatarDataUrl
                ? `<img src="${normalizedUser.avatarDataUrl}" alt="Profile picture">`
                : displayName.charAt(0).toUpperCase();
            document.getElementById('profileName').textContent = displayName;
            document.getElementById('profileSubtitle').textContent = 'Account profile for your MonkeyPace training progress';
            document.getElementById('profileUsername').textContent = displayName;
            document.getElementById('profilePlayerId').textContent = playerId;
            document.getElementById('profileLoggedInAt').textContent = formatDateTime(normalizedUser.loggedInAt);

            const bestScore = sessions.reduce((highest, session) => {
                const score = Number(session.score);
                return Number.isFinite(score) && score > highest ? score : highest;
            }, 0);
            const accuracies = sessions
                .map((session) => getAccuracyValue(session))
                .filter((value) => value !== null && Number.isFinite(value));

            const reactionTimes = sessions
                .map((session) => getSessionReactionTime(session))
                .filter((value) => value !== null && value >= 0);
            const bestMetrics = getBestMetricSessions(sessions);

            document.getElementById('summarySessions').textContent = String(sessions.length);
            document.getElementById('summaryBestScore').textContent = sessions.length ? String(bestScore) : '--';
            document.getElementById('summaryBestScoreGame').textContent = sessions.length && bestMetrics.bestScoreSession
                ? 'Game: ' + formatGameName(bestMetrics.bestScoreSession.game_name)
                : 'Game: --';
            document.getElementById('summaryBestAccuracy').textContent = accuracies.length ? Math.max(...accuracies).toFixed(1) + '%' : '--';
            document.getElementById('summaryBestAccuracyGame').textContent = bestMetrics.bestAccuracySession
                ? 'Game: ' + formatGameName(bestMetrics.bestAccuracySession.game_name)
                : 'Game: --';
            document.getElementById('summaryAvgReaction').textContent = reactionTimes.length ? formatMilliseconds(Math.round(reactionTimes.reduce((sum, value) => sum + value, 0) / reactionTimes.length)) : '--';
            document.getElementById('summaryAvgReactionGame').textContent = bestMetrics.fastestReactionSession
                ? 'Game: ' + formatGameName(bestMetrics.fastestReactionSession.game_name)
                : 'Game: --';
            document.getElementById('summaryLastGame').textContent = sessions.length ? sessions[0].game_name.replace(/-/g, ' ') : '--';

            const recentSessions = document.getElementById('recentSessions');
            const noSessionsState = document.getElementById('noSessionsState');

            if (!sessions.length) {
                recentSessions.innerHTML = '';
                noSessionsState.style.display = '';
                return;
            }

            noSessionsState.style.display = 'none';
            recentSessions.innerHTML = sessions.map((session) => {
                const dateLabel = formatDateTime(session.created_at);
                const difficulty = getSessionDifficulty(session);
                const reactionLabel = formatMilliseconds(session.avg_reaction_time_ms);
                return `
                    <li class="session-item">
                        <div class="session-top">
                            <span class="session-game">${session.game_name.replace(/-/g, ' ')}</span>
                            <span class="session-meta">${dateLabel}</span>
                        </div>
                        <div class="session-details">Score: ${session.score ?? '--'} | Accuracy: ${formatAccuracy(session)} | Reaction: ${reactionLabel} | Difficulty: ${difficulty}</div>
                    </li>
                `;
            }).join('');

            document.getElementById('profileSettingsForm').onsubmit = function (event) {
                event.preventDefault();

                const currentUserRaw = localStorage.getItem(profileStorageKey);
                const storedUser = currentUserRaw && currentUserRaw !== 'null' ? JSON.parse(currentUserRaw) : normalizedUser;
                const nextUsername = document.getElementById('usernameInput').value.trim();
                const nextNote = document.getElementById('profileNoteInput').value.trim();

                if (!nextUsername) {
                    setSaveStatus('Username cannot be empty.', true);
                    return;
                }

                const nextUser = {
                    ...storedUser,
                    username: nextUsername,
                    name: nextUsername,
                    profileNote: nextNote,
                    avatarDataUrl: storedUser.avatarDataUrl || normalizedUser.avatarDataUrl || '',
                };

                persistProfileUser(nextUser);
                renderAvatarPreview(nextUsername, nextUser.avatarDataUrl || '');
                document.getElementById('profileAvatar').innerHTML = nextUser.avatarDataUrl
                    ? `<img src="${nextUser.avatarDataUrl}" alt="Profile picture">`
                    : nextUsername.charAt(0).toUpperCase();
                document.getElementById('profileName').textContent = nextUsername;
                document.getElementById('profileUsername').textContent = nextUsername;
                updateAuthButtonsVisibility();
                setSaveStatus('Profile updated.');
            };

            document.getElementById('profilePictureInput').onchange = function () {
                const file = this.files && this.files[0];
                if (!file) {
                    return;
                }

                if (!file.type.startsWith('image/')) {
                    setSaveStatus('Please choose an image file.', true);
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (loadEvent) {
                    const avatarDataUrl = String(loadEvent.target.result || '');
                    const currentUserRaw = localStorage.getItem(profileStorageKey);
                    const storedUser = currentUserRaw && currentUserRaw !== 'null' ? JSON.parse(currentUserRaw) : normalizedUser;
                    const nextUser = {
                        ...storedUser,
                        username: document.getElementById('usernameInput').value.trim() || storedUser.username || displayName,
                        name: document.getElementById('usernameInput').value.trim() || storedUser.name || displayName,
                        profileNote: document.getElementById('profileNoteInput').value.trim(),
                        avatarDataUrl: avatarDataUrl,
                    };

                    persistProfileUser(nextUser);
                    renderAvatarPreview(nextUser.username, avatarDataUrl);
                    document.getElementById('profileAvatar').innerHTML = `<img src="${avatarDataUrl}" alt="Profile picture">`;
                    updateAuthButtonsVisibility();
                    setSaveStatus('Profile picture updated.');
                };

                reader.onerror = function () {
                    setSaveStatus('Unable to read that image file.', true);
                };

                reader.readAsDataURL(file);
            };

            document.getElementById('resetAvatarButton').onclick = function () {
                const currentUserRaw = localStorage.getItem(profileStorageKey);
                const storedUser = currentUserRaw && currentUserRaw !== 'null' ? JSON.parse(currentUserRaw) : normalizedUser;
                const nextUser = {
                    ...storedUser,
                    avatarDataUrl: '',
                    profileNote: document.getElementById('profileNoteInput').value.trim(),
                };

                persistProfileUser(nextUser);
                document.getElementById('profilePictureInput').value = '';
                renderAvatarPreview(document.getElementById('usernameInput').value.trim() || displayName, '');
                document.getElementById('profileAvatar').textContent = (document.getElementById('usernameInput').value.trim() || displayName).charAt(0).toUpperCase();
                updateAuthButtonsVisibility();
                setSaveStatus('Profile picture removed.');
            };

            document.getElementById('resetNameButton').onclick = function () {
                const fallbackName = normalizedUser.username || normalizedUser.name || 'User';
                document.getElementById('usernameInput').value = fallbackName;
                document.getElementById('profileName').textContent = fallbackName;
                document.getElementById('profileUsername').textContent = fallbackName;
                setSaveStatus('Username reset to the current account name.');
            };
        }

        async function initializeProfilePage() {
            const currentUserRaw = localStorage.getItem('quickstrike_current_user');
            const currentUser = currentUserRaw && currentUserRaw !== 'null' ? JSON.parse(currentUserRaw) : null;

            updateAuthButtonsVisibility();

            document.getElementById('toggleEditAccountButton').onclick = function () {
                const editPanel = document.getElementById('editAccountPanel');
                setEditPanelVisibility(editPanel.hidden);
            };

            setEditPanelVisibility(false);

            if (!currentUser) {
                renderProfile(null, []);
                return;
            }

            try {
                const sessions = await loadProfileSessions(currentUser);
                renderProfile(currentUser, sessions);
            } catch (error) {
                renderProfile(currentUser, []);
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeSideMenu();
            }
        });

        document.addEventListener('DOMContentLoaded', initializeProfilePage);
    </script>
</body>
</html>