
# PRODUCT REQUIREMENTS DOCUMENT (PRD)
# SKPP - Sistem Pengajuan dan Pengelolaan Kepegawaian

## 1. PRODUCT OVERVIEW

### 1.1 Product Name
SKPP (Sistem Pengajuan dan Pengelolaan Kepegawaian)

### 1.2 Product Description
SKPP adalah website untuk membantu proses pengajuan, pengelolaan, verifikasi, dan persetujuan administrasi kepegawaian secara digital.

Sistem ini dirancang untuk mempermudah Mitra dalam mengajukan permohonan, membantu Staff mengelola pengajuan, serta memberikan Kepala akses untuk melakukan review dan persetujuan sesuai kewenangan.

### 1.3 Product Goals
- Mendigitalisasi proses pengajuan kepegawaian.
- Mempermudah pengguna dalam mengajukan permohonan.
- Meningkatkan efisiensi pengelolaan administrasi.
- Menyediakan informasi pengajuan secara transparan.
- Mengurangi kesalahan input dan pengelolaan dokumen.
- Membangun sistem yang profesional, aman, dan mudah digunakan.

---

## 2. TARGET USERS & ROLES

### 2.1 Mitra
Pengguna yang mengajukan permohonan melalui sistem.

Permissions:
- Register dan login.
- Melihat dashboard pribadi.
- Membuat pengajuan.
- Mengisi dan mengedit data pengajuan sesuai ketentuan.
- Mengunggah dokumen yang diperlukan.
- Melihat detail dan riwayat pengajuan.
- Memantau perkembangan pengajuan.
- Mengunduh dokumen yang tersedia.
- Mengelola profil pribadi.

### 2.2 Staff
Pengelola pengajuan dan administrasi sistem.

Permissions:
- Login ke dashboard Staff.
- Melihat seluruh pengajuan yang memiliki akses.
- Memeriksa dan memverifikasi data.
- Mengelola data pengajuan.
- Mengelola dokumen.
- Memproses pengajuan sesuai kewenangan.
- Melihat riwayat dan laporan pengajuan.
- Mengelola data yang diperlukan oleh sistem.

### 2.3 Kepala
Pengguna dengan kewenangan review dan persetujuan.

Permissions:
- Login ke dashboard Kepala.
- Melihat pengajuan yang perlu direview.
- Melihat detail dan dokumen pengajuan.
- Memberikan persetujuan atau penolakan sesuai kewenangan.
- Memberikan catatan review.
- Melihat riwayat persetujuan.
- Melihat ringkasan data pengajuan.

---

## 3. CORE FEATURES

### 3.1 Authentication & Authorization
- Login dan logout.
- Registrasi Mitra sesuai kebutuhan sistem.
- Role-based access control.
- Pembatasan akses berdasarkan role.
- Validasi kredensial pengguna.
- Perlindungan route dan halaman privat.
- Penanganan error autentikasi.

### 3.2 Dashboard
Setiap role memiliki dashboard yang relevan.

Mitra:
- Ringkasan pengajuan milik sendiri.
- Jumlah pengajuan.
- Pengajuan yang sedang diproses.
- Pengajuan yang selesai atau ditolak.
- Akses cepat untuk membuat pengajuan.

Staff:
- Statistik pengajuan.
- Daftar pengajuan terbaru.
- Pengajuan yang memerlukan tindakan.
- Ringkasan pekerjaan administrasi.

Kepala:
- Ringkasan pengajuan untuk review.
- Pengajuan yang menunggu persetujuan.
- Statistik pengajuan sesuai akses.
- Akses cepat ke proses review.

### 3.3 Pengajuan
- Membuat pengajuan baru.
- Formulir dengan field yang relevan.
- Validasi input wajib.
- Penyimpanan data ke database.
- Melihat detail pengajuan.
- Mengedit pengajuan sesuai status dan hak akses.
- Membatalkan atau menghapus pengajuan sesuai ketentuan.
- Menampilkan feedback setelah tindakan pengguna.

