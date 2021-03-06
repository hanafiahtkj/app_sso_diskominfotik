<?php

use App\Models\User;
use App\Models\UsersAplikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiRegisterController;
use App\Http\Controllers\Api\ApiHomeController;

/*
|--------------------------------------------------------------------------
| API Untuk Web SSO
|--------------------------------------------------------------------------
|
*/
Route::middleware('auth:sanctum')->post('/sso/is-valid', function (Request $request) {
    $user = $request->user();
    if ($request->id_sso == $request->user()->id) { 
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => true,
            'user' => $user,
        ]);
    }
    else {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => false,
        ]);
    }
});

Route::post('/sso/register-app', function (Request $req) {
    $data = new UsersAplikasi;
    $data->id_user = $req->id_user;
    $data->id_aplikasi = $req->id_aplikasi;
    $data->save();

    return response()->json([
        'status' => ($data != null) ? true : false,
    ]);
});

/*
|--------------------------------------------------------------------------
| API Untuk Mobile/Android/IOS SSO
|--------------------------------------------------------------------------
|
*/
Route::post('/login', [ ApiAuthController::class, "login" ]);
Route::post('/register', [ ApiAuthController::class, "register" ]);
Route::get('/getKategoriWithApps', [ ApiHomeController::class, "getKategoriWithApps" ]);
Route::get('/getBerita', [ ApiHomeController::class, "getBerita" ]); 

Route::group([ "middleware" => ['auth:sanctum']], function() {
    Route::get('/isLogin', [ ApiAuthController::class, "isLogin" ]);
    Route::get('/checkVerifiedStatus', [ ApiAuthController::class, "checkVerifiedStatus" ]);
    Route::post('/emailVerify', [ApiAuthController::class, 'emailVerify']);
    Route::post('/sendEmailVerificationNotification', [ApiAuthController::class, 'sendEmailVerificationNotification']);
});

Route::group([ "middleware" => ['auth:sanctum', 'verified']], function() {
    Route::get('/user', [ ApiAuthController::class, "user" ]);
    Route::get('/user2', [ ApiAuthController::class, "user2" ]);
    Route::post('/updateInfoProfile', [ ApiAuthController::class, "updateInfoProfile" ]);
    Route::post('/updateUserPassword', [ ApiAuthController::class, "updateUserPassword" ]);
    Route::post('/deleteProfile', [ ApiAuthController::class, "deleteProfile" ]);
});

Route::post('/forgot-password', [ApiAuthController::class, 'sendEmailPasswordReset']);
