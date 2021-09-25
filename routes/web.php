<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UtamaController;
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

Route::get('/', [ UtamaController::class, "index" ])->name('welcome');

Route::get('/?r=home', [ UtamaController::class, "index" ])->name('welcome2');

Route::get('/app/{id}', [ UtamaController::class, "app" ])->name('app');

Route::get('/app/{id}?r=home', [ UtamaController::class, "app" ])->name('app2');

Route::get('/about', [ UtamaController::class, "index" ])->name('about');

require __DIR__.'/web-sso.php';