### 3.4 Verifikasi & Persetujuan
- Staff dapat memeriksa data dan dokumen.
- Kepala dapat melakukan review sesuai kewenangan.
- Setiap keputusan memiliki catatan jika diperlukan.
- Validasi alur proses sebelum perubahan status.
- Pengguna dapat melihat hasil proses sesuai hak akses.
- Riwayat proses disimpan untuk kebutuhan administrasi.

### 3.5 Document Management
- Upload dokumen sesuai kebutuhan pengajuan.
- Validasi format dan ukuran file.
- Penyimpanan dokumen secara aman.
- Melihat dan mengunduh dokumen sesuai hak akses.
- Penggantian dokumen sesuai ketentuan.
- Penanganan file yang tidak valid.
- Mencegah akses dokumen oleh pengguna yang tidak berwenang.

### 3.6 Profile Management
- Melihat profil.
- Mengubah informasi profil yang diizinkan.
- Mengubah password.
- Validasi data profil.
- Feedback keberhasilan dan kegagalan.

### 3.7 Search, Filter & Data Management
- Pencarian pengajuan.
- Filter berdasarkan kategori atau status yang tersedia.
- Sorting data jika diperlukan.
- Pagination untuk daftar data.
- Empty state jika tidak ada data.
- Tampilan error ketika data gagal dimuat.

---

## 4. FUNCTIONAL REQUIREMENTS

### FR-01: User Authentication
Sistem harus memungkinkan pengguna login menggunakan kredensial yang valid.

Acceptance Criteria:
- Pengguna dengan kredensial valid dapat login.
- Pengguna dengan kredensial tidak valid menerima pesan error.
- Pengguna yang belum login tidak dapat mengakses halaman privat.
- Pengguna dapat logout dengan aman.

### FR-02: Role-Based Access
Sistem harus membatasi akses fitur berdasarkan role pengguna.

Acceptance Criteria:
- Mitra tidak dapat mengakses halaman khusus Staff atau Kepala tanpa izin.
- Staff hanya dapat menjalankan tindakan sesuai kewenangannya.
- Kepala hanya dapat mengakses fitur yang diberikan.
- Akses tidak hanya dibatasi melalui tampilan, tetapi juga diverifikasi di server.

### FR-03: Create Submission
Mitra dapat membuat pengajuan baru.

Acceptance Criteria:
- Form pengajuan dapat dibuka.
- Field wajib divalidasi.
- Data yang valid dapat disimpan.
- Data yang tidak valid tidak disimpan.
- Pengguna menerima notifikasi keberhasilan atau error.

### FR-04: Submission Review
Staff dan Kepala dapat melakukan proses review sesuai kewenangan.

Acceptance Criteria:
- Pengguna berwenang dapat melihat data pengajuan.
- Dokumen yang relevan dapat diperiksa.
- Keputusan dapat disimpan sesuai alur.
- Catatan review dapat disimpan jika diperlukan.
- Perubahan tercatat dalam riwayat proses.

### FR-05: Document Upload
Sistem harus mengelola dokumen pengajuan dengan validasi.

Acceptance Criteria:
- Hanya file yang memenuhi ketentuan yang diterima.
- Ukuran file divalidasi.
- File disimpan melalui mekanisme storage yang aman.
- File tidak dapat diakses oleh pengguna yang tidak berwenang.

### FR-06: Submission Tracking
Mitra dapat memantau perkembangan pengajuan miliknya.

Acceptance Criteria:
- Pengguna dapat melihat daftar pengajuan sendiri.
- Detail pengajuan dapat dibuka.
- Informasi proses ditampilkan secara jelas.
- Data pengguna lain tidak dapat diakses.

---

## 5. NON-FUNCTIONAL REQUIREMENTS

### NFR-01: Security
- Gunakan CSRF protection.
- Gunakan validasi server-side.
- Gunakan authorization pada route dan tindakan.
- Gunakan Eloquent ORM atau query yang aman.
- Lindungi data dan dokumen pribadi.
- Jangan menampilkan informasi sensitif pada error publik.
- Jangan menyimpan password dalam bentuk plaintext.

