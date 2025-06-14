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
