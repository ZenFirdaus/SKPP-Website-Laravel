@extends('layouts.app')

@section('content')
    <style>
        body {
            background: #e8f3f8;
        }

        .shell {
            max-width: 430px;
            margin: auto;
            min-height: 100vh;
            background: #dff0f7;
        }

        /* HEADER */
        .top-bar {
            background: linear-gradient(160deg, #2ec6e8, #1a8fb3);
            padding: 30px 20px 80px;
            /* ⬅️ tambah tinggi */
            border-radius: 0 0 30px 30px;
            display: flex;
            align-items: flex-end;
            /* ⬅️ bikin isi turun ke bawah */
            justify-content: space-between;
        }

        .top-bar h1 {
            color: white;
            font-weight: 800;
            font-size: 24px;
            margin-bottom: 5px;
            /* ⬅️ kasih jarak bawah */
        }

        .top-bar a {
            color: white;
            font-size: 24px;
        }

        /* CONTENT */
        .content {
            margin-top: -30px;
            padding: 15px;
        }

        /* CARD */
        .card-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 18px;
            border-radius: 25px;
            margin-bottom: 14px;
            color: white;
        }

        /* WARNA */
        .card-item:nth-child(1) {
            background: linear-gradient(135deg, #6c63ff, #4e46c4);
        }

        .card-item:nth-child(2) {
            background: linear-gradient(135deg, #f5a623, #e08c10);
        }

        .card-item:nth-child(3) {
            background: linear-gradient(135deg, #2ec6e8, #1a8fb3);
        }

        .card-item:nth-child(4) {
            background: linear-gradient(135deg, #f06c2b, #d45a1a);
        }

        /* AVATAR */
        .card-avatar {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            overflow: hidden;
        }

        .card-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* TEXT */
        .card-info {
            flex: 1;
        }

        .card-nomor {
            font-weight: bold;
        }

        .card-nama {
            font-size: 14px;
            opacity: .9;
        }

        .card-tanggal {
            font-size: 12px;
            opacity: .7;
        }

        /* BADGE */
        .badge {
            font-size: 11px;
            padding: 6px 10px;
            border-radius: 20px;
        }

        .badge-belum {
            background: #ff6b9d;
        }

        .badge-selesai {
            background: #2ecc71;
        }

        .empty-state {
            height: 60vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* tengah vertikal */
            align-items: center;
            /* tengah horizontal */
            text-align: center;
            color: #888;
        }

        .empty-state .icon {
            font-size: 50px;
            margin-bottom: 10px;
        }
    </style>

    <div class="shell">

        <div class="top-bar">
            <a href="{{ route('dashboard') }}">‹</a>
            <h1>Pencatatan</h1>
            <span style="color:white;">⋮</span>
        </div>

        <div class="content">
            @forelse($pengajuanList as $item)
                <a href="{{ route('staff.pencatatan.create', $item->id) }}" class="card-item">

                    <div class="card-avatar">
                        <img src="https://i.pravatar.cc/100">
                    </div>

                    <div class="card-info">
                        <div class="card-nomor">SKPP {{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</div>
                        <div class="card-nama">{{ $item->user->name }}</div>
                        <div class="card-tanggal">{{ $item->created_at->format('d F Y') }}</div>
                    </div>

                    <span
                        class="badge {{ $item->status_pencatatan == 'selesai_dicatat' ? 'badge-selesai' : 'badge-belum' }}">
                        {{ $item->status_pencatatan == 'selesai_dicatat' ? 'Selesai Dicatat' : 'Belum Dicatat' }}
                    </span>

                </a>

            @empty
                <div class="empty-state">
                    <div class="icon">📋</div>
                    <p>Belum ada pengajuan yang masuk.</p>
                </div>
            @endforelse
        </div>


        <!-- NAVBAR -->
        <div class="absolute bottom-0 w-full bg-white border-t flex justify-around py-4">
            <div class="text-blue-500">
                <svg class="w-7 h-7" fill="currentColor">
                    <path d="M3 9l9-7 9 7v11H3z" />
                </svg>
            </div>

            <div>
                <svg class="w-8 h-8" fill="none" stroke="black" stroke-width="2">
                    <path d="M12 5v14M5 12h14" />
                </svg>
            </div>

            <div>
                <svg class="w-7 h-7" fill="none" stroke="black" stroke-width="2">
                    <circle cx="12" cy="7" r="4" />
                    <path d="M5 21c1.5-4 12.5-4 14 0" />
                </svg>
            </div>
        </div>


    </div>
@endsection
