<?php

namespace App\Http\Livewire\Settings;

use App\Models\User;
use App\Models\Pages;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class About extends Component
{
    public $page_id = 1;
    public $action;
    public $button;
    public $pages;

    protected function getRules()
    {
        return [
            'pages.judul' => 'required',
            'pages.konten' => 'required'
        ];
    }

    public function updateSetting ()
    {
        $this->resetErrorBag();
        $this->validate();
        Pages::query()
        ->where('id', $this->page_id)
        ->update([
            'judul'  => $this->pages->judul,
            "konten" => $this->pages->konten,
            'slug'   => 'about'
        ]);

        $this->emit('saved');
    }

    public function mount ()
    {
        $this->button = create_button($this->action, "Halaman Tentang");
        $this->pages = Pages::find($this->page_id);
    }

    public function render()
    {
        return view('livewire.settings.about');
    }
}


