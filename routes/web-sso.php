<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UtamaController;

/*
|--------------------------------------------------------------------------
| SSO Routes
|--------------------------------------------------------------------------
*/

Route::get('/sso/login', function () {
    return view('authsso.login');
});

Route::get('/sso/is-login', function (Request $request) {
    return response()->json([
        'status'  => Auth::check(),
        'message' => Auth::check() ? 'SSO Sudah Login' : 'SSO Belum Login'
    ]);
});

Route::group([ "middleware" => ['auth:sanctum', 'verified'] ], function() {
    
    Route::get('/sso/user', function (Request $request) {
        return response()->json([
            'status' => Auth::check(),
            'data'   => Auth::user(),
        ]);
    });

    Route::get('/dashboard', [ UtamaController::class, "index" ])->name('dashboard');
    Route::resource('app', AppController::class)->middleware(['auth']);
    Route::resource('kategori', KategoriController::class)->middleware(['auth']);
    Route::get('/user', [ UserController::class, "index_view" ])->name('user');
    Route::view('/user/new', "pages.user.user-new")->name('user.new');
    Route::view('/user/edit/{userId}', "pages.user.user-edit")->name('user.edit');
});



