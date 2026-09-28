<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(160deg, #29b6d8 0%, #1a8fb3 100%);
            min-height: 100vh;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }

        .card {
            background: #fff;
            border-radius: 32px 32px 0 0;
            width: 100%;
            max-width: 430px;
            padding: 36px 28px 40px;
            min-height: 72vh;
        }

        h1 {
            color: #1a8fb3;
            font-size: 26px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 28px;
        }

        .field-label {
            color: #1a8fb3;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .field-wrap {
            margin-bottom: 18px;
        }

        .field-input {
            width: 100%;
            background: #eaf6fb;
            border: none;
            border-radius: 50px;
            padding: 13px 18px;
            font-size: 14px;
            color: #444;
            outline: none;
            font-family: inherit;
        }

        .field-input:focus {
            box-shadow: 0 0 0 2px #29b6d8;
        }

        /* TOGGLE PASSWORD BUTTON */
        .toggle-pw {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background 0.2s;
        }

        .toggle-pw:hover {
            background: rgba(26, 143, 179, 0.1);
        }

        .toggle-pw svg {
            width: 20px;
            height: 20px;
            stroke: #1a8fb3;
            fill: none;
            stroke-width: 1.8;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .field-input {
            padding-right: 45px;
            /* kasih ruang buat icon */
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .remember-left {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remember-left label {
            font-size: 13px;
            color: #555;
        }

        .remember-left input[type=checkbox] {
            width: 16px;
            height: 16px;
            accent-color: #1a8fb3;
            cursor: pointer;
        }

        .forgot {
            font-size: 13px;
            color: #1a8fb3;
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            background: #1a8fb3;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 15px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            margin-bottom: 24px;
        }

        .btn-login:hover {
            background: #157a9a;
        }

        .btn-google {
            width: 100%;
            background: #fff;
            color: #444;
            border: 1.5px solid #1a8fb3;
            border-radius: 50px;
            padding: 13px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            font-family: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-google:hover {
            background: #eaf6fb;
        }

        .g-icon {
            width: 20px;
            height: 20px;
        }

        .alert-error {
            background: #ffeaea;
            color: #c0392b;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            margin-bottom: 14px;
        }

        .register-link {
            text-align: center;
            font-size: 13px;
            color: #888;
            margin-top: 20px;
        }

        .register-link a {
            color: #1a8fb3;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Login</h1>

        @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field-wrap">
                <div class="field-label">Email</div>
                <input class="field-input" type="email" name="email" placeholder="Masukkan Email"
                    value="{{ old('email') }}" required autofocus />
            </div>

            {{-- PASSWORD --}}
            <div class="field-wrap">
                <div class="field-label">Password</div>
                <div class="input-wrap">
                    <input class="field-input" type="password" id="pw-login" name="password"
                        placeholder="Masukkan Password" required />
                    <button type="button" class="toggle-pw" onclick="togglePw('pw-login', this)"
                        title="Tampilkan password">
                        <!-- EYE ICON -->
                        <svg id="eye-login" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <!-- EYE-OFF ICON (hidden) -->
                        <svg id="eye-off-login" viewBox="0 0 24 24" style="display:none">
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94" />
                            <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19" />
                            <line x1="1" y1="1" x2="23" y2="23" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- REMEMBER ME & FORGOT PASSWORD --}}
            <div class="remember-row">
                <div class="remember-left">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                    <label for="remember">Ingat Saya</label>
                </div>
                @if (Route::has('password.request'))
                    <a class="forgot" href="{{ route('password.request') }}">Lupa Password</a>
                @endif
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>
    </div>


    <script>
        function togglePw(inputId, btn) {
            const input = document.getElementById(inputId);
            const eyeOn = document.getElementById('eye-' + inputId.replace('pw-', ''));
            const eyeOff = document.getElementById('eye-off-' + inputId.replace('pw-', ''));

            if (input.type === 'password') {
                input.type = 'text';
                eyeOn.style.display = 'none';
                eyeOff.style.display = 'block';
                btn.title = 'Sembunyikan password';
            } else {
                input.type = 'password';
                eyeOn.style.display = 'block';
                eyeOff.style.display = 'none';
                btn.title = 'Tampilkan password';
            }
        }
    </script>
</body>

</html>
