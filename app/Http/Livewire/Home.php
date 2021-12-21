<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Settings;
use App\Models\Aplikasi;
use DB;

class Home extends Component
{
    public $settings;
    public $aplikasi;
    public $berita;
    public $polling;

    public function mount()
    {
        $this->aplikasi = Aplikasi::where('id_kategori', 93)->get();
        $this->settings = Settings::all()->sortBy('urut')->pluck('value', 'field');
        $this->berita   = $this->_getBerita();

        $query = DB::table('polling')
                ->select(
                    DB::raw('SUM(sangatbaik) as sangatbaik'),
                    DB::raw('SUM(baik) as baik'),
                    DB::raw('SUM(cukup) as cukup'),
                    DB::raw('SUM(kurang) as kurang')
                )
                ->first();

        $total = DB::table('polling')->count();

        $this->polling = [
            'sangatbaik' => ( $total == 0 ) ? 0 : round(($query->sangatbaik * 100) / $total),
            'baik'       => ( $total == 0 ) ? 0 : round(($query->baik * 100) / $total),
            'cukup'      => ( $total == 0 ) ? 0 : round(($query->cukup * 100) / $total),
            'kurang'     => ( $total == 0 ) ? 0 : round(($query->kurang * 100) / $total),
        ];

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
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return ($response) ? json_decode($response) : [];
    }

    public function render()
    {
        return view('livewire.home');
    }
}
