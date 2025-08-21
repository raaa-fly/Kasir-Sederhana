<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Users;


// ========================
// Halaman Home
// ========================
Route::get('/', function () {
    return view('home'); // Pastikan resources/views/home.blade.php ada
})->name('home');


// ========================
// Produk
// ========================
Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
Route::resource('produk', ProdukController::class);


// ========================
// Pelanggan
// ========================
Route::resource('pelanggan', PelangganController::class);


// ========================
// Transaksi
// ========================
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/pilih-produk/{pelanggan_id}', [TransaksiController::class, 'pilihProduk'])->name('transaksi.pilih_produk');
Route::post('/transaksi/simpan-produk', [TransaksiController::class, 'simpanProduk'])->name('transaksi.simpan_produk');
// web.php

// Route for search and display pelanggan data
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');

// Route to continue to pilih_produk
Route::post('/transaksi/lanjutkan', [TransaksiController::class, 'lanjutkanTransaksi'])->name('transaksi.lanjutkan');


Route::get('transaksi/tambah-pelanggan', [TransaksiController::class, 'tambahPelanggan'])->name('transaksi.tambah_pelanggan');
Route::post('transaksi/tambah-pelanggan', [TransaksiController::class, 'storePelanggan'])->name('transaksi.store_pelanggan');
Route::post('/transaksi/reset', [TransaksiController::class, 'resetTransaksi'])->name('transaksi.reset');
Route::get('/laporan', [TransaksiController::class, 'laporan'])->name('laporan.index');


Route::get('/', function () {
    $transaksis = \App\Models\Transaksi::latest()
    ->take(3)
    ->get()
    ->map(function($transaksis) {
        return [
            'type' => 'transaksi',
            'message' => 'Transaksi baru: ' . $transaksis->kode_transaksi,
            'time' => $transaksis->created_at->diffForHumans()
        ];
    });

    // Get latest produkss
    $produks = \App\Models\Produk::latest()
        ->take(3)
        ->get()
        ->map(function($produks) {
            return [
                'type' => 'produks',
                'message' => 'Produk baru: ' . $produks->nama_produk . ' (Stok: ' . $produks->stok . ')',
                'time' => $produks->created_at->diffForHumans()
            ];
        });

    // Combine and sort by time
    $latestActivities = $transaksis->concat($produks)
        ->sortByDesc('time')
        ->take(5);

    return view('home', compact('latestActivities'));
})->name('home');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\Auth\RegisterController;

// Existing login routes...

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

use Illuminate\Support\Facades\Auth;

// Middleware untuk mengecek role admin

Route::middleware(['auth'])->group(function () {

    // Admin Dashboard
    Route::get('/dashboard/admin', function () {
        $user = Auth::user();
        if ($user->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }

        return view('dashboard.admin');
    })->name('dashboard.admin');

    // petugas Dashboard
    Route::get('/dashboard/kasir', function () {
        $user = Auth::user();
        if ($user->role !== 'petugas') {
            abort(403, 'Akses hanya untuk petugas.');
        }

        return view('dashboard.kasir');
    })->name('dashboard.kasir');
});
use App\Http\Controllers\ProfileController;

Route::middleware(['auth'])->get('/profile', [ProfileController::class, 'index'])->name('profile.index');

use App\Http\Controllers\ReportController;

Route::get('/report/export-excel', [ReportController::class, 'exportExcel'])->name('report.exportExcel');
Route::middleware(['auth'])->group(function () {
    Route::resource('transaksi', TransaksiController::class);
    // Route transaksi lainnya

Route::get('/laporan', [ReportController::class, 'index'])->name('report.index');
Route::get('/laporan/export', [ReportController::class, 'exportExcel'])->name('report.exportExcel');

});