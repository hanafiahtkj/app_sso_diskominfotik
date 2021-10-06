<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Kategori;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $data = [
            'kategori' => Kategori::with('aplikasi')->orderBy('urut', 'asc')->get(),
        ];

        return view('layouts.guest', $data);
    }
}