### NFR-02: Performance
- Gunakan pagination untuk data berjumlah banyak.
- Hindari query database yang tidak diperlukan.
- Optimalkan pemuatan data.
- Hindari duplikasi proses yang tidak diperlukan.
- Pastikan halaman tetap responsif.

### NFR-03: Usability
- Navigasi mudah dipahami.
- Formulir memiliki label dan feedback yang jelas.
- Pesan error mudah dipahami.
- Tombol tindakan memiliki fungsi dan label yang jelas.
- Pengguna dapat memahami alur pengajuan tanpa kebingungan.

### NFR-04: Responsive Design
- Website harus mendukung desktop, tablet, dan mobile.
- Prioritaskan tampilan mobile dengan lebar target sekitar 430px.
- Komponen tidak boleh melampaui layar.
- Tabel dan formulir harus dapat digunakan pada layar kecil.
- Navigasi mobile harus mudah diakses.

### NFR-05: Maintainability
- Gunakan struktur Laravel yang terorganisir.
- Gunakan penamaan file, class, dan variabel yang konsisten.
- Hindari kode duplikat.
- Pertahankan pemisahan tanggung jawab.
- Gunakan komponen Blade yang dapat digunakan kembali jika relevan.
- Jangan menambahkan kompleksitas yang tidak diperlukan.

---


## 6. UI/UX DESIGN REQUIREMENTS

### 6.1 Design Vision

Buat website SKPP dengan tampilan yang profesional, modern, sederhana, dan nyaman dilihat. Desain harus terlihat seperti website layanan administrasi profesional, bukan sekadar project mahasiswa.

Prioritaskan:
- Simple but professional.
- Clean and modern interface.
- Intuitive navigation.
- Consistent visual design.
- Good readability.
- Comfortable user experience.
- Responsive layout.

Jangan membuat desain terlalu ramai, menggunakan terlalu banyak warna, atau menambahkan elemen dekoratif yang tidak memiliki fungsi.

### 6.2 Design Principles

- Gunakan prinsip minimalism dan visual hierarchy.
- Utamakan fungsi dan kemudahan penggunaan.
- Gunakan whitespace yang cukup agar tampilan tidak padat.
- Gunakan typography yang modern dan mudah dibaca.
- Gunakan komponen UI yang konsisten di seluruh halaman.
- Pastikan setiap halaman memiliki layout yang terstruktur.
- Hindari desain yang terlihat generik atau tidak terorganisir.
- Gunakan animasi sederhana dan halus hanya jika memberikan manfaat UX.
- Jangan menambahkan efek berlebihan, seperti gradient yang terlalu dominan, animasi berlebihan, atau dekorasi yang mengganggu.

### 6.3 Visual Style

Gaya visual website:
- Professional.
- Minimalist.
- Modern.
- Clean.
- Trustworthy.
- Friendly but formal.

Gunakan kombinasi warna yang harmonis dan tidak berlebihan.

Primary Color:
- #2ec6e8
- #1a8fb3

Color Guidelines:
- Gunakan warna utama untuk tombol penting, link, dan elemen branding.
- Gunakan warna netral untuk background dan konten utama.
- Gunakan warna status secara konsisten.
- Pastikan teks memiliki kontras yang baik.
- Hindari penggunaan terlalu banyak warna dalam satu halaman.

### 6.4 Layout & Structure

Buat layout yang rapi dan mudah dipahami.

Desktop:
- Sidebar atau navbar yang profesional.
- Konten utama dengan max-width yang sesuai.
- Dashboard menggunakan card statistik yang sederhana.
- Tabel dengan spacing yang cukup.
- Formulir disusun secara terstruktur.
- Gunakan grid dan flexbox sesuai kebutuhan.

