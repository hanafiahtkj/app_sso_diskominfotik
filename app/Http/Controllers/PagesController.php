<?php

namespace App\Http\Controllers;

use App\Models\Pages;

class PagesController extends Controller
{
    public function about()
    {
        $data = [
            'about' => Pages::find(1),
        ];
        return view('about', $data);
    }
}
