<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKPP - Sistem Pengajuan dan Pengelolaan Kepegawaian</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #f7fafc;
            color: #2d3748;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #2ec6e8 0%, #1a8fb3 100%);
        }
    </style>
</head>

<body class="min-h-screen flex flex-col justify-between">
    <!-- NAVBAR -->
    <header class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#1a8fb3] to-[#2ec6e8] flex items-center justify-center text-white font-bold text-lg shadow-md">
                    SK
                </div>
                <div>
                    <span class="font-bold text-lg text-gray-800 tracking-tight">SKPP</span>
                    <span class="text-xs text-gray-500 hidden sm:inline ml-2 border-l pl-2">Kepegawaian Digital</span>
                </div>
            </div>

            <nav class="flex items-center gap-3">
                <a href="{{ route('panduan') }}" class="text-sm font-semibold text-gray-600 hover:text-[#1a8fb3] px-3 py-2 rounded-lg transition">
                    Panduan
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold text-white bg-[#1a8fb3] hover:bg-[#157a9a] px-5 py-2 rounded-full shadow-sm transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-[#1a8fb3] hover:bg-[#eaf6fb] px-4 py-2 rounded-full transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="text-sm font-bold text-white bg-[#1a8fb3] hover:bg-[#157a9a] px-5 py-2 rounded-full shadow-md transition">
                        Daftar
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- HERO SECTION -->
    <main class="flex-1">
        <section class="hero-gradient text-white py-16 sm:py-24 px-4 sm:px-6 lg:px-8 text-center relative overflow-hidden">
            <div class="max-w-3xl mx-auto relative z-10">
                <span class="inline-block bg-white/20 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider mb-4">
                    Sistem Layanan Administrasi Digital
                </span>
                <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                    Pengajuan & Pengelolaan Kepegawaian Lebih Cepat dan Transparan
                </h1>
                <p class="text-base sm:text-lg text-cyan-50 mb-8 max-w-2xl mx-auto leading-relaxed">
                    Sistem terintegrasi untuk mempermudah Mitra mengajukan permohonan SKPP, membantu Staff memverifikasi dokumen, dan memberikan Kepala akses persetujuan secara digital.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="w-full sm:w-auto bg-white text-[#1a8fb3] hover:bg-gray-50 px-8 py-3.5 rounded-full font-bold shadow-lg transition transform hover:-translate-y-0.5">
                            Buka Dashboard Saya
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="w-full sm:w-auto bg-white text-[#1a8fb3] hover:bg-gray-50 px-8 py-3.5 rounded-full font-bold shadow-lg transition transform hover:-translate-y-0.5">
                            Mulai Ajukan SKPP
                        </a>
                        <a href="{{ route('login') }}" class="w-full sm:w-auto border-2 border-white/80 hover:bg-white/10 text-white px-8 py-3.5 rounded-full font-semibold transition">
                            Login ke Akun
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- FITUR UTAMA SECTION -->
        <section class="py-16 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Alur Layanan SKPP</h2>
                <p class="text-sm sm:text-base text-gray-500 max-w-xl mx-auto">
                    Seluruh proses administrasi dirancang terstruktur sesuai kewenangan masing-masing role.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Mitra -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-cyan-100 text-[#1a8fb3] flex items-center justify-center font-bold text-xl mb-4">
                        1
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Mitra Pemohon</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Mengajukan permohonan SKPP secara mandiri, mengunggah dokumen pendukung (Slip Gaji, SK, Pengantar), serta memantau status perkembangan secara real-time.
                    </p>
                </div>

                <!-- Staff -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xl mb-4">
                        2
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Staff Administrasi</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Memeriksa dan memvalidasi keabsahan data pemohon, mencatat NIP, serta mengarsipkan dokumen SKPP yang telah disetujui untuk dikirimkan kembali ke mitra.
                    </p>
                </div>

                <!-- Kepala -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-xl mb-4">
                        3
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Kepala Staff</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Meninjau kelengkapan berkas, memberikan keputusan persetujuan atau penolakan, serta mengunggah file SKPP resmi yang siap diterbitkan.
                    </p>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200 py-6 text-center text-xs text-gray-500">
        <p>&copy; {{ date('Y') }} SKPP - Sistem Pengajuan dan Pengelolaan Kepegawaian. Hak Cipta Dilindungi.</p>
    </footer>
</body>

</html>