Mobile:
- Responsive pada layar kecil hingga sekitar 430px.
- Sidebar dapat berubah menjadi mobile navigation.
- Card dan formulir menyesuaikan lebar layar.
- Tabel memiliki solusi responsive yang nyaman digunakan.
- Tombol dan input memiliki ukuran yang mudah disentuh.
- Hindari horizontal overflow yang tidak diperlukan.

### 6.5 UI Components

Gunakan komponen dengan tampilan konsisten:

- Navbar / Sidebar.
- Dashboard cards.
- Buttons.
- Input fields.
- Select dropdown.
- Data tables.
- Status badges.
- Modal confirmation.
- Alert messages.
- Empty states.
- Loading states.
- Error states.
- Pagination.
- Breadcrumb jika dibutuhkan.

Setiap komponen harus:
- Memiliki spacing yang konsisten.
- Menggunakan border radius yang wajar.
- Memiliki hover dan focus state.
- Memiliki feedback yang jelas.
- Tidak terlihat berlebihan.
- Dapat digunakan kembali jika relevan.

### 6.6 Dashboard Design

Dashboard harus menampilkan informasi secara ringkas dan mudah dipahami.

Requirements:
- Tampilkan informasi yang paling relevan di bagian atas.
- Gunakan card statistik yang sederhana.
- Tampilkan pengajuan terbaru atau aktivitas penting.
- Gunakan visual hierarchy yang jelas.
- Jangan memenuhi dashboard dengan terlalu banyak informasi.
- Sediakan shortcut ke tindakan utama.
- Pastikan konten berbeda sesuai role pengguna.

Dashboard harus terasa seperti aplikasi administrasi profesional yang mudah digunakan, bukan halaman yang penuh elemen tanpa prioritas.

### 6.7 Form Design

Formulir harus sederhana, terstruktur, dan mudah diisi.

Requirements:
- Gunakan label yang jelas.
- Kelompokkan field yang saling berkaitan.
- Gunakan helper text jika diperlukan.
- Tampilkan validasi error di dekat field terkait.
- Gunakan placeholder secara wajar.
- Berikan feedback saat proses berhasil.
- Hindari formulir panjang tanpa pengelompokan yang jelas.
- Gunakan tombol submit yang mudah ditemukan.
- Berikan konfirmasi untuk tindakan yang berisiko.

### 6.8 Table & Data Management Design

Tabel harus terlihat rapi dan mudah dipindai.

Requirements:
- Gunakan header tabel yang jelas.
- Gunakan spacing yang cukup antarbaris.
- Tampilkan status menggunakan badge yang konsisten.
- Sediakan pencarian dan filter jika diperlukan.
- Gunakan pagination untuk data yang banyak.
- Sediakan empty state jika data tidak tersedia.
- Pastikan tabel tetap usable pada perangkat mobile.
- Hindari kolom yang terlalu padat.

### 6.9 Interaction & Feedback

Berikan feedback yang jelas untuk setiap tindakan pengguna.

Implement:
- Success alert setelah operasi berhasil.
- Error alert ketika terjadi kegagalan.
- Loading indicator saat proses berlangsung.
- Confirmation modal untuk tindakan berisiko.
- Empty state untuk data kosong.
- Disabled state ketika tombol tidak dapat digunakan.
- Hover dan focus state pada elemen interaktif.

Jangan menggunakan alert atau modal secara berlebihan. Feedback harus informatif, singkat, dan mudah dipahami.

### 6.10 Responsive & Accessibility

- Website harus responsive pada desktop, tablet, dan mobile.
- Pastikan tampilan nyaman pada layar 430px.
- Gunakan semantic HTML jika relevan.
- Pastikan form memiliki label yang sesuai.
- Pastikan kontras warna memadai.
- Gunakan focus state untuk navigasi keyboard.
- Jangan hanya mengandalkan warna untuk menunjukkan status.
- Pastikan elemen interaktif mudah digunakan.

### 6.11 Quality Standard

