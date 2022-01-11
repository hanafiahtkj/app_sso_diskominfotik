<?php

namespace App\Http\Controllers;
use DB;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Settings;

class UtamaController extends Controller
{
    public function index()
    {
        $data = [
            'kategori' => Kategori::with('aplikasi')->orderBy('urut', 'asc')->get(),
        ];

        dd($data);
        
        return view('welcome', $data);
    }

    public function apps()
    { 
        $data = [
            'kategori' => Kategori::with('aplikasi')->orderBy('urut', 'asc')->get(),
        ];
        return view('apps', $data);
    }
}
