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

use App\Mail\VerifikasiEmail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Password;
use Laravel\Fortify\Fortify;

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
                'message' => $validator->errors(),
            ], 400);
        }
    
        $user = User::where('email', $request->email)->first();
    
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email dengan Password tidak ditemukan'
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

    public function user2(Request $request)
    {
        $script = $request->server('REMOTE_ADDR').$request->server('HTTP_USER_AGENT');
        $key = $request->user()->createToken($script)->plainTextToken;
        $status = ($request->user() != null) ? true : false;
        return response()->json([
            'status' => $status,
            'data'   => [
                'user'  => $request->user(),
                'key'   => $key,
            ]
        ]);
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
                'message' => 'Gagal mengubah informasi profil!',
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

    public function deleteProfile(Request $request)
    {
        $validasi = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $validasi);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 400);
        }
    
        $id = $request->id;
        $user = User::find($id);
        if ($user) {
            $user->delete();  
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
                'message' => $validator->errors(),
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
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->assignRole('General');

        // sementara
        $user->forceFill(['email_verified_at' => Carbon::now()->toDateTimeString()]);
            $user->save();

        // $this->_sendEmailVerificationNotification($user);

        return response()->json([
            'id' => $user->id,
            'token' => $user->createToken($request->input('email'))->plainTextToken,
            'message' => 'Registrasi Berhasil',
        ]);
    }

    function _sendEmailVerificationNotification(User $user) 
    {
        $verification_kode = strtoupper(substr(md5(uniqid(rand(), true)), 6, 6));
        
        $user->verification_kode = $verification_kode;

        $user->save();

        Mail::to($user->email)->send(new VerifikasiEmail($user, $verification_kode));
    }

    public function sendEmailVerificationNotification(Request $request) 
    {
        $user = $request->user();

        $verification_kode = strtoupper(substr(md5(uniqid(rand(), true)), 6, 6));
        
        $user->verification_kode = $verification_kode;

        $user->save();

        Mail::to($user->email)->send(new VerifikasiEmail($user, $verification_kode));
        
		return response()->json([
            'status'  => true, 
            'message' => 'Email Verifikasi Berhasil terkirim',
        ]);  
    }

    public function emailVerify(Request $request)
    {
        $user = $request->user();
        $verification_kode = $request->input('verification_kode');

        $status = false;
        if ($user->verification_kode == $verification_kode) {
            $user->forceFill(['email_verified_at' => Carbon::now()->toDateTimeString()]);
            $user->save();
            $status = true;
        }

        return response()->json([
            'status' => $status,
        ]);
    } 

    public function checkVerifiedStatus(Request $request)
    {
        return response()->json([
            'status' => ($request->user()->hasVerifiedEmail()) ? true : false,
        ]);
    } 

    public function isLogin(Request $request)
    {
        $status = ($request->user() != null) ? true : false;
        return response()->json([
            'status'  => $status,
            'message' => $status ? 'SSO Sudah Login' : 'SSO Belum Login'
        ]);
    } 

    public function sendEmailPasswordReset(Request $request)
    {
        $request->validate([Fortify::email() => 'required|email']);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = $this->broker()->sendResetLink(
            $request->only(Fortify::email())
        );

        return response()->json([
            'status'  => $status == Password::RESET_LINK_SENT ? true : false,
            // 'message' => $status ? 'SSO Sudah Login' : 'SSO Belum Login'
        ]);
    }

    protected function broker(): PasswordBroker
    {
        return Password::broker(config('fortify.passwords'));
    }
}
