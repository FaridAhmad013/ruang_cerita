<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\RyunnaAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manage\{UserController, KelolaDokumenController};
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;

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
});
