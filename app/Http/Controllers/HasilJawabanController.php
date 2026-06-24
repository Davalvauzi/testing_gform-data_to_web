<?php

namespace App\Http\Controllers;

use App\Models\HasilJawabanModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class HasilJawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data tugas siswa dari database
        $semuaTugas = HasilJawabanModel::latest()->get();

        // Kirim data ke file view bernama index.blade.php
        return view('index', compact('semuaTugas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Simpan ke tabel hasil_jawaban
            HasilJawabanModel::create([
                'nama'      => $request->nama_siswa,      // FIX: tambah field nama
                'email'     => $request->email_siswa,
                'jawaban_1' => $request->jawaban_soal_1,
                'jawaban_2' => $request->jawaban_soal_2,
                'jawaban_3' => $request->jawaban_soal_3,
            ]);

            return response()->json(['status' => 'Success', 'message' => 'Data berhasil disimpan'], 200);
        } catch (\Exception $e) {
            // Mencatat error ke storage/logs/laravel.log jika gagal
            Log::error("Gagal simpan data dari Google Form: " . $e->getMessage());
            return response()->json(['status' => 'Error', 'message' => $e->getMessage()], 500);
        }
    }

    public function create() {}
    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}
