<?php

namespace App\Http\Controllers;
use DB;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Settings;
use App\Models\Aplikasi;

class UtamaController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function apps()
    { 
        $data = [
            'kategori' => Kategori::with('aplikasi')->orderBy('urut', 'asc')->get(),
        ];
        return view('apps', $data);
    }

    public function app($id)
    { 
        $data = [
            'aplikasi' => Aplikasi::where('id_kategori', $id)->get(),
        ];
        return view('app', $data);
    }
}
