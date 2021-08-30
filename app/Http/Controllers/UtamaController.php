<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Settings;

class UtamaController extends Controller
{
    public function index()
    {
        $data = [
            'kategori' => Kategori::all(),
            'settings' => Settings::all()->sortBy('urut')->pluck('value', 'field'),
        ];
        return view('welcome', $data);
    }
}
