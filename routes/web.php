<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


use App\Http\Controllers\admin\ProfilController;

use App\Http\Controllers\user\ProfilUserController;
use App\Http\Controllers\RateContractController;
use App\Http\Controllers\user\RateContractUserController;

//controller admin bagian asteng
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

//controller user bagian asteng
use App\Http\Controllers\user\PitClearingUserController;
use App\Http\Controllers\user\TopSoilUserController;
use App\Http\Controllers\user\OBUserController;
use App\Http\Controllers\user\CoalUserController;
use App\Http\Controllers\user\OtherUserController;
use App\Http\Controllers\user\SingleRateUserController;
use App\Http\Controllers\user\MudUserController;
use App\Http\Controllers\user\DayworkUserController;
use App\Http\Controllers\user\oudistanceUserController;
use App\Http\Controllers\user\FuelUserController;

//controller admin bagian asbar
use App\Http\Controllers\admin\asbar_admin\CoalHaulingtoPLTUController;
use App\Http\Controllers\admin\asbar_admin\HaulRoadMaintenancePLTUController;
use App\Http\Controllers\admin\asbar_admin\DayworkAsbarController;
use App\Http\Controllers\admin\asbar_admin\FuelAsbarController;

//controller user bagian asbar
use App\Http\Controllers\user\asbar_user\CoalHaulingPLTUUserController;
use App\Http\Controllers\user\asbar_user\HaulRoadMaintenancePLTUUserController;
use App\Http\Controllers\user\asbar_user\DayworkAsbarUserController;
use App\Http\Controllers\user\asbar_user\FuelAsbarUserController;

//controller admin bagian astim
use App\Http\Controllers\admin\astim_admin\PitClearingLCMController;
use App\Http\Controllers\admin\astim_admin\TopSoilLCMController;
use App\Http\Controllers\aDMIN\astim_admin\OBLCMController;
use App\Http\Controllers\admin\astim_admin\CoalLCMController;
use App\Http\Controllers\admin\astim_admin\MudLCMController;
use App\Http\Controllers\admin\astim_admin\DayworkLCMController;
use App\Http\Controllers\admin\astim_admin\FuelLCMController;
use App\Http\Controllers\admin\astim_admin\OtherItemsLCMController;
use App\Http\Controllers\admin\astim_admin\OudistanceLCMController;
use App\Http\Controllers\LupaPassword;
//controller user bagian astim
use App\Http\Controllers\user\astim_user\PitClearingLCMUserController;
use App\Http\Controllers\user\astim_user\TopSoilLCMUserController;
use App\Http\Controllers\user\astim_user\OBLCMUserController;
use App\Http\Controllers\user\astim_user\CoalLCMUserController;
use App\Http\Controllers\user\astim_user\MudLCMUserController;
use App\Http\Controllers\user\astim_user\DayworkLCMUserController;
use App\Http\Controllers\user\astim_user\OtherItemsLCMUserController;
use App\Http\Controllers\user\astim_user\OudistanceLCMUserController;
use App\Http\Controllers\user\astim_user\FuelLCMUserController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;


Route::get('/test-email', function () {
    Mail::raw('Ini adalah email uji coba dengan SendGrid.', function ($message) {
        $message->to('nurefendi210203@gmail.com') // Ganti dengan email penerima
                ->subject('Tes Email SendGrid')
                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
    });

    return 'Email telah dikirim!';
});


