<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Daftar Pengajuan - SKPP</title>
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
            background: #dff0f7;
            display: flex;
            flex-direction: column;
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

        .top-bar a:hover {
            background: rgba(255, 255, 255, 0.2);
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

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-radius: 14px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 16px;
            font-weight: 500;
        }

        .alert-error {
            background: #fdecea;
            color: #c0392b;
            border-radius: 14px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 16px;
            font-weight: 500;
        }

        /* SEARCH & FILTER */
        .search-wrap {
            margin-bottom: 16px;
        }

        .search-box {
            position: relative;
            margin-bottom: 10px;
        }

        .search-input {
            width: 100%;
            background: #fff;
            border: none;
            border-radius: 50px;
            padding: 12px 44px 12px 18px;
            font-size: 14px;
            color: #333;
            outline: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            font-family: inherit;
        }

        .search-input:focus {
            box-shadow: 0 0 0 2px #2ec6e8;
        }

        .search-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            stroke: #aaa;
            fill: none;
            stroke-width: 2;
            pointer-events: none;
        }

        .filter-row {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 4px;
        }

        .filter-btn {
            padding: 8px 14px;
            border-radius: 50px;
            border: none;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            background: #fff;
            color: #666;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.07);
            white-space: nowrap;
            text-decoration: none;
            display: inline-block;
        }

        .filter-btn.active {
            background: #1a8fb3;
            color: #fff;
        }

        /* BTN TAMBAH */
        .btn-tambah {
            width: 100%;
            background: #1a8fb3;
            color: #fff;
            border-radius: 50px;
            padding: 14px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            box-shadow: 0 4px 14px rgba(26, 143, 179, 0.35);
            transition: background 0.2s, transform 0.1s;
        }

        .btn-tambah:hover {
            background: #157a9a;
        }

        .btn-tambah:active {
            transform: scale(0.98);
        }

        .btn-tambah svg {
            width: 18px;
            height: 18px;
            stroke: #fff;
            fill: none;
            stroke-width: 2.5;
        }

        /* CARD LIST */
        .card-item {
            background: #fff;
            border-radius: 20px;
            padding: 16px;
            margin-bottom: 14px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            display: block;
            text-decoration: none;
            color: inherit;
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .card-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.09);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .card-id {
            font-size: 15px;
            font-weight: 700;
            color: #1a8fb3;
        }

        .card-date {
            font-size: 12px;
            color: #888;
        }

        .card-body {
            margin-bottom: 12px;
        }

        .card-title {
            font-size: 15px;
            font-weight: 700;
            color: #222;
            margin-bottom: 4px;
        }

        .card-keperluan {
            font-size: 13px;
            color: #555;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #f0f0f0;
            padding-top: 10px;
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

        .card-actions {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            font-size: 12px;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 50px;
            text-decoration: none;
            border: 1px solid #ddd;
            color: #555;
            background: #fafafa;
        }

        .btn-action.primary {
            border-color: #1a8fb3;
            color: #1a8fb3;
            background: #eaf6fb;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #888;
        }

        .empty-state .icon {
            font-size: 52px;
            margin-bottom: 12px;
        }

        /* PAGINATION */
        .pagination-wrap {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .pagination-wrap nav {
            display: flex;
            gap: 6px;
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
        <div class="top-bar">
            <a href="{{ route('mitra.dashboard') }}">&#8249;</a>
            <h2>Pengajuan Saya</h2>
            <span style="width:40px"></span>
        </div>

        <div class="content">
            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            <a href="{{ route('mitra.pengajuan.create') }}" class="btn-tambah">
                <svg viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Buat Pengajuan Baru
            </a>

            {{-- SEARCH & FILTER --}}
            <form method="GET" action="{{ route('mitra.pengajuan.index') }}" class="search-wrap">
                <div class="search-box">
                    <input type="text" name="search" class="search-input"
                        placeholder="Cari nama atau keperluan..." value="{{ request('search') }}"
                        oninput="this.form.submit()">
                    <svg class="search-icon" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                </div>
                <div class="filter-row">
                    <a href="{{ route('mitra.pengajuan.index') }}"
                        class="filter-btn {{ !request('status') ? 'active' : '' }}">Semua</a>
                    <a href="{{ route('mitra.pengajuan.index', ['status' => 'menunggu']) }}"
                        class="filter-btn {{ request('status') === 'menunggu' ? 'active' : '' }}">Menunggu</a>
                    <a href="{{ route('mitra.pengajuan.index', ['status' => 'diproses']) }}"
                        class="filter-btn {{ request('status') === 'diproses' ? 'active' : '' }}">Diproses</a>
                    <a href="{{ route('mitra.pengajuan.index', ['status' => 'selesai']) }}"
                        class="filter-btn {{ request('status') === 'selesai' ? 'active' : '' }}">Selesai</a>
                    <a href="{{ route('mitra.pengajuan.index', ['status' => 'ditolak']) }}"
                        class="filter-btn {{ request('status') === 'ditolak' ? 'active' : '' }}">Ditolak</a>
                </div>
            </form>

            @forelse($pengajuans as $item)
                @php
                    $isSelesai = $item->status_arsip === 'diarsipkan' && $item->arsip?->dikirim_ke_mitra;
                    $statusLabel = $isSelesai ? 'Selesai' : ucfirst($item->status);
                    $statusBadge = $isSelesai ? 'badge-selesai' : 'badge-' . $item->status;
                @endphp
                <div class="card-item">
                    <div class="card-header">
                        <span class="card-id">SKPP #{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</span>
                        <span class="card-date">{{ $item->created_at->translatedFormat('d M Y') }}</span>
                    </div>
                    <div class="card-body">
                        <div class="card-title">{{ $item->nama_perusahaan }}</div>
                        <div class="card-keperluan">{{ $item->keperluan }}</div>
                    </div>
                    <div class="card-footer">
                        <span class="badge {{ $statusBadge }}">{{ $statusLabel }}</span>
                        <div class="card-actions">
                            <a href="{{ route('mitra.pengajuan.show', $item->id) }}" class="btn-action primary">Detail</a>
                            @if ($item->status === 'menunggu' && $item->status_pencatatan === 'belum_dicatat')
                                <a href="{{ route('mitra.pengajuan.edit', $item->id) }}" class="btn-action">Edit</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="icon">📄</div>
                    <p>{{ request('search') ? 'Tidak ada pengajuan yang cocok.' : 'Belum ada pengajuan dibuat.' }}</p>
                </div>
            @endforelse

            <div class="pagination-wrap">
                {{ $pengajuans->links() }}
            </div>
        </div>

        {{-- NAVBAR --}}
        <div class="navbar">
            <a href="{{ route('mitra.dashboard') }}" class="nav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
            </a>
            <a href="{{ route('mitra.pengajuan.create') }}" class="nav-plus" title="Buat Pengajuan">
                <svg viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
            </a>
            <a href="{{ route('profile.edit') }}" class="nav-item">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                </svg>
            </a>
        </div>
    </div>
</body>

</html>
