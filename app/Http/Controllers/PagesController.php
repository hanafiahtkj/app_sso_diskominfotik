<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use App\Models\Faq;

class PagesController extends Controller
{
    public function about()
    {
        $data = [
            'about' => Pages::find(1),
        ];
        return view('about', $data);
    }

    public function faq()
    {
        $data = [
            'faqs' => Faq::orderBy('sort_order')->get(),
        ];
        return view('faq', $data);
    }
}
