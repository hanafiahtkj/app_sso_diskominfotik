<?php

namespace App\Http\Controllers;
use DB;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Settings;
use App\Models\Aplikasi;
use Illuminate\Support\Facades\Storage;

class UtamaController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function privacyPolicy() 
    {
        return view('privacy-policy');
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

    public function resize()
    {
        $files = Storage::allFiles('logo_app');

        var_dump($files); die;
    }
}
