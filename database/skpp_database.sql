-- -------------------------------------------------------------
-- TablePlus 6.8.6(662)
--
-- https://tableplus.com/
--
-- Database: database_backup.sqlite
-- Generation Time: 2026-04-26 20:52:33.5790
-- -------------------------------------------------------------


DROP TABLE IF EXISTS "migrations";
CREATE TABLE "migrations" ("id" integer primary key autoincrement not null, "migration" varchar not null, "batch" integer not null);

DROP TABLE IF EXISTS "sqlite_sequence";
CREATE TABLE sqlite_sequence(name,seq);

DROP TABLE IF EXISTS "users";
CREATE TABLE "users" ("id" integer primary key autoincrement not null, "name" varchar not null, "email" varchar not null, "email_verified_at" datetime, "password" varchar not null, "remember_token" varchar, "created_at" datetime, "updated_at" datetime, "role" varchar check ("role" in ('mitra', 'staff', 'kepala')) not null default 'mitra');

DROP TABLE IF EXISTS "password_reset_tokens";
CREATE TABLE "password_reset_tokens" ("email" varchar not null, "token" varchar not null, "created_at" datetime, primary key ("email"));

DROP TABLE IF EXISTS "sessions";
CREATE TABLE "sessions" ("id" varchar not null, "user_id" integer, "ip_address" varchar, "user_agent" text, "payload" text not null, "last_activity" integer not null, primary key ("id"));

DROP TABLE IF EXISTS "cache";
CREATE TABLE "cache" ("key" varchar not null, "value" text not null, "expiration" integer not null, primary key ("key"));

DROP TABLE IF EXISTS "cache_locks";
CREATE TABLE "cache_locks" ("key" varchar not null, "owner" varchar not null, "expiration" integer not null, primary key ("key"));

DROP TABLE IF EXISTS "jobs";
CREATE TABLE "jobs" ("id" integer primary key autoincrement not null, "queue" varchar not null, "payload" text not null, "attempts" integer not null, "reserved_at" integer, "available_at" integer not null, "created_at" integer not null);

DROP TABLE IF EXISTS "job_batches";
CREATE TABLE "job_batches" ("id" varchar not null, "name" varchar not null, "total_jobs" integer not null, "pending_jobs" integer not null, "failed_jobs" integer not null, "failed_job_ids" text not null, "options" text, "cancelled_at" integer, "created_at" integer not null, "finished_at" integer, primary key ("id"));

DROP TABLE IF EXISTS "failed_jobs";
CREATE TABLE "failed_jobs" ("id" integer primary key autoincrement not null, "uuid" varchar not null, "connection" text not null, "queue" text not null, "payload" text not null, "exception" text not null, "failed_at" datetime not null default CURRENT_TIMESTAMP);

DROP TABLE IF EXISTS "pengajuans";
CREATE TABLE "pengajuans" ("id" integer primary key autoincrement not null, "user_id" integer not null, "nama_perusahaan" varchar not null, "alamat" varchar not null, "npwp" varchar, "keperluan" text not null, "status" varchar not null default 'menunggu', "created_at" datetime, "updated_at" datetime, "file_slip_gaji" varchar, "file_sk" varchar, "file_skpp" varchar, "status_pencatatan" varchar check ("status_pencatatan" in ('belum_dicatat', 'selesai_dicatat')) not null default 'belum_dicatat', "status_pengecekan" varchar check ("status_pengecekan" in ('menunggu', 'disetujui', 'ditolak')) not null default 'menunggu', "status_arsip" varchar check ("status_arsip" in ('belum', 'diarsipkan')) not null default 'belum', "status_draft" varchar check ("status_draft" in ('belum', 'sudah_diupload')) not null default 'belum', "deleted_at" datetime, foreign key("user_id") references "users"("id") on delete cascade);

