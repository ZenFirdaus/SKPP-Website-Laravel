<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Dashboard Mitra - SKPP</title>
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

        /* HEADER */
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
            transition: background 0.2s;
        }

        .header-actions a:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* BANNER */
        .welcome-card {
            background: #fff;
            margin: -24px 16px 16px;
            border-radius: 20px;
            padding: 18px 20px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
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

        .stat-icon.menunggu {
            background: linear-gradient(135deg, #f5a623, #f7ba59);
        }

        .stat-icon.diproses {
            background: linear-gradient(135deg, #4e63e8, #6c7cf7);
        }

        .stat-icon.selesai {
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

        .section-link {
            font-size: 12px;
            color: #1a8fb3;
            font-weight: 600;
            text-decoration: none;
        }

        .shortcuts-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            padding: 0 16px;
            margin-bottom: 24px;
        }

        .shortcut-item {
            background: #fff;
            border-radius: 16px;
            padding: 14px 10px;
            text-align: center;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .shortcut-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(26, 143, 179, 0.15);
        }

        .shortcut-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .shortcut-icon svg {
            width: 22px;
            height: 22px;
            fill: none;
            stroke-width: 2;
        }

        .shortcut-item span {
            font-size: 12px;
            font-weight: 700;
            color: #444;
        }

        /* RECENT LIST */
        .recent-list {
            padding: 0 16px 100px;
        }

        .recent-item {
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

        .recent-item:hover {
            background: #fbfdfe;
        }

        .recent-info h4 {
            font-size: 14px;
            font-weight: 700;
            color: #222;
            margin-bottom: 2px;
        }

        .recent-info p {
            font-size: 11px;
            color: #888;
        }

        .badge {
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 50px;
            text-transform: capitalize;
        }

        .badge-menunggu {
            background: #fff3cd;
            color: #856404;
        }

        .badge-diproses {
            background: #cce5ff;
            color: #004085;
        }

        .badge-disetujui {
            background: #d4edda;
            color: #155724;
        }

        .badge-ditolak {
            background: #f8d7da;
            color: #721c24;
        }

        .badge-selesai {
            background: #2ecc71;
            color: #fff;
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
                        <p class="greeting">Halo, Mitra</p>
                        <p class="name">{{ Auth::user()->name }}</p>
                    </div>
                </div>
                <div class="header-actions">
                    <a href="{{ route('panduan') }}">Panduan</a>
                </div>
            </div>
        </div>

        <!-- WELCOME CARD -->
        <div class="welcome-card">
            <div>
                <h2>SKPP Kepegawaian</h2>
                <p>Kelola dan pantau permohonan SKPP secara transparan dan mudah.</p>
            </div>
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
                <div class="stat-icon menunggu">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div>
                    <div class="stat-num">{{ $stats['menunggu'] }}</div>
                    <div class="stat-lbl">Menunggu</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon diproses">
                    <svg viewBox="0 0 24 24"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
                </div>
                <div>
                    <div class="stat-num">{{ $stats['diproses'] }}</div>
                    <div class="stat-lbl">Sedang Diproses</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon selesai">
                    <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div>
                    <div class="stat-num">{{ $stats['selesai'] }}</div>
                    <div class="stat-lbl">Siap Unduh</div>
                </div>
            </div>
        </div>

        <!-- MENU SHORTCUTS -->
        <div class="section-header">
            <span class="section-title">Menu Utama</span>
        </div>
        <div class="shortcuts-row">
            <a href="{{ route('mitra.pengajuan.create') }}" class="shortcut-item">
                <div class="shortcut-icon" style="background: #eaf6fb;">
                    <svg viewBox="0 0 24 24" stroke="#1a8fb3"><path d="M12 5v14M5 12h14"/></svg>
                </div>
                <span>Buat Baru</span>
            </a>

            <a href="{{ route('mitra.pengajuan.index') }}" class="shortcut-item">
                <div class="shortcut-icon" style="background: #eef2ff;">
                    <svg viewBox="0 0 24 24" stroke="#4e63e8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <span>Pengajuan</span>
            </a>

            <a href="{{ route('mitra.pengunduhan.index') }}" class="shortcut-item">
                <div class="shortcut-icon" style="background: #f0fdf4;">
                    <svg viewBox="0 0 24 24" stroke="#2ecc71"><path d="M12 2v13M7 11l5 5 5-5"/><path d="M3 18h18v2H3z"/></svg>
                </div>
                <span>Unduh SKPP</span>
            </a>
        </div>

        <!-- RECENT SUBMISSIONS -->
        <div class="section-header">
            <span class="section-title">Pengajuan Terbaru</span>
            <a href="{{ route('mitra.pengajuan.index') }}" class="section-link">Lihat Semua ›</a>
        </div>
        <div class="recent-list">
            @forelse($pengajuanTerbaru as $item)
                @php
                    $isSelesai = $item->status_arsip === 'diarsipkan' && $item->arsip?->dikirim_ke_mitra;
                    $statusLabel = $isSelesai ? 'Selesai' : ucfirst($item->status);
                    $statusBadge = $isSelesai ? 'badge-selesai' : 'badge-' . $item->status;
                @endphp
                <a href="{{ route('mitra.pengajuan.show', $item->id) }}" class="recent-item">
                    <div class="recent-info">
                        <h4>SKPP #{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</h4>
                        <p>{{ $item->nama_perusahaan }} &bull; {{ $item->created_at->translatedFormat('d M Y') }}</p>
                    </div>
                    <span class="badge {{ $statusBadge }}">{{ $statusLabel }}</span>
                </a>
            @empty
                <div style="background: #fff; border-radius: 16px; padding: 24px; text-align: center; color: #888; font-size: 13px;">
                    Belum ada pengajuan. Klik <strong>Buat Baru</strong> untuk mulai.
                </div>
            @endforelse
        </div>

        <!-- BOTTOM NAVBAR -->
        <div class="navbar">
            <a href="{{ route('mitra.dashboard') }}" class="nav-item active">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </a>
            <a href="{{ route('mitra.pengajuan.create') }}" class="nav-plus" title="Buat Pengajuan">
                <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </a>
            <a href="{{ route('profile.edit') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            </a>
        </div>
    </div>
</body>

</html>
