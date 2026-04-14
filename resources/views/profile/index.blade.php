<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Profile</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #e8f6fb;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }
        .phone-wrap {
            width: 100%;
            max-width: 430px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: #e8f6fb;
        }
        .top-bar {
            background: linear-gradient(160deg, #29b6d8 0%, #1a8fb3 100%);
            padding: 20px 20px 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .top-bar a { color: #fff; font-size: 24px; text-decoration: none; padding: 4px 8px; }
        .top-bar h2 { color: #fff; font-size: 18px; font-weight: 700; flex: 1; text-align: center; }
        .top-bar span { color: #fff; font-size: 22px; padding: 4px 8px; cursor: pointer; }
        .profile-body {
            flex: 1;
            padding: 0 24px 32px;
            margin-top: -30px;
        }
        .avatar-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 24px;
        }
        .avatar {
            width: 80px; height: 80px;
            border-radius: 50%;
            background: #1a8fb3;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
            border: 3px solid #fff;
        }
        .avatar svg { width: 52px; height: 52px; }
        .edit-btn {
            color: #1a8fb3;
            font-size: 13px;
            font-weight: 600;
            text-decoration: underline;
            background: none;
            border: none;
            cursor: pointer;
        }
        .field-label {
            color: #1a8fb3;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
            margin-top: 16px;
        }
        .field-val {
            background: #fff;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            color: #444;
            width: 100%;
        }
        .btn-logout {
            width: 100%;
            background: #fff;
            color: #1a8fb3;
            border: 1.5px solid #1a8fb3;
            border-radius: 50px;
            padding: 14px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            margin-top: 28px;
        }
        .btn-logout:hover { background: #eaf6fb; }
        .bottom-nav {
            background: #fff;
            border-top: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px 0 20px;
            position: sticky;
            bottom: 0;
        }
        .nav-item { display: flex; flex-direction: column; align-items: center; gap: 2px; cursor: pointer; }
        .nav-item svg { width: 24px; height: 24px; stroke: #aaa; fill: none; stroke-width: 1.8; }
        .nav-item.active svg { stroke: #1a8fb3; }
        .role-badge {
            display: inline-block;
            background: #eaf6fb;
            color: #1a8fb3;
            border-radius: 50px;
            padding: 2px 12px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 6px;
        }
    </style>
</head>
<body>
<div class="phone-wrap">
    <div class="top-bar">
        <a href="javascript:history.back()">&#8249;</a>
        <h2>Profile</h2>
        <span>&#8942;</span>
    </div>

    <div class="profile-body">
        <div class="avatar-wrap">
            <div class="avatar">
                <svg viewBox="0 0 52 52" fill="none">
                    <circle cx="26" cy="19" r="10" fill="#fff" opacity="0.9"/>
                    <ellipse cx="26" cy="42" rx="18" ry="10" fill="#fff" opacity="0.7"/>
                </svg>
            </div>
            <button class="edit-btn">Edit Profile</button>
        </div>

        <div class="field-label">Username</div>
        <div class="field-val">{{ Auth::user()->name }}</div>

        <div class="field-label">E-mail</div>
        <div class="field-val">{{ Auth::user()->email }}</div>

        <div class="field-label">Password</div>
        <div class="field-val">••••••••</div>

        <div class="field-label">Role</div>
        <div class="field-val">
            @php
                $roleLabel = [
                    'mitra'  => 'Mitra',
                    'staff'  => 'Staff',
                    'kepala' => 'Kepala Staff',
                ][Auth::user()->role] ?? Auth::user()->role;
            @endphp
            {{ $roleLabel }}
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Keluar</button>
        </form>
    </div>

    <div class="bottom-nav">
        <div class="nav-item">
            <svg viewBox="0 0 24 24">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
        </div>
        <div class="nav-item">
            <svg viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
        </div>
        <div class="nav-item active">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="4"/>
                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
            </svg>
        </div>
    </div>
</div>
</body>
</html>