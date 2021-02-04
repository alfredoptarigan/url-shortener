<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\UrlController;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/r/{url}', [UrlController::class, 'findUrl'])->name('public.url.find');



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Menu Route
    Route::get('/menu', [UrlController::class, 'index'])->name('public.url.menu');
    Route::get('/my-url', [UrlController::class, 'myURL'])->name('public.url.myurl');

    // URL Route
    Route::get('/create-url', [UrlController::class, 'create'])->name('public.url.create');
    Route::post('/post-url', [UrlController::class, 'store'])->name('public.url.post');

    // Gift Route
    Route::get('/gifts', [GiftController::class, 'index'])->name('public.gift.index');
    Route::get('/claim-gift/{unqiuekey}', [GiftController::class, 'claim'])->name('public.gift.claim');
});

Route::middleware(['auth', isAdmin::class])->group(function () {
    Route::get('/admin/gifts/', [AdministratorController::class, 'createGiftVoucher'])->name('admin.gifts');
    Route::post('/admin/gifts/', [AdministratorController::class, 'storeGiftVoucher'])->name('admin.gifts.store');
});

require __DIR__ . '/auth.php';
