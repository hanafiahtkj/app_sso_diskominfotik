<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Settings;
use App\Models\Aplikasi;
use DB;

class App extends Component
{
    public $settings;
    public $aplikasi;
    public $berita;
    public $polling;

    public function mount()
    {
        $this->aplikasi = Aplikasi::where('id_kategori', 93)->get()->sortBy([
            ['order', 'asc']]);
        $this->settings = Settings::all()->sortBy('urut')->pluck('value', 'field');
    }

    public function render()
    {
        return view('livewire.home');
    }
}