DROP TABLE IF EXISTS "pencatatan";
CREATE TABLE "pencatatan" ("id" integer primary key autoincrement not null, "pengajuan_id" integer not null, "nama_lengkap" varchar not null, "nip" varchar not null, "status_dokumen" varchar check ("status_dokumen" in ('valid', 'tidak_valid')) not null default 'valid', "catatan" text, "dicatat_oleh" integer not null, "created_at" datetime, "updated_at" datetime, foreign key("pengajuan_id") references "pengajuans"("id") on delete cascade, foreign key("dicatat_oleh") references "users"("id") on delete cascade);

DROP TABLE IF EXISTS "pengecekan";
CREATE TABLE "pengecekan" ("id" integer primary key autoincrement not null, "pengajuan_id" integer not null, "slip_gaji" varchar check ("slip_gaji" in ('lengkap', 'tidak')), "sk" varchar check ("sk" in ('lengkap', 'tidak')), "surat_pengantar" varchar check ("surat_pengantar" in ('lengkap', 'tidak')), "keputusan" varchar check ("keputusan" in ('setuju', 'tolak')), "catatan_pengecekan" text, "dicek_oleh" integer not null, "created_at" datetime, "updated_at" datetime, foreign key("pengajuan_id") references "pengajuans"("id") on delete cascade, foreign key("dicek_oleh") references "users"("id") on delete cascade);

DROP TABLE IF EXISTS "arsip";
CREATE TABLE "arsip" ("id" integer primary key autoincrement not null, "pengajuan_id" integer not null, "dikirim_ke_mitra" tinyint(1) not null default ('0'), "file_skpp" varchar, "created_at" datetime, "updated_at" datetime, "diarsipkan_oleh" integer, "tanggal_selesai" datetime, "tanggal_arsip" datetime, foreign key("pengajuan_id") references pengajuans("id") on delete cascade on update no action, foreign key("diarsipkan_oleh") references "users"("id"));

DROP TABLE IF EXISTS "draft_skpp";
CREATE TABLE "draft_skpp" ("id" integer primary key autoincrement not null, "pengajuan_id" integer not null, "diupload_oleh" integer not null, "file_skpp" varchar not null, "tanggal_upload" datetime, "created_at" datetime, "updated_at" datetime, foreign key("pengajuan_id") references "pengajuans"("id") on delete cascade, foreign key("diupload_oleh") references "users"("id") on delete cascade);

INSERT INTO "migrations" ("id", "migration", "batch") VALUES
('1', '0001_01_01_000000_create_users_table', '1'),
('2', '0001_01_01_000001_create_cache_table', '1'),
('3', '0001_01_01_000002_create_jobs_table', '1'),
('4', '2026_02_26_154947_add_role_to_users_table', '1'),
('5', '2026_03_11_152048_create_pengajuans_table', '1'),
('6', '2026_04_06_150415_add_dokumen_to_pengajuans_table', '1'),
('7', '2026_04_13_153059_create_pencatatan_table', '1'),
('8', '2026_04_14_154060_create_pengecekan_table', '1'),
('9', '2026_04_18_062124_add_status_columns_to_pengajuans_table', '1'),
('10', '2026_04_18_110834_create_arsip_table', '1'),
('11', '2026_04_21_131942_add_diarsipkan_oleh_to_arsip_table', '1'),
('12', '2026_04_22_060036_create_draft_skpp_table', '2'),
('13', '2026_04_22_040026_add_tanggal_to_arsip_table', '3'),
('14', '2026_04_24_085330_add_softdelete_to_pengajuans', '3');

INSERT INTO "sqlite_sequence" ("name", "seq") VALUES
('migrations', '14'),
('arsip', '2'),
('users', '4'),
('pengajuans', '3'),
('pencatatan', '3'),
('pengecekan', '3'),
('draft_skpp', '2');

