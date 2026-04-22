<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Pengecekan</title>
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
            font-size: 26px;
            text-decoration: none;
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
            padding: 40px 16px 90px;
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

        .card-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px 16px;
            border-radius: 22px;
            margin-bottom: 14px;
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

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #888;
        }

        .empty-state .icon {
            font-size: 52px;
            margin-bottom: 12px;
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
        }

        .nav-plus svg {
            stroke: #fff;
            width: 24px;
            height: 24px;
        }
    </style>
</head>

<body>
    <div class="shell">

        <div class="top-bar">
            <a href="{{ route('kepala.dashboard') }}">&#8249;</a>
            <h2>Pengecekan</h2>
            <span class="more">&#8942;</span>
        </div>

        <div class="content">

            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @forelse($pengajuanList as $item)
                @php
                    $status = $item->status_pengecekan ?? 'menunggu';
                    $nomorSkpp = 'SKPP ' . str_pad($item->id, 3, '0', STR_PAD_LEFT);
                    $tanggal = $item->created_at->translatedFormat('j F Y');
                    $inisial = strtoupper(substr($item->user->name ?? 'U', 0, 1));
                @endphp

                <a href="{{ route('kepala.pengecekan.show', $item->id) }}" class="card-item">
                    <div class="card-avatar">
                        <span class="initials">{{ $inisial }}</span>
                    </div>
                    <div class="card-info">
                        <div class="card-nomor">{{ $nomorSkpp }}</div>
                        <div class="card-nama">{{ $item->user->name ?? '-' }}</div>
                        <div class="card-tanggal">{{ $tanggal }}</div>
                    </div>
                    <span class="badge badge-{{ $status }}">
                        {{ $status === 'menunggu' ? 'Menunggu' : ($status === 'disetujui' ? 'Disetujui' : 'Ditolak') }}
                    </span>
                </a>
            @empty
                <div class="empty-state">
                    <div class="icon">🔍</div>
                    <p>Belum ada pengajuan yang siap dicek.</p>
                </div>
            @endforelse

        </div>

        <!-- NAVBAR -->
            <div class="absolute bottom-0 w-full bg-white border-t flex justify-around py-4">
                <div class="text-blue-500">
                    <a href="{{ route('dashboard') }}">
                        <svg class="w-7 h-7" fill="currentColor">
                            <path d="M3 9l9-7 9 7v11H3z" />
                        </svg>
                    </a>
                </div>

                <div>
                    <svg class="w-8 h-8" fill="none" stroke="black" stroke-width="2">
                        <path d="M12 5v14M5 12h14" />
                    </svg>
                </div>

                <div>
                    <a href="{{ route('profile.edit') }}">
                        <svg class="w-7 h-7" fill="none" stroke="black" stroke-width="2">
                            <circle cx="12" cy="7" r="4" />
                            <path d="M5 21c1.5-4 12.5-4 14 0" />
                        </svg>
                    </a>
                </div>
            </div>

    </div>
</body>

</html>
