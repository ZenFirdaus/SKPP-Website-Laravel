<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Dashboard Staff - SKPP</title>
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

        .header-bg {
            background: linear-gradient(160deg, #2ec6e8 0%, #1a8fb3 100%);
            padding: 24px 20px 48px;
            color: #fff;
            border-radius: 0 0 32px 32px;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.25);
            border: 2px solid #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 18px;
            text-decoration: none;
        }

        .user-text .greeting {
            font-size: 12px;
            opacity: 0.9;
        }

        .user-text .name {
            font-size: 17px;
            font-weight: 700;
        }

        .header-actions a {
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
        }

        .welcome-card {
            background: #fff;
            margin: -24px 16px 16px;
            border-radius: 20px;
            padding: 18px 20px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        }

        .welcome-card h2 {
            font-size: 16px;
            font-weight: 700;
            color: #1a8fb3;
            margin-bottom: 4px;
        }

        .welcome-card p {
            font-size: 12px;
            color: #666;
            line-height: 1.4;
        }

        /* STATS GRID */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            padding: 0 16px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: #fff;
            border-radius: 18px;
            padding: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon svg {
            width: 22px;
            height: 22px;
            stroke: #fff;
            fill: none;
            stroke-width: 2;
        }

        .stat-icon.total {
            background: linear-gradient(135deg, #1a8fb3, #2ec6e8);
        }

        .stat-icon.catat {
            background: linear-gradient(135deg, #f5a623, #f7ba59);
        }

        .stat-icon.siap-arsip {
            background: linear-gradient(135deg, #4e63e8, #6c7cf7);
        }

        .stat-icon.arsip-selesai {
            background: linear-gradient(135deg, #2ecc71, #54e390);
        }

        .stat-num {
            font-size: 20px;
            font-weight: 800;
            color: #222;
            line-height: 1;
        }

        .stat-lbl {
            font-size: 11px;
            color: #777;
            margin-top: 4px;
            font-weight: 600;
        }

        /* SHORTCUTS */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 16px;
            margin-bottom: 12px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #333;
        }

        .shortcuts-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            padding: 0 16px;
            margin-bottom: 24px;
        }

        .shortcut-item {
            background: #fff;
            border-radius: 18px;
            padding: 16px;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            display: flex;
            align-items: center;
            gap: 12px;
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .shortcut-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(26, 143, 179, 0.15);
        }

        .shortcut-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .shortcut-icon svg {
            width: 22px;
            height: 22px;
            fill: none;
            stroke-width: 2;
        }

        .shortcut-title {
            font-size: 13px;
            font-weight: 700;
            color: #222;
        }

        .shortcut-desc {
            font-size: 11px;
            color: #888;
            margin-top: 2px;
        }

        /* LIST ITEMS */
        .list-section {
            padding: 0 16px;
            margin-bottom: 24px;
        }

        .list-item {
            background: #fff;
            border-radius: 16px;
            padding: 14px 16px;
            margin-bottom: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-decoration: none;
            color: inherit;
        }

        .list-item:hover {
            background: #fbfdfe;
        }

        .list-info h4 {
            font-size: 14px;
            font-weight: 700;
            color: #222;
            margin-bottom: 2px;
        }

        .list-info p {
            font-size: 11px;
            color: #888;
        }

        .badge {
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 50px;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-info {
            background: #eaf6fb;
            color: #1a8fb3;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        /* NAVBAR */
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
            transition: background 0.2s;
            text-decoration: none;
        }

        .nav-item:hover {
            background: #f0f9fc;
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

        .nav-plus {
            width: 50px;
            height: 50px;
            background: #1a8fb3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: -20px;
            box-shadow: 0 4px 14px rgba(26, 143, 179, 0.4);
            transition: background 0.2s, transform 0.15s;
            text-decoration: none;
        }

        .nav-plus:hover {
            background: #157a9a;
            transform: scale(1.08);
        }

        .nav-plus svg {
            stroke: #fff;
            width: 24px;
            height: 24px;
            fill: none;
            stroke-width: 2;
        }
    </style>
</head>

<body>
    <div class="shell">
        <!-- HEADER -->
        <div class="header-bg">
            <div class="header-top">
                <div class="user-info">
                    <a href="{{ route('profile.edit') }}" class="avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </a>
                    <div class="user-text">
                        <p class="greeting">Halo, Staff Administrasi</p>
                        <p class="name">{{ Auth::user()->name }}</p>
                    </div>
                </div>
                <div class="header-actions">
                    <a href="{{ route('panduan') }}">Panduan</a>
                </div>
            </div>
        </div>

        <div class="welcome-card">
            <h2>Pengelolaan Kepegawaian</h2>
            <p>Verifikasi data pengajuan pemohon dan kelola arsip dokumen SKPP.</p>
        </div>

        <!-- STATS -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon total">
                    <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <div>
                    <div class="stat-num">{{ $stats['total'] }}</div>
                    <div class="stat-lbl">Total Pengajuan</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon catat">
                    <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </div>
                <div>
                    <div class="stat-num">{{ $stats['menunggu_catat'] }}</div>
                    <div class="stat-lbl">Perlu Dicatat</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon siap-arsip">
                    <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                </div>
                <div>
                    <div class="stat-num">{{ $stats['siap_arsip'] }}</div>
                    <div class="stat-lbl">Siap Arsip</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon arsip-selesai">
                    <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div>
                    <div class="stat-num">{{ $stats['selesai_arsip'] }}</div>
                    <div class="stat-lbl">Diarsipkan</div>
                </div>
            </div>
        </div>

        <!-- MENU ADMIN -->
        <div class="section-header">
            <span class="section-title">Menu Administrasi</span>
        </div>
        <div class="shortcuts-row">
            <a href="{{ route('staff.pencatatan.index') }}" class="shortcut-item">
                <div class="shortcut-icon" style="background: #fff8e1;">
                    <svg viewBox="0 0 24 24" stroke="#f5a623"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </div>
                <div>
                    <div class="shortcut-title">Pencatatan</div>
                    <div class="shortcut-desc">Verifikasi data masuk</div>
                </div>
            </a>

            <a href="{{ route('staff.pengarsipan.index') }}" class="shortcut-item">
                <div class="shortcut-icon" style="background: #eaf6fb;">
                    <svg viewBox="0 0 24 24" stroke="#1a8fb3"><path d="M3 7h18v13H3z"/><path d="M3 7l3-4h12l3 4"/></svg>
                </div>
                <div>
                    <div class="shortcut-title">Pengarsipan</div>
                    <div class="shortcut-desc">Arsip & kirim ke mitra</div>
                </div>
            </a>
        </div>

        <!-- PERLU TINDAKAN -->
        <div class="section-header">
            <span class="section-title">Perlu Tindakan Segera</span>
        </div>
        <div class="list-section">
            @forelse($perluTindakan as $item)
                @php
                    $isPerluCatat = $item->status_pencatatan === 'belum_dicatat';
                    $url = $isPerluCatat ? route('staff.pencatatan.create', $item->id) : route('staff.pengarsipan.index');
                    $label = $isPerluCatat ? 'Belum Dicatat' : 'Siap Arsip';
                    $badgeClass = $isPerluCatat ? 'badge-warning' : 'badge-info';
                @endphp
                <a href="{{ $url }}" class="list-item">
                    <div class="list-info">
                        <h4>SKPP #{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</h4>
                        <p>{{ $item->nama_perusahaan }} &bull; {{ $item->created_at->translatedFormat('d M Y') }}</p>
                    </div>
                    <span class="badge {{ $badgeClass }}">{{ $label }}</span>
                </a>
            @empty
                <div style="background: #fff; border-radius: 16px; padding: 20px; text-align: center; color: #888; font-size: 13px;">
                    Semua pengajuan telah diproses dengan baik.
                </div>
            @endforelse
        </div>

        <!-- DAFTAR PENGAJUAN TERBARU -->
        <div class="section-header">
            <span class="section-title">Pengajuan Terbaru</span>
            <a href="{{ route('staff.pencatatan.index') }}" style="font-size: 12px; color: #1a8fb3; font-weight: 600; text-decoration: none;">Semua ›</a>
        </div>
        <div class="list-section" style="padding-bottom: 90px;">
            @forelse($pengajuanTerbaru as $item)
                <a href="{{ route('staff.pencatatan.show', $item->id) }}" class="list-item">
                    <div class="list-info">
                        <h4>SKPP #{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</h4>
                        <p>{{ $item->nama_perusahaan }} &bull; Diajukan: {{ $item->created_at->translatedFormat('d M Y') }}</p>
                    </div>
                    <span class="badge {{ $item->status_pencatatan === 'selesai_dicatat' ? 'badge-success' : 'badge-warning' }}">
                        {{ $item->status_pencatatan === 'selesai_dicatat' ? 'Sudah Dicatat' : 'Belum Dicatat' }}
                    </span>
                </a>
            @empty
                <div style="background: #fff; border-radius: 16px; padding: 20px; text-align: center; color: #888; font-size: 13px;">
                    Belum ada pengajuan masuk.
                </div>
            @endforelse
        </div>

        <!-- NAVBAR -->
        <div class="navbar">
            <a href="{{ route('staff.dashboard') }}" class="nav-item active">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </a>
            <a href="{{ route('staff.pencatatan.index') }}" class="nav-plus" title="Pencatatan">
                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </a>
            <a href="{{ route('profile.edit') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            </a>
        </div>
    </div>
</body>

</html>
