<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motor;

class HomeController extends Controller
{
    public function index()
    {
        $motors = Motor::all();
        return view('home', compact('motors'));
    }
}


