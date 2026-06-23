<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilJawabanModel extends Model
{
    //
    use HasFactory;

    // 1. Tentukan nama tabelnya secara eksplisit (opsional, tapi baik untuk kejelasan)
    protected $table = 'hasil_jawaban';

    // 2. Daftarkan kolom mana saja yang boleh diisi secara massal saat memanggil TugasSiswa::create()
    protected $fillable = [
        'email',
        'jawaban_1',
        'jawaban_2',
        'jawaban_3'
    ];

    // 3. (Opsional) Mengatur nilai default bawaan model jika tidak diisi saat insert data
    protected $attributes = [
        'status_koreksi' => 'Belum Dikoreksi',
        'nilai' => 0,
    ];
}
