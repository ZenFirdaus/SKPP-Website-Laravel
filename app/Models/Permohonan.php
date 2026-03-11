<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    protected $fillable = [
    'user_id',
    'nama_perusahaan',
    'alamat',
    'npwp',
    'keperluan',
    'status'
];
}
