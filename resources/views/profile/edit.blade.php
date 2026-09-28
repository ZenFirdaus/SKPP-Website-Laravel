<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Profil Saya - SKPP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #dff0f7;
            display: flex;
            justify-content: center;
        }

        .shell {
            width: 100%;
            max-width: 430px;
            min-height: 100vh;
            background: #f3f7fa;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .top-bar {
            background: linear-gradient(160deg, #2ec6e8 0%, #1a8fb3 100%);
            padding: 20px 20px 52px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 0 0 32px 32px;
        }

        .top-bar a {
            color: #fff;
            font-size: 28px;
            text-decoration: none;
            padding: 4px 8px;
            border-radius: 10px;
            transition: background 0.2s;
        }

        .top-bar h2 {
            color: #fff;
            font-size: 20px;
            font-weight: 700;
            flex: 1;
            text-align: center;
        }

        .content {
            flex: 1;
            padding: 16px 16px 100px;
            margin-top: -24px;
        }

        .card {
            background: #fff;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .avatar-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 16px;
        }

        .avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1a8fb3, #2ec6e8);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 28px;
            font-weight: 700;
            border: 3px solid #fff;
            box-shadow: 0 4px 12px rgba(26, 143, 179, 0.2);
            margin-bottom: 8px;
        }

        .role-badge {
            display: inline-block;
            background: #eaf6fb;
            color: #1a8fb3;
            border-radius: 50px;
            padding: 4px 12px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-radius: 12px;
            padding: 10px 14px;
            font-size: 13px;
            margin-bottom: 14px;
        }

        .field-group {
            margin-bottom: 14px;
        }

        .field-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #555;
            margin-bottom: 6px;
        }

        .field-input {
            width: 100%;
            background: #eaf6fb;
            border: 1px solid transparent;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 14px;
            color: #333;
            outline: none;
            font-family: inherit;
        }

        .field-input:focus {
            border-color: #2ec6e8;
        }

        .btn-simpan {
            width: 100%;
            background: #1a8fb3;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 6px;
        }

        .btn-simpan:hover {
            background: #157a9a;
        }

        .btn-logout {
            width: 100%;
            background: #fff;
            color: #e74c3c;
            border: 1.5px solid #e74c3c;
            border-radius: 50px;
            padding: 13px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.2s;
        }

        .btn-logout:hover {
            background: #fdecea;
        }

        .error-msg {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }

        .navbar {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 430px;
            background: #fff;
            border-top: 1px solid #e8e8e8;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 12px 0 20px;
            z-index: 100;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            padding: 6px 14px;
            border-radius: 14px;
            text-decoration: none;
        }

        .nav-item svg {
            width: 26px;
            height: 26px;
            stroke: #aaa;
            fill: none;
            stroke-width: 1.8;
        }

        .nav-item.active svg {
            stroke: #1a8fb3;
        }
    </style>
</head>

<body>
    <div class="shell">
        <div class="top-bar">
            <a href="{{ route('dashboard') }}">&#8249;</a>
            <h2>Profil Saya</h2>
            <span style="width:40px"></span>
        </div>

        <div class="content">
            <!-- AVATAR & ROLE -->
            <div class="card">
                <div class="avatar-wrap">
                    <div class="avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="role-badge">Role: {{ Auth::user()->role }}</span>
                </div>

                @if (session('status') === 'profile-updated')
                    <div class="alert-success">✓ Data profil berhasil diperbarui!</div>
                @endif

                <!-- UPDATE PROFILE INFO FORM -->
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="field-group">
                        <label class="field-label">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="field-input" required>
                        @error('name')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="field-input" required>
                        @error('email')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn-simpan">Simpan Profil</button>
                </form>
            </div>

            <!-- UPDATE PASSWORD -->
            <div class="card">
                <h3 style="font-size: 15px; font-weight: 700; color: #1a8fb3; margin-bottom: 12px;">Ubah Password</h3>

                @if (session('status') === 'password-updated')
                    <div class="alert-success">✓ Password berhasil diubah!</div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="field-group">
                        <label class="field-label">Password Saat Ini</label>
                        <input type="password" name="current_password" class="field-input" placeholder="Masukkan password lama" required>
                        @error('current_password', 'updatePassword')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">Password Baru</label>
                        <input type="password" name="password" class="field-input" placeholder="Masukkan password baru" required>
                        @error('password', 'updatePassword')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">Ulangi Password Baru</label>
                        <input type="password" name="password_confirmation" class="field-input" placeholder="Konfirmasi password baru" required>
                        @error('password_confirmation', 'updatePassword')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn-simpan">Perbarui Password</button>
                </form>
            </div>

            <!-- LOGOUT BUTTON -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Keluar dari Akun</button>
            </form>
        </div>

        <div class="navbar">
            <a href="{{ route('dashboard') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" /><polyline points="9 22 9 12 15 12 15 22" /></svg>
            </a>
            <a href="{{ route('profile.edit') }}" class="nav-item active">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4" /><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" /></svg>
            </a>
        </div>
    </div>
</body>

</html>
