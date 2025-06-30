<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\MenuController;
use App\Models\Menu;
use App\Models\Pesanan;

/*
|--------------------------------------------------------------------------
| route user (ga login)
|--------------------------------------------------------------------------
*/
Route::get('/', [PesanController::class, 'form'])->name('pesan.form');
Route::post('/pesan', [PesanController::class, 'store'])->name('pesan.store');
Route::get('/menu', [UserController::class, 'index'])->name('pesan.index');
Route::post('/pesanan/kirim', [PesanController::class, 'store'])->name('pesanan.kirim');

/*
|--------------------------------------------------------------------------
| bawaan jetstream
|--------------------------------------------------------------------------
*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| route admin (kudu login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // dashboard
    Route::get('/', function () {
        return view('admin.dashboard', [
            'menus' => \App\Models\Menu::all(),
            'pesanans' => \App\Models\Pesanan::with('items.menu')->latest()->get(),
            'totalPesanan' => Pesanan::count(),
            'totalPending' => Pesanan::where('status', 'pending')->count(),
            'totalSelesai' => Pesanan::where('status', 'selesai')->count(),
        ]);
    })->name('dashboard');

    // manajemen menu
    Route::resource('menu', MenuController::class);

    // manajemen pesanan
    Route::get('pesanan', [PesanController::class, 'index'])->name('pesanan.index');
    Route::post('pesanan/{id}/konfirmasi', [PesanController::class, 'konfirmasi'])->name('pesanan.konfirmasi');

    Route::delete('pesanan/{id}', [PesanController::class, 'destroy'])->name('pesanan.destroy');
});
