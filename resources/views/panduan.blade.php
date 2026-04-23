<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Panduan Pengguna</title>
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

        .top-bar .more {
            color: #fff;
            font-size: 22px;
            padding: 4px 8px;
        }

        .content {
            flex: 1;
            padding: 16px 16px 100px;
            margin-top: -24px;
        }

        /* TAB ROLE */
        .tab-row {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            background: #fff;
            border-radius: 50px;
            padding: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .tab-btn {
            flex: 1;
            padding: 9px 6px;
            border-radius: 50px;
            border: none;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            background: transparent;
            color: #888;
            transition: all 0.2s;
        }

        .tab-btn.active {
            background: #1a8fb3;
            color: #fff;
            box-shadow: 0 2px 8px rgba(26, 143, 179, 0.3);
        }

        .tab-btn:hover:not(.active) {
            background: #eaf6fb;
            color: #1a8fb3;
        }

        /* TAB CONTENT */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* INTRO CARD */
        .intro-card {
            background: linear-gradient(135deg, #1a8fb3, #2ec6e8);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .intro-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .intro-icon svg {
            width: 28px;
            height: 28px;
            stroke: #fff;
            fill: none;
            stroke-width: 2;
        }

        .intro-text .title {
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .intro-text .sub {
            color: rgba(255, 255, 255, 0.85);
            font-size: 12px;
            line-height: 1.5;
        }

        /* STEP CARD */
        .step-card {
            background: #fff;
            border-radius: 20px;
            padding: 18px;
            margin-bottom: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        }

        .step-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            cursor: pointer;
        }

        .step-num {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .step-num.blue {
            background: #1a8fb3;
        }

        .step-num.purple {
            background: #6c63ff;
        }

        .step-num.green {
            background: #2ecc71;
        }

        .step-num.orange {
            background: #f5a623;
        }

        .step-num.red {
            background: #e74c3c;
        }

        .step-num.cyan {
            background: #00bcd4;
        }

        .step-title {
            font-size: 15px;
            font-weight: 700;
            color: #222;
            flex: 1;
        }

        .step-arrow {
            color: #aaa;
            font-size: 18px;
            transition: transform 0.2s;
        }

        .step-arrow.open {
            transform: rotate(90deg);
        }

        .step-body {
            display: none;
            padding-top: 4px;
        }

        .step-body.open {
            display: block;
        }

        .step-desc {
            font-size: 13px;
            color: #555;
            line-height: 1.7;
            margin-bottom: 10px;
        }

        .step-list {
            list-style: none;
            padding: 0;
        }

        .step-list li {
            font-size: 13px;
            color: #444;
            padding: 6px 0 6px 22px;
            position: relative;
            border-bottom: 1px solid #f0f0f0;
            line-height: 1.5;
        }

        .step-list li:last-child {
            border-bottom: none;
        }

        .step-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #2ecc71;
            font-weight: 700;
            font-size: 13px;
        }

        .note-box {
            background: #fff8e1;
            border-left: 3px solid #f5a623;
            border-radius: 10px;
            padding: 10px 14px;
            margin-top: 10px;
            font-size: 12px;
            color: #856404;
            line-height: 1.6;
        }

        .note-box strong {
            color: #e08c10;
        }

        /* SECTION TITLE */
        .section-label {
            font-size: 12px;
            font-weight: 700;
            color: #1a8fb3;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin: 20px 0 10px;
            padding-left: 4px;
        }

        /* FAQ */
        .faq-card {
            background: #fff;
            border-radius: 16px;
            padding: 16px 18px;
            margin-bottom: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }

        .faq-q {
            font-size: 14px;
            font-weight: 600;
            color: #222;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .faq-q span {
            flex: 1;
        }

        .faq-icon {
            color: #1a8fb3;
            font-size: 18px;
            flex-shrink: 0;
            transition: transform 0.2s;
        }

        .faq-icon.open {
            transform: rotate(45deg);
        }

        .faq-a {
            display: none;
            font-size: 13px;
            color: #555;
            line-height: 1.7;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #f0f0f0;
        }

        .faq-a.open {
            display: block;
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
            <a href="{{ url()->previous() }}">&#8249;</a>
            <h2>Panduan Pengguna</h2>
            <span class="more">&#8942;</span>
        </div>

        <div class="content">

            <!-- TAB ROLE -->
            <div class="tab-row">
                <button class="tab-btn active" onclick="switchTab('mitra', this)">Mitra</button>
                <button class="tab-btn" onclick="switchTab('staff', this)">Staff</button>
                <button class="tab-btn" onclick="switchTab('kepala', this)">Kepala</button>
            </div>

            <!-- ===================== MITRA ===================== -->
            <div class="tab-content active" id="tab-mitra">

                <div class="intro-card">
                    <div class="intro-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </div>
                    <div class="intro-text">
                        <div class="title">Panduan Mitra Kerja</div>
                        <div class="sub">Pelajari cara mengajukan SKPP dan mengunduh dokumen yang sudah selesai
                            diproses.</div>
                    </div>
                </div>

                <div class="section-label">Langkah-langkah</div>

                <!-- Step 1 -->
                <div class="step-card">
                    <div class="step-header" onclick="toggleStep(this)">
                        <div class="step-num blue">1</div>
                        <div class="step-title">Daftar & Login Akun</div>
                        <span class="step-arrow">›</span>
                    </div>
                    <div class="step-body">
                        <p class="step-desc">Buat akun baru atau masuk menggunakan akun yang sudah terdaftar.</p>
                        <ul class="step-list">
                            <li>Buka halaman Login di aplikasi SIMUDAH</li>
                            <li>Jika belum punya akun, klik "Daftar di sini"</li>
                            <li>Isi Nama Lengkap, Username, Email, dan Password</li>
                            <li>Klik tombol Daftar, lalu login dengan email & password</li>
                            <li>Setelah login, kamu akan masuk ke Dashboard Mitra</li>
                        </ul>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="step-card">
                    <div class="step-header" onclick="toggleStep(this)">
                        <div class="step-num purple">2</div>
                        <div class="step-title">Mengajukan SKPP</div>
                        <span class="step-arrow">›</span>
                    </div>
                    <div class="step-body">
                        <p class="step-desc">Kirim pengajuan SKPP dengan melengkapi data dan mengunggah dokumen
                            pendukung.</p>
                        <ul class="step-list">
                            <li>Klik menu <strong>Pengajuan</strong> di dashboard</li>
                            <li>Isi data: Nama Pegawai, Alamat, NPWP, dan Keperluan</li>
                            <li>Upload file <strong>Slip Gaji</strong> (format PDF, maks 2MB)</li>
                            <li>Upload file <strong>SK</strong> (Surat Keputusan, format PDF)</li>
                            <li>Upload file <strong>Surat Pengantar</strong> (format PDF)</li>
                            <li>Klik tombol <strong>Kirim Pengajuan</strong></li>
                        </ul>
                        <div class="note-box"><strong>Catatan:</strong> Pastikan semua file dalam format PDF dan ukuran
                            tidak melebihi 2MB per file.</div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="step-card">
                    <div class="step-header" onclick="toggleStep(this)">
                        <div class="step-num green">3</div>
                        <div class="step-title">Menunggu Proses</div>
                        <span class="step-arrow">›</span>
                    </div>
                    <div class="step-body">
                        <p class="step-desc">Setelah pengajuan dikirim, sistem akan memproses dokumen melalui beberapa
                            tahap.</p>
                        <ul class="step-list">
                            <li>Staff administrasi akan mencatat dan memverifikasi data</li>
                            <li>Kepala staff akan memeriksa kelengkapan dokumen</li>
                            <li>Kepala akan mengupload file SKPP yang sudah dibuat</li>
                            <li>Staff akan mengarsipkan dan mengirimkan SKPP ke kamu</li>
                        </ul>
                        <div class="note-box"><strong>Info:</strong> Proses pengajuan biasanya membutuhkan beberapa hari
                            kerja.</div>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="step-card">
                    <div class="step-header" onclick="toggleStep(this)">
                        <div class="step-num orange">4</div>
                        <div class="step-title">Mengunduh SKPP</div>
                        <span class="step-arrow">›</span>
                    </div>
                    <div class="step-body">
                        <p class="step-desc">Setelah SKPP selesai diproses, kamu bisa mengunduhnya dari menu
                            Pengunduhan.</p>
                        <ul class="step-list">
                            <li>Klik menu <strong>Pengunduhan</strong> di dashboard</li>
                            <li>Cari SKPP dengan nomor yang sesuai</li>
                            <li>Klik tombol <strong>Unduh</strong></li>
                            <li>File SKPP PDF akan otomatis terunduh ke perangkatmu</li>
                        </ul>
                    </div>
                </div>

                <div class="section-label">FAQ</div>

                <div class="faq-card" onclick="toggleFaq(this)">
                    <div class="faq-q"><span>Berapa lama proses pengajuan SKPP?</span><span class="faq-icon">+</span>
                    </div>
                    <div class="faq-a">Proses pengajuan biasanya memakan waktu 3-5 hari kerja, tergantung kelengkapan
                        dokumen dan antrean pengajuan yang masuk.</div>
                </div>

                <div class="faq-card" onclick="toggleFaq(this)">
                    <div class="faq-q"><span>Dokumen apa saja yang harus diupload?</span><span
                            class="faq-icon">+</span></div>
                    <div class="faq-a">Kamu perlu mengupload 3 dokumen: Slip Gaji, Surat Keputusan (SK), dan Surat
                        Pengantar. Semua dalam format PDF maksimal 2MB.</div>
                </div>

                <div class="faq-card" onclick="toggleFaq(this)">
                    <div class="faq-q"><span>SKPP saya belum muncul di menu Pengunduhan?</span><span
                            class="faq-icon">+</span></div>
                    <div class="faq-a">SKPP akan muncul setelah staff mengirimkannya ke akunmu. Hubungi staff
                        administrasi jika proses sudah lebih dari 5 hari kerja.</div>
                </div>

            </div>

            <!-- ===================== STAFF ===================== -->
            <div class="tab-content" id="tab-staff">

                <div class="intro-card" style="background: linear-gradient(135deg, #6c63ff, #4e46c4);">
                    <div class="intro-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <div class="intro-text">
                        <div class="title">Panduan Staff Administrasi</div>
                        <div class="sub">Pelajari cara mencatat data pengajuan dan mengarsipkan SKPP yang sudah
                            disetujui.</div>
                    </div>
                </div>

                <div class="section-label">Langkah-langkah</div>

                <div class="step-card">
                    <div class="step-header" onclick="toggleStep(this)">
                        <div class="step-num blue">1</div>
                        <div class="step-title">Login sebagai Staff</div>
                        <span class="step-arrow">›</span>
                    </div>
                    <div class="step-body">
                        <p class="step-desc">Login menggunakan email dan password akun staff yang telah ditetapkan oleh
                            sistem.</p>
                        <ul class="step-list">
                            <li>Buka halaman Login</li>
                            <li>Masukkan email staff yang sudah terdaftar</li>
                            <li>Masukkan password, lalu klik Login</li>
                            <li>Sistem akan mengarahkan ke Dashboard Staff</li>
                        </ul>
                        <div class="note-box"><strong>Penting:</strong> Hanya email yang terdaftar sebagai staff yang
                            dapat mengakses halaman ini.</div>
                    </div>
                </div>

                <div class="step-card">
                    <div class="step-header" onclick="toggleStep(this)">
                        <div class="step-num purple">2</div>
                        <div class="step-title">Pencatatan Data</div>
                        <span class="step-arrow">›</span>
                    </div>
                    <div class="step-body">
                        <p class="step-desc">Catat data mitra berdasarkan dokumen pengajuan yang masuk.</p>
                        <ul class="step-list">
                            <li>Klik menu <strong>Catat Data</strong> di dashboard</li>
                            <li>Pilih pengajuan dari daftar yang tersedia</li>
                            <li>Isi form: Nama Lengkap dan NIP pegawai</li>
                            <li>Pilih Status Dokumen: <strong>Valid</strong> atau <strong>Tidak Valid</strong></li>
                            <li>Tambahkan catatan jika diperlukan</li>
                            <li>Klik <strong>Simpan</strong> untuk menyimpan data</li>
                        </ul>
                    </div>
                </div>

                <div class="step-card">
                    <div class="step-header" onclick="toggleStep(this)">
                        <div class="step-num green">3</div>
                        <div class="step-title">Pengarsipan SKPP</div>
                        <span class="step-arrow">›</span>
                    </div>
                    <div class="step-body">
                        <p class="step-desc">Setelah kepala mengupload file SKPP, staff bertugas mengarsipkan dan
                            mengirimkan ke mitra.</p>
                        <ul class="step-list">
                            <li>Klik menu <strong>Arsip</strong> di dashboard</li>
                            <li>Cari SKPP yang sudah siap diarsipkan (status: Siap Arsip)</li>
                            <li>Klik tombol <strong>Arsipkan</strong></li>
                            <li>Akan muncul konfirmasi — klik <strong>Ya</strong> untuk mengirim ke mitra</li>
                            <li>SKPP akan langsung tersedia di menu Pengunduhan mitra</li>
                        </ul>
                        <div class="note-box"><strong>Catatan:</strong> SKPP hanya bisa diarsipkan setelah kepala
                            mengupload file SKPP di menu Draft SKPP.</div>
                    </div>
                </div>

                <div class="section-label">FAQ</div>

                <div class="faq-card" onclick="toggleFaq(this)">
                    <div class="faq-q"><span>Pengajuan tidak muncul di menu Pencatatan?</span><span
                            class="faq-icon">+</span></div>
                    <div class="faq-a">Pastikan mitra sudah mengirimkan pengajuan. Pengajuan baru akan muncul di
                        daftar pencatatan setelah berhasil dikirim oleh mitra.</div>
                </div>

                <div class="faq-card" onclick="toggleFaq(this)">
                    <div class="faq-q"><span>Tombol Arsipkan tidak bisa diklik?</span><span class="faq-icon">+</span>
                    </div>
                    <div class="faq-a">Tombol Arsipkan hanya aktif jika kepala sudah mengupload file SKPP di menu
                        Draft SKPP. Hubungi kepala untuk segera mengupload file.</div>
                </div>

            </div>

            <!-- ===================== KEPALA ===================== -->
            <div class="tab-content" id="tab-kepala">

                <div class="intro-card" style="background: linear-gradient(135deg, #f5a623, #e08c10);">
                    <div class="intro-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                        </svg>
                    </div>
                    <div class="intro-text">
                        <div class="title">Panduan Kepala Staff</div>
                        <div class="sub">Pelajari cara memeriksa pengajuan, menyetujui, dan mengupload file SKPP
                            final.</div>
                    </div>
                </div>

                <div class="section-label">Langkah-langkah</div>

                <div class="step-card">
                    <div class="step-header" onclick="toggleStep(this)">
                        <div class="step-num blue">1</div>
                        <div class="step-title">Login sebagai Kepala</div>
                        <span class="step-arrow">›</span>
                    </div>
                    <div class="step-body">
                        <p class="step-desc">Login menggunakan email dan password akun kepala staff yang telah
                            ditetapkan.</p>
                        <ul class="step-list">
                            <li>Buka halaman Login</li>
                            <li>Masukkan email kepala yang sudah terdaftar</li>
                            <li>Masukkan password, lalu klik Login</li>
                            <li>Sistem akan mengarahkan ke halaman Pengecekan</li>
                        </ul>
                    </div>
                </div>

                <div class="step-card">
                    <div class="step-header" onclick="toggleStep(this)">
                        <div class="step-num purple">2</div>
                        <div class="step-title">Pengecekan Dokumen</div>
                        <span class="step-arrow">›</span>
                    </div>
                    <div class="step-body">
                        <p class="step-desc">Periksa kelengkapan dokumen dan berikan keputusan atas setiap pengajuan
                            SKPP.</p>
                        <ul class="step-list">
                            <li>Buka menu <strong>Pengecekan</strong></li>
                            <li>Pilih pengajuan yang akan diperiksa</li>
                            <li>Lihat detail: Nama, NIP, dan Tanggal Pengajuan</li>
                            <li>Centang status setiap dokumen: Slip Gaji, SK, Surat Pengantar</li>
                            <li>Pilih <strong>Lengkap</strong> atau <strong>Tidak</strong> untuk setiap dokumen</li>
                            <li>Klik <strong>Setuju</strong> jika semua dokumen lengkap, atau <strong>Tolak</strong>
                                jika ada kekurangan</li>
                        </ul>
                    </div>
                </div>

                <div class="step-card">
                    <div class="step-header" onclick="toggleStep(this)">
                        <div class="step-num green">3</div>
                        <div class="step-title">Upload Draft SKPP</div>
                        <span class="step-arrow">›</span>
                    </div>
                    <div class="step-body">
                        <p class="step-desc">Setelah pengajuan disetujui, upload file SKPP yang sudah dibuat secara
                            manual.</p>
                        <ul class="step-list">
                            <li>Buka menu <strong>Draft SKPP</strong></li>
                            <li>Pilih pengajuan yang sudah disetujui</li>
                            <li>Klik tombol <strong>Upload File SKPP</strong></li>
                            <li>Pilih file SKPP dalam format PDF (maks 5MB)</li>
                            <li>Klik <strong>Simpan</strong> — file akan tersedia untuk staff</li>
                        </ul>
                        <div class="note-box"><strong>Penting:</strong> File SKPP harus dalam format PDF. Setelah
                            diupload, staff dapat melanjutkan proses pengarsipan.</div>
                    </div>
                </div>

                <div class="step-card">
                    <div class="step-header" onclick="toggleStep(this)">
                        <div class="step-num orange">4</div>
                        <div class="step-title">Memantau Status</div>
                        <span class="step-arrow">›</span>
                    </div>
                    <div class="step-body">
                        <p class="step-desc">Kepala dapat memantau status setiap pengajuan yang sudah diproses.</p>
                        <ul class="step-list">
                            <li>Lihat daftar di menu Pengecekan untuk status tiap pengajuan</li>
                            <li>Badge <strong>Disetujui</strong> berarti sudah disetujui</li>
                            <li>Badge <strong>Ditolak</strong> berarti pengajuan ditolak</li>
                            <li>Badge <strong>Sudah Upload</strong> di Draft SKPP berarti file sudah diupload</li>
                        </ul>
                    </div>
                </div>

                <div class="section-label">FAQ</div>

                <div class="faq-card" onclick="toggleFaq(this)">
                    <div class="faq-q"><span>Pengajuan tidak muncul di Pengecekan?</span><span
                            class="faq-icon">+</span></div>
                    <div class="faq-a">Pengajuan akan muncul di halaman Pengecekan setelah staff menyelesaikan proses
                        pencatatan data. Hubungi staff jika data belum dicatat.</div>
                </div>

                <div class="faq-card" onclick="toggleFaq(this)">
                    <div class="faq-q"><span>Apakah bisa mengubah keputusan setelah Setuju/Tolak?</span><span
                            class="faq-icon">+</span></div>
                    <div class="faq-a">Keputusan dapat diubah selama staff belum mengarsipkan SKPP. Buka kembali
                        pengajuan di menu Pengecekan dan ubah keputusannya.</div>
                </div>

                <div class="faq-card" onclick="toggleFaq(this)">
                    <div class="faq-q"><span>Format file SKPP yang bisa diupload?</span><span
                            class="faq-icon">+</span></div>
                    <div class="faq-a">File SKPP harus dalam format PDF dengan ukuran maksimal 5MB per file.</div>
                </div>

            </div>

        </div>

        {{-- NAVBAR --}}
        <div class="navbar">
            <a href="{{ url()->previous() }}" class="nav-item">
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
        function switchTab(role, btn) {
            document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.getElementById('tab-' + role).classList.add('active');
            btn.classList.add('active');
        }

        function toggleStep(header) {
            const body = header.nextElementSibling;
            const arrow = header.querySelector('.step-arrow');
            body.classList.toggle('open');
            arrow.classList.toggle('open');
        }

        function toggleFaq(card) {
            const answer = card.querySelector('.faq-a');
            const icon = card.querySelector('.faq-icon');
            answer.classList.toggle('open');
            icon.classList.toggle('open');
        }

        // Buka step pertama otomatis
        document.querySelectorAll('.tab-content').forEach(tab => {
            const firstHeader = tab.querySelector('.step-header');
            if (firstHeader) {
                firstHeader.nextElementSibling.classList.add('open');
                firstHeader.querySelector('.step-arrow').classList.add('open');
            }
        });
    </script>
</body>

</html>
