<?php

namespace App\Http\Controllers;

use App\Ligue;

class LigueSettingsController extends Controller
{
    public function show(Ligue $ligue)
    {
        return view('/ligues/settings/show', $ligue, compact('ligue'));
    }
}
