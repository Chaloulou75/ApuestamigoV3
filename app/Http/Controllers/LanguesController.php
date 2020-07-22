<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguesController extends Controller
{
    public function index()
    {
        return view('pages/langues/index');
    }
}
