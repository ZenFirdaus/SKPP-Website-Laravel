<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Daftar Akun</title>
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
            padding: 30px 28px 40px;
            min-height: 78vh;
        }

        h1 {
            color: #1a8fb3;
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 22px;
        }

        .field-label {
            color: #1a8fb3;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .field-wrap {
            margin-bottom: 15px;
        }

        /* INPUT WRAPPER */
        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .field-input {
            width: 100%;
            background: #eaf6fb;
            border: none;
            border-radius: 50px;
            padding: 12px 18px;
            font-size: 14px;
            color: #444;
            outline: none;
            font-family: inherit;
        }

        .field-input:focus {
            box-shadow: 0 0 0 2px #29b6d8;
        }

        .field-input.is-invalid {
            box-shadow: 0 0 0 2px #e74c3c;
        }

        .invalid-feedback {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 4px;
            padding-left: 12px;
        }

        /* TOGGLE PASSWORD */
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

        .alert-error {
            background: #ffeaea;
            color: #c0392b;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            margin-bottom: 14px;
        }

        .btn-register {
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
            margin-top: 6px;
            margin-bottom: 16px;
        }

        .btn-register:hover {
            background: #157a9a;
        }

        .login-link {
            text-align: center;
            font-size: 13px;
            color: #888;
        }

        .login-link a {
            color: #1a8fb3;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Daftar Akun</h1>

        @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="field-wrap">
                <div class="field-label">Nama Lengkap</div>
                <input class="field-input {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                    placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}" required autofocus />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="field-wrap">
                <div class="field-label">Username</div>
                <input class="field-input {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text"
                    name="username" placeholder="Masukkan Username" value="{{ old('username') }}" required />
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="field-wrap">
                <div class="field-label">E-mail</div>
                <input class="field-input {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                    placeholder="Masukkan Email" value="{{ old('email') }}" required />
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="field-wrap">
                <div class="field-label">Password</div>
                <div class="input-wrap">
                    <input class="field-input {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                        id="pw-reg" name="password" placeholder="Masukkan Password" required />
                    <button type="button" class="toggle-pw" onclick="togglePw('pw-reg')" title="Tampilkan password">
                        <svg id="eye-pw-reg" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <svg id="eye-off-pw-reg" viewBox="0 0 24 24" style="display:none">
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94" />
                            <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19" />
                            <line x1="1" y1="1" x2="23" y2="23" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="field-wrap">
                <div class="field-label">Konfirmasi Password</div>
                <div class="input-wrap">
                    <input class="field-input" type="password" id="pw-confirm" name="password_confirmation"
                        placeholder="Ulangi Password" required />
                    <button type="button" class="toggle-pw" onclick="togglePw('pw-confirm')"
                        title="Tampilkan password">
                        <svg id="eye-pw-confirm" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <svg id="eye-off-pw-confirm" viewBox="0 0 24 24" style="display:none">
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94" />
                            <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19" />
                            <line x1="1" y1="1" x2="23" y2="23" />
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-register">Daftar</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>


    <script>
        function togglePw(inputId) {
            const input = document.getElementById(inputId);
            const eyeOn = document.getElementById('eye-' + inputId);
            const eyeOff = document.getElementById('eye-off-' + inputId);

            if (input.type === 'password') {
                input.type = 'text';
                eyeOn.style.display = 'none';
                eyeOff.style.display = 'block';
            } else {
                input.type = 'password';
                eyeOn.style.display = 'block';
                eyeOff.style.display = 'none';
            }
        }
    </script>


</body>

</html>
