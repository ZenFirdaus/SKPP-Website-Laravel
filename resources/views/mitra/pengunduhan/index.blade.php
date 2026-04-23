<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Pengunduhan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
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

        /* TOP BAR */
        .top-bar {
            background: linear-gradient(160deg, #2ec6e8 0%, #1a8fb3 100%);
            padding: 20px 20px 52px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 0 0 32px 32px;
        }
        .top-bar a { color: #fff; font-size: 26px; text-decoration: none; }
        .top-bar h2 { color: #fff; font-size: 20px; font-weight: 700; flex: 1; text-align: center; }
        .top-bar .more { color: #fff; font-size: 22px; }

        /* CONTENT */
        .content { flex: 1; padding: 40px 16px 100px; margin-top: -24px; }

        /* ALERT */
        .alert-error {
            background: #fdecea; color: #c0392b;
            border-radius: 12px; padding: 12px 16px;
            font-size: 13px; margin-bottom: 16px;
        }
        .alert-success {
            background: #d4edda; color: #155724;
            border-radius: 12px; padding: 12px 16px;
            font-size: 13px; margin-bottom: 16px;
        }

        /* OUTER CARD */
        .outer-card {
            background: #fff;
            border-radius: 24px;
            padding: 14px;
            margin-bottom: 18px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        }

        /* INNER CARD */
        .inner-card {
            border-radius: 18px;
            padding: 16px;
            margin-bottom: 12px;
            position: relative;
        }
        .inner-card.purple { background: linear-gradient(135deg, #6c63ff, #4e46c4); }
        .inner-card.orange { background: linear-gradient(135deg, #f5a623, #e08c10); }
        .inner-card.cyan   { background: linear-gradient(135deg, #2ec6e8, #1a8fb3); }
        .inner-card.red    { background: linear-gradient(135deg, #f06c2b, #d45a1a); }

        .inner-top {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }
        .inner-avatar {
            width: 52px; height: 52px;
            border-radius: 14px;
            background: rgba(255,255,255,0.25);
            overflow: hidden;
            flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
        }
        .inner-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .inner-avatar .initials { color: #fff; font-size: 20px; font-weight: 700; }

        .inner-info { flex: 1; }
        .inner-nomor { color: #fff; font-size: 16px; font-weight: 700; margin-bottom: 2px; }
        .inner-nama  { color: rgba(255,255,255,0.95); font-size: 13px; font-weight: 500; }
        .inner-nip   { color: rgba(255,255,255,0.75); font-size: 11px; margin-top: 2px; }

        .badge-selesai {
            background: #2ecc71;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 50px;
            white-space: nowrap;
            align-self: flex-start;
        }

        /* TANGGAL ROW */
        .tanggal-row {
            background: rgba(255,255,255,0.22);
            border-radius: 50px;
            padding: 9px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .tanggal-row span { color: #fff; font-size: 13px; font-weight: 500; }

        /* BTN UNDUH */
        .btn-unduh {
            width: 100%;
            background: #1a8fb3;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 14px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            transition: background 0.2s, transform 0.1s;
        }
        .btn-unduh:hover { background: #157a9a; }
        .btn-unduh:active { transform: scale(0.97); }
        .btn-unduh svg {
            width: 20px; height: 20px;
            stroke: #fff; fill: none; stroke-width: 2;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 80px 24px;
        }
        .empty-icon {
            width: 90px; height: 90px;
            background: rgba(26,143,179,0.10);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 18px;
        }
        .empty-icon svg { width: 44px; height: 44px; stroke: #1a8fb3; fill: none; stroke-width: 1.5; }
        .empty-title { font-size: 16px; font-weight: 700; color: #333; margin-bottom: 8px; }
        .empty-sub { font-size: 13px; color: #888; line-height: 1.6; }

        /* DOWNLOADING OVERLAY */
        .dl-toast {
            display: none;
            position: fixed;
            bottom: 100px;
            left: 50%; transform: translateX(-50%);
            background: #1a8fb3;
            color: #fff;
            padding: 12px 24px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 700;
            z-index: 300;
            box-shadow: 0 4px 14px rgba(26,143,179,0.35);
            white-space: nowrap;
        }
        .dl-toast.show { display: block; animation: fadeUp 0.3s ease; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateX(-50%) translateY(10px); }
            to   { opacity: 1; transform: translateX(-50%) translateY(0); }
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

    <!-- TOP BAR -->
    <div class="top-bar">
        <a href="{{ route('mitra.dashboard') }}">&#8249;</a>
        <h2>Pengunduhan</h2>
        <span class="more">&#8942;</span>
    </div>

    <!-- CONTENT -->
    <div class="content">

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @php $colors = ['purple', 'orange', 'cyan', 'red']; @endphp

        @forelse($pengajuanList as $i => $item)
            @php
                $color     = $colors[$i % 4];
                $nomorSkpp = 'SKPP ' . str_pad($item->id, 3, '0', STR_PAD_LEFT);
                $nip       = $item->pencatatan->nip ?? '—';
                $nama      = $item->pencatatan->nama_lengkap ?? Auth::user()->name;
                $inisial   = strtoupper(substr($nama, 0, 1));
                $tglSelesai = $item->arsip->tanggal_selesai
                    ? $item->arsip->tanggal_selesai->translatedFormat('j M Y')
                    : $item->updated_at->translatedFormat('j M Y');
            @endphp

            <div class="outer-card">
                <div class="inner-card {{ $color }}">
                    <div class="inner-top">
                        <div class="inner-avatar">
                            @if(Auth::user()->foto ?? false)
                                <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="foto">
                            @else
                                <span class="initials">{{ $inisial }}</span>
                            @endif
                        </div>
                        <div class="inner-info">
                            <div class="inner-nomor">{{ $nomorSkpp }}</div>
                            <div class="inner-nama">{{ $nama }}</div>
                            <div class="inner-nip">NIP : {{ $nip }}</div>
                        </div>
                        <span class="badge-selesai">Selesai Dibuat</span>
                    </div>
                    <div class="tanggal-row">
                        <span>Tanggal Selesai</span>
                        <span>{{ $tglSelesai }}</span>
                    </div>
                </div>

                <!-- TOMBOL UNDUH -->
                <a
                    href="{{ route('mitra.pengunduhan.download', $item->id) }}"
                    class="btn-unduh"
                    onclick="showToast()"
                >
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2v13M7 11l5 5 5-5"/>
                        <path d="M3 18h18v2H3z"/>
                    </svg>
                    Unduh
                </a>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2v13M7 11l5 5 5-5"/>
                        <rect x="3" y="18" width="18" height="3" rx="1"/>
                    </svg>
                </div>
                <div class="empty-title">Belum ada SKPP tersedia</div>
                <div class="empty-sub">SKPP akan muncul di sini setelah<br>selesai diproses oleh staff.</div>
            </div>
        @endforelse

    </div>

    <!-- TOAST NOTIF -->
    <div class="dl-toast" id="dl-toast">
        ⬇ Mengunduh SKPP...
    </div>

    {{-- NAVBAR --}}
        <div class="navbar">
            <a href="{{ route('mitra.dashboard') }}" class="nav-item">
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
    function showToast() {
        const toast = document.getElementById('dl-toast');
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 3000);
    }
</script>
</body>
</html>