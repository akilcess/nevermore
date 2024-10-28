<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AddKeranjangController,
    DashboardPegawaiController,
    LoginController,
    DashboardSuperadminController,
    JenisBarangController,
    MasterPegawaiController,
    BarangController,
    KabupatenController,
    KonfirmStokController,
    ManageGambarController,
    RequestStokController,
    MerkBarangController,
    WebDetailProdukController,
    WebIndexController,
    WebJenisProdukController,
    WebKeranjangController,
    WebMerkProdukController,
    WebSemuaProdukController,
    ProvinsiController,
    RegisterUserController,
    WilayahController,
    CheckoutController,
    HandleLaporanController,
    ProsesPenjualanController,
    WebPesananController,
    ManageCustomerController
};


Route::get('/run-admin', function () {
    Artisan::call('db:seed', [
        '--class' => 'SuperAdminSeeder'
    ]);

    return "AdminSeeder has been create successfully!";
});

Route::get('/wilayah', [WilayahController::class, 'fetchAndStoreAll']);

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

Route::get('/register', [RegisterUserController::class, 'index'])->name('registeruser.index');
Route::post('/register/store', [RegisterUserController::class, 'store'])->name('registeruser.store');


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

    Route::get('/master-merkbarang', [MerkBarangController::class, 'index'])->name('merk.index');
    Route::get('/master-merkbarang/create', [MerkBarangController::class, 'create'])->name('merk.create');
    Route::post('/master-merkbarang/store', [MerkBarangController::class, 'store'])->name('merk.store');
    Route::get('/master-merkbarang/edit/{id}', [MerkBarangController::class, 'edit'])->name('merk.edit');
    Route::put('/master-merkbarang/update/{id}', [MerkBarangController::class, 'update'])->name('merk.update');
    Route::delete('/master-merkbarang/delete/{id}', [MerkBarangController::class, 'destroy'])->name('merk.destroy');

    Route::get('/master-barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/master-barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/master-barang/store', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/master-barang/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/master-barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/master-barang/delete/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    Route::get('/konfirm-request-stok', [KonfirmStokController::class, 'index'])->name('konfirm_request_stok.index');
    Route::get('/konfirm-request-stok/edit/{id}', [KonfirmStokController::class, 'edit'])->name('konfirm_request_stok.edit');
    Route::put('/konfirm-request-stok/updateStatus/{id}', [KonfirmStokController::class, 'updateStatus'])->name('konfirm_request_stok.update');


    Route::get('/laporan-keseluruhan', [HandleLaporanController::class, 'allpenjualan'])->name('allpenjualan.index');
    Route::get('/laporan-stok', [HandleLaporanController::class, 'allstok'])->name('allstok.index');
    Route::get('/laporan-topsold', [HandleLaporanController::class, 'palingseringdibeli'])->name('topsold.index');

    Route::get('/customer', [ManageCustomerController::class, 'index'])->name('admin.users.index');
    Route::delete('/customer/delete/{registerUserId}', [ManageCustomerController::class, 'delete'])->name('admin.users.delete');
});


// ADMIN

// PEGAWAI
Route::group(['middleware' => ['role:pegawai']], function () {

    Route::get('/manage-gambar', [ManageGambarController::class, 'index'])->name('manage_gambar.index');
    Route::get('/manage-gambar/manage/{id}', [ManageGambarController::class, 'manage'])->name('manage_gambar.manage');
    Route::put('/manage-gambar/update/{id}', [ManageGambarController::class, 'update'])->name('manage_gambar.update');

    Route::get('/request-stok', [RequestStokController::class, 'index'])->name('request_stok.index');
    Route::get('/request-stok/create', [RequestStokController::class, 'create'])->name('request_stok.create');
    Route::post('/request-stok/store', [RequestStokController::class, 'store'])->name('request_stok.store');
    Route::get('/request-stok/edit/{id}', [RequestStokController::class, 'edit'])->name('request_stok.edit');
    Route::put('/request-stok/update/{id}', [RequestStokController::class, 'update'])->name('request_stok.update');
    Route::delete('/request-stok/delete/{id}', [RequestStokController::class, 'destroy'])->name('request_stok.destroy');
    Route::get('/get-stok/{id}', [RequestStokController::class, 'getStok']);

    Route::get('/proses-pesanan', [ProsesPenjualanController::class, 'index'])->name('proses_penjualan');
    Route::get('/pesanan-dikirim', [ProsesPenjualanController::class, 'dikirim'])->name('dikirim');
    Route::get('/pesanan-selesai', [ProsesPenjualanController::class, 'selesai'])->name('selesai');
    Route::post('/proses-pesanan/dikirim/{id}', [ProsesPenjualanController::class, 'markAsCompleted'])->name('pesanan.dikirim');
});

// PEGAWAI



// PENGGUNA

Route::get('/', [WebIndexController::class, 'index'])->name('landing.index');
Route::get('/semua-produk', [WebSemuaProdukController::class, 'index'])->name('semua.produk');

Route::get('/produk/jenis/{jenis_barang_id}', [WebJenisProdukController::class, 'getBarangByJenis'])->name('produk.jenis');
Route::get('/produk/merk/{merk_barang_id}', [WebMerkProdukController::class, 'getBarangByMerk'])->name('produk.merk');


Route::get('/produk/detail/{id}', [WebDetailProdukController::class, 'index'])->name('produk.detail');


Route::get('/get-kabupaten/{province_id}', [RegisterUserController::class, 'getKabupaten'])->name('get.kabupaten');

Route::group(['middleware' => ['role:user']], function () {

    Route::get('/profile/edit', [RegisterUserController::class, 'editprofile'])->name('profile.edit');
    Route::put('/profile/update/{user_id}', [RegisterUserController::class, 'updateprofile'])->name('profile.update');

    Route::get('/keranjang', [WebKeranjangController::class, 'index'])->name('keranjang.index');

    Route::post('/add-to-cart/{barangId}', [WebKeranjangController::class, 'addToCart'])->name('cart.add');
    Route::delete('/keranjang/{id}', [WebKeranjangController::class, 'destroy'])->name('keranjang.destroy');

    Route::get('/proses/checkout', [CheckoutController::class, 'index'])->name('proses.checkout');
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

    Route::get('/pesanansaya', [WebPesananController::class, 'index'])->name('pesanansaya');
    Route::post('/pesanan/selesai/{id}', [WebPesananController::class, 'markAsCompleted'])->name('pesanan.selesai');
});
// PENGGUNA