<?php

namespace App\Http\Controllers;

use App\Game;
use App\Ligue;
use App\Match;
use App\User;
use Illuminate\Http\Request;

class ApuestasOrphansController extends Controller
{
    public function index()
    {
        //je veux tous les matches dont le game_id n'as pas de correspondance avec un game id
        $game_ids = Game::select('id')->pluck('id')->all();
        // et ceux qui n'ont pas ou plus de ligues
        $ligue_ids = Ligue::select('id')->pluck('id')->all();
        // ceux qui n'ont pas ou plus de user
        $users_ids = User::select('id')->pluck('id')->all();

        $orphans = Match::whereNotIn('game_id', $game_ids)
                      ->orWhereNull('game_id')
                      ->orWhereNotIn('ligue_id', $ligue_ids)
                      ->orWhereNull('ligue_id')
                      ->orWhereNotIn('user_id', $users_ids)
                      ->orWhereNull('user_id')
                      ->orWhereNull('date_journees_id')
                      ->orWhereNull('championnat_id')
                      ->get();

        return view('/pages/admin/apuestasorphelines', compact('orphans'));
    }

    public function destroy($orphan)
    {
        $orphanmatch = Match::where('id', $orphan)->first();
        $orphanmatch->delete();

        return back()->with('message.level', 'success')->with('message.content', __('Match supprimé'));
    }
}
