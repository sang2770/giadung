<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntroduceController extends Controller
{
    public function index()
    {
        return view('introduce');
    }
}
