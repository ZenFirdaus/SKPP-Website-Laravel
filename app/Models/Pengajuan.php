<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_perusahaan',
        'alamat',
        'npwp',
        'keperluan',
        'status',
        'file_slip_gaji',
        'file_sk',
        'file_skpp',
        'status_pencatatan',  // tambah ini
        'status_pengecekan',  // tambah ini
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pencatatan()
    {
        return $this->hasOne(Pencatatan::class);
    }

    public function pengecekan()
    {
        return $this->hasOne(Pengecekan::class);
    }
}