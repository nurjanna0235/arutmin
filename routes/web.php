<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DokumenController;
use App\Http\Controllers\KontraktorController;
use App\Http\Controllers\PitClearingController;
use App\Http\Controllers\TopSoilController;
use App\Http\Controllers\admin\PenggunaController;
use App\Http\Controllers\admin\OBController;
use App\Http\Controllers\admin\CoalController;
use App\Http\Controllers\admin\SingeRateController;


//Halaman pengguna
Route::get('admin/pengguna', [PenggunaController::class, 'index']);
Route::get('admin/pengguna/edit/{num}', [PenggunaController::class, 'edit']);

//Route::get('kontraktor', [KontraktorController::class, 'index']);

//Dokumen controller
Route::get('dokumen', [DokumenController::class, 'index']);

//Dokumen Darma Henwa Asteng/pit-clearing
Route::get('dokumen/asteng/pit-clearing', [PitClearingController::class, 'index']);
Route::get('dokumen/asteng/pit-clearing/detail/{num}', [PitClearingController::class, 'detail']);

//Dokumen Darma Henwa Asteng/top-soil
Route::get('dokumen/asteng/top-soil', [TopSoilController::class, 'index']);
Route::get('dokumen/asteng/top-soil/detail/{num}', [TopSoilController::class, 'detail']);

//Dokumen Darma Henwa Asteng/ob
Route::get('dokumen/asteng/ob', [OBController::class, 'index']);

//Dokumen Darma Henwa Asteng/coal
Route::get('dokumen/asteng/coal', [CoalController::class, 'index']);

//Dokumen Darma Henwa Asteng/single-rate
Route::get('dokumen/asteng/single-rate', [SingeRateController::class, 'index']);


// Route::get('akun', [datacontroller::class, 'tampil'])->name('akun.tampil');


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

