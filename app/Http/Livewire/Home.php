<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Settings;

class Home extends Component
{
    public $settings;
    public $kategori;
    public $berita;

    public function mount()
    {
        $this->kategori = Kategori::with('aplikasi')->orderBy('urut', 'asc')->get();
        $this->settings = Settings::all()->sortBy('urut')->pluck('value', 'field');
        $this->berita   = $this->_getBerita();
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

        return json_decode($response);
    }

    public function render()
    {
        return view('livewire.home');
    }
}
