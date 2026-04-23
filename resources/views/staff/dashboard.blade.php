
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
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

            {{-- NAVBAR --}}
            <div class="navbar">    
                <a href="{{ route('staff.dashboard') }}" class="nav-item active">
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
    </div>
</body>

</html>
