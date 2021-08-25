<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;

class UtamaController extends Controller
{
    public function index()
    {
        $data = [
            'kategori' => Kategori::all(),
        ];
        return view('welcome', $data);
    }
}
