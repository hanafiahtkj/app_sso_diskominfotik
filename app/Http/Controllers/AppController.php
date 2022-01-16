<?php

namespace App\Http\Controllers;
use DB;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Settings;
use App\Models\Aplikasi;

class AppController extends Controller
{
    public function app($id)
    {
        $data = [
            'kategori' => Kategori::find($id),
            'aplikasi' => Aplikasi::where('id_kategori', $id)->get()->sortBy([
                ['order', 'asc']]),
        ];
        return view('app', $data);
    }
}
