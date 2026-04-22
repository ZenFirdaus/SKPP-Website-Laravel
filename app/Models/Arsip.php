<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    protected $table = 'arsip';

    protected $fillable = [
        'pengajuan_id',
        'diarsipkan_oleh',
        'dikirim_ke_mitra',
        'tanggal_selesai',
        'tanggal_arsip',
    ];

    protected $casts = [
        'dikirim_ke_mitra' => 'boolean',
        'tanggal_selesai'  => 'datetime',
        'tanggal_arsip'    => 'datetime',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'diarsipkan_oleh');
    }

    // public function arsip()
    // {
    //     return $this->hasOne(Arsip::class);
    // }
}