INSERT INTO "users" ("id", "name", "email", "email_verified_at", "password", "remember_token", "created_at", "updated_at", "role") VALUES
('1', 'Staff Admin', 'staff@example.com', NULL, '$2y$12$I9FIReogQP/7lTrCUWq.Du/Tjr54x6HXhToiLGpDrw991gy14c/Y6', NULL, '2026-04-21 15:28:47', '2026-04-21 15:28:47', 'staff'),
('2', 'Kepala Staff', 'kepala@example.com', NULL, '$2y$12$MOwl0EZNK0eXgGhC66QQkuDmeommPe5N.Ej1lJEKEXacsD8R3AES.', NULL, '2026-04-21 15:28:47', '2026-04-21 15:28:47', 'kepala'),
('3', 'azin', 'zainaulia312@gmail.com', NULL, '$2y$12$ap0dlbKCa5Ms0Nre.Q7TcuDCxnbtH1ePabMO/bbioWpGFEn51uJCG', NULL, '2026-04-21 15:30:05', '2026-04-21 15:30:05', 'mitra'),
('4', 'juki', 'juki@gmail.com', NULL, '$2y$12$KsVVoAQqm6jFD93ie3s69..we7TWWk0x6cL.Zd.W/n.6T6BFpPvny', 'QfUmtcJGWMPpuEdnaXSquPxJ0glgJqm1JMhwxi5mP7HMMIi1oPo9PkH5gbFn', '2026-04-22 04:45:18', '2026-04-22 04:45:18', 'mitra');

