<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/sanctum/token', function (Request $request) {
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

    //return $user->createToken($request->device_name)->plainTextToken;
    return response()->json([
        'token'    => $user->createToken($request->device_name)->plainTextToken,
    ]);
});

Route::post('/sso/register', [UserController::class, "register"]);

Route::middleware('auth:sanctum')->post('/sso/is-login', function (Request $request) {
    $id_sso = $request->id_sso;
    $user = $request->user();
    if ($id_sso == $request->user()->id) { 
        $user->tokens()->delete();
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

require __DIR__.'/web-sso.php';
