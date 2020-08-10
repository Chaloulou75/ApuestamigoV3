<?php

namespace App\Http\Controllers;

use App\DateJournee;
use App\Match;
use App\User;
use Illuminate\Http\Request;

class CompareApuestasController extends Controller
{
    public function update($journee)
    {
        $journee = DateJournee::with(['championnat', 'games'])->where('id', $journee)->first();
        // les resultats de l'admin
        $resultsAdmin = User::with(['matchs' => function ($query) use ($journee) {
            $query->where('championnat_id', $journee->championnat_id)
                                        ->where('date_journees_id', $journee->id)
                                        ->whereNotNull(['resultatEq1', 'resultatEq2'])
                                        ->orderBy('game_id');
        }])->where('admin', 1)
                                 ->first();
        //les users
        $users = User::with(['ligues'=> function ($query) use ($journee) {
            $query->with(['matchs' => function ($query) use ($journee) {
                $query->where('championnat_id', $journee->championnat_id)
                                                 ->where('date_journees_id', $journee->id);
            }])->where('championnat_id', $journee->championnat_id);
        }])->get();

        foreach ($resultsAdmin->matchs as $key => $resultAdmin) {
            $gameId = $resultAdmin->game_id;
            $scoreOff1 = $resultAdmin->resultatEq1;
            $scoreOff2 = $resultAdmin->resultatEq2;

            foreach ($users as $user) {
                foreach ($user->ligues as $k => $ligue) {
                    // on récupere les matchs ds chaque ligue/journee pour chaque user //
                    $apuestas = $user->matchs()->where('championnat_id', $journee->championnat_id)
                                       ->where('date_journees_id', $journee->id)
                                       ->where('ligue_id', $ligue->id)
                                       ->where('game_id', $gameId)
                                       ->whereNotNull(['resultatEq1', 'resultatEq2'])
                                       ->get();

                    foreach ($apuestas as $key => $apuesta) {
                        $apuestaGameId = $apuesta->game_id;
                        $scoreapuesta1 = $apuesta->resultatEq1;
                        $scoreapuesta2 = $apuesta->resultatEq2;

                        if ($apuestaGameId !== $gameId) {
                            echo "il y a surement un bug pour ". $user->name .' - ' . $gameId . " - " . $apuestaGameId . "<br>";
                        } elseif ($scoreOff1 === $scoreapuesta1 && $scoreOff2 === $scoreapuesta2) {
                            echo "le score pour le match n° ".$gameId ." est : " . $scoreOff1 .'-'. $scoreOff2 .' et '. $user->name .' dans la ligue '. $ligue->id .'  a mis '. $scoreapuesta1 .'-'. $scoreapuesta2 .  " pour le match n° ".$apuestaGameId ." ça fait 3 point!"."<br>";
                            Match::where('date_journees_id', '=', $journee->id)
                      ->where('championnat_id', $journee->championnat_id)
                      ->where('user_id', $user->id)
                      ->where('ligue_id', $ligue->id)
                      ->where('game_id', $apuestaGameId)
                      ->update(['pointMatch' => 3]);
                        } elseif ($scoreOff1 > $scoreOff2 && $scoreapuesta1 > $scoreapuesta2 && $scoreapuesta1 !== $scoreOff1) {
                            echo "le score pour le match n° ".$gameId ." est : " . $scoreOff1 .'-'. $scoreOff2 .' et '. $user->name .' dans la ligue '. $ligue->id .'  a mis '. $scoreapuesta1 .'-'. $scoreapuesta2 .  " pour le match n° ".$apuestaGameId ." ça fait 1 point!"."<br>";
                            Match::where('date_journees_id', '=', $journee->id)
                      ->where('championnat_id', $journee->championnat_id)
                      ->where('user_id', $user->id)
                      ->where('ligue_id', $ligue->id)
                      ->where('game_id', $apuestaGameId)
                      ->update(['pointMatch' => 1]);
                        } elseif ($scoreOff1 < $scoreOff2 && $scoreapuesta1 < $scoreapuesta2 && $scoreapuesta1 !== $scoreOff1) {
                            echo "le score pour le match n° ".$gameId ." est : " . $scoreOff1 .'-'. $scoreOff2 .' et '. $user->name .' dans la ligue '. $ligue->id .'  a mis '. $scoreapuesta1 .'-'. $scoreapuesta2 .  " pour le match n° ".$apuestaGameId ." ça fait 1 point!"."<br>";
                            Match::where('date_journees_id', $journee->id)
                      ->where('championnat_id', $journee->championnat_id)
                      ->where('user_id', $user->id)
                      ->where('ligue_id', $ligue->id)
                      ->where('game_id', $apuestaGameId)
                      ->update(['pointMatch' => 1]);
                        } elseif ($scoreOff1 === $scoreOff2 && $scoreapuesta1 === $scoreapuesta2 && $scoreapuesta1 !== $scoreOff1) {
                            echo "le score pour le match n° ".$gameId ." est : " . $scoreOff1 .'-'. $scoreOff2 .' et '. $user->name .' dans la ligue '. $ligue->id .'  a mis '. $scoreapuesta1 .'-'. $scoreapuesta2 .  " pour le match n° ".$apuestaGameId ." ça fait 1 point!"."<br>";
                            Match::where('date_journees_id', $journee->id)
                      ->where('championnat_id', $journee->championnat_id)
                      ->where('user_id', $user->id)
                      ->where('ligue_id', $ligue->id)
                      ->where('game_id', $apuestaGameId)
                      ->update(['pointMatch' => 1]);
                        } else {
                            echo "le score pour le match n° ".$gameId ." est : " . $scoreOff1 .'-'. $scoreOff2 .' et '. $user->name .' dans la ligue '. $ligue->id .'  a mis '. $scoreapuesta1 .'-'. $scoreapuesta2 .  " pour le match n° ".$apuestaGameId ." Désolé mais 0 point!"."<br>";

                            Match::where('date_journees_id', $journee->id)
                      ->where('championnat_id', $journee->championnat_id)
                      ->where('user_id', $user->id)
                      ->where('ligue_id', $ligue->id)
                      ->where('game_id', $apuestaGameId)
                      ->update(['pointMatch' => 0]);
                        }
                    }
                }
            }
        }
    }
}
