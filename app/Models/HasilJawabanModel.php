<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilJawabanModel extends Model
{
    use HasFactory;

    // Nama tabel eksplisit
    protected $table = 'hasil_jawaban';

    // FIX: tambah 'nama', 'status_koreksi', 'nilai' ke fillable
    protected $fillable = [
        'nama',
        'email',
        'jawaban_1',
        'jawaban_2',
        'jawaban_3',
        'status_koreksi',
        'nilai',
    ];

    // FIX: $attributes dihapus — default value sekarang ditangani di migration (kolom DB)
    // Kalau dibiarkan, Laravel ikut-ikutan insert kolom ini walau belum ada di tabel
}
