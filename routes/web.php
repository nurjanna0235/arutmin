<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\BerandaController;
use App\Http\Controllers\RateContractController;
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
// Route::get('beranda', [BerandaController::class, 'index']);

//Halaman pengguna
Route::get('admin/pengguna', [PenggunaController::class, 'index']);
Route::get('admin/pengguna/edit/{num}', [PenggunaController::class, 'edit']);
Route::post('admin/pengguna/update/{num}', [PenggunaController::class, 'update']);
Route::get('admin/pengguna/tambah', [PenggunaController::class, 'tambah']);
Route::post('admin/pengguna/simpan', [PenggunaController::class, 'simpan']);
Route::delete('admin/pengguna/delete/{num}', [PenggunaController::class, 'delete']);

//Route::get('kontraktor', [KontraktorController::class, 'index']);

//Dokumen controller
Route::get('rate-contract', [RateContractController::class, 'index']);

//Dokumen Darma Henwa Asteng/pit-clearing
Route::get('rate-contract/asteng/pit-clearing', [PitClearingController::class, 'index']);
Route::get('rate-contract/asteng/pit-clearing/detail/{num}', [PitClearingController::class, 'detail']);
Route::get('rate-contract/asteng/pit-clearing/tambah', [PitClearingController::class, 'tambah']);
Route::post('rate-contract/asteng/pit-clearing/simpan', [PitClearingController::class, 'simpan']);
Route::delete('rate-contract/asteng/pit-clearing/delete/{num}', [PitClearingController::class, 'hapus']);
Route::get('rate-contract/asteng/pit-clearing/edit/{num}', [PitClearingController::class, 'edit']);
Route::put('rate-contract/asteng/pit-clearing/update/{num}', [PitClearingController::class, 'update']);

//rate_contract Darma Henwa Asteng/top-soil
Route::get('rate-contract/asteng/top-soil', [TopSoilController::class, 'index']);
Route::get('rate-contract/asteng/top-soil/detail/{num}', [TopSoilController::class, 'detail']);
Route::get('rate-contract/asteng/top-soil/tambah', [TopSoilController::class, 'tambah']);
Route::post('rate-contract/asteng/top-soil/simpan', [TopSoilController::class, 'simpan']);
Route::delete('rate-contract/asteng/top-soil/delete/{num}', [TopSoilController::class, 'hapus']);
Route::get('rate-contract/asteng/top-soil/edit/{num}', [topSoilController::class, 'edit']);
Route::put('rate-contract/asteng/top-soil/update/{num}', [topSoilController::class, 'update']);


//rate_contract Darma Henwa Asteng/ob
Route::get('rate-contract/asteng/ob', [OBController::class, 'index']);
Route::get('rate-contract/asteng/ob/detail/{num}', [OBController::class, 'detail']);
Route::get('rate-contract/asteng/ob/tambah', [OBController::class, 'tambah']);
Route::post('rate-contract/asteng/ob/simpan', [OBController::class, 'simpan']);
Route::delete('rate-contract/asteng/ob/delete/{num}', [OBController::class, 'hapus']);
Route::get('rate-contract/asteng/ob/edit/{num}', [OBController::class, 'edit']);
Route::put('rate-contract/asteng/ob/update/{num}', [OBController::class, 'update']);

//rate_contract Darma Henwa Asteng/coal
Route::get('rate-contract/asteng/coal', [CoalController::class, 'index']);
Route::get('rate-contract/asteng/coal/detail/{num}', [CoalController::class, 'detail']);
Route::get('rate-contract/asteng/coal/tambah', [CoalController::class, 'tambah']);
Route::post('rate-contract/asteng/coal/simpan', [CoalController::class, 'simpan']);
Route::delete('rate-contract/asteng/coal/delete/{num}', [CoalController::class, 'hapus']);
Route::get('rate-contract/asteng/coal/edit/{num}', [CoalController::class, 'edit']);
Route::put('rate-contract/asteng/coal/update/{num}', [CoalController::class, 'update']);

