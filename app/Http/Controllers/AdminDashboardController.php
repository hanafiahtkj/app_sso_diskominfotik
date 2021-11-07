<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $data = [
            'users'          => DB::table('users')->count(),
            'users_verified' => DB::table('users')->where('email_verified_at', '<>', null)->count(),
            'kategori'       => DB::table('kategori')->count(),
            'apps'           => DB::table('aplikasi')->count(),
        ];
        return view('pages.dashboard', $data);
    }
}
