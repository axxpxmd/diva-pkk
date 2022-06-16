<?php

use Illuminate\Support\Facades\Route;

//* Controller
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RTRWController;
use App\Http\Controllers\UtilityController;

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

Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/', function () {
        return redirect(Route('dashboard'));
    })->name('home');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/rt-rw', RTRWController::class);

    Route::get('/get-kelurahan/{id}', [UtilityController::class, 'kelurahanByKecamatan'])->name('kelurahanByKecamatan');
});
