<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Polling;

class PollingController extends Controller
{
    public function simpan(Request $request)
    {
        $polling = $request->input('polling');
        switch ($polling) {
            case 1:
              $field = 'sangatbaik';
              break;
            case 2:
              $field = 'baik';
              break;
            case 3:
              $field = 'cukup';
              break;
            case 4:
              $field = 'kurang';
              break;
            default:
              //
        }

        $poll = [
            $field => 1,
        ];

        $polling = Polling::create($poll);

        return response()->cookie('polling', 'display: none;', time() + 31556926)
          ->json([
            'status' => true,
        ]);
    }
}
