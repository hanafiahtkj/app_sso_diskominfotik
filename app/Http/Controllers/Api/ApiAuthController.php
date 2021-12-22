<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Mail\MalasNgodingEmail;
use Illuminate\Support\Facades\Mail;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $validasi = [
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ];

        $validator = Validator::make($request->all(), $validasi);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Login Gagal!',
                'messages' => $validator->errors(),
            ], 400);
        }
    
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
        $validasi = [
            'id'    => 'required',
            'name'  => 'required',
            'email' => 'required|email',
        ];

        $validator = Validator::make($request->all(), $validasi);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Gagal mengubah informasi profil!',
                'messages' => $validator->errors(),
            ], 400);
        }
    
        $id = $request->id;
        $user = User::find($id);
        if ($user) {
            $data = [
                'name' => $request->name,
                'email'=> $request->email
            ];
            $user->update($data);
            return response()->json([
                'status' => true
            ]);
        }   
    }

    public function updateUserPassword(Request $request)
    {
        $validasi = [
            'id'               => 'required',
            'current_password' => 'current_password',
            'password'         => 'required',
        ];

        $validator = Validator::make($request->all(), $validasi);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Terjadi Kesalahan!',
                'messages' => $validator->errors(),
            ], 400);
        }
        
        $id = $request->id;
        $user = User::find($id);

        if (! Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'error' => 'Pasword yang dimasukan salah!'
            ], 400);
        }

        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();

        return response()->json([
            'status' => true
        ]);
    }

    public function register(Request $request)
    {
        $validasi = [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $validasi);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Terjadi Kesalahan!',
                'messages' => $validator->errors(),
            ], 400);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->assignRole('General');

        return response()->json([
            'id' => $user->id,
            'token' => $user->createToken($request->input('email'))->plainTextToken,
        ]);
    }

    public function sendEmailVerificationNotification(Request $request) 
    {
        $user = $request->user();

        Mail::to($user->email)->send(new VerifikasiEmail($user));

		return response()->json([]);  
    }
}
