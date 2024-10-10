<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardPegawaiController,
    LoginController,
    DashboardSuperadminController,
    JenisBarangController,
    MasterPegawaiController,
    BarangController,
  
};
use App\Models\MasterPegawai;
use App\Models\PendaftaranSurat;

Route::get('/run-admin', function () {
    Artisan::call('db:seed', [
        '--class' => 'SuperAdminSeeder'
    ]);

    return "AdminSeeder has been create successfully!";
});



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


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// Route::group(['middleware' => ['role:admin']], function () {
Route::get('/dashboard-owner', [DashboardSuperadminController::class, 'index'])->name('admin.dashboard');
Route::get('/dashboard-pegawai', [DashboardPegawaiController::class, 'index'])->name('pegawai.dashboard');
// });


// ADMIN
Route::group(['middleware' => ['role:admin']], function () {

    Route::get('/master-pegawai', [MasterPegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/master-pegawai/create', [MasterPegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('/master-pegawai/store', [MasterPegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('/master-pegawai/edit/{id}', [MasterPegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::put('/master-pegawai/update/{id}', [MasterPegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/master-pegawai/delete/{id}', [MasterPegawaiController::class, 'destroy'])->name('pegawai.destroy');
    
    Route::get('/master-jenisbarang', [JenisBarangController::class, 'index'])->name('jenis.index');
    Route::get('/master-jenisbarang/create', [JenisBarangController::class, 'create'])->name('jenis.create');
    Route::post('/master-jenisbarang/store', [JenisBarangController::class, 'store'])->name('jenis.store');
    Route::get('/master-jenisbarang/edit/{id}', [JenisBarangController::class, 'edit'])->name('jenis.edit');
    Route::put('/master-jenisbarang/update/{id}', [JenisBarangController::class, 'update'])->name('jenis.update');
    Route::delete('/master-jenisbarang/delete/{id}', [JenisBarangController::class, 'destroy'])->name('jenis.destroy');
    
    Route::get('/master-barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/master-barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/master-barang/store', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/master-barang/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/master-barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/master-barang/delete/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    

});

// ADMIN

// MAHASISWA


// MAHASISWA