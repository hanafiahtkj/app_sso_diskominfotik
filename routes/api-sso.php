<?php

use App\Models\User;
use App\Models\UsersAplikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\UserController;

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

// Api untuk Android/ios

/*
|--------------------------------------------------------------------------
| API Untuk Mobile/Android/IOS SSO
|--------------------------------------------------------------------------
|
*/

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return response()->json([
        'token'    => $user->createToken($request->deviceName)->plainTextToken,
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getKategoriWithApps', [ ApiHomeController::class, "getKategoriWithApps" ]);
Route::get('/getBerita', [ ApiHomeController::class, "getBerita" ]); 