INSERT INTO "sessions" ("id", "user_id", "ip_address", "user_agent", "payload", "last_activity") VALUES
('CNVpjHCNiMotiZ5CkPF78V55GTWkjDUNHZI8w9x8', '1', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOEk3eEJEZ2p2UEthRVlJQ0wxTW9JaVhRQWhPUXNQYzl0MWpUZnpZeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9za3BwLXdlYnNpdGUudGVzdC9zdGFmZi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6InN0YWZmLmRhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', '1777126364'),
('L6OSgCE28rzleoDAxFNZj1zEEXEbeKUhnzhbwKHs', '3', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoickRPQ2s2cklvU09qN292WHBFQWZGM01CSlNMcENpbE41cmxzVE1YcSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovL3NrcHAtd2Vic2l0ZS50ZXN0L21pdHJhL3BlbmdhanVhbiI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vc2twcC13ZWJzaXRlLnRlc3QvbWl0cmEvZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjE1OiJtaXRyYS5kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', '1777179915'),
('gxuaJQEgCVIXPdIRagIbbwVrjQZXYDzK4LU7rUP2', '3', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZnlBVzhmMExPSUN3NUNuQTVPbVFnbjhxVVZ0VTZUWjkxU21rQkxJNyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MjoiaHR0cDovL3NrcHAtd2Vic2l0ZS50ZXN0L3N0YWZmL3BlbmdhcnNpcGFuIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9za3BwLXdlYnNpdGUudGVzdC9taXRyYS9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6Im1pdHJhLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', '1777133740');

INSERT INTO "cache" ("key", "value", "expiration") VALUES
('laravel-cache-juki@gmail.com|127.0.0.1', 'i:1;', '1776837903'),
('laravel-cache-juki@gmail.com|127.0.0.1:timer', 'i:1776837903;', '1776837903');

INSERT INTO "pengajuans" ("id", "user_id", "nama_perusahaan", "alamat", "npwp", "keperluan", "status", "created_at", "updated_at", "file_slip_gaji", "file_sk", "file_skpp", "status_pencatatan", "status_pengecekan", "status_arsip", "status_draft", "deleted_at") VALUES
('1', '3', 'zen', 'kiringan', '1234', 'gaji', 'menunggu', '2026-04-21 15:44:54', '2026-04-22 10:33:39', 'pengajuan/2JGCkIGTEZJqXFPxew7ZNLJzO5E36hfw1cHX9Q3a.pdf', 'pengajuan/XhjLmV63Ae16hvU2djaPj17X8KSkDNOWE0EknsTE.pdf', 'pengajuan/2FsSSjGgoPldmYGrjSZUtSjAUcA8bJv44EhgISsV.pdf', 'selesai_dicatat', 'disetujui', 'diarsipkan', 'sudah_diupload', NULL),
('2', '4', 'juki', 'nganjuk', '1234', 'gaji', 'menunggu', '2026-04-22 04:46:17', '2026-04-25 12:05:01', 'pengajuan/CZoWAQxAKtZMoEhLzqTpXG6bJ5aScVIns8Sz7lim.pdf', 'pengajuan/ZjQ8mWBTVeBuQFqSExusBkKnyMZY17iYYlsAfAa1.pdf', 'pengajuan/0J2tzYDCvr77aqVlmWZ0qLVc5GQZsK08fgCnU530.pdf', 'selesai_dicatat', 'ditolak', 'belum', 'belum', NULL),
('3', '3', 'zennnn', 'kiringan', '23463426', 'gaji', 'menunggu', '2026-04-22 06:05:05', '2026-04-22 10:35:04', 'pengajuan/PvgmD9wOj1PBUaqHTXRSjKU3dJ7lOwoTLtu1SMZR.pdf', 'pengajuan/KkdEJS9GTGC34HMawcyDysxei0dwgu8cutCHBT8V.pdf', 'pengajuan/Et2GcpREO4VjvgvBwCEIESn3uJQti0ERZiRUQy2L.pdf', 'selesai_dicatat', 'disetujui', 'diarsipkan', 'sudah_diupload', NULL);

INSERT INTO "pencatatan" ("id", "pengajuan_id", "nama_lengkap", "nip", "status_dokumen", "catatan", "dicatat_oleh", "created_at", "updated_at") VALUES
('1', '1', 'azin muhammad', '12345', 'valid', 'nice', '1', '2026-04-21 15:45:49', '2026-04-21 15:45:49'),
('2', '2', 'juki mahendra', '224781764', 'tidak_valid', NULL, '1', '2026-04-22 04:47:05', '2026-04-22 04:47:05'),
('3', '3', 'zen firdaus', '2341245', 'valid', NULL, '1', '2026-04-22 06:05:40', '2026-04-22 06:05:40');

INSERT INTO "pengecekan" ("id", "pengajuan_id", "slip_gaji", "sk", "surat_pengantar", "keputusan", "catatan_pengecekan", "dicek_oleh", "created_at", "updated_at") VALUES
('1', '1', 'lengkap', 'lengkap', 'lengkap', 'setuju', NULL, '2', '2026-04-21 15:46:28', '2026-04-21 15:46:28'),
('2', '2', 'tidak', 'tidak', 'tidak', 'tolak', NULL, '2', '2026-04-22 04:47:38', '2026-04-22 04:47:38'),
('3', '3', 'lengkap', 'lengkap', 'lengkap', 'setuju', NULL, '2', '2026-04-22 10:14:01', '2026-04-22 10:14:01');

INSERT INTO "arsip" ("id", "pengajuan_id", "dikirim_ke_mitra", "file_skpp", "created_at", "updated_at", "diarsipkan_oleh", "tanggal_selesai", "tanggal_arsip") VALUES
('1', '1', '1', NULL, '2026-04-22 04:01:18', '2026-04-22 04:01:27', '1', '2026-04-22 04:01:18', '2026-04-22 04:01:18'),
('2', '3', '1', NULL, '2026-04-22 10:35:04', '2026-04-22 10:35:07', '1', '2026-04-22 10:35:04', '2026-04-22 10:35:04');

INSERT INTO "draft_skpp" ("id", "pengajuan_id", "diupload_oleh", "file_skpp", "tanggal_upload", "created_at", "updated_at") VALUES
('1', '3', '2', 'draft_skpp/2AUf9el4OTKlbPrfKiVi2wJnsYgOlXHPwkG9R59C.pdf', '2026-04-22 10:33:25', '2026-04-22 10:33:25', '2026-04-22 10:33:25'),
('2', '1', '2', 'draft_skpp/XFlU9NOsQz027zLp6iClGP75spKWZbcTTqIb7EH6.pdf', '2026-04-22 10:33:39', '2026-04-22 10:33:39', '2026-04-22 10:33:39');

