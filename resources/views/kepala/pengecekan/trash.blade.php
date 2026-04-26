<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Sampah SKPP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            background: linear-gradient(160deg, #e74c3c 0%, #c0392b 100%);
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

        .top-bar .more {
            color: #fff;
            font-size: 22px;
        }

        .content {
            flex: 1;
            padding: 16px 16px 90px;
            margin-top: -24px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 16px;
        }

        /* SEARCH */
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
            box-shadow: 0 0 0 2px #e74c3c;
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
        }

        .filter-btn {
            flex: 1;
            padding: 9px;
            border-radius: 50px;
            border: none;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            background: #fff;
            color: #888;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.07);
            transition: all 0.2s;
        }

        .filter-btn.active {
            background: #e74c3c;
            color: #fff;
        }

        .filter-clear {
            padding: 9px 14px;
            border-radius: 50px;
            background: #fdecea;
            color: #e74c3c;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        /* INFO BOX */
        .info-box {
            background: #fff8e1;
            border-radius: 14px;
            padding: 12px 16px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-box svg {
            width: 18px;
            height: 18px;
            stroke: #f5a623;
            fill: none;
            stroke-width: 2;
            flex-shrink: 0;
        }

        .info-box span {
            font-size: 13px;
            color: #856404;
            line-height: 1.5;
        }

        /* CARD WRAPPER */
        .card-wrapper {
            background: #fff;
            border-radius: 24px;
            padding: 16px;
            margin-bottom: 14px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.07);
        }

        .card-top {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .card-avatar {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            background: #eee;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-avatar .initials {
            color: #999;
            font-size: 18px;
            font-weight: 700;
        }

        .card-info {
            flex: 1;
        }

        .card-nomor {
            font-size: 16px;
            font-weight: 700;
            color: #333;
            margin-bottom: 2px;
        }

        .card-nama {
            font-size: 13px;
            color: #666;
            margin-bottom: 3px;
        }

        .card-tanggal {
            font-size: 12px;
            color: #aaa;
        }

        .badge-hapus {
            background: #fdecea;
            color: #e74c3c;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 50px;
            flex-shrink: 0;
        }

        /* SISA WAKTU */
        .sisa-waktu {
            background: #f8f8f8;
            border-radius: 12px;
            padding: 8px 14px;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sisa-waktu .label {
            font-size: 12px;
            color: #888;
        }

        .sisa-waktu .days {
            font-size: 13px;
            font-weight: 700;
        }

        .sisa-waktu .days.urgent {
            color: #e74c3c;
        }

        .sisa-waktu .days.ok {
            color: #1a8fb3;
        }

        /* BTN PULIHKAN */
        .btn-pulihkan {
            width: 100%;
            background: #1a8fb3;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 13px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s, transform 0.1s;
        }

        .btn-pulihkan:hover {
            background: #157a9a;
        }

        .btn-pulihkan:active {
            transform: scale(0.97);
        }

        .btn-pulihkan svg {
            width: 16px;
            height: 16px;
            stroke: #fff;
            fill: none;
            stroke-width: 2;
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

        /* TOAST */
        .toast {
            display: none;
            position: fixed;
            top: 24px;
            left: 50%;
            transform: translateX(-50%);
            background: #2ecc71;
            color: #fff;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 14px;
            z-index: 999;
        }

        .toast.show {
            display: block;
            animation: fadeDown 0.3s ease;
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
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
            <a href="{{ route('kepala.pengecekan.index') }}">&#8249;</a>
            <h2>Sampah SKPP</h2>
            <span class="more">&#8942;</span>
        </div>

        <div class="content">

            {{-- SEARCH & FILTER --}}
            <form method="GET" action="{{ route('kepala.pengecekan.trash') }}" class="search-wrap">
                <div class="search-box">
                    <input type="text" name="search" class="search-input" placeholder="Cari nama atau nomor SKPP..."
                        value="{{ request('search') }}" oninput="this.form.submit()">
                    <svg class="search-icon" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                </div>
                <div class="filter-row">
                    <button type="submit" name="sort" value="asc"
                        class="filter-btn {{ request('sort') === 'asc' ? 'active' : '' }}">↑ Terlama Dihapus</button>
                    <button type="submit" name="sort" value="desc"
                        class="filter-btn {{ request('sort', 'desc') === 'desc' ? 'active' : '' }}">↓ Terbaru
                        Dihapus</button>
                    @if (request('search') || request('sort'))
                        <a href="{{ route('kepala.pengecekan.trash') }}" class="filter-clear">✕</a>
                    @endif
                </div>
            </form>

            <div class="info-box">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="12" />
                    <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
                <span>Pengajuan yang dihapus akan <strong>otomatis terhapus permanen setelah 30 hari</strong>. Pulihkan
                    sebelum waktunya habis.</span>
            </div>

            @forelse($trashedList as $item)
                @php
                    $nomorSkpp = 'SKPP ' . str_pad($item->id, 3, '0', STR_PAD_LEFT);
                    $nama = $item->pencatatan->nama_lengkap ?? ($item->user->name ?? '—');
                    $inisial = strtoupper(substr($nama, 0, 1));
                    $tglHapus = $item->deleted_at->translatedFormat('j F Y');
                    $sisaHari = now()->diffInDays($item->deleted_at->addDays(30), false);
                    $sisaHari = max(0, (int) $sisaHari);
                @endphp

                <div class="card-wrapper" id="card-{{ $item->id }}">
                    <div class="card-top">
                        <div class="card-avatar"><span class="initials">{{ $inisial }}</span></div>
                        <div class="card-info">
                            <div class="card-nomor">{{ $nomorSkpp }}</div>
                            <div class="card-nama">{{ $nama }}</div>
                            <div class="card-tanggal">Dihapus: {{ $tglHapus }}</div>
                        </div>
                        <span class="badge-hapus">Dihapus</span>
                    </div>

                    <div class="sisa-waktu">
                        <span class="label">Sisa waktu pemulihan</span>
                        <span class="days {{ $sisaHari <= 7 ? 'urgent' : 'ok' }}">
                            {{ $sisaHari }} hari lagi
                        </span>
                    </div>

                    <button class="btn-pulihkan" onclick="pulihkan({{ $item->id }}, '{{ $nomorSkpp }}', this)">
                        <svg viewBox="0 0 24 24">
                            <polyline points="1 4 1 10 7 10" />
                            <path d="M3.51 15a9 9 0 1 0 .49-5" />
                        </svg>
                        Pulihkan
                    </button>
                </div>
            @empty
                <div class="empty-state">
                    <div class="icon"></div>
                    <p>{{ request('search') ? 'Tidak ada hasil pencarian.' : 'Tidak ada pengajuan yang dihapus.' }}</p>
                </div>
            @endforelse
        </div>

        <div class="toast" id="toast-pulih">✓ Pengajuan berhasil dipulihkan!</div>

        <div class="navbar">
            <a href="{{ route('kepala.dashboard') }}" class="nav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
            </a>
            <a href="#" class="nav-plus">
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

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        async function pulihkan(id, nomor, btn) {
            btn.disabled = true;
            btn.textContent = 'Memulihkan...';
            try {
                const res = await fetch(`/kepala/pengecekan/${id}/pulihkan`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                });
                const data = await res.json();
                if (data.success) {
                    document.getElementById('card-' + id).remove();
                    const toast = document.getElementById('toast-pulih');
                    toast.classList.add('show');
                    setTimeout(() => toast.classList.remove('show'), 3000);
                }
            } catch (e) {
                btn.disabled = false;
                btn.textContent = 'Pulihkan';
                alert('Terjadi kesalahan.');
            }
        }
    </script>
</body>

</html>