//rate_contract Darma Henwa Asteng/other
Route::get('rate-contract/asteng/other', [OtherController::class, 'index']);
Route::get('rate-contract/asteng/other/detail/{num}', [OtherController::class, 'detail']);
Route::get('rate-contract/asteng/other/tambah', [OtherController::class, 'tambah']);
Route::post('rate-contract/asteng/other/simpan', [OtherController::class, 'simpan']);
Route::delete('rate-contract/asteng/other/delete/{num}', [OtherController::class, 'hapus']);
Route::get('rate-contract/asteng/other/edit/{num}', [OtherController::class, 'edit']);
Route::put('rate-contract/asteng/other/update/{num}', [OtherController::class, 'update']);

//rate_contract Darma Henwa Asteng/single-rate
Route::get('rate-contract/asteng/single-rate', [SingleRateController::class, 'index']);
Route::get('rate-contract/asteng/single-rate/detail/{num}', [SingleRateController::class, 'detail']);
Route::get('rate-contract/asteng/single-rate/tambah', [SingleRateController::class, 'tambah']);
Route::post('rate-contract/asteng/single-rate/simpan', [SingleRateController::class, 'simpan']);
Route::delete('rate-contract/asteng/single-rate/delete/{num}', [SingleRateController::class, 'hapus']);
Route::get('rate-contract/asteng/single-rate/edit/{num}', [SingleRateController::class, 'edit']);
Route::put('rate-contract/asteng/single-rate/update/{num}', [SingleRateController::class, 'update']);

//rate_contract Darma Henwa Asteng/mud
Route::get('rate-contract/asteng/mud', [MudController::class, 'index']);
Route::get('rate-contract/asteng/mud/detail/{num}', [MudController::class, 'detail']);
Route::get('rate-contract/asteng/mud/tambah', [MudController::class, 'tambah']);
Route::post('rate-contract/asteng/mud/simpan', [MudController::class, 'simpan']);
Route::delete('rate-contract/asteng/mud/delete/{num}', [MudController::class, 'hapus']);
Route::get('rate-contract/asteng/mud/edit/{num}', [MudController::class, 'edit']);
Route::put('rate-contract/asteng/mud/update/{num}', [MudController::class, 'update']);

//rate_contract Darma Henwa Asteng/daywork
Route::get('rate-contract/asteng/daywork', [DayworkController::class, 'index']);
Route::get('rate-contract/asteng/daywork/detail/{num}', [DayworkController::class, 'detail']);
Route::get('rate-contract/asteng/daywork/tambah', [DayworkController::class, 'tambah']);
Route::post('rate-contract/asteng/daywork/simpan', [dayworkController::class, 'simpan']);
Route::delete('rate-contract/asteng/daywork/delete/{num}', [dayworkController::class, 'hapus']);
Route::get('rate-contract/asteng/daywork/edit/{num}', [dayworkController::class, 'edit']);
Route::put('rate-contract/asteng/daywork/update/{num}', [dayworkController::class, 'update']);

//rate_contract Darma Henwa Asteng/oudistance
Route::get('rate-contract/asteng/oudistance', [oudistanceController::class, 'index']);
Route::get('rate-contract/asteng/oudistance/detail/{num}', [oudistanceController::class, 'detail']);
Route::get('rate-contract/asteng/oudistance/tambah', [oudistanceController::class, 'tambah']);
Route::post('rate-contract/asteng/oudistance/simpan', [oudistanceController::class, 'simpan']);
Route::delete('rate-contract/asteng/oudistance/delete/{num}', [oudistanceController::class, 'hapus']);
Route::get('rate-contract/asteng/oudistance/edit/{num}', [oudistanceController::class, 'edit']);
Route::put('rate-contract/asteng/oudistance/update/{num}', [oudistanceController::class, 'update']);

//rate_contract Darma Henwa Asteng/Fuel
Route::get('rate-contract/asteng/fuel', [FuelController::class, 'index']);
Route::get('rate-contract/asteng/fuel/detail/{num}', [FuelController::class, 'detail']);
Route::get('rate-contract/asteng/fuel/tambah', [FuelController::class, 'tambah']);
Route::post('rate-contract/asteng/fuel/simpan', [fuelController::class, 'simpan']);
Route::delete('rate-contract/asteng/fuel/delete/{num}', [fuelController::class, 'hapus']);
Route::get('rate-contract/asteng/fuel/edit/{num}', [fuelController::class, 'edit']);
Route::put('rate-contract/asteng/fuel/update/{num}', [fuelController::class, 'update']);


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

