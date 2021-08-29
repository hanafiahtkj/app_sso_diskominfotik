<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class UserController extends Controller
{
    public function index_view ()
    {
        return view('pages.user.user-data', [
            'user' => User::class
        ]);
    }

    public function register(Request $request)
    {
        $validasi = [
            'name'     => 'requiredstring|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $validasi);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->assignRole('General');

        return response()->json([
            'status' => true,
        ]);
    }
}
