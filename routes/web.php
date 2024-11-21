<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\BerandaController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\KontraktorController;
use App\Http\Controllers\PitClearingController;
use App\Http\Controllers\admin\TopSoilController;
use App\Http\Controllers\admin\PenggunaController;
use App\Http\Controllers\admin\OBController;
use App\Http\Controllers\admin\CoalController;
use App\Http\Controllers\admin\SingleRateController;
use App\Http\Controllers\admin\OtherController;
use App\Http\Controllers\admin\MudController;
use App\Http\Controllers\admin\DayworkController;
use App\Http\Controllers\admin\oudistanceController;
use App\Http\Controllers\admin\FuelController;

//Halaman beranda
Route::get('beranda', [BerandaController::class, 'index']);

//Halaman pengguna
Route::get('admin/pengguna', [PenggunaController::class, 'index']);
Route::get('admin/pengguna/edit/{num}', [PenggunaController::class, 'edit']);
Route::post('admin/pengguna/update/{num}', [PenggunaController::class, 'update']);
Route::get('admin/pengguna/tambah', [PenggunaController::class, 'tambah']);
Route::post('admin/pengguna/simpan', [PenggunaController::class, 'simpan']);
Route::delete('admin/pengguna/delete/{num}', [PenggunaController::class, 'delete']);

//Route::get('kontraktor', [KontraktorController::class, 'index']);

//Dokumen controller
Route::get('dokumen', [DokumenController::class, 'index']);

//Dokumen Darma Henwa Asteng/pit-clearing
Route::get('dokumen/asteng/pit-clearing', [PitClearingController::class, 'index']);
Route::get('dokumen/asteng/pit-clearing/detail/{num}', [PitClearingController::class, 'detail']);
Route::get('dokumen/asteng/pit-clearing/tambah', [PitClearingController::class, 'tambah']);
Route::post('dokumen/asteng/pit-clearing/simpan', [PitClearingController::class, 'simpan']);
Route::delete('dokumen/asteng/pit-clearing/delete/{num}', [PitClearingController::class, 'hapus']);


//Dokumen Darma Henwa Asteng/top-soil
Route::get('dokumen/asteng/top-soil', [TopSoilController::class, 'index']);
Route::get('dokumen/asteng/top-soil/detail/{num}', [TopSoilController::class, 'detail']);
Route::get('dokumen/asteng/top-soil/tambah', [TopSoilController::class, 'tambah']);
Route::post('dokumen/asteng/top-soil/simpan', [TopSoilController::class, 'simpan']);
Route::delete('dokumen/asteng/top-soil/delete/{num}', [TopSoilController::class, 'hapus']);


//Dokumen Darma Henwa Asteng/ob
Route::get('dokumen/asteng/ob', [OBController::class, 'index']);
Route::get('dokumen/asteng/ob/detail/{num}', [OBController::class, 'detail']);
Route::get('dokumen/asteng/ob/tambah', [OBController::class, 'tambah']);
Route::post('dokumen/asteng/ob/simpan', [OBController::class, 'simpan']);
Route::delete('dokumen/asteng/ob/delete/{num}', [OBController::class, 'hapus']);

//Dokumen Darma Henwa Asteng/coal
Route::get('dokumen/asteng/coal', [CoalController::class, 'index']);
Route::get('dokumen/asteng/coal/detail/{num}', [CoalController::class, 'detail']);
Route::get('dokumen/asteng/coal/tambah', [CoalController::class, 'tambah']);
Route::post('dokumen/asteng/coal/simpan', [CoalController::class, 'simpan']);
Route::delete('dokumen/asteng/coal/delete/{num}', [CoalController::class, 'hapus']);

//Dokumen Darma Henwa Asteng/other
Route::get('dokumen/asteng/other', [OtherController::class, 'index']);
Route::get('dokumen/asteng/other/detail/{num}', [OtherController::class, 'detail']);
Route::get('dokumen/asteng/other/tambah', [OtherController::class, 'tambah']);
Route::post('dokumen/asteng/other/simpan', [OtherController::class, 'simpan']);
Route::delete('dokumen/asteng/other/delete/{num}', [OtherController::class, 'hapus']);

//Dokumen Darma Henwa Asteng/single-rate
Route::get('dokumen/asteng/single-rate', [SingleRateController::class, 'index']);
Route::get('dokumen/asteng/single-rate/detail/{num}', [SingleRateController::class, 'detail']);
Route::get('dokumen/asteng/single-rate/tambah', [SingleRateController::class, 'tambah']);
Route::post('dokumen/asteng/single-rate/simpan', [SingleRateController::class, 'simpan']);
Route::delete('dokumen/asteng/single-rate/delete/{num}', [SingleRateController::class, 'hapus']);

//Dokumen Darma Henwa Asteng/mud
Route::get('dokumen/asteng/mud', [MudController::class, 'index']);
Route::get('dokumen/asteng/mud/detail/{num}', [MudController::class, 'detail']);
Route::get('dokumen/asteng/mud/tambah', [MudController::class, 'tambah']);
Route::post('dokumen/asteng/mud/simpan', [MudController::class, 'simpan']);
Route::delete('dokumen/asteng/mud/delete/{num}', [MudController::class, 'hapus']);

//Dokumen Darma Henwa Asteng/daywork
Route::get('dokumen/asteng/daywork', [DayworkController::class, 'index']);
Route::get('dokumen/asteng/daywork/detail/{num}', [DayworkController::class, 'detail']);
Route::get('dokumen/asteng/daywork/tambah', [DayworkController::class, 'tambah']);
Route::post('dokumen/asteng/daywork/simpan', [dayworkController::class, 'simpan']);
Route::delete('dokumen/asteng/daywork/delete/{num}', [dayworkController::class, 'hapus']);

//Dokumen Darma Henwa Asteng/oudistance
Route::get('dokumen/asteng/oudistance', [oudistanceController::class, 'index']);
Route::get('dokumen/asteng/oudistance/detail/{num}', [oudistanceController::class, 'detail']);
Route::get('dokumen/asteng/oudistance/tambah', [oudistanceController::class, 'tambah']);
Route::post('dokumen/asteng/oudistance/simpan', [oudistanceController::class, 'simpan']);
Route::delete('dokumen/asteng/oudistance/delete/{num}', [oudistanceController::class, 'hapus']);

//Dokumen Darma Henwa Asteng/Fuel
Route::get('dokumen/asteng/fuel', [FuelController::class, 'index']);
Route::get('dokumen/asteng/fuel/detail/{num}', [FuelController::class, 'detail']);
Route::get('dokumen/asteng/fuel/tambah', [FuelController::class, 'tambah']);
Route::post('dokumen/asteng/fuel/simpan', [fuelController::class, 'simpan']);
Route::delete('dokumen/asteng/fuel/delete/{num}', [fuelController::class, 'hapus']);


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

