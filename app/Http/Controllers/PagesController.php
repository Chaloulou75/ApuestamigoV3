<?php

namespace App\Http\Controllers;

use App\Equipe;

class PagesController extends Controller
{
    public function welcome()
    {
        $equipes = Equipe::all();
        return view('/index', compact('equipes'));
    }
}