Sebelum menyelesaikan implementasi UI, pastikan:
- [ ] Tampilan profesional dan konsisten.
- [ ] Layout tidak terlalu padat atau kosong.
- [ ] Warna dan typography harmonis.
- [ ] Semua halaman menggunakan style yang konsisten.
- [ ] Responsive pada desktop dan mobile.
- [ ] Tidak ada overflow yang tidak diperlukan.
- [ ] Semua tombol dan interaksi memiliki fungsi nyata.
- [ ] Formulir mudah dipahami.
- [ ] Loading, error, dan empty states tersedia.
- [ ] Tidak ada desain yang terlihat unfinished.

### 6.12 AI Agent UI Instructions

Saat mengembangkan UI:
1. Pelajari desain dan komponen yang sudah tersedia.
2. Pertahankan identitas visual SKPP.
3. Perbaiki tampilan secara bertahap.
4. Gunakan komponen reusable jika sesuai.
5. Prioritaskan usability daripada dekorasi.
6. Jangan menambahkan library UI baru jika tidak diperlukan.
7. Pastikan setiap perubahan konsisten di seluruh halaman.
8. Periksa tampilan desktop dan mobile setelah implementasi.

Target akhir:
Website SKPP harus terlihat seperti produk digital profesional, dengan desain minimalis, modern, rapi, dan nyaman digunakan. UI harus sederhana tetapi memiliki kualitas visual yang baik serta mendukung alur administrasi secara efektif.

## 7. SYSTEM ARCHITECTURE

### 7.1 Technology Stack
- Backend: Laravel 12.
- Frontend: Blade + Alpine.js.
- Styling: Tailwind CSS atau styling yang sudah tersedia.
- Authentication: Laravel Breeze.
- Database: SQLite sesuai konfigurasi project.
- Language: PHP.
- Testing: Pest atau framework testing yang sudah tersedia.

### 7.2 Architecture Principles
- Gunakan MVC Laravel.
- Gunakan Form Request untuk validasi yang kompleks jika relevan.
- Gunakan middleware dan authorization untuk pembatasan akses.
- Gunakan Eloquent untuk akses database.
- Pisahkan business logic dari tampilan jika kompleksitas memerlukannya.
- Pertahankan struktur sederhana untuk fitur yang sederhana.

### 7.3 Data Integrity
- Validasi data sebelum disimpan.
- Gunakan foreign key dan constraint sesuai kebutuhan.
- Hindari penyimpanan data yang tidak konsisten.
- Pertahankan relasi antarentitas.
- Gunakan transaksi database ketika beberapa operasi harus berhasil secara bersamaan.

---

## 8. BUSINESS RULES

### BR-01: Role Access
Setiap role hanya dapat mengakses fitur yang sesuai dengan kewenangannya.

### BR-02: Submission Ownership
Mitra hanya dapat melihat dan mengelola pengajuan miliknya sendiri, kecuali akses tambahan yang secara eksplisit diberikan.

### BR-03: Data Validation
Pengajuan tidak dapat diproses apabila data wajib belum lengkap atau tidak valid.

### BR-04: Document Validation
Dokumen harus memenuhi format dan ukuran yang telah ditentukan oleh sistem.

### BR-05: Workflow
Setiap proses pengajuan harus mengikuti alur yang ditetapkan oleh sistem. Perubahan proses tidak boleh melewati validasi atau authorization.

### BR-06: Auditability
Tindakan penting seperti verifikasi dan persetujuan harus memiliki informasi riwayat yang memadai jika diperlukan oleh kebutuhan administrasi.

### BR-07: Error Handling
Kegagalan proses harus ditangani dengan pesan yang jelas tanpa membocorkan informasi sensitif.

---

## 9. DEVELOPMENT SCOPE

### 9.1 In Scope
- Perbaikan bug dan error pada sistem yang sudah ada.
- Penyempurnaan autentikasi dan authorization.
- Penyempurnaan dashboard setiap role.
- Penyempurnaan pengajuan dan pengelolaan dokumen.
- Penyempurnaan proses verifikasi dan persetujuan.
- Peningkatan UI/UX.
- Responsive design.
- Validasi dan keamanan.
- Testing fitur penting.

