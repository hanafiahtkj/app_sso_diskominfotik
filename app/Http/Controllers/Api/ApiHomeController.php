<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Settings;
use App\Http\Controllers\Controller;

class ApiHomeController extends Controller
{
    public function getKategoriWithApps()
    {
        $data = Kategori::with('aplikasi')->orderBy('urut', 'asc')->get();
        return response()->json($data);
    }
}
