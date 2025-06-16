<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\RyunnaAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Manajamen\{RoleController, UserController};
use App\Http\Controllers\Master\KategoriPertanyaanController;
use App\Http\Controllers\Master\PertanyaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuangCerita\ObrolanController;
use App\Http\Middleware\RedirectResetPassword;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('routes', function () {
    $routeCollection = Route::getRoutes();

    dd($routeCollection);
});

Route::get('timezone', function () {
    dd(date("Y-m-d H:i:s"));
});

Route::get('/', [MainController::class, 'index'])->name('pengguna.index');
Route::namespace('App\Http\Controllers\Auth')->group(function () {
    Route::prefix('login')->group(function(){
        Route::get('/', [AuthController::class, 'login'])->name('auth.login');
        Route::post('/login_process', [AuthController::class, 'login_process'])->name('auth.login_process');
    });

    Route::prefix('register')->group(function(){
        Route::get('/', [AuthController::class, 'register'])->name('auth.register');
        Route::post('/register_process', [AuthController::class, 'register_process'])->name('auth.register_process');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

// Page
Route::prefix('admin')->middleware([RyunnaAuth::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/total_pengguna', [DashboardController::class, 'get_total_pengguna'])->name('dashboard.total_pengguna');
    Route::get('/dashboard/total_pertanyaan', [DashboardController::class, 'get_total_pertanyaan'])->name('dashboard.total_pertanyaan');
    Route::get('/dashboard/total_entry_jurnal_hari_ini', [DashboardController::class, 'get_total_entry_jurnal_hari_ini'])->name('dashboard.total_entry_jurnal_hari_ini');
    Route::get('/dashboard/total_pengguna_aktif', [DashboardController::class, 'get_total_pengguna_aktif'])->name('dashboard.total_pengguna_aktif');

    //pengguna
    Route::get('/dashboard/check_menulis_jurnal', [DashboardController::class, 'check_menulis_jurnal'])->name('dashboard.check_menulis_jurnal');
    Route::get('/dashboard/get_kalender_progress', [DashboardController::class, 'get_kalender_progress'])->name('dashboard.get_kalender_progress');
    Route::get('/dashboard/get_jejak_ceritamu', [DashboardController::class, 'get_jejak_ceritamu'])->name('dashboard.get_jejak_ceritamu');



    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/edit_profile', [ProfileController::class, 'edit_profile'])->name('profile.edit_profile');
    Route::put('/profile/updatepassword', [ProfileController::class, 'updatePassword'])->name('profile.updatepassword');


    Route::prefix('manajemen')->group(function(){
        Route::resources([
            'user' => UserController::class,
            'role' => RoleController::class
        ]);

        Route::prefix('user')->group(function(){
            Route::post('unblock/{id}', [UserController::class, 'unblock'])->name('user.unblock');
            Route::post('change_status/{id}', [UserController::class, 'change_status'])->name('user.change_status');
        });

        Route::prefix('role')->group(function(){
            Route::post('change_status/{id}', [RoleController::class, 'change_status'])->name('role.change_status');
        });
    });

    Route::prefix('master')->group(function(){
        Route::resources([
            'kategori_pertanyaan' => KategoriPertanyaanController::class,
            'pertanyaan' => PertanyaanController::class
        ]);
    });

    Route::prefix('ruang_cerita')->group(function(){
       Route::get('mulai_sesi_journal', [ObrolanController::class, 'mulai_sesi_journal'])->name('ruang_cerita.mulai_sesi_journal');
       Route::get('check_status_sesi_journal', [ObrolanController::class, 'check_status_sesi_journal'])->name('ruang_cerita.check_status_sesi_journal');
       Route::get('get_pertanyaan_jawaban/{sesi_journal_id}', [ObrolanController::class, 'get_pertanyaan_jawaban'])->name('ruang_cerita.get_pertanyaan_jawaban');
       Route::get('get_kesimpulan/{sesi_journal_id}', [ObrolanController::class, 'get_kesimpulan'])->name('ruang_cerita.get_kesimpulan');
       Route::get('generate_kesimpulan/{sesi_journal_id}', [ObrolanController::class, 'generate_kesimpulan'])->name('ruang_cerita.generate_kesimpulan');
       Route::prefix('obrolan')->group(function(){
            Route::get('/', [ObrolanController::class, 'halaman_obrolan'])->name('ruang_cerita.obrolan.halaman_obrolan');
            Route::post('/kirim_pesan', [ObrolanController::class, 'kirim_pesan'])->name('ruang_cerita.obrolan.kirim_pesan');
       });

    });

    Route::prefix('datatable')->group(function(){
        Route::post('user', [UserController::class, 'datatable'])->name('datatable.user');
        Route::post('role', [RoleController::class, 'datatable'])->name('datatable.role');
        Route::post('kategori_pertanyaan', [KategoriPertanyaanController::class, 'datatable'])->name('datatable.kategori_pertanyaan');
        Route::post('pertanyaan', [PertanyaanController::class, 'datatable'])->name('datatable.pertanyaan');
    });

    Route::prefix('select2')->group(function(){
        Route::get('role', [RoleController::class, 'select2'])->name('select2.role');
        Route::get('kategori_pertanyaan', [KategoriPertanyaanController::class, 'select2'])->name('select2.kategori_pertanyaan');
    });
});
