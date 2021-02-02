<?php

use App\Http\Controllers\UrlController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/menu', [UrlController::class, 'index'])->name('public.url.menu');
    Route::get('/create-url', [UrlController::class, 'create'])->name('public.url.create');
    Route::post('/post-url', [UrlController::class, 'store'])->name('public.url.post');
    Route::get('/redirect/{url}', [UrlController::class, 'findUrl'])->name('public.url.find');
});

require __DIR__ . '/auth.php';
