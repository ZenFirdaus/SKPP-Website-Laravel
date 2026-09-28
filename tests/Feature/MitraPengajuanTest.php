<?php

use App\Models\Arsip;
use App\Models\DraftSkpp;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('mitra can view dashboard with summary stats', function () {
    $mitra = User::factory()->create(['role' => 'mitra']);
    Pengajuan::factory()->create(['user_id' => $mitra->id, 'status' => 'menunggu']);

    $response = $this->actingAs($mitra)->get(route('mitra.dashboard'));

    $response->assertStatus(200);
    $response->assertSee('Halo, Mitra');
    $response->assertSee('Total Pengajuan');
});

test('mitra can create pengajuan with valid documents', function () {
    Storage::fake('public');
    $mitra = User::factory()->create(['role' => 'mitra']);

    $slipGaji = UploadedFile::fake()->create('slip_gaji.pdf', 500, 'application/pdf');
    $sk = UploadedFile::fake()->create('sk.pdf', 500, 'application/pdf');
    $skpp = UploadedFile::fake()->create('pengantar.pdf', 500, 'application/pdf');

    $response = $this->actingAs($mitra)->post(route('mitra.pengajuan.store'), [
        'nama_perusahaan' => 'PT Maju Bersama',
        'alamat' => 'Jl. Merdeka No. 45',
        'npwp' => '01.234.567.8-999.000',
        'keperluan' => 'Pengajuan administrasi berkas SKPP pegawai',
        'file_slip_gaji' => $slipGaji,
        'file_sk' => $sk,
        'file_skpp' => $skpp,
    ]);

    $response->assertRedirect(route('mitra.pengajuan.index'));
    $this->assertDatabaseHas('pengajuans', [
        'user_id' => $mitra->id,
        'nama_perusahaan' => 'PT Maju Bersama',
        'status' => 'menunggu',
    ]);
});

test('mitra cannot create pengajuan without mandatory fields', function () {
    $mitra = User::factory()->create(['role' => 'mitra']);

    $response = $this->actingAs($mitra)->post(route('mitra.pengajuan.store'), []);

    $response->assertSessionHasErrors(['nama_perusahaan', 'alamat', 'keperluan', 'file_slip_gaji', 'file_sk', 'file_skpp']);
});

test('mitra can only view their own pengajuan', function () {
    $mitra1 = User::factory()->create(['role' => 'mitra']);
    $mitra2 = User::factory()->create(['role' => 'mitra']);

    $pengajuan2 = Pengajuan::factory()->create(['user_id' => $mitra2->id]);

    $response = $this->actingAs($mitra1)->get(route('mitra.pengajuan.show', $pengajuan2->id));
    $response->assertStatus(404);
});

test('mitra cannot edit or delete pengajuan that has been processed', function () {
    $mitra = User::factory()->create(['role' => 'mitra']);
    $pengajuan = Pengajuan::factory()->create([
        'user_id' => $mitra->id,
        'status' => 'diproses',
        'status_pencatatan' => 'selesai_dicatat',
    ]);

    $editResponse = $this->actingAs($mitra)->get(route('mitra.pengajuan.edit', $pengajuan->id));
    $editResponse->assertRedirect(route('mitra.pengajuan.show', $pengajuan->id));

    $deleteResponse = $this->actingAs($mitra)->delete(route('mitra.pengajuan.destroy', $pengajuan->id));
    $deleteResponse->assertRedirect(route('mitra.pengajuan.index'));
    $deleteResponse->assertSessionHas('error');

    $this->assertNotSoftDeleted('pengajuans', ['id' => $pengajuan->id]);
});

test('mitra can download skpp when archived and sent', function () {
    Storage::fake('public');
    $mitra = User::factory()->create(['role' => 'mitra']);
    $pengajuan = Pengajuan::factory()->create([
        'user_id' => $mitra->id,
        'status_arsip' => 'diarsipkan',
    ]);

    $filePath = 'draft_skpp/test_skpp.pdf';
    Storage::disk('public')->put($filePath, 'fake content');

    DraftSkpp::factory()->create([
        'pengajuan_id' => $pengajuan->id,
        'file_skpp' => $filePath,
    ]);

    Arsip::factory()->create([
        'pengajuan_id' => $pengajuan->id,
        'dikirim_ke_mitra' => true,
    ]);

    $response = $this->actingAs($mitra)->get(route('mitra.pengunduhan.download', $pengajuan->id));
    $response->assertStatus(200);
});

test('mitra cannot access staff or kepala routes', function () {
    $mitra = User::factory()->create(['role' => 'mitra']);

    $this->actingAs($mitra)->get(route('staff.dashboard'))->assertStatus(403);
    $this->actingAs($mitra)->get(route('kepala.dashboard'))->assertStatus(403);
});
