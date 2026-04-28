<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonkeyPace - Leaderboard</title>
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
            margin-bottom: 16px;
            color: #2e5450;
            font-size: clamp(15px, 2vw, 18px);
        }

        .filters-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 12px;
            margin-top: 12px;
            margin-bottom: 18px;
        }

        .filter-group {
            background: #edf8f3;
            border: 1px solid #cfe9dc;
            border-radius: 10px;
            padding: 10px 12px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .filter-label {
            font-size: 12px;
            font-weight: 700;
            color: #355f59;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        .filter-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .filter-button {
            border: 1px solid #9bd5c3;
            border-radius: 8px;
            padding: 7px 11px;
            font-size: 14px;
            color: #1f4744;
            background: #ffffff;
            cursor: pointer;
            transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
        }

        .filter-button:hover {
            transform: translateY(-1px);
            border-color: #72c9bb;
            background: #f4fbf8;
        }

        .filter-button.active {
            background: #4ecdc4;
            color: #ffffff;
            border-color: #4ecdc4;
            box-shadow: 0 8px 14px rgba(20, 85, 78, 0.15);
        }

        .filter-button:focus {
            border-color: #4ecdc4;
            box-shadow: 0 0 0 3px rgba(78, 205, 196, 0.2);
            outline: none;
        }

        .game-tabs {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
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

        .board-wrap {
            background: linear-gradient(170deg, #ffffff 0%, #f7fdfa 100%);
            border: 2px solid #d8eee5;
            border-radius: 16px;
            padding: 20px;
            overflow-x: auto;
        }

        .leaderboard-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 760px;
        }

        .leaderboard-table th,
        .leaderboard-table td {
            text-align: left;
            padding: 11px 10px;
            border-bottom: 1px solid #d8eee5;
            color: #244943;
            font-size: 14px;
        }

        .leaderboard-table th {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            color: #355f59;
            background: #edf8f3;
            position: sticky;
            top: 0;
        }

        .rank-cell {
            font-weight: 800;
            color: #153a3e;
            width: 60px;
        }

        .player-cell {
            font-weight: 700;
            color: #173a3e;
        }

        .empty-state {
            padding: 30px 14px;
            text-align: center;
            color: #3f6760;
            font-size: 15px;
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
            <h1>Leaderboard</h1>
            <a class="back-link" href="{{ route('home') }}">Back to Home</a>
        </div>
        <p class="subtitle">Top player performance by game. Showing highest score, highest accuracy, longest played, and total sessions.</p>

        <div class="game-tabs" id="gameTabs"></div>

        <div class="filters-row">
            <div class="filter-group">
                <div class="filter-label">Difficulty</div>
                <div id="difficultyFilter" class="filter-buttons" role="group" aria-label="Difficulty filter">
                    <button type="button" class="filter-button" data-difficulty="all">All Difficulties</button>
                    <button type="button" class="filter-button" data-difficulty="easy">Easy</button>
                    <button type="button" class="filter-button" data-difficulty="normal">Normal</button>
                    <button type="button" class="filter-button" data-difficulty="hard">Hard</button>
                    <button type="button" class="filter-button" data-difficulty="extreme">Extreme</button>
                </div>
            </div>
            <div class="filter-group">
                <div class="filter-label">Ranking Mode</div>
                <div id="sortFilter" class="filter-buttons" role="group" aria-label="Ranking mode filter">
                    <button type="button" class="filter-button" data-sort="highest_score">Highest Score</button>
                    <button type="button" class="filter-button" data-sort="most_accurate">Most Accurate</button>
                    <button type="button" class="filter-button" data-sort="most_sessions">Most Sessions</button>
                    <button type="button" class="filter-button" data-sort="fastest_reaction" style="display:none;" id="fastestReactionBtn">Fastest Reaction</button>
                    <button type="button" class="filter-button" data-sort="highest_combo" style="display:none;" id="highestComboBtn">Highest Combo</button>
                    <button type="button" class="filter-button" data-sort="longest_played" style="display:none;" id="longestPlayedBtn">Longest Played</button>
                    <button type="button" class="filter-button" data-sort="fastest_solve" style="display:none;" id="fastestSolveBtn">Fastest Solve Time</button>
                </div>
            </div>
        </div>

        <section class="board-wrap">
            <div id="boardContent" class="empty-state">Loading leaderboard...</div>
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
        const leaderboardApiUrl = {{ Js::from(route('api.leaderboard.index')) }};
        const queryParams = new URLSearchParams(window.location.search);
        const selectedFromQuery = queryParams.get('game');
        const difficultyFromQuery = queryParams.get('difficulty');
        const sortFromQuery = queryParams.get('sort');
        const gameOrder = ['jungle-rush', 'rapid-tiles', 'monkey-ball', 'math-quest'];
        let currentGame = normalizeGameName(selectedFromQuery);
        let currentDifficulty = normalizeDifficulty(difficultyFromQuery);
        let currentSort = normalizeSort(sortFromQuery);

        function canonicalizeGameKey(name) {
            const normalized = normalizeGameName(name);

            if (normalized === 'shape-match-hue') {
                return 'jungle-rush';
            }

            if (normalized === 'test-game') {
                return null;
            }

            return normalized;
        }

        function normalizeGameName(name) {
            return String(name || '')
                .trim()
                .replace(/([a-z])([A-Z])/g, '$1-$2')
                .toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        }

        function normalizeDifficulty(value) {
            const normalized = String(value || 'all').trim().toLowerCase();
            return ['all', 'easy', 'normal', 'hard', 'extreme'].includes(normalized) ? normalized : 'all';
        }

        function normalizeSort(value) {
            const normalized = String(value || 'highest_score').trim().toLowerCase();
            return ['highest_score', 'most_accurate', 'most_sessions', 'fastest_reaction', 'highest_combo', 'longest_played', 'fastest_solve'].includes(normalized) ? normalized : 'highest_score';
        }

        function toTitleCase(text) {
            return String(text || '')
                .split('-')
                .map((part) => part.charAt(0).toUpperCase() + part.slice(1))
                .join(' ');
        }

        function formatDuration(ms) {
            if (ms === null || ms === undefined) {
                return '--';
            }

            const totalSeconds = Math.floor(Number(ms) / 1000);
            const minutes = Math.floor(totalSeconds / 60);
            const seconds = totalSeconds % 60;
            return minutes + 'm ' + seconds.toString().padStart(2, '0') + 's';
        }

        function mergePlayerSummaries(existingPlayer, incomingPlayer) {
            const numericFields = ['highest_score', 'highest_accuracy', 'longest_played_ms', 'fastest_reaction_ms', 'highest_combo', 'best_hits', 'fastest_solve_time_ms'];
            const mergedPlayer = {
                player_name: existingPlayer.player_name || incomingPlayer.player_name || 'Unknown Player',
                sessions_played: (existingPlayer.sessions_played ?? 0) + (incomingPlayer.sessions_played ?? 0),
            };

            numericFields.forEach((field) => {
                const leftValue = existingPlayer[field];
                const rightValue = incomingPlayer[field];

                if (field === 'fastest_reaction_ms' || field === 'fastest_solve_time_ms') {
                    const candidates = [leftValue, rightValue].filter((value) => value !== null && value !== undefined && !Number.isNaN(Number(value)));
                    mergedPlayer[field] = candidates.length ? Math.min(...candidates.map((value) => Number(value))) : null;
                    return;
                }

                if (field === 'highest_accuracy') {
                    const candidates = [leftValue, rightValue].filter((value) => value !== null && value !== undefined && !Number.isNaN(Number(value)));
                    mergedPlayer[field] = candidates.length ? Math.max(...candidates.map((value) => Number(value))) : null;
                    return;
                }

                const leftNumeric = Number.isFinite(Number(leftValue)) ? Number(leftValue) : null;
                const rightNumeric = Number.isFinite(Number(rightValue)) ? Number(rightValue) : null;

                if (leftNumeric === null && rightNumeric === null) {
                    mergedPlayer[field] = null;
                } else {
                    mergedPlayer[field] = Math.max(leftNumeric ?? 0, rightNumeric ?? 0);
                }
            });

            if (mergedPlayer.highest_score === null) {
                mergedPlayer.highest_score = 0;
            }

            return mergedPlayer;
        }

        function consolidateGameEntries(games) {
            const mergedGames = new Map();

            games.forEach((game) => {
                const canonicalKey = canonicalizeGameKey(game.game_name);

                if (!canonicalKey) {
                    return;
                }

                const existingGame = mergedGames.get(canonicalKey);
                const incomingPlayers = Array.isArray(game.players) ? game.players : [];

                if (!existingGame) {
                    mergedGames.set(canonicalKey, {
                        ...game,
                        game_name: canonicalKey,
                        players: incomingPlayers.map((player) => ({ ...player })),
                    });
                    return;
                }

                const playerIndex = new Map(
                    existingGame.players.map((player, index) => [String(player.player_name || 'Unknown Player'), index])
                );

                incomingPlayers.forEach((incomingPlayer) => {
                    const playerName = String(incomingPlayer.player_name || 'Unknown Player');
                    const existingIndex = playerIndex.get(playerName);

                    if (existingIndex === undefined) {
                        existingGame.players.push({ ...incomingPlayer });
                        playerIndex.set(playerName, existingGame.players.length - 1);
                        return;
                    }

                    existingGame.players[existingIndex] = mergePlayerSummaries(existingGame.players[existingIndex], incomingPlayer);
                });
            });

            return sortGamesByFixedOrder(Array.from(mergedGames.values()));
        }

        function sortGamesByFixedOrder(games) {
            const fallbackIndex = gameOrder.length + 10;
            return [...games].sort((left, right) => {
                const leftKey = canonicalizeGameKey(left.game_name) || '';
                const rightKey = canonicalizeGameKey(right.game_name) || '';
                const leftIndex = gameOrder.indexOf(leftKey);
                const rightIndex = gameOrder.indexOf(rightKey);
                const normalizedLeft = leftIndex === -1 ? fallbackIndex : leftIndex;
                const normalizedRight = rightIndex === -1 ? fallbackIndex : rightIndex;

                if (normalizedLeft !== normalizedRight) {
                    return normalizedLeft - normalizedRight;
                }

                return leftKey.localeCompare(rightKey);
            });
        }

        function updateFilterVisibility(gameKey) {
            const fastestReactionBtn = document.getElementById('fastestReactionBtn');
            const highestComboBtn = document.getElementById('highestComboBtn');
            const longestPlayedBtn = document.getElementById('longestPlayedBtn');
            const fastestSolveBtn = document.getElementById('fastestSolveBtn');
            const isJungleRush = gameKey === 'jungle-rush';
            const isRapidTiles = gameKey === 'rapid-tiles';
            const isMonkeyBall = gameKey === 'monkey-ball';
            const isMathQuest = gameKey === 'math-quest';
            
            fastestReactionBtn.style.display = isJungleRush ? '' : 'none';
            highestComboBtn.style.display = isRapidTiles ? '' : 'none';
            longestPlayedBtn.style.display = isMonkeyBall ? '' : 'none';
            fastestSolveBtn.style.display = isMathQuest ? '' : 'none';
            
            // If fastest_reaction is selected but game is not Jungle Rush, reset to highest_score
            if (!isJungleRush && currentSort === 'fastest_reaction') {
                currentSort = 'highest_score';
            }
            
            // If highest_combo is selected but game is not Rapid Tiles, reset to highest_score
            if (!isRapidTiles && currentSort === 'highest_combo') {
                currentSort = 'highest_score';
            }
            
            // If longest_played is selected but game is not MonkeyBall, reset to highest_score
            if (!isMonkeyBall && currentSort === 'longest_played') {
                currentSort = 'highest_score';
            }
            
            // If fastest_solve is selected but game is not Math Quest, reset to highest_score
            if (!isMathQuest && currentSort === 'fastest_solve') {
                currentSort = 'highest_score';
            }
        }

        function renderTabs(games, activeGame) {
            const tabsRoot = document.getElementById('gameTabs');
            tabsRoot.innerHTML = games.map((game) => {
                const gameKey = canonicalizeGameKey(game.game_name) || normalizeGameName(game.game_name);
                const isActive = gameKey === activeGame;
                return '<button type="button" class="game-tab' + (isActive ? ' active' : '') + '" data-game="' + gameKey + '">' + toTitleCase(gameKey) + '</button>';
            }).join('');

            tabsRoot.querySelectorAll('.game-tab').forEach((button) => {
                button.addEventListener('click', function () {
                    const gameKey = this.getAttribute('data-game');
                    currentGame = gameKey;
                    updateFilterVisibility(gameKey);
                    updateUrlState();
                    renderLeaderboard(gameKey);
                });
            });
        }

        function updateUrlState() {
            const url = new URL(window.location.href);
            if (currentGame) {
                url.searchParams.set('game', currentGame);
            } else {
                url.searchParams.delete('game');
            }

            url.searchParams.set('difficulty', currentDifficulty);
            url.searchParams.set('sort', currentSort);
            window.history.replaceState({}, '', url.toString());
        }

        function initializeFilters() {
            const difficultyButtons = document.querySelectorAll('#difficultyFilter .filter-button');
            const sortButtons = document.querySelectorAll('#sortFilter .filter-button');

            function syncActiveButtons() {
                difficultyButtons.forEach((button) => {
                    const isActive = button.getAttribute('data-difficulty') === currentDifficulty;
                    button.classList.toggle('active', isActive);
                    button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
                });

                sortButtons.forEach((button) => {
                    const isActive = button.getAttribute('data-sort') === currentSort;
                    button.classList.toggle('active', isActive);
                    button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
                });
            }

            difficultyButtons.forEach((button) => {
                button.addEventListener('click', function () {
                    currentDifficulty = normalizeDifficulty(this.getAttribute('data-difficulty'));
                    syncActiveButtons();
                    updateUrlState();
                    renderLeaderboard(currentGame);
                });
            });

            sortButtons.forEach((button) => {
                button.addEventListener('click', function () {
                    currentSort = normalizeSort(this.getAttribute('data-sort'));
                    syncActiveButtons();
                    updateUrlState();
                    renderLeaderboard(currentGame);
                });
            });

            syncActiveButtons();
        }

        function renderTable(game) {
            const board = document.getElementById('boardContent');
            const players = game.players || [];
            const gameName = normalizeGameName(game.game_name);
            const isJungleRush = gameName === 'jungle-rush';
            const isRapidTiles = gameName === 'rapid-tiles';
            const isMonkeyBall = gameName === 'monkey-ball';
            const isMathQuest = gameName === 'math-quest';

            if (!players.length) {
                board.className = 'empty-state';
                board.textContent = 'No leaderboard data available for this game yet.';
                return;
            }

            const rows = players.map((player, index) => {
                const accuracy = player.highest_accuracy === null || player.highest_accuracy === undefined
                    ? '--'
                    : Number(player.highest_accuracy).toFixed(1) + '%';

                let fifthColumn = '';
                if (isJungleRush) {
                    fifthColumn = player.fastest_reaction_ms !== null && player.fastest_reaction_ms !== undefined
                        ? player.fastest_reaction_ms + 'ms'
                        : '--';
                } else if (isRapidTiles) {
                    fifthColumn = player.highest_combo !== null && player.highest_combo !== undefined
                        ? player.highest_combo
                        : '--';
                } else if (isMonkeyBall) {
                    fifthColumn = formatDuration(player.longest_played_ms);
                } else if (isMathQuest) {
                    fifthColumn = player.fastest_solve_time_ms !== null && player.fastest_solve_time_ms !== undefined
                        ? player.fastest_solve_time_ms + 'ms'
                        : '--';
                } else {
                    fifthColumn = formatDuration(player.longest_played_ms);
                }

                return '<tr>' +
                    '<td class="rank-cell">#' + (index + 1) + '</td>' +
                    '<td class="player-cell">' + (player.player_name || 'Unknown Player') + '</td>' +
                    '<td>' + (player.highest_score ?? 0) + '</td>' +
                    '<td>' + accuracy + '</td>' +
                    '<td>' + fifthColumn + '</td>' +
                    '<td>' + (player.sessions_played ?? 0) + '</td>' +
                '</tr>';
            }).join('');

            let fifthColumnHeader = 'Longest Played';
            if (isJungleRush) {
                fifthColumnHeader = 'Fastest Reaction';
            } else if (isRapidTiles) {
                fifthColumnHeader = 'Highest Combo';
            } else if (isMonkeyBall) {
                fifthColumnHeader = 'Longest Played';
            } else if (isMathQuest) {
                fifthColumnHeader = 'Fastest Solve Time';
            }

            board.className = '';
            board.innerHTML =
                '<table class="leaderboard-table">' +
                    '<thead>' +
                        '<tr>' +
                            '<th>Rank</th>' +
                            '<th>Player</th>' +
                            '<th>Highest Score</th>' +
                            '<th>Highest Accuracy</th>' +
                            '<th>' + fifthColumnHeader + '</th>' +
                            '<th>Sessions</th>' +
                        '</tr>' +
                    '</thead>' +
                    '<tbody>' + rows + '</tbody>' +
                '</table>';
        }

        async function renderLeaderboard(activeGameOverride = null) {
            const board = document.getElementById('boardContent');
            board.className = 'empty-state';
            board.textContent = 'Loading leaderboard...';

            try {
                const apiUrl = new URL(leaderboardApiUrl, window.location.origin);
                apiUrl.searchParams.set('difficulty', currentDifficulty);
                apiUrl.searchParams.set('sort_by', currentSort);

                const response = await fetch(apiUrl.toString(), {
                    headers: {
                        'Accept': 'application/json',
                    },
                });

                const payload = await response.json();
                const apiGames = Array.isArray(payload.data) ? payload.data : [];
                const games = consolidateGameEntries(apiGames);

                if (!games.length) {
                    board.textContent = 'No leaderboard data yet. Play sessions to start ranking players.';
                    document.getElementById('gameTabs').innerHTML = '';
                    return;
                }

                const preferred = canonicalizeGameKey(activeGameOverride || currentGame) || normalizeGameName(activeGameOverride || currentGame);
                const fallback = canonicalizeGameKey(games[0].game_name) || normalizeGameName(games[0].game_name);
                const activeGame = games.some((game) => (canonicalizeGameKey(game.game_name) || normalizeGameName(game.game_name)) === preferred)
                    ? preferred
                    : fallback;

                currentGame = activeGame;
                updateUrlState();
                updateFilterVisibility(activeGame);
                renderTabs(games, activeGame);
                const selectedGame = games.find((game) => (canonicalizeGameKey(game.game_name) || normalizeGameName(game.game_name)) === activeGame) || games[0];
                renderTable(selectedGame);
            } catch (error) {
                board.className = 'empty-state';
                board.textContent = 'Unable to load leaderboard right now.';
            }
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
            updateAuthButtonsVisibility();
            window.location.reload();
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeSideMenu();
            }
        });

        updateAuthButtonsVisibility();
        initializeFilters();
        renderLeaderboard();
    </script>
</body>
</html>
