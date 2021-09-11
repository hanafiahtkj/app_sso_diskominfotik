<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'kategori' => Kategori::orderBy('urut', 'asc')->get(),
            'settings' => Settings::all()->sortBy('urut')->pluck('value', 'field'),
        ];
        return view('welcome', $data);
    }
}
