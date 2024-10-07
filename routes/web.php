<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardPegawaiController,
    LoginController,
    DashboardSuperadminController,
    MasterPegawaiController,
  
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
    

});

// ADMIN

// MAHASISWA


// MAHASISWA