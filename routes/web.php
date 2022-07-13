<?php

use Illuminate\Support\Facades\Route;

//* Controller
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RTRWController;
use App\Http\Controllers\RumahController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DasawismaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AnggotaKeluargaController;

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

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-password/{id}', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::post('/profile/update-photo/{id}', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');

    Route::get('/get-kelurahan/{id}', [UtilityController::class, 'kelurahanByKecamatan'])->name('kelurahanByKecamatan');
    Route::get('/get-dasawisma/{id}', [UtilityController::class, 'dasawismaByRTRW'])->name('dasawismaByRTRW');
    Route::get('/get-nokk/{id}', [UtilityController::class, 'getNoKKByKepalaKeluarga'])->name('getNoKKByKepalaKeluarga');

    Route::resource('/rumah', RumahController::class);
    Route::post('/rumah/store-kk', [RumahController::class, 'storeKK'])->name('rumah.storeKK');
    Route::get('/rumah/edit-kk/{id}', [RumahController::class, 'editKK'])->name('rumah.editKK');
    Route::patch('/rumah/update-kk/{id}', [RumahController::class, 'updateKK'])->name('rumah.updateKK');
    Route::delete('/rumah/destroy-kk/{id}', [RumahController::class, 'destroyKK'])->name('rumah.destroyKK');

    Route::resource('/anggota-keluarga', AnggotaKeluargaController::class);
    Route::post('/anggota-keluarga/check-validation-form1', [AnggotaKeluargaController::class, 'checkValidationForm1'])->name('anggota-keluarga.checkValidationForm1');
    Route::post('/anggota-keluarga/check-validation-form2',  [AnggotaKeluargaController::class, 'checkValidationForm2'])->name('anggota-keluarga.checkValidationForm2');
});