Route::get('password/forgot', [LupaPassword::class, 'showForgotForm'])->name('password.request');
Route::post('password/email', [LupaPassword::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [LupaPassword::class, 'index'])->name('password.reset');
Route::post('password/reset', [LupaPassword::class, 'reset'])->name('password.update');


//halaman login
Route::get('', [LoginController::class, 'index']);
Route::get('login', [LoginController::class, 'index']);
Route::get('lupa-password', [LupaPassword::class, 'index']);
Route::post('login/auth', [LoginController::class, 'authentication']);
Route::get('logout', [LoginController::class, 'logout']);



//halaman profil beranda
Route::get('admin/profile', [ProfilController::class, 'index'])->middleware('isAdmin');
Route::get('admin/profile/edit', [ProfilController::class, 'edit'])->middleware('isAdmin');
Route::post('admin/profile/update', [ProfilController::class, 'update'])->middleware('isAdmin');

//halaman profil beranda
Route::get('user/profile', [ProfilUserController::class, 'index'])->middleware('isUser');
Route::get('user/profile/edit', [ProfilUserController::class, 'edit'])->middleware('isUser');
Route::post('user/profile/update', [ProfilUserController::class, 'update'])->middleware('isUser');


//Halaman pengguna
Route::get('admin/pengguna', [PenggunaController::class, 'index'])->middleware('isAdmin');
Route::get('admin/pengguna/edit/{num}', [PenggunaController::class, 'edit'])->middleware('isAdmin');
Route::post('admin/pengguna/update/{num}', [PenggunaController::class, 'update'])->middleware('isAdmin');
Route::get('admin/pengguna/tambah', [PenggunaController::class, 'tambah'])->middleware('isAdmin');
Route::post('admin/pengguna/simpan', [PenggunaController::class, 'simpan'])->middleware('isAdmin');
Route::delete('admin/pengguna/delete/{num}', [PenggunaController::class, 'delete'])->middleware('isAdmin');

// Halaman user
Route::delete('user/pengguna/delete/{num}', [PenggunaController::class, 'delete'])->middleware('isUser');

//Route::get('kontraktor', [KontraktorController::class, 'index']);

//Dokumen controller
Route::get('rate-contract', [RateContractController::class, 'index'])->middleware('isAdmin');

//route bagian asteng
Route::get('rate-contract/asteng', [RateContractController::class, 'asteng'])->middleware('isAdmin');
//rate_contract Darma Henwa Asteng/pit-clearing
Route::get('rate-contract/asteng/pit-clearing', [PitClearingController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/asteng/pit-clearing/detail/{num}', [PitClearingController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/asteng/pit-clearing/tambah', [PitClearingController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/asteng/pit-clearing/simpan', [PitClearingController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/asteng/pit-clearing/delete/{num}', [PitClearingController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/asteng/pit-clearing/edit/{num}', [PitClearingController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/asteng/pit-clearing/update/{num}', [PitClearingController::class, 'update'])->middleware('isAdmin');

//rate_contract Darma Henwa Asteng/top-soil
Route::get('rate-contract/asteng/top-soil', [TopSoilController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/asteng/top-soil/detail/{num}', [TopSoilController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/asteng/top-soil/tambah', [TopSoilController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/asteng/top-soil/simpan', [TopSoilController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/asteng/top-soil/delete/{num}', [TopSoilController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/asteng/top-soil/edit/{num}', [topSoilController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/asteng/top-soil/update/{num}', [topSoilController::class, 'update'])->middleware('isAdmin');

//rate_contract Darma Henwa Asteng/ob
Route::get('rate-contract/asteng/ob', [OBController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/asteng/ob/detail/{num}', [OBController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/asteng/ob/tambah', [OBController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/asteng/ob/simpan', [OBController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/asteng/ob/delete/{num}', [OBController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/asteng/ob/edit/{num}', [OBController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/asteng/ob/update/{num}', [OBController::class, 'update'])->middleware('isAdmin');

//rate_contract Darma Henwa Asteng/coal
Route::get('rate-contract/asteng/coal', [CoalController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/asteng/coal/detail/{num}', [CoalController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/asteng/coal/tambah', [CoalController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/asteng/coal/simpan', [CoalController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/asteng/coal/delete/{num}', [CoalController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/asteng/coal/edit/{num}', [CoalController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/asteng/coal/update/{num}', [CoalController::class, 'update'])->middleware('isAdmin');

//rate_contract Darma Henwa Asteng/other
Route::get('rate-contract/asteng/other', [OtherController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/asteng/other/detail/{num}', [OtherController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/asteng/other/tambah', [OtherController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/asteng/other/simpan', [OtherController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/asteng/other/delete/{num}', [OtherController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/asteng/other/edit/{num}', [OtherController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/asteng/other/update/{num}', [OtherController::class, 'update'])->middleware('isAdmin');

//rate_contract Darma Henwa Asteng/single-rate
Route::get('rate-contract/asteng/single-rate', [SingleRateController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/asteng/single-rate/detail/{num}', [SingleRateController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/asteng/single-rate/tambah', [SingleRateController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/asteng/single-rate/simpan', [SingleRateController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/asteng/single-rate/delete/{num}', [SingleRateController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/asteng/single-rate/edit/{num}', [SingleRateController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/asteng/single-rate/update/{num}', [SingleRateController::class, 'update'])->middleware('isAdmin');

//rate_contract Darma Henwa Asteng/mud
Route::get('rate-contract/asteng/mud', [MudController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/asteng/mud/detail/{num}', [MudController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/asteng/mud/tambah', [MudController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/asteng/mud/simpan', [MudController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/asteng/mud/delete/{num}', [MudController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/asteng/mud/edit/{num}', [MudController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/asteng/mud/update/{num}', [MudController::class, 'update'])->middleware('isAdmin');

//rate_contract Darma Henwa Asteng/daywork
Route::get('rate-contract/asteng/daywork', [DayworkController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/asteng/daywork/detail/{num}', [DayworkController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/asteng/daywork/tambah', [DayworkController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/asteng/daywork/simpan', [dayworkController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/asteng/daywork/delete/{num}', [dayworkController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/asteng/daywork/edit/{num}', [dayworkController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/asteng/daywork/update/{num}', [dayworkController::class, 'update'])->middleware('isAdmin');

//rate_contract Darma Henwa Asteng/oudistance
Route::get('rate-contract/asteng/oudistance', [oudistanceController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/asteng/oudistance/detail/{num}', [oudistanceController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/asteng/oudistance/tambah', [oudistanceController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/asteng/oudistance/simpan', [oudistanceController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/asteng/oudistance/delete/{num}', [oudistanceController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/asteng/oudistance/edit/{num}', [oudistanceController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/asteng/oudistance/update/{num}', [oudistanceController::class, 'update'])->middleware('isAdmin');

//rate_contract Darma Henwa Asteng/Fuel
Route::get('rate-contract/asteng/fuel', [FuelController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/asteng/fuel/detail/{num}', [FuelController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/asteng/fuel/tambah', [FuelController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/asteng/fuel/simpan', [fuelController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/asteng/fuel/delete/{num}', [fuelController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/asteng/fuel/edit/{num}', [fuelController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/asteng/fuel/update/{num}', [fuelController::class, 'update'])->middleware('isAdmin');

// Ini adalah route halaman user

//Dokumen rate-contract
Route::get('user/rate-contract', [RateContractUserController::class, 'index'])->middleware('isUser');

//route bagian asteng user
Route::get('user/rate-contract/asteng', [RateContractUserController::class, 'asteng'])->middleware('isUser');
//rate_contract Darma Henwa Asteng/pit-clearing user
Route::get('user/rate-contract/asteng/pit-clearing', [PitClearingUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/asteng/pit-clearing/detail/{num}', [PitClearingUserController::class, 'detail'])->middleware('isUser');

//rate_contract Darma Henwa Asteng/topsoil user
Route::get('user/rate-contract/asteng/top-soil', [TopSoilUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/asteng/top-soil/detail/{num}', [TopSoilUserController::class, 'detail'])->middleware('isUser');

//rate_contract Darma Henwa Asteng/ob user
Route::get('user/rate-contract/asteng/ob', [OBUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/asteng/ob/detail/{num}', [OBUserController::class, 'detail'])->middleware('isUser');

//rate_contract Darma Henwa Asteng/coal user
Route::get('user/rate-contract/asteng/coal', [CoalUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/asteng/coal/detail/{num}', [CoalUserController::class, 'detail'])->middleware('isUser');

//rate_contract Darma Henwa Asteng/other user
Route::get('user/rate-contract/asteng/other', [OtherUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/asteng/other/detail/{num}', [OtherUserController::class, 'detail'])->middleware('isUser');


//rate_contract Darma Henwa Asteng/single rate user
Route::get('user/rate-contract/asteng/single-rate', [SingleRateUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/asteng/single-rate/detail/{num}', [SingleRateUserController::class, 'detail'])->middleware('isUser');

//rate_contract Darma Henwa Asteng/mud  user
Route::get('user/rate-contract/asteng/mud', [MudUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/asteng/mud/detail/{num}', [MudUserController::class, 'detail'])->middleware('isUser');

//rate_contract Darma Henwa Asteng/daywork user
Route::get('user/rate-contract/asteng/daywork', [DayworkUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/asteng/daywork/detail/{num}', [DayworkUserController::class, 'detail'])->middleware('isUser');

//rate_contract Darma Henwa Asteng/oudistance user
Route::get('user/rate-contract/asteng/oudistance', [oudistanceUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/asteng/oudistance/detail/{num}', [oudistanceUserController::class, 'detail'])->middleware('isUser');

//rate_contract Darma Henwa Asteng/fuel user
Route::get('user/rate-contract/asteng/fuel', [FuelUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/asteng/fuel/detail/{num}', [FuelUserController::class, 'detail'])->middleware('isAdmin');


//route admin bagian asbar//
Route::get('rate-contract/asbar', [RateContractController::class, 'asbar'])->middleware('isAdmin');

//route asbar rate_contract Darma Henwa Asbar/Coal Hauling to PLTU
Route::get('rate-contract/asbar/coal-hauling', [CoalHaulingtoPLTUController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/asbar/coal-hauling/detail/{num}', [CoalHaulingtoPLTUController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/asbar/coal-hauling/tambah', [CoalHaulingtoPLTUController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/asbar/coal-hauling/simpan', [CoalHaulingtoPLTUController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/asbar/coal-hauling/delete/{num}', [CoalHaulingtoPLTUController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/asbar/coal-hauling/edit/{num}', [CoalHaulingtoPLTUController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/asbar/coal-hauling/update/{num}', [CoalHaulingtoPLTUController::class, 'update'])->middleware('isAdmin');

//route asbar rate_contract Darma Henwa Asbar/Haul Road Maintenance PLTU
Route::get('rate-contract/asbar/haul-road-maintenance-pltu', [HaulRoadMaintenancePLTUController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/asbar/haul-road-maintenance-pltu/detail/{num}', [HaulRoadMaintenancePLTUController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/asbar/haul-road-maintenance-pltu/tambah', [HaulRoadMaintenancePLTUController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/asbar/haul-road-maintenance-pltu/simpan', [HaulRoadMaintenancePLTUController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/asbar/haul-road-maintenance-pltu/delete/{num}', [HaulRoadMaintenancePLTUController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/asbar/haul-road-maintenance-pltu/edit/{num}', [HaulRoadMaintenancePLTUController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/asbar/haul-road-maintenance-pltu/update/{num}', [HaulRoadMaintenancePLTUController::class, 'update'])->middleware('isAdmin');

//route asbar rate_contract Darma Henwa Asbar/Daywork Asbar
Route::get('rate-contract/asbar/daywork-asbar', [DayworkAsbarController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/asbar/daywork-asbar/detail/{num}', [DayworkAsbarController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/asbar/daywork-asbar/tambah', [DayworkAsbarController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/asbar/daywork-asbar/simpan', [DayworkAsbarController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/asbar/daywork-asbar/delete/{num}', [DayworkAsbarController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/asbar/daywork-asbar/edit/{num}', [DayworkAsbarController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/asbar/daywork-asbar/update/{num}', [DayworkAsbarController::class, 'update'])->middleware('isAdmin');

//route asbar rate_contract Darma Henwa Asbar/Fuel Asbar
Route::get('rate-contract/asbar/fuel-asbar', [FuelAsbarController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/asbar/fuel-asbar/detail/{num}', [FuelAsbarController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/asbar/fuel-asbar/tambah', [FuelAsbarController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/asbar/fuel-asbar/simpan', [FuelAsbarController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/asbar/fuel-asbar/delete/{num}', [FuelAsbarController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/asbar/fuel-asbar/edit/{num}', [FuelAsbarController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/asbar/fuel-asbar/update/{num}', [FuelAsbarController::class, 'update'])->middleware('isAdmin');


//Dokumen rate-contract
Route::get('user/rate-contract/asbar', [RateContractUserController::class, 'asbar'])->middleware('isUser');

//rate_contract Darma Henwa Asbar/coal-hauling user
Route::get('user/rate-contract/asbar/coal-hauling', [CoalHaulingPLTUUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/asbar/coal-hauling/detail/{num}', [CoalHaulingPLTUUserController::class, 'detail'])->middleware('isUser');

//route asbar rate_contract Darma Henwa Asbar/haul-road-maintenance-pltu Asbar user
Route::get('user/rate-contract/asbar/haul-road-maintenance-pltu', [HaulRoadMaintenancePLTUUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/asbar/haul-road-maintenance-pltu/detail/{num}', [HaulRoadMaintenancePLTUUserController::class, 'detail'])->middleware('isUser');

//route asbar rate_contract Darma Henwa Asbar/Daywork Asbar user
Route::get('user/rate-contract/asbar/daywork-asbar', [DayworkAsbarUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/asbar/daywork-asbar/detail/{num}', [DayworkAsbarUserController::class, 'detail'])->middleware('isUser');

//route asbar rate_contract Darma Henwa Asbar/Fuel Asbar user
Route::get('user/rate-contract/asbar/fuel-asbar', [FuelAsbarUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/asbar/fuel-asbar/detail/{num}', [FuelAsbarUserController::class, 'detail'])->middleware('isUser');



//Dokumen rate-contract
Route::get('rate-contract/astim', [RateContractController::class, 'astim'])->middleware('isAdmin');

//route astim rate_contract Laz Coal Mandiri Astim/pit-clearing
Route::get('rate-contract/astim/pit-clearing-lcm', [PitClearingLCMController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/astim/pit-clearing-lcm/detail/{num}', [PitClearingLCMController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/astim/pit-clearing-lcm/tambah', [PitClearingLCMController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/astim/pit-clearing-lcm/simpan', [PitClearingLCMController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/astim/pit-clearing-lcm/delete/{num}', [PitClearingLCMController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/astim/pit-clearing-lcm/edit/{num}', [PitClearingLCMController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/astim/pit-clearing-lcm/update/{num}', [PitClearingLCMController::class, 'update'])->middleware('isAdmin');

//route astim rate_contract Laz Coal Mandiri Astim/top-soil
Route::get('rate-contract/astim/top-soil-lcm', [TopSoilLCMController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/astim/top-soil-lcm/detail/{num}', [TopSoilLCMUserController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/astim/top-soil-lcm/tambah', [TopSoilLCMController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/astim/top-soil-lcm/simpan', [TopSoilLCMController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/astim/top-soil-lcm/delete/{num}', [TopSoilLCMController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/astim/top-soil-lcm/edit/{num}', [TopSoilLCMController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/astim/top-soil-lcm/update/{num}', [TopSoilLCMController::class, 'update'])->middleware('isAdmin');

//route astim rate_contract Laz Coal Mandiri Astim/ob
Route::get('rate-contract/astim/ob-lcm', [OBLCMController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/astim/ob-lcm/detail/{num}', [OBLCMController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/astim/ob-lcm/tambah', [OBLCMController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/astim/ob-lcm/simpan', [OBLCMController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/astim/ob-lcm/delete/{num}', [OBLCMController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/astim/ob-lcm/edit/{num}', [OBLCMController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/astim/ob-lcm/update/{num}', [OBLCMController::class, 'update'])->middleware('isAdmin');

//route astim rate_contract Laz Coal Mandiri Astim/coal
Route::get('rate-contract/astim/coal-lcm', [CoalLCMController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/astim/coal-lcm/detail/{num}', [CoalLCMController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/astim/coal-lcm/tambah', [CoalLCMController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/astim/coal-lcm/simpan', [CoalLCMController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/astim/coal-lcm/delete/{num}', [CoalLCMController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/astim/coal-lcm/edit/{num}', [CoalLCMController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/astim/coal-lcm/update/{num}', [CoalLCMController::class, 'update'])->middleware('isAdmin');

//route astim rate_contract Laz Coal Mandiri Astim/mud
Route::get('rate-contract/astim/mud-lcm', [MudLCMController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/astim/mud-lcm/detail/{num}', [MudLCMController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/astim/mud-lcm/tambah', [MudLCMController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/astim/mud-lcm/simpan', [MudLCMController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/astim/mud-lcm/delete/{num}', [MudLCMController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/astim/mud-lcm/edit/{num}', [MudLCMController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/astim/mud-lcm/update/{num}', [MudLCMController::class, 'update'])->middleware('isAdmin');

//route astim rate_contract Laz Coal Mandiri Astim/mud
Route::get('rate-contract/astim/mud-lcm', [MudLCMController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/astim/mud-lcm/detail/{num}', [MudLCMController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/astim/mud-lcm/tambah', [MudLCMController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/astim/mud-lcm/simpan', [MudLCMController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/astim/mud-lcm/delete/{num}', [MudLCMController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/astim/mud-lcm/edit/{num}', [MudLCMController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/astim/mud-lcm/update/{num}', [MudLCMController::class, 'update'])->middleware('isAdmin');

//route astim rate_contract Laz Coal Mandiri Astim/daywork
Route::get('rate-contract/astim/daywork-lcm', [DayworkLCMController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/astim/daywork-lcm/detail/{num}', [DayworkLCMController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/astim/daywork-lcm/tambah', [DayworkLCMController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/astim/daywork-lcm/simpan', [DayworkLCMController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/astim/daywork-lcm/delete/{num}', [DayworkLCMController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/astim/daywork-lcm/edit/{num}', [DayworkLCMController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/astim/daywork-lcm/update/{num}', [DayworkLCMController::class, 'update'])->middleware('isAdmin');

//route astim rate_contract Laz Coal Mandiri Astim/other_items
Route::get('rate-contract/astim/other-items-lcm', [OtherItemsLCMController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/astim/other-items-lcm/detail/{num}', [OtherItemsLCMController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/astim/other-items-lcm/tambah', [OtherItemsLCMController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/astim/other-items-lcm/simpan', [OtherItemsLCMController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/astim/other-items-lcm/delete/{num}', [OtherItemsLCMController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/astim/other-items-lcm/edit/{num}', [OtherItemsLCMController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/astim/other-items-lcm/update/{num}', [OtherItemsLCMController::class, 'update'])->middleware('isAdmin');

//route astim rate_contract Laz Coal Mandiri Astim/oudistance
Route::get('rate-contract/astim/oudistance-lcm', [OudistanceLCMController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/astim/oudistance-lcm/detail/{num}', [OudistanceLCMController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/astim/oudistance-lcm/tambah', [OudistanceLCMController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/astim/oudistance-lcm/simpan', [OudistanceLCMController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/astim/oudistance-lcm/delete/{num}', [OudistanceLCMController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/astim/oudistance-lcm/edit/{num}', [OudistanceLCMController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/astim/oudistance-lcm/update/{num}', [OudistanceLCMController::class, 'update'])->middleware('isAdmin');

//route astim rate_contract Laz Coal Mandiri Astim/oudistance
Route::get('rate-contract/astim/fuel-lcm', [FuelLCMController::class, 'index'])->middleware('isAdmin');
Route::get('rate-contract/astim/fuel-lcm/detail/{num}', [FuelLCMController::class, 'detail'])->middleware('isAdmin');
Route::get('rate-contract/astim/fuel-lcm/tambah', [FuelLCMController::class, 'tambah'])->middleware('isAdmin');
Route::post('rate-contract/astim/fuel-lcm/simpan', [FuelLCMController::class, 'simpan'])->middleware('isAdmin');
Route::delete('rate-contract/astim/fuel-lcm/delete/{num}', [FuelLCMController::class, 'hapus'])->middleware('isAdmin');
Route::get('rate-contract/astim/fuel-lcm/edit/{num}', [FuelLCMController::class, 'edit'])->middleware('isAdmin');
Route::put('rate-contract/astim/fuel-lcm/update/{num}', [FuelLCMController::class, 'update'])->middleware('isAdmin');



//Dokumen rate-contract
Route::get('user/rate-contract/astim', [RateContractUserController::class, 'astim'])->middleware('isUser');

//rate_contract Laz Coal Mandiri Astim/pit-clearing-lcm user
Route::get('user/rate-contract/astim/pit-clearing-lcm', [PitClearingLCMUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/astim/pit-clearing-lcm/detail/{num}', [PitClearingLCMUserController::class, 'detail'])->middleware('isUser');

//rate_contract Laz Coal Mandiri Astim/top-soil-lcm user
Route::get('user/rate-contract/astim/top-soil-lcm', [TopSoilLCMUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/astim/top-soil-lcm/detail/{num}', [TopSoilLCMUserController::class, 'detail'])->middleware('isUser');

//rate_contract Laz Coal Mandiri Astim/ob-lcm user
Route::get('user/rate-contract/astim/ob-lcm', [OBLCMUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/astim/ob-lcm/detail/{num}', [OBLCMUserController::class, 'detail'])->middleware('isUser');

//rate_contract Laz Coal Mandiri Astim/coal-lcm user
Route::get('user/rate-contract/astim/coal-lcm', [CoalLCMUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/astim/coal-lcm/detail/{num}', [CoalLCMUserController::class, 'detail'])->middleware('isUser');

//rate_contract Laz Coal Mandiri Astim/mud-lcm user
Route::get('user/rate-contract/astim/mud-lcm', [MudLCMUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/astim/mud-lcm/detail/{num}', [MudLCMUserController::class, 'detail'])->middleware('isUser');

//rate_contract Laz Coal Mandiri Astim/other-items-lcm user
Route::get('user/rate-contract/astim/other-items-lcm', [OtherItemsLCMUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/astim/other-items-lcm/detail/{num}', [OtherItemsLCMUserController::class, 'detail'])->middleware('isUser');

//rate_contract Laz Coal Mandiri Astim/daywork-lcm user
Route::get('user/rate-contract/astim/daywork-lcm', [DayworkLCMUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/astim/daywork-lcm/detail/{num}', [DayworkLCMUserController::class, 'detail'])->middleware('isUser');

//rate_contract Laz Coal Mandiri Astim/oudistance-lcm user
Route::get('user/rate-contract/astim/oudistance-lcm', [OudistanceLCMUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/astim/oudistance-lcm/detail/{num}', [OudistanceLCMUserController::class, 'detail'])->middleware('isUser');

//rate_contract Laz Coal Mandiri Astim/fuel-lcm user
Route::get('user/rate-contract/astim/fuel-lcm', [FuelLCMUserController::class, 'index'])->middleware('isUser');
Route::get('user/rate-contract/astim/fuel-lcm/detail/{num}', [FuelLCMUserController::class, 'detail'])->middleware('isUser');
