<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonkeyPace - Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(140deg, #4ecdc4 0%, #99d9ba 45%, #eafaf3 100%);
            color: #1d1d1d;
            display: grid;
            place-items: center;
            padding: 28px;
        }

        .auth-shell {
            width: min(980px, 100%);
            background: #ffffff;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 26px 70px rgba(24, 70, 82, 0.24);
            display: grid;
            grid-template-columns: 1.1fr 1fr;
        }

        .auth-promo {
            background: #4ecdc4;
            padding: 48px 38px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
            color: #153a3e;
        }

        .brand img {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            object-fit: contain;
        }

        .auth-promo h1 {
            font-size: clamp(34px, 5.5vw, 56px);
            line-height: 1.05;
            margin-top: 36px;
        }

        .auth-promo p {
            margin-top: 18px;
            font-size: 17px;
            max-width: 40ch;
        }

        .auth-form-wrap {
            padding: 48px 38px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-form-wrap h2 {
            font-size: 34px;
            margin-bottom: 8px;
        }

        .auth-form-wrap .sub {
            color: #575757;
            margin-bottom: 24px;
            font-size: 15px;
        }

        .python-login-note {
            margin: -8px 0 16px;
            padding: 10px 12px;
            border-radius: 10px;
            background: #edf8f3;
            border: 1px solid #cfe9dc;
            color: #1f3330;
            font-size: 13px;
            line-height: 1.45;
        }

        .python-login-note a {
            color: #1f5d5a;
            font-weight: 700;
            text-decoration: none;
        }

        .python-login-note a:hover {
            text-decoration: underline;
        }

        form {
            display: grid;
            gap: 14px;
        }

        .field {
            display: grid;
            gap: 6px;
        }

        label {
            font-size: 14px;
            font-weight: 600;
        }

        input {
            border: 2px solid #d4e7e6;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        input:focus {
            border-color: #47b5c1;
            box-shadow: 0 0 0 4px rgba(71, 181, 193, 0.14);
        }

        .primary-btn {
            margin-top: 4px;
            border: none;
            border-radius: 999px;
            padding: 12px 20px;
            background: #2e2e2e;
            color: #ffffff;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        }

        .primary-btn:hover {
            background: #1f1f1f;
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.2);
        }

        .back-link {
            margin-top: 14px;
            display: inline-block;
            color: #1f5d5a;
            text-decoration: none;
            font-weight: 600;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 840px) {
            .auth-shell {
                grid-template-columns: 1fr;
            }

            .auth-promo {
                padding: 32px 24px;
            }

            .brand {
                font-size: 20px;
            }

            .brand img {
                width: 40px;
                height: 40px;
            }

            .auth-form-wrap {
                padding: 32px 24px;
            }
        }
    </style>
</head>
<body>
    <main class="auth-shell">
        <section class="auth-promo">
            <a class="brand" href="{{ route('home') }}" aria-label="Go to homepage">
                <img src="{{ asset('logo.png') }}?v={{ @filemtime(public_path('logo.png')) }}" alt="MonkeyPace Logo">
                <span>MonkeyPace</span>
            </a>

            <div>
                <h1>Join the Training Crew.</h1>
                <p>Create your account and start tracking reaction speed, mini-game performance, and leaderboard progress.</p>
            </div>
        </section>

        <section class="auth-form-wrap">
            <h2>Register</h2>
            <p class="sub">Create a website account if you are new.</p>
            <p class="python-login-note">
                Already have an account from the Python game?
                <a href="{{ route('login.page') }}">Use Log In</a>
                with your Username + Player ID to view your synced stats.
            </p>

            <form id="registerForm">
                <div class="field">
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" placeholder="your_username" required>
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="you@example.com" required>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" placeholder="********" required>
                </div>

                <div class="field">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="********" required>
                </div>

                <button class="primary-btn" type="submit">Create Account</button>
            </form>

            <a class="back-link" href="{{ route('login.page') }}">Back to Login</a>
        </section>
    </main>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function (event) {
            event.preventDefault();

            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                return;
            }

            const username = document.getElementById('username').value.trim();
            const email = document.getElementById('email').value.trim();

            const mockUser = {
                username: username,
                email: email,
                isNewUser: true,
                loggedInAt: new Date().toISOString()
            };

            localStorage.setItem('quickstrike_current_user', JSON.stringify(mockUser));
            window.location.href = {{ Js::from(route('home')) }};
        });
    </script>
</body>
</html>
