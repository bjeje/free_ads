<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class errorController extends Controller
{
    public function show()
    {
        return view('errors.403');
    }
}
