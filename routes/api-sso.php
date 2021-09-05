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

    return $user->createToken($request->device_name)->plainTextToken;
    return response()->json([
        'token'    => $user->createToken($request->device_name)->plainTextToken,
    ]);
});

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

