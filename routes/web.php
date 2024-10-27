<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\KontraktorController;
use App\Http\Controllers\PitClearingController;

Route::get('pengguna', [PenggunaController::class, 'index']);
//Route::get('kontraktor', [KontraktorController::class, 'index']);

Route::get('dokumen', [DokumenController::class, 'index']);
Route::get('dokumen/asteng/pit-clearing', [PitClearingController::class, 'index']);
Route::get('dokumen/asteng/pit-clearing/detail/{num}', [PitClearingController::class, 'detail']);


Route::get('akun', [datacontroller::class, 'tampil'])->name('akun.tampil');


Route::get('/beranda', function () {
  return view('admin/beranda/beranda',['nama'=> 'janna']);
});

//Route::get('/registrasi', [AuthController::class, 'tampilRegistrasi'])->name('registrasi.tampil');

// Route::get('/home', function () {
//     return view('home',['title'=>'Home page']);
// });

// Route::get('/blog', function () {
//    return view('blog',['title'=>'blog']);
// });

// Route::get('/contact', function () {
//     return view('contact');
// });

