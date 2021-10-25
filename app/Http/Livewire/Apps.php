<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kategori;
use App\Models\Settings;

class Apps extends Component
{
    public $settings;
    public $kategori;
    
    public function mount()
    {
        $this->kategori = Kategori::with('aplikasi')->orderBy('urut', 'asc')->get();
        $this->settings = Settings::all()->sortBy('urut')->pluck('value', 'field');
    }

    public function render()
    {
        return view('livewire.apps');
    }
}