### 9.2 Out of Scope
- Migrasi ke framework frontend baru tanpa kebutuhan.
- Penggantian database tanpa alasan teknis.
- Fitur di luar kebutuhan SKPP.
- Integrasi layanan pihak ketiga yang belum diperlukan.
- Penambahan fitur kompleks yang tidak mendukung tujuan utama sistem.

---

## 10. ACCEPTANCE CRITERIA

Website dinyatakan memenuhi kebutuhan apabila:

- [ ] Seluruh role dapat login dan mengakses fitur sesuai kewenangan.
- [ ] Pengajuan dapat dibuat dengan validasi yang benar.
- [ ] Pengajuan dapat ditampilkan dan dikelola sesuai hak akses.
- [ ] Proses verifikasi dan persetujuan mengikuti alur yang ditetapkan.
- [ ] Upload dokumen memiliki validasi dan proteksi akses.
- [ ] Data pengguna tidak dapat diakses oleh pihak yang tidak berwenang.
- [ ] Dashboard menampilkan informasi yang relevan.
- [ ] Tampilan responsive pada desktop dan mobile.
- [ ] Error dan success feedback tersedia.
- [ ] Tidak ada error kritis pada fitur utama.
- [ ] Testing atau pemeriksaan kode telah dijalankan.
- [ ] Kode mudah dipahami dan tidak menimbulkan regresi pada fitur lama.

---

## 11. DEVELOPMENT WORKFLOW

1. Audit struktur project dan fitur yang sudah ada.
2. Periksa database, migration, model, route, dan controller.
3. Identifikasi bug dan kebutuhan yang belum terpenuhi.
4. Prioritaskan perbaikan berdasarkan dampak dan urgensi.
5. Implementasikan perubahan secara bertahap.
6. Jalankan testing atau pemeriksaan kode.
7. Periksa keamanan dan hak akses.
8. Pastikan responsive UI.
9. Dokumentasikan perubahan yang dilakukan.
10. Jangan mengubah fitur yang tidak relevan tanpa alasan.

---

## 12. AI AGENT INSTRUCTIONS

- Baca dan pahami file project sebelum melakukan modifikasi.
- Gunakan PRD ini sebagai pedoman pengembangan.
- Jangan langsung mengubah seluruh project secara besar-besaran.
- Prioritaskan perbaikan yang nyata dan dapat diverifikasi.
- Gunakan implementasi sederhana, profesional, dan mudah dipelihara.
- Jika requirement belum jelas, periksa implementasi yang ada terlebih dahulu.
- Jangan mengarang struktur database atau fitur yang belum tersedia.
- Jangan mengklaim fitur selesai jika belum diuji.
- Setelah setiap perubahan penting, lakukan pemeriksaan yang relevan.
- Laporkan file yang dimodifikasi, perubahan utama, dan hasil testing.
- Pertahankan kompatibilitas dengan teknologi yang sudah digunakan.

## 13. DEFINITION OF DONE

Sebuah fitur dianggap selesai apabila:
- Fitur telah diimplementasikan sesuai requirement.
- Validasi dan authorization sudah diterapkan.
- UI dapat digunakan dengan baik.
- Tidak merusak fitur lain yang sudah ada.
- Testing atau pemeriksaan yang relevan telah dijalankan.
- Error yang ditemukan telah diperbaiki atau didokumentasikan.
- Perubahan dapat dijelaskan dengan jelas kepada developer.


## 14. CODE QUALITY & IMPLEMENTATION REQUIREMENTS

### 14.1 Simple but Professional Code

Gunakan kode yang sederhana, bersih, profesional, dan mudah dipahami oleh developer pemula hingga menengah.

