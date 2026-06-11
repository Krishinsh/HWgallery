<?php

use App\Http\Controllers\AdministratoraKontrolieris;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalvenasGalerijasKontrolieris;
use App\Http\Controllers\IndividualasGalerijasKontrolieris;
use App\Http\Controllers\ProfilaKontrolieris;
use Illuminate\Support\Facades\Route;

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['lv', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', [GalvenasGalerijasKontrolieris::class, 'list'])->name('galerija');
Route::get('/meklet', [GalvenasGalerijasKontrolieris::class, 'search'])->name('galerija.meklet');
Route::get('/masina/{id}', [GalvenasGalerijasKontrolieris::class, 'detail'])->name('masina.detail');
Route::get('/lietotaji', [GalvenasGalerijasKontrolieris::class, 'users'])->name('lietotaji');
Route::get('/lietotaji/{id}', [GalvenasGalerijasKontrolieris::class, 'userGallery'])->name('lietotajs.galerija');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/mana-kolekcija', [IndividualasGalerijasKontrolieris::class, 'select'])->name('mana.kolekcija');
    Route::get('/mana-kolekcija/meklet', [IndividualasGalerijasKontrolieris::class, 'search'])->name('mana.kolekcija.meklet');

    Route::get('/pievienot', [IndividualasGalerijasKontrolieris::class, 'pievienotForm'])->name('masina.pievienot');
    Route::post('/pievienot', [IndividualasGalerijasKontrolieris::class, 'create']);

    Route::get('/rediget/{id}', [IndividualasGalerijasKontrolieris::class, 'edit'])->name('masina.rediget');
    Route::put('/rediget/{id}', [IndividualasGalerijasKontrolieris::class, 'update']);

    Route::delete('/masina/{id}', [IndividualasGalerijasKontrolieris::class, 'delete'])->name('masina.dzest');

    Route::delete('/masina/{car}/bilde/{image}', [IndividualasGalerijasKontrolieris::class, 'dzestBildi'])
        ->name('masina.bilde.dzest');

    Route::get('/profils', [ProfilaKontrolieris::class, 'show'])->name('profils.show');
    Route::put('/profils', [ProfilaKontrolieris::class, 'update'])->name('profils.update');
    Route::delete('/profils', [ProfilaKontrolieris::class, 'destroy'])->name('profils.dzest');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::delete('/admin/masina/{id}', [AdministratoraKontrolieris::class, 'deleteContent'])->name('admin.dzest');
    Route::delete('/admin/lietotajs/{id}', [AdministratoraKontrolieris::class, 'deleteUser'])->name('admin.lietotajs.dzest');
});
