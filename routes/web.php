<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\AsramaController;
use App\Http\Controllers\KategoripaketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});
Route::get('/tabel', [UserController::class, 'usertabel'])->name('user');
Route::get('/alternatif', [UserController::class, 'useralternatif']);
Route::get('/kriteria', [UserController::class, 'userkriteria']);
Route::get('/kelas', [UserController::class, 'userkelas']);
Route::get('/siswa', [UserController::class, 'usersiswa']);

route::middleware(['auth', 'guru'])->group(function () {
	Route::get('/dashboard_admin2', [HomeController::class, 'index2']);
});

route::middleware(['auth', 'isAdmin'])->group(function () {
	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index2'])->name('home');
	Route::get('/dashboard_admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	// ------------------------ Setting
	Route::get('/setting', [SettingController::class, 'index'])->name('backup.index');
	Route::post('/backup/run', [SettingController::class, 'runBackup'])->name('backup.run');
	Route::post('/backup/restore', [SettingController::class, 'restore'])->name('backup.restore');
	Route::get('/backup/download/{filename}', [SettingController::class, 'download'])->name('backup.download');
	// ------------------------ laporan
	Route::get('laporan_admin', [LaporanController::class, 'index']);
	Route::get('laporan_admin2', [LaporanController::class, 'index2']);
	// Route::get('laporan_admin2', [LaporanController::class, 'ambildata5']);
    // ------------------------ user
	Route::get('/usermanagement', [UserManagementController::class, 'index']);
	Route::get('/usermanagement_delete/{id}', [UserManagementController::class, 'delete']);
	Route::post('/usermanagement_add', [UserManagementController::class, 'create']);
	Route::post('/usermanagement_update/{id}', [UserManagementController::class, 'update']);
	// ------------------------ Asrama
	Route::get('/asrama_admin', [AsramaController::class, 'index']);
	Route::get('/asrama_delete/{id}', [AsramaController::class, 'delete']);
	Route::post('/asrama_add', [AsramaController::class, 'create']);
	Route::post('/asrama_update/{id}', [AsramaController::class, 'update']);
	// ------------------------ kategori Paket
	Route::get('/kategoripaket_admin', [KategoripaketController::class, 'index']);
	Route::get('/kategori_delete/{id}', [KategoripaketController::class, 'delete']);
	Route::post('/kategori_add', [KategoripaketController::class, 'create']);
	Route::post('/kategori_update/{id}', [KategoripaketController::class, 'update']);

	// ------------------------ Santri
	Route::get('/santri_admin', [SantriController::class, 'index']);
	Route::get('/santri_delete/{nis}', [SantriController::class, 'delete']);
	Route::post('/santri_add', [SantriController::class, 'create']);
	Route::post('/santri_update/{nis}', [SantriController::class, 'update']);
	Route::post('/santri_import_excel', [SantriController::class, 'import']);
	Route::get('/santri/export_excel', [SantriController::class, 'exsport']);

	// ------------------------ Pkaet
	Route::get('/paket_admin', [PaketController::class, 'index']);
	Route::get('/paket_delete/{id}', [PaketController::class, 'delete']);
	Route::get('tambah-paket', [PaketController::class, 'tambah']);
	Route::post('insert-paket', [PaketController::class, 'insert']);
	Route::get('edit-paket/{id}', [PaketController::class, 'edit']);
	Route::put('update-paket/{id}', [PaketController::class, 'update']);
	Route::get('hapus-paket/{id}', [PaketController::class, 'delete']);

});
Auth::routes();


Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});
