<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class ContextController extends Controller
{
    public function get()
    {
        $loggedIn = Auth::check();

        $user = null;
        if ($loggedIn) {
            $user = Auth::user();
        }

        return response()->json([
            'loggedIn' => $loggedIn,
            'user' => $user
        ]);
    }
}
