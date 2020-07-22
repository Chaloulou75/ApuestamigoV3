<?php

namespace App\Http\Controllers;

use App\Ligue;
use Illuminate\Http\Request;

class LigueSettingsController extends Controller
{
    public function show(Ligue $ligue)
    {
        return view('/ligues/settings/show', $ligue, compact('ligue'));
    }
}
