<?php

use Illuminate\Support\Facades\Route;

//* Controller
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RTRWController;
use App\Http\Controllers\RumahController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\CetakController;
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
    Route::get('/create-ketua-rt/{id}', [RTRWController::class, 'createKetuaRT'])->name('rt-rw.createKetuaRT');
    Route::post('/store-ketua-rt', [RTRWController::class, 'storeKetuaRT'])->name('rt-rw.storeKetuaRT');
    Route::get('/edit-ketua-rt/{id}', [RTRWController::class, 'editKetuaRT'])->name('rt-rw.editKetuaRT');
    Route::post('/update-ketua-rt', [RTRWController::class, 'updateKetuaRT'])->name('rt-rw.updateKetuaRT');

    Route::resource('/dasawisma', DasawismaController::class);
    Route::get('/show-ketua/{id}', [DasawismaController::class, 'showKetua'])->name('dasawisma.showKetua');

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
    Route::Get('/get-rtrw/{id}', [UtilityController::class, 'rtrwByKelurahan'])->name('rtrwByKelurahan');
    Route::get('/get-dasawisma/{id}', [UtilityController::class, 'dasawismaByRTRW'])->name('dasawismaByRTRW');
    Route::get('/get-nokk/{id}', [UtilityController::class, 'getNoKKByKepalaKeluarga'])->name('getNoKKByKepalaKeluarga');
    Route::get('/get-kartu-keluarga/{id}', [UtilityController::class, 'nokkByRumah'])->name('nokkByRumah');
    Route::get('/get-detail-rumah/{id}', [UtilityController::class, 'getDetailRumah'])->name('getDetailRumah');
    Route::get('/get-rw/{id}', [UtilityController::class, 'rwByKelurahan'])->name('rwByKelurahan');
    Route::get('/get-rumah/{id}', [UtilityController::class, 'rumahByDasawisma'])->name('rumahByDasawisma');

    Route::get('/cetak-data-warga/{id}', [CetakController::class, 'cetakAnggota'])->name('cetakAnggota');
    Route::get('/cetak-kegiatan-warga/{id}', [CetakController::class, 'cetakKegiatanWarga'])->name('cetakKegiatanWarga');
    Route::get('/cetak-rumah/{id}', [CetakController::class, 'cetakRumah'])->name('cetakRumah');
    Route::get('/cetak-kartu-keluarga/{id}', [CetakController::class, 'cetakKartuKeluarga'])->name('cetakKartuKeluarga');

    Route::resource('/rumah', RumahController::class);
    Route::post('/rumah/store-kk', [RumahController::class, 'storeKK'])->name('rumah.storeKK');
    Route::get('/rumah/edit-kk/{id}', [RumahController::class, 'editKK'])->name('rumah.editKK');
    Route::patch('/rumah/update-kk/{id}', [RumahController::class, 'updateKK'])->name('rumah.updateKK');
    Route::delete('/rumah/destroy-kk/{id}', [RumahController::class, 'destroyKK'])->name('rumah.destroyKK');

    Route::resource('/anggota-keluarga', AnggotaKeluargaController::class);
    Route::post('/anggota-keluarga/check-validation-form1', [AnggotaKeluargaController::class, 'checkValidationForm1'])->name('anggota-keluarga.checkValidationForm1');
    Route::post('/anggota-keluarga/check-validation-form2',  [AnggotaKeluargaController::class, 'checkValidationForm2'])->name('anggota-keluarga.checkValidationForm2');
    Route::post('/anggota-keluarga/store-hidup', [AnggotaKeluargaController::class, 'storeHidup'])->name('anggota-keluarga.storeHidup');
    Route::post('/anggote-keluarga/store-meninggal', [AnggotaKeluargaController::class, 'storeMeninggal'])->name('anggota-keluarga.storeMeninggal');
});
