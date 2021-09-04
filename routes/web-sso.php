<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UtamaController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| SSO Routes
|--------------------------------------------------------------------------
*/

Route::get('/sso/login', function () {
    return view('authsso.login');
});

Route::get('/about', [ PagesController::class, "about" ])->name('pages.about');

Route::group([ "middleware" => ['auth:sanctum']], function() {

    Route::get('/sso/is-login', function (Request $request) {
        return response()->json([
            'status'  => Auth::check(),
            'message' => Auth::check() ? 'SSO Sudah Login' : 'SSO Belum Login'
        ]);
    });

    Route::get('/sso/user', function (Request $request) {
        $script = $request->server('REMOTE_ADDR').$request->server('HTTP_USER_AGENT');
        $key = $request->user()->createToken($script)->plainTextToken;
        return response()->json([
            'status' => Auth::check(),
            'data'   => [
                'user'  => Auth::user(),
                'key'   => $key,
            ]
        ]);
    });

    Route::post('/sso/is-valid', function (Request $request) {
        $user = $request->user();
        if ($id_sso == $request->user()->id) { 
            $user->tokens()->where('token', $request->key)->delete();
            return response()->json([
                'status' => true,
                'data'   => $user,
            ]);
        }
        else {
            $user->tokens()->delete();
            return response()->json([
                'status' => false,
            ]);
        }
    });

    Route::post('/sso/register', [UserController::class, "register"]);
});

Route::group([ "middleware" => ['auth:sanctum', 'verified', 'role:Admin']], function() {
    Route::get('/dashboard', [ DashboardController::class, "index" ])->name('dashboard');
    Route::resource('kategori', KategoriController::class)->middleware(['auth']);
    Route::resource('app', AppController::class)->middleware(['auth']);
    Route::get('/user', [ UserController::class, "index_view" ])->name('user');
    Route::view('/user/new', "pages.user.user-new")->name('user.new');
    Route::view('/user/edit/{userId}', "pages.user.user-edit")->name('user.edit');
    Route::get('/settings', [ SettingsController::class, "index" ])->name('settings.index'); 
});




