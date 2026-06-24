<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HasilJawabanController;

// Route::get('/', function () {
//     return view('welcome');
//     });

Route::post('/api/terima-jawaban', [HasilJawabanController::class, 'store']);
Route::get('/', [HasilJawabanController::class, 'index']); // FIX: 'route' -> 'Route' (case-sensitive)
