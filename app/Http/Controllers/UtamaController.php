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
            'berita'   => $this->_getBerita(),
        ];
        return view('welcome', $data);
    }

    protected function _getBerita() 
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://berita.banjarmasinkota.go.id/api-berita',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        // CURLOPT_HTTPHEADER => array(
        //     'Cookie: PHPSESSID=jn9431hu6lfeg82vl88a04cei0'
        // ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);

    }
}
