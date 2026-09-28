<?php

use App\Models\Arsip;
use App\Models\DraftSkpp;
use App\Models\Pencatatan;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

test('staff can view staff dashboard with administration statistics', function () {
    $staff = User::factory()->staff()->create();
    Pengajuan::factory()->count(3)->create();

    $response = $this->actingAs($staff)->get(route('staff.dashboard'));

    $response->assertStatus(200);
    $response->assertSee('Halo, Staff Administrasi');
    $response->assertSee('Total Pengajuan');
});

test('staff can record data for an application', function () {
    $staff = User::factory()->staff()->create();
    $pengajuan = Pengajuan::factory()->create([
        'status_pencatatan' => 'belum_dicatat',
    ]);

    $response = $this->actingAs($staff)->post(route('staff.pencatatan.store', $pengajuan->id), [
        'nama_lengkap' => 'Budi Prakoso',
        'nip' => '198501012010011001',
        'status_dokumen' => 'valid',
        'catatan' => 'Berkas lengkap dan sesuai.',
    ]);

    $response->assertRedirect(route('staff.pencatatan.index'));
    $this->assertDatabaseHas('pencatatan', [
        'pengajuan_id' => $pengajuan->id,
        'nama_lengkap' => 'Budi Prakoso',
        'nip' => '198501012010011001',
        'status_dokumen' => 'valid',
        'dicatat_oleh' => $staff->id,
    ]);

    $this->assertDatabaseHas('pengajuans', [
        'id' => $pengajuan->id,
        'status_pencatatan' => 'selesai_dicatat',
        'status' => 'diproses',
    ]);
});

test('staff can view detail pencatatan page', function () {
    $staff = User::factory()->staff()->create();
    $pengajuan = Pengajuan::factory()->create();
    $pencatatan = Pencatatan::factory()->create([
        'pengajuan_id' => $pengajuan->id,
        'dicatat_oleh' => $staff->id,
    ]);

    $response = $this->actingAs($staff)->get(route('staff.pencatatan.show', $pengajuan->id));

    $response->assertStatus(200);
    $response->assertSee($pencatatan->nama_lengkap);
    $response->assertSee($pencatatan->nip);
});

test('staff can archive an approved submission when draft is uploaded', function () {
    Storage::fake('public');
    $staff = User::factory()->staff()->create();
    $pengajuan = Pengajuan::factory()->create([
        'status_pengecekan' => 'disetujui',
        'status_draft' => 'sudah_diupload',
        'status_arsip' => 'belum',
    ]);

    DraftSkpp::factory()->create([
        'pengajuan_id' => $pengajuan->id,
    ]);

    $response = $this->actingAs($staff)->postJson(route('staff.pengarsipan.store', $pengajuan->id));

    $response->assertStatus(200);
    $response->assertJson(['success' => true]);

    $this->assertDatabaseHas('arsip', [
        'pengajuan_id' => $pengajuan->id,
        'diarsipkan_oleh' => $staff->id,
    ]);

    $this->assertDatabaseHas('pengajuans', [
        'id' => $pengajuan->id,
        'status_arsip' => 'diarsipkan',
    ]);
});

test('staff can send archived skpp to mitra', function () {
    $staff = User::factory()->staff()->create();
    $pengajuan = Pengajuan::factory()->create([
        'status_arsip' => 'diarsipkan',
    ]);

    $arsip = Arsip::factory()->create([
        'pengajuan_id' => $pengajuan->id,
        'diarsipkan_oleh' => $staff->id,
        'dikirim_ke_mitra' => false,
    ]);

    $response = $this->actingAs($staff)->postJson(route('staff.pengarsipan.kirim', $pengajuan->id));

    $response->assertStatus(200);
    $response->assertJson(['success' => true]);

    $this->assertDatabaseHas('arsip', [
        'id' => $arsip->id,
        'dikirim_ke_mitra' => true,
    ]);

    $this->assertDatabaseHas('pengajuans', [
        'id' => $pengajuan->id,
        'status' => 'selesai',
    ]);
});

test('staff cannot access mitra or kepala restricted routes', function () {
    $staff = User::factory()->staff()->create();

    $this->actingAs($staff)->get(route('mitra.dashboard'))->assertStatus(403);
    $this->actingAs($staff)->get(route('kepala.dashboard'))->assertStatus(403);
});
