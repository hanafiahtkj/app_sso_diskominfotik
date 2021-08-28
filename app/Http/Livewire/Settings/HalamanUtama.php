<?php

namespace App\Http\Livewire\Settings;

use App\Models\User;
use App\Models\Settings;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class HalamanUtama extends Component
{
    public $action;
    public $button;
    public $settings;

    protected function getRules()
    {
        return [
            'settings.judul' => 'required',
            'settings.keterangan' => 'required'
        ];
    }

    public function updateSetting ()
    {
        $this->resetErrorBag();
        $this->validate();

        foreach ($this->settings as $key => $value) {
            Settings::query()
            ->where('field', $key)
            ->update([
                "value" => $value,
            ]);
        }

        $this->emit('saved');
    }

    public function mount ()
    {
        $this->button = create_button($this->action, "Pengaturan");
        $settings = Settings::all();
        $this->settings = $settings->pluck('value', 'field');
    }

    public function render()
    {
        return view('livewire.settings.halaman-utama');
    }
}

