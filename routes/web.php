<?php

use Illuminate\Support\Facades\Route;

//* Controller
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DasawismaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
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
    Route::resource('/dasawisma', DasawismaController::class);
    Route::resource('/kader', KaderController::class);
    Route::resource('/permission', PermissionController::class);
    Route::resource('/role', RoleController::class);
    Route::get('/role/{id}/permission', [RoleController::class, 'permission'])->name('role.permission');
    Route::get('/role/{id}/get-permission', [RoleController::class, 'getPermission'])->name('role.getPermission');
    Route::post('/role/store-permission', [RoleController::class, 'storePermission'])->name('role.storePermission');
    Route::delete('/role/{name}/destroy-permission', [RoleController::class, 'destroyPermission'])->name('role.destroyPermission');

    Route::get('/get-kelurahan/{id}', [UtilityController::class, 'kelurahanByKecamatan'])->name('kelurahanByKecamatan');
});
