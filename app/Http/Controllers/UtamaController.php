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
            'kategori' => Kategori::with('aplikasi')->orderBy('urut', 'asc')->get(),
            'settings' => Settings::all()->sortBy('urut')->pluck('value', 'field'),
        ];
        return view('welcome', $data);
    }

    public function app($id)
    {
        $data = [
            'app_id'   => $id,
            'kategori' => Kategori::with('aplikasi')->orderBy('urut', 'asc')->get(),
            'settings' => Settings::all()->sortBy('urut')->pluck('value', 'field'),
        ];
        return view('welcome', $data);
    }
}
