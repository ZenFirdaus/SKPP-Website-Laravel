<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}