Prinsip utama:
- KISS (Keep It Simple, Stupid).
- Hindari overengineering.
- Jangan membuat arsitektur yang terlalu kompleks untuk fitur sederhana.
- Gunakan kode yang mudah dibaca dan dipelihara.
- Prioritaskan functionality, readability, dan maintainability.
- Gunakan solusi native Laravel jika sudah cukup.
- Jangan menambahkan library atau dependency yang tidak diperlukan.

### 14.2 Laravel Backend

Gunakan struktur Laravel yang sudah tersedia.

Requirements:
- Gunakan MVC dengan benar.
- Gunakan Controller untuk mengatur alur request.
- Gunakan Model Eloquent untuk akses database.
- Gunakan Form Request jika validasi cukup kompleks atau perlu digunakan kembali.
- Gunakan middleware dan authorization untuk keamanan.
- Gunakan route yang jelas dan RESTful jika sesuai.
- Hindari controller yang terlalu panjang.
- Hindari duplikasi kode.
- Jangan membuat service atau abstraction tambahan jika belum diperlukan.
- Gunakan nama class, method, dan variabel yang deskriptif.

Contoh prinsip:
- CRUD sederhana dapat tetap menggunakan Controller + Model.
- Business logic yang kompleks dapat dipisahkan ke Service.
- Jangan membuat banyak layer hanya untuk operasi sederhana.

### 14.3 Blade & Alpine.js

Gunakan Blade dan Alpine.js yang sudah tersedia dalam project.

Requirements:
- Gunakan Blade component untuk UI yang berulang.
- Gunakan partial untuk bagian tampilan yang relevan.
- Gunakan Alpine.js untuk interaksi ringan seperti dropdown, modal, toggle, dan alert.
- Hindari JavaScript yang panjang jika interaksi dapat dibuat sederhana.
- Jangan mengganti Blade dengan framework frontend baru tanpa kebutuhan.
- Pisahkan markup dan logic agar mudah dipahami.
- Gunakan komponen yang konsisten di seluruh halaman.

### 14.4 CSS & UI Implementation

Gunakan styling yang sederhana tetapi profesional.

Requirements:
- Gunakan Tailwind CSS atau styling yang sudah digunakan project.
- Utamakan utility class yang konsisten.
- Hindari CSS duplikat.
- Gunakan komponen UI reusable jika relevan.
- Gunakan spacing, typography, warna, dan border radius yang konsisten.
- Jangan menambahkan animasi berlebihan.
- Hindari inline style yang tidak diperlukan.
- Pastikan UI tetap responsive.

Visual target:
- Clean layout.
- Consistent spacing.
- Professional typography.
- Subtle shadow.
- Appropriate border radius.
- Clear button hierarchy.
- Comfortable form layout.
- Minimal but polished interface.

### 14.5 Database & Query

- Gunakan Eloquent ORM untuk operasi database.
- Gunakan eager loading jika diperlukan untuk menghindari N+1 query.
- Validasi input sebelum menyimpan data.
- Gunakan pagination untuk daftar data yang banyak.
- Hindari query duplikat yang tidak diperlukan.
- Pertahankan relasi database yang sudah ada.
- Jangan mengubah migration atau struktur database tanpa alasan dan pemeriksaan dampaknya.

### 14.6 Security & Validation

- Validasi data pada server-side.
- Gunakan authorization pada tindakan penting.
- Gunakan CSRF protection.
- Validasi file upload berdasarkan tipe, ukuran, dan kebutuhan sistem.
- Pastikan pengguna hanya dapat mengakses data sesuai haknya.
- Jangan mempercayai validasi frontend saja.
- Jangan menampilkan detail error sensitif kepada pengguna.
- Gunakan mekanisme autentikasi Laravel yang tersedia.

### 14.7 Error Handling

Gunakan penanganan error yang jelas dan sederhana.

Requirements:
- Tampilkan pesan error yang mudah dipahami.
- Gunakan validasi Laravel untuk error formulir.
- Berikan feedback keberhasilan setelah tindakan selesai.
- Gunakan logging sesuai kebutuhan untuk debugging.
- Jangan menggunakan try-catch berlebihan jika tidak diperlukan.
- Jangan menutupi error dengan mengabaikan exception.
- Pastikan error handling tidak membocorkan informasi sensitif.

