<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\RyunnaAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manage\{UserController, KelolaDokumenController};
use App\Http\Controllers\MainController;

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
Route::prefix('login')->group(function(){
    Route::get('/', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/login_process', [AuthController::class, 'login_process'])->name('auth.login_process');
});

// Page
Route::prefix('admin')->middleware([RyunnaAuth::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
});
