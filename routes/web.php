<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UtamaController;
use App\Http\Controllers\PollingController;
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

Route::get('/', [ UtamaController::class, "apps" ])->name('welcome');

// Route::get('/apps', [ UtamaController::class, "apps" ])->name('apps');

Route::get('/about', [ UtamaController::class, "index" ])->name('about');

Route::post('/polling/simpan', [ PollingController::class, "simpan" ])->name('polling');

require __DIR__.'/web-sso.php';
