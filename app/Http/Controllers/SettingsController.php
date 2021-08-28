<?php

namespace App\Http\Controllers;

use App\Models\User;

class SettingsController extends Controller
{
    public function index()
    {
        return view('pages.settings.settings', [
            'user' => User::class
        ]);
    }
}
