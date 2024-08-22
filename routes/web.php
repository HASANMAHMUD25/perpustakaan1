<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\favoriteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Peminjam\keranjangController;
use App\Http\Controllers\Petugas\BukuController;
use App\Http\Controllers\Petugas\KategoriController;
use App\Http\Controllers\Petugas\PenerbitController;
use App\Http\Controllers\Petugas\RakController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Peminjam\BukuController as PeminjamBukuController;
use App\Http\Controllers\Petugas\ChartController;
use App\Http\Controllers\Petugas\DashboardController;
use App\Http\Controllers\Petugas\TransaksiController;
use App\Http\Controllers\ProfileController;
use App\Livewire\AuditTrail;
use App\Livewire\FavoriteBooks;

Route::get('/favorite-books', function () {
    return view('favorite-books');
});


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/coba', function () {
    notify()->success('Pesan masuk');
    return view('coba');
});

Route::get('/coba2', function () {
    notify()->success('Welcome to Laravel Notify ⚡️') or notify()->success('Welcome to Laravel Notify ⚡️', 'My custom title');
    return redirect()->to('/coba');
});

Route::get('/afterregister', function () {
    return view('afterregister');
});

Route::get('/buku1', PeminjamBukuController::class);
Route::get('/', favoriteController::class);

Auth::routes([
    'register' => false,
]);

Route::get('/favorite', function () {
    return view('favorite-books');
});

Route::get('/cek-role', function () {
    if (auth()->user()->hasRole(['admin', 'petugas'])) {
        return redirect('/dashboard');
    } else {
        return redirect('/buku1');
    }
});


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth', 'role:admin|petugas'])->group(function () {

    Route::get('/dashboard', DashboardController::class);

Route::get('/kategori', KategoriController::class);
Route::get('/rak', RakController::class);
Route::get('/penerbit', PenerbitController::class);
Route::get('/buku', BukuController::class);
Route::get('/chart', ChartController::class);
Route::get('/transaksi', TransaksiController::class);


});

Route::middleware(['role:peminjam'])->group(function () {
    Route::get('/keranjang', KeranjangController::class);
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('/user', UserController::class);
});

Route::get('activity', ActivityLogController::class);


Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
