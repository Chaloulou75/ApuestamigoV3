<?php

namespace App\Http\Controllers;

use App\Championnat;
use App\Ligue;

class SeasonController extends Controller
{
    public function update(Championnat $championnat)
    {
        if ($championnat->finished == '0') {
            $championnat = Championnat::find($championnat->id);
            $championnat->finished = '1';
            $championnat->save();

            //update all leagues where $championnat_id = $championnat to finished = true
            $liguesterminees = Ligue::where('championnat_id', $championnat->id)
                                  ->update(['finished' => '1']);

            return back()->with('message.level', 'success')->with('message.content', __('Saison ' . $championnat->name . ' et Ligues terminées'));
        }

        return back()->with('message.level', 'success')->with('message.content', __('Saison ' . $championnat->name . ' déjà terminée'));
    }
}
