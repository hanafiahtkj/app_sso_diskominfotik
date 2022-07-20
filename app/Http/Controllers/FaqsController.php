<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;
use DB;

class FaqsController extends Controller
{
    public function index_view ()
    {
        return view('pages.faqs.faqs-data', [
            'faq' => Faq::class
        ]);
    }
}
