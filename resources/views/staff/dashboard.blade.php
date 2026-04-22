{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Staff
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                Halo Staff, {{ auth()->user()->name }}
            </div>
        </div>
    </div>
</x-app-layout><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Pencatatan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #e8f3f8;
            display: flex;
            justify-content: center;
        }
        .shell {
            width: 100%;
            max-width: 430px;
            min-height: 100vh;
            background: #dff0f7;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        /* HEADER */
        .top-bar {
            background: linear-gradient(160deg, #2ec6e8 0%, #1a8fb3 100%);
            padding: 20px 20px 52px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 0 0 32px 32px;
        }
        .top-bar a { color: #fff; font-size: 26px; text-decoration: none; line-height: 1; }
        .top-bar h2 { color: #fff; font-size: 20px; font-weight: 700; flex: 1; text-align: center; }
        .top-bar .more { color: #fff; font-size: 22px; cursor: pointer; }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 16px 16px 90px;
            margin-top: -24px;
        }

        /* ALERT */
        .alert-success {
            background: #d4edda;
            color: #155724;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 16px;
        }

        /* CARD ITEM */
        .card-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px 16px;
            border-radius: 22px;
            margin-bottom: 14px;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.15s, box-shadow 0.15s;
            position: relative;
            overflow: hidden;
        }
        .card-item:hover { transform: scale(1.02); }
        .card-item:active { transform: scale(0.98); }

        /* warna kartu bergantian */
        .card-item:nth-child(4n+1) { background: linear-gradient(135deg, #6c63ff, #4e46c4); }
        .card-item:nth-child(4n+2) { background: linear-gradient(135deg, #f5a623, #e08c10); }
        .card-item:nth-child(4n+3) { background: linear-gradient(135deg, #2ec6e8, #1a8fb3); }
        .card-item:nth-child(4n+4) { background: linear-gradient(135deg, #f06c2b, #d45a1a); }

        .card-avatar {
            width: 58px;
            height: 58px;
            border-radius: 16px;
            background: rgba(255,255,255,0.25);
            flex-shrink: 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-avatar img {
            width: 100%; height: 100%; object-fit: cover;
        }
        .card-avatar .initials {
            color: #fff;
            font-size: 20px;
            font-weight: 700;
        }

        .card-info { flex: 1; }
        .card-nomor {
            color: #fff;
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 3px;
        }
        .card-nama {
            color: rgba(255,255,255,0.92);
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 4px;
        }
        .card-tanggal {
            color: rgba(255,255,255,0.75);
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
        .badge-belum {
            background: #ff6b9d;
            color: #fff;
        }
        .badge-selesai {
            background: #2ecc71;
            color: #fff;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #888;
        }
        .empty-state .icon {
            font-size: 52px;
            margin-bottom: 12px;
        }
        .empty-state p { font-size: 15px; }

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
        .nav-item { display: flex; flex-direction: column; align-items: center; cursor: pointer; }
        .nav-item svg { width: 26px; height: 26px; stroke: #aaa; fill: none; stroke-width: 1.8; }
        .nav-item.active svg { stroke: #1a8fb3; }
        .nav-plus {
            width: 50px; height: 50px;
            background: #1a8fb3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: -20px;
            box-shadow: 0 4px 14px rgba(26,143,179,0.4);
        }
        .nav-plus svg { stroke: #fff; width: 24px; height: 24px; }
    </style>
</head>
<body>
<div class="shell">

    <!-- TOP BAR -->
    <div class="top-bar">
        <a href="{{ route('staff.dashboard') }}">&#8249;</a>
        <h2>Pencatatan</h2>
        <span class="more">&#8942;</span>
    </div>

    <!-- CONTENT -->
    <div class="content">

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @forelse($pengajuanList as $item)
            @php
                $sudahDicatat = $item->status_pencatatan === 'selesai_dicatat';
                $inisial = strtoupper(substr($item->user->name ?? 'U', 0, 1));
                $nomorSkpp = 'SKPP ' . str_pad($item->id, 3, '0', STR_PAD_LEFT);
                $tanggal = $item->created_at->translatedFormat('j F Y');
            @endphp

            <a href="{{ route('staff.pencatatan.create', $item->id) }}" class="card-item">
                <div class="card-avatar">
                    @if($item->user->foto ?? false)
                        <img src="{{ asset('storage/' . $item->user->foto) }}" alt="foto">
                    @else
                        <span class="initials">{{ $inisial }}</span>
                    @endif
                </div>
                <div class="card-info">
                    <div class="card-nomor">{{ $nomorSkpp }}</div>
                    <div class="card-nama">{{ $item->user->name ?? '-' }}</div>
                    <div class="card-tanggal">{{ $tanggal }}</div>
                </div>
                <span class="badge {{ $sudahDicatat ? 'badge-selesai' : 'badge-belum' }}">
                    {{ $sudahDicatat ? 'Selesai Dicatat' : 'Belum Dicatat' }}
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
</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-300">
    <div class="w-full flex justify-center">

        <!-- CONTAINER -->
        <div class="w-full max-w-[430px] min-h-screen bg-[#f3f4f6] rounded-[40px] shadow-2xl overflow-hidden relative">

            <!-- HEADER -->
            <div class="bg-gradient-to-r from-cyan-400 to-blue-500 px-6 pt-6 pb-20 text-white">

                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('profile.edit') }}">
                            <div class="w-14 h-14 bg-white rounded-full"></div>
                        </a>
                        <div>
                            <p class="text-base">Halo,</p>
                            <p class="font-bold text-lg">{{ Auth::user()->name }}</p>
                        </div>
                    </div>

                    <!-- ICON KANAN -->
                    <div class="flex gap-4 items-center">

                        <!-- SETTING -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M12 8a4 4 0 100 8 4 4 0 000-8z" />
                            <path
                                d="M2 12h2m16 0h2M12 2v2m0 16v2M4.9 4.9l1.4 1.4m11.4 11.4l1.4 1.4M4.9 19.1l1.4-1.4m11.4-11.4l1.4-1.4" />
                        </svg>

                        <!-- TITIK TIGA -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="currentColor">
                            <circle cx="12" cy="5" r="2" />
                            <circle cx="12" cy="12" r="2" />
                            <circle cx="12" cy="19" r="2" />
                        </svg>

                    </div>
                </div>
            </div>

            <!-- CARD -->
            <div class="bg-white -mt-16 mx-4 p-6 shadow-lg rounded-2xl">

                <div class="flex justify-between items-center">
                    <div class="w-2/3">
                        <h2 class="text-xl font-bold text-gray-800">
                            Selamat Datang di SIMUDAH
                        </h2>
                        <p class="text-gray-500 text-base mt-2">
                            Pengajuan, pengecekan, hingga arsip dalam satu aplikasi
                        </p>
                    </div>

                    <img src="https://cdn-icons-png.flaticon.com/512/3075/3075977.png" class="w-24">
                </div>

            </div>

            <!-- MENU -->
            <div class="p-6 grid grid-cols-2 gap-6 mt-2">

                <!-- Pengajuan -->
                <a href="{{ route('mitra.pengajuan.index') }}" class="transform transition hover:scale-105">
                    <div
                        class="bg-indigo-500 p-8 text-white shadow-lg rounded-2xl h-[170px] flex flex-col justify-between">
                        <svg class="w-16 h-16" fill="none" stroke="white" stroke-width="2">
                            <path d="M7 2h6l5 5v13H7z" />
                        </svg>
                        <p class="text-lg font-semibold">Pengajuan</p>
                    </div>
                </a>

                <!-- Catat Data -->
                <a href="{{ route('staff.pencatatan.index') }}" class="transform transition hover:scale-105">
                    <div
                        class="bg-orange-400 p-8 text-white shadow-lg rounded-2xl h-[170px] flex flex-col justify-between">
                        <svg class="w-16 h-16" fill="none" stroke="white" stroke-width="2">
                            <path d="M16.5 3.5 7 19l-4 1 1-4Z" />
                        </svg>
                        <p class="text-lg font-semibold">Catat Data</p>
                    </div>
                </a>

                <!-- Pengecekan -->
                <a href="{{ route('kepala.pengecekan.index') }}" class="transform transition hover:scale-105">
                    <div
                        class="bg-green-500 p-8 text-white shadow-lg rounded-2xl h-[170px] flex flex-col justify-between">
                        <svg class="w-20 h-20" fill="none" stroke="white" stroke-width="2">
                            <path d="M20 6 9 17l-5-5" />
                        </svg>
                        <p class="text-lg font-semibold">Pengecekan</p>
                    </div>
                </a>

                <!-- Draft -->
                <a href="{{ route('staff.pengarsipan.index') }}" class="transform transition hover:scale-105">
                    <div
                        class="bg-yellow-400 p-8 text-white shadow-lg rounded-2xl h-[170px] flex flex-col justify-between">
                        <svg class="w-16 h-16" fill="none" stroke="white" stroke-width="2">
                            <path d="M6 2h8l4 4v14H6z" />
                        </svg>
                        <p class="text-lg font-semibold">Draft SKPP</p>
                    </div>
                </a>

                <!-- Arsip -->
                <a href="{{ route('staff.pengarsipan.index') }}" class="transform transition hover:scale-105">
                    <div
                        class="bg-blue-400 p-8 text-white shadow-lg rounded-2xl h-[170px] flex flex-col justify-between">
                        <svg class="w-16 h-16" fill="none" stroke="white" stroke-width="2">
                            <path d="M3 7h18v13H3z" />
                            <path d="M3 7l3-4h12l3 4" />
                        </svg>
                        <p class="text-lg font-semibold">Arsip</p>
                    </div>
                </a>

                <!-- Pengunduhan -->
                <a href="{{ route('mitra.pengunduhan.index') }}" class="transform transition hover:scale-105">
                    <div
                        class="bg-pink-400 p-8 text-white shadow-lg rounded-2xl h-[170px] flex flex-col justify-between">
                        <svg class="w-16 h-16" fill="none" stroke="white" stroke-width="2">
                            <path d="M4 19h16M4 15h10M4 11h16M4 7h10" />
                        </svg>
                        <p class="text-lg font-semibold">Unduh SKPP</p>
                    </div>
                </a>

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
    </div>
</body>

</html>
