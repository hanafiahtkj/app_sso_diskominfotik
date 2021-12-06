<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'Email dengan Password tidak ditemukan'
            ], 400);
        }
    
        return response()->json([
            'token' => $user->createToken($request->device_name)->plainTextToken,
        ]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function updateInfoProfile(Request $request)
    {
        $request->validate([
            'id'    => 'required',
            'name'  => 'required',
            'email' => 'required|email',
        ]);

        $validator = Validator::make($request->all(), $validasi);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Gagal mengubah informasi profil!'
            ], 400);
        }
    
        $id = $request->id;
        $user = User::find($id);
        if ($user) {
            $data = ['name' => $request->name];
            $user->update($data);
            return response()->json([
                'status' => true
            ]);
        }   
    }

    public function updateUserPassword(Request $request)
    {
        $request->validate([
            'id'               => 'required',
            'current_password' => 'current_password',
            'password'         => 'required',
        ]);

        $validator = Validator::make($request->all(), $validasi);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'The provided password does not match your current password.'
            ], 400);
        }
        
        $id = $request->id;
        $user = User::find($id);
        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();

        return response()->json([
            'status' => true
        ]);
    }
}
