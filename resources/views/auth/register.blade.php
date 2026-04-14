{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Daftar Akun</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
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
        .field-wrap { margin-bottom: 15px; }
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
        .field-input:focus { box-shadow: 0 0 0 2px #29b6d8; }
        .field-input.is-invalid { box-shadow: 0 0 0 2px #e74c3c; }
        .invalid-feedback {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 4px;
            padding-left: 12px;
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
        .btn-register:hover { background: #157a9a; }
        .login-link {
            text-align: center;
            font-size: 13px;
            color: #888;
        }
        .login-link a { color: #1a8fb3; font-weight: 600; }
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
                <input
                    class="field-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                    type="text"
                    name="name"
                    placeholder="Masukkan Nama Lengkap"
                    value="{{ old('name') }}"
                    required
                    autofocus
                />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="field-wrap">
                <div class="field-label">Username</div>
                <input
                    class="field-input {{ $errors->has('username') ? 'is-invalid' : '' }}"
                    type="text"
                    name="username"
                    placeholder="Masukkan Username"
                    value="{{ old('username') }}"
                    required
                />
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="field-wrap">
                <div class="field-label">E-mail</div>
                <input
                    class="field-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    type="email"
                    name="email"
                    placeholder="Masukkan Email"
                    value="{{ old('email') }}"
                    required
                />
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="field-wrap">
                <div class="field-label">Password</div>
                <input
                    class="field-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    type="password"
                    name="password"
                    placeholder="Masukkan Password"
                    required
                />
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="field-wrap">
                <div class="field-label">Konfirmasi Password</div>
                <input
                    class="field-input"
                    type="password"
                    name="password_confirmation"
                    placeholder="Ulangi Password"
                    required
                />
            </div>

            <button type="submit" class="btn-register">Daftar</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>
</body>
</html>