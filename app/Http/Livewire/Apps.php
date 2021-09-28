<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kategori;

class Apps extends Component
{
    public $kategori;
    
    public function mount()
    {
        $this->kategori = Kategori::with('aplikasi')->orderBy('urut', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.apps');
    }
}
