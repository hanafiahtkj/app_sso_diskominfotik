<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Settings;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'kategori' => Kategori::all(),
            'settings' => Settings::all()->pluck('value', 'field'),
        ];
        return view('pages.dashboard', $data);
    }
}
