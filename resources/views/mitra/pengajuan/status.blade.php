<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Status Pengajuan - SKPP</title>
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

        .card-item {
            background: #fff;
            border-radius: 20px;
            padding: 16px;
            margin-bottom: 14px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            display: block;
            text-decoration: none;
            color: inherit;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .card-id {
            font-size: 15px;
            font-weight: 700;
            color: #1a8fb3;
        }

        .badge {
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 50px;
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

        .status-steps {
            background: #f8fcfe;
            border-radius: 12px;
            padding: 10px 12px;
            margin-top: 10px;
            font-size: 12px;
            color: #555;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #888;
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
            text-decoration: none;
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
            <h2>Status Pengajuan</h2>
            <span style="width:40px"></span>
        </div>

        <div class="content">
            @forelse($pengajuans as $item)
                @php
                    $isSelesai = $item->status_arsip === 'diarsipkan' && $item->arsip?->dikirim_ke_mitra;
                    $statusLabel = $isSelesai ? 'Selesai' : ucfirst($item->status);
                    $statusBadge = $isSelesai ? 'badge-selesai' : 'badge-' . $item->status;
                @endphp
                <a href="{{ route('mitra.pengajuan.show', $item->id) }}" class="card-item">
                    <div class="card-header">
                        <span class="card-id">SKPP #{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</span>
                        <span class="badge {{ $statusBadge }}">{{ $statusLabel }}</span>
                    </div>
                    <div style="font-weight: 700; font-size: 14px; color: #222;">{{ $item->nama_perusahaan }}</div>
                    <div style="font-size: 12px; color: #777; margin-top: 2px;">{{ $item->keperluan }}</div>

                    <div class="status-steps">
                        @if ($isSelesai)
                            ✓ Dokumen SKPP telah diarsipkan & siap diunduh
                        @elseif($item->status_draft === 'sudah_diupload')
                            • Draft SKPP telah diupload, menunggu pengarsipan
                        @elseif($item->status_pengecekan === 'disetujui')
                            • Disetujui Kepala, dalam proses pembuatan SKPP
                        @elseif($item->status_pengecekan === 'ditolak')
                            ✕ Ditolak: {{ $item->pengecekan?->catatan_pengecekan ?: 'Dokumen tidak valid' }}
                        @elseif($item->status_pencatatan === 'selesai_dicatat')
                            • Data dicatat oleh Staff, menunggu review Kepala
                        @else
                            • Menunggu verifikasi awal oleh Staff
                        @endif
                    </div>
                </a>
            @empty
                <div class="empty-state">
                    <div style="font-size: 48px; margin-bottom: 10px;">📋</div>
                    <p>Belum ada pengajuan aktif.</p>
                </div>
            @endforelse

            <div style="margin-top: 16px; display: flex; justify-content: center;">
                {{ $pengajuans->links() }}
            </div>
        </div>

        <div class="navbar">
            <a href="{{ route('mitra.dashboard') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" /><polyline points="9 22 9 12 15 12 15 22" /></svg>
            </a>
            <a href="{{ route('mitra.pengajuan.create') }}" class="nav-plus">
                <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
            </a>
            <a href="{{ route('profile.edit') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4" /><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" /></svg>
            </a>
        </div>
    </div>
</body>

</html>
