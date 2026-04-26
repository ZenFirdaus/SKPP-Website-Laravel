<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Pengecekan</title>
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

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-sampah {
            width: 100%;
            background: transparent;
            color: #1a8fb3;
            border: 2px solid #1a8fb3;
            border-radius: 50px;
            padding: 15px;
            margin-bottom: 18px;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;

            text-decoration: none;
            font-size: 15px;
            font-weight: 700;

            transition: all .2s ease;
        }

        .btn-sampah:hover {
            background: #eaf6fb;
            transform: translateY(-1px);
        }

        .btn-sampah:active {
            transform: scale(.98);
        }

        .btn-sampah svg {
            width: 20px;
            height: 20px;
            stroke: #1a8fb3;
            fill: none;
            stroke-width: 2;
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
            background: #1a8fb3;
            color: #fff;
        }

        .filter-btn:hover:not(.active) {
            background: #eaf6fb;
            color: #1a8fb3;
        }

        .filter-clear {
            padding: 9px 14px;
            border-radius: 50px;
            background: #fdecea;
            color: #e74c3c;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.07);
            display: flex;
            align-items: center;
        }

        .hasil-pencarian {
            font-size: 12px;
            color: #888;
            margin-bottom: 12px;
            padding-left: 4px;
        }

        /* CARD WRAPPER dengan tombol hapus */
        .card-wrapper {
            position: relative;
            margin-bottom: 14px;
        }

        .card-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px 16px;
            border-radius: 22px;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.15s;
            position: relative;
        }

        .card-item:hover {
            transform: scale(1.02);
        }

        .card-item:active {
            transform: scale(0.98);
        }

        .card-item:nth-child(4n+1) {
            background: linear-gradient(135deg, #6c63ff, #4e46c4);
        }

        .card-item:nth-child(4n+2) {
            background: linear-gradient(135deg, #f5a623, #e08c10);
        }

        .card-item:nth-child(4n+3) {
            background: linear-gradient(135deg, #2ec6e8, #1a8fb3);
        }

        .card-item:nth-child(4n+4) {
            background: linear-gradient(135deg, #f06c2b, #d45a1a);
        }

        /* Fix nth-child untuk card-wrapper */
        .card-wrapper:nth-child(4n+1) .card-item {
            background: linear-gradient(135deg, #6c63ff, #4e46c4);
        }

        .card-wrapper:nth-child(4n+2) .card-item {
            background: linear-gradient(135deg, #f5a623, #e08c10);
        }

        .card-wrapper:nth-child(4n+3) .card-item {
            background: linear-gradient(135deg, #2ec6e8, #1a8fb3);
        }

        .card-wrapper:nth-child(4n+4) .card-item {
            background: linear-gradient(135deg, #f06c2b, #d45a1a);
        }

        .card-avatar {
            width: 58px;
            height: 58px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.25);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-avatar .initials {
            color: #fff;
            font-size: 20px;
            font-weight: 700;
        }

        .card-info {
            flex: 1;
        }

        .card-nomor {
            color: #fff;
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .card-nama {
            color: rgba(255, 255, 255, 0.92);
            font-size: 13px;
            margin-bottom: 4px;
        }

        .card-tanggal {
            color: rgba(255, 255, 255, 0.75);
            font-size: 12px;
        }

        .badge {
            font-size: 11px;
            font-weight: 700;
            padding: 5px 11px;
            border-radius: 50px;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .badge-menunggu {
            background: #ff6b9d;
            color: #fff;
        }

        .badge-disetujui {
            background: #2ecc71;
            color: #fff;
        }

        .badge-ditolak {
            background: #e74c3c;
            color: #fff;
        }

        /* TOMBOL HAPUS */
        .btn-hapus {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #e74c3c;
            border: 2px solid #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            box-shadow: 0 2px 8px rgba(231, 76, 60, 0.4);
            transition: background 0.2s, transform 0.15s;
        }

        .btn-hapus:hover {
            background: #c0392b;
            transform: scale(1.1);
        }

        .btn-hapus svg {
            width: 14px;
            height: 14px;
            stroke: #fff;
            fill: none;
            stroke-width: 2.5;
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

        /* MODAL HAPUS */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 200;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-box {
            background: #fff;
            border-radius: 24px;
            padding: 28px 24px 24px;
            width: 300px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
            animation: popIn 0.2s ease;
        }

        @keyframes popIn {
            from {
                transform: scale(0.85);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .modal-icon-hapus {
            width: 60px;
            height: 60px;
            background: #fdecea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
        }

        .modal-icon-hapus svg {
            width: 30px;
            height: 30px;
            stroke: #e74c3c;
            fill: none;
            stroke-width: 2;
        }

        .modal-title {
            font-size: 15px;
            font-weight: 700;
            color: #222;
            margin-bottom: 6px;
            line-height: 1.5;
        }

        .modal-sub {
            font-size: 13px;
            color: #888;
            margin-bottom: 20px;
        }

        .modal-btns {
            display: flex;
            gap: 10px;
        }

        .modal-btn-batal {
            flex: 1;
            background: #fff;
            color: #333;
            border: 1.5px solid #ddd;
            border-radius: 50px;
            padding: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: background 0.2s;
        }

        .modal-btn-batal:hover {
            background: #f5f5f5;
        }

        .modal-btn-hapus {
            flex: 1;
            background: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            transition: background 0.2s;
        }

        .modal-btn-hapus:hover {
            background: #c0392b;
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
            <a href="{{ route('kepala.dashboard') }}">&#8249;</a>
            <h2>Pengecekan</h2>
            <span style="width:40px"></span>
        </div>

        <div class="content">
            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            {{-- SEARCH & FILTER --}}
            <form method="GET" action="{{ route('kepala.pengecekan.index') }}" class="search-wrap">
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
                        class="filter-btn {{ request('sort') === 'asc' ? 'active' : '' }}">
                        ↑ SKPP Terlama
                    </button>
                    <button type="submit" name="sort" value="desc"
                        class="filter-btn {{ request('sort', 'desc') === 'desc' ? 'active' : '' }}">
                        ↓ SKPP Terbaru
                    </button>
                    @if (request('search') || request('sort'))
                        <a href="{{ route('kepala.pengecekan.index') }}" class="filter-clear">✕</a>
                    @endif
                </div>
            </form>

            <a href="{{ route('kepala.pengecekan.trash') }}" class="btn-sampah">
                <svg viewBox="0 0 24 24">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6l-1 14H6L5 6" />
                    <path d="M10 11v6M14 11v6" />
                    <path d="M9 6V4h6v2" />
                </svg>
                Buka Sampah
            </a>

            @if (request('search'))
                <div class="hasil-pencarian">
                    Hasil: <strong>"{{ request('search') }}"</strong> — {{ $pengajuanList->count() }} ditemukan
                </div>
            @endif

            @forelse($pengajuanList as $item)
                @php
                    $status = $item->status_pengecekan ?? 'menunggu';
                    $nomorSkpp = 'SKPP ' . str_pad($item->id, 3, '0', STR_PAD_LEFT);
                    $tanggal = $item->created_at->translatedFormat('j F Y');
                    $inisial = strtoupper(substr($item->user->name ?? 'U', 0, 1));
                @endphp

                <div class="card-wrapper">
                    <a href="{{ route('kepala.pengecekan.show', $item->id) }}" class="card-item">
                        <div class="card-avatar"><span class="initials">{{ $inisial }}</span></div>
                        <div class="card-info">
                            <div class="card-nomor">{{ $nomorSkpp }}</div>
                            <div class="card-nama">{{ $item->user->name ?? '-' }}</div>
                            <div class="card-tanggal">{{ $tanggal }}</div>
                        </div>
                        <span class="badge badge-{{ $status }}">
                            {{ $status === 'menunggu' ? 'Menunggu' : ($status === 'disetujui' ? 'Disetujui' : 'Ditolak') }}
                        </span>
                    </a>
                    <button class="btn-hapus" onclick="confirmHapus({{ $item->id }}, '{{ $nomorSkpp }}')"
                        title="Hapus">
                        <svg viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                </div>
            @empty
                <div class="empty-state">
                    <div class="icon">🔍</div>
                    <p>{{ request('search') ? 'Tidak ada hasil pencarian.' : 'Belum ada pengajuan yang siap dicek.' }}
                    </p>
                </div>
            @endforelse
        </div>

        {{-- MODAL KONFIRMASI HAPUS --}}
        <div class="modal-overlay" id="modal-hapus">
            <div class="modal-box">
                <div class="modal-icon-hapus">
                    <svg viewBox="0 0 24 24">
                        <polyline points="3 6 5 6 21 6" />
                        <path d="M19 6l-1 14H6L5 6" />
                        <path d="M9 6V4h6v2" />
                    </svg>
                </div>
                <div class="modal-title" id="modal-hapus-title">Hapus Pengajuan?</div>
                <div class="modal-sub">Pengajuan yang dihapus dapat dipulihkan dalam 30 hari.</div>
                <div class="modal-btns">
                    <button class="modal-btn-batal" onclick="tutupModal()">Batal</button>
                    <button class="modal-btn-hapus" onclick="hapusPengajuan()">Hapus</button>
                </div>
            </div>
        </div>

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
        let hapusId = null;

        function confirmHapus(id, nomor) {
            hapusId = id;
            document.getElementById('modal-hapus-title').textContent =
                `Apakah anda yakin ingin menghapus pengajuan ${nomor}?`;
            document.getElementById('modal-hapus').classList.add('active');
        }

        function tutupModal() {
            document.getElementById('modal-hapus').classList.remove('active');
            hapusId = null;
        }

        async function hapusPengajuan() {
            if (!hapusId) return;
            try {
                const res = await fetch(`/kepala/pengecekan/${hapusId}/hapus`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                });
                const data = await res.json();
                if (data.success) {
                    tutupModal();
                    // Hapus card dari DOM
                    const card = document.querySelector(`[data-id="${hapusId}"]`);
                    if (card) card.remove();
                    // Reload halaman
                    window.location.reload();
                }
            } catch (e) {
                tutupModal();
                alert('Terjadi kesalahan.');
            }
        }

        // Tutup modal jika klik di luar
        document.getElementById('modal-hapus').addEventListener('click', function(e) {
            if (e.target === this) tutupModal();
        });
    </script>
</body>

</html>