### 14.8 Reusable Components

Gunakan reusable components jika suatu elemen digunakan berulang kali.

Contoh:
- Button.
- Input.
- Alert.
- Modal.
- Status Badge.
- Card.
- Table.
- Layout.
- Navigation.

Rules:
- Jangan membuat component untuk setiap elemen kecil tanpa kebutuhan.
- Component harus memiliki tujuan yang jelas.
- Hindari component yang terlalu kompleks.
- Pastikan props dan penamaannya mudah dipahami.
- Gunakan kembali component yang sudah tersedia sebelum membuat baru.

### 14.9 Code Style

- Gunakan penamaan yang konsisten.
- Gunakan indentation yang rapi.
- Hindari function yang terlalu panjang.
- Hindari nested condition yang berlebihan.
- Hindari komentar yang tidak diperlukan.
- Gunakan komentar hanya untuk menjelaskan logic yang tidak mudah dipahami.
- Hapus kode yang tidak digunakan setelah memastikan tidak dibutuhkan.
- Jangan meninggalkan debugging statement seperti `dd()` atau `dump()` pada production code.
- Jangan membuat perubahan yang tidak berkaitan dengan kebutuhan fitur.

### 14.10 Performance & Maintainability

- Prioritaskan solusi yang sederhana dan efisien.
- Hindari pengambilan data yang berulang.
- Gunakan pagination dan eager loading jika dibutuhkan.
- Jangan melakukan optimasi prematur yang menambah kompleksitas.
- Pertahankan struktur folder yang mudah dipahami.
- Pastikan kode baru mengikuti pola yang sudah digunakan project.
- Jangan mengubah teknologi atau struktur besar tanpa alasan yang jelas.

### 14.11 Testing & Verification

Setelah implementasi:
- Jalankan `php artisan test` jika test tersedia dan relevan.
- Jalankan pemeriksaan kode yang sesuai.
- Periksa route dan authorization.
- Uji validasi formulir.
- Uji fitur utama secara manual jika diperlukan.
- Periksa responsive UI.
- Pastikan tidak ada error PHP atau JavaScript pada fitur yang diubah.
- Jangan mengklaim fitur berhasil jika belum diverifikasi.

### 14.12 AI Agent Coding Instructions

Saat menulis kode:
1. Baca kode yang sudah ada terlebih dahulu.
2. Gunakan pola dan struktur project yang sudah tersedia.
3. Pilih solusi paling sederhana yang memenuhi requirement.
4. Jangan membuat sistem terlalu kompleks.
5. Jangan mengubah banyak file jika perubahan kecil sudah cukup.
6. Pertahankan kompatibilitas fitur lama.
7. Periksa dampak perubahan sebelum memodifikasi database atau alur utama.
8. Tulis kode yang dapat dipahami developer lain.
9. Uji hasil implementasi.
10. Jelaskan perubahan secara singkat setelah selesai.

### 14.13 Definition of Professional Code

Kode dianggap memenuhi standar apabila:
- [ ] Sederhana dan mudah dibaca.
- [ ] Tidak memiliki kompleksitas yang tidak diperlukan.
- [ ] Mengikuti struktur Laravel yang sesuai.
- [ ] Memiliki validasi dan authorization yang benar.
- [ ] Tidak terdapat duplikasi yang tidak diperlukan.
- [ ] UI dan backend bekerja sesuai kebutuhan.
- [ ] Mudah dikembangkan di masa mendatang.
- [ ] Tidak merusak fitur yang sudah ada.
- [ ] Testing atau pemeriksaan yang relevan telah dijalankan.

Target:
Buat kode yang sederhana seperti project yang mudah dipelajari, tetapi memiliki kualitas implementasi seperti website profesional. Prioritaskan readability, security, maintainability, dan user experience tanpa overengineering.

END OF PRD