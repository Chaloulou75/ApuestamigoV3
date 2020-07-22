<?php

namespace App\Http\Controllers;

use App\DateJournee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountPointsController extends Controller
{
   public function update($journee)
    {
      $journee = DateJournee::where('id', $journee)->first();

      // on récupère tous les joueurs  ds ligues et championnats concernés
      $users = User::with(['ligues' => function ($query) use($journee) {
                          $query->where('championnat_id', $journee->championnat_id);
                          }, 'matchs' => function ($query) use($journee) {
                          $query->where('championnat_id', $journee->championnat_id)
                                ->where('date_journees_id', $journee->id);
                          }])->get(); 

      foreach ($users as $user) 
      {
        foreach ($user->ligues as $key => $ligue) 
        {
          // points par journee
          $pointMatch = $user->matchs()
                              ->where('championnat_id', $journee->championnat_id)
                              ->where('date_journees_id', $journee->id)
                              ->where('ligue_id', $ligue->id)
                              ->get();

          $totJournee = $pointMatch->sum('pointMatch');

          echo "Pour la journée n° ". $journee->namejournee.'- '. $journee->season .', '. $user->name .' a eu '. $totJournee .' points dans la ligue '. $ligue->name . "<br>";

          // points totaux du joueur
          $pointTot = $user->matchs()->where('ligue_id', $ligue->id)->get();
          $totalPoints = $pointTot->sum('pointMatch');

          echo $user->name .' a au total '. $totalPoints .' points dans la ligue '. $ligue->name . "<br>";
          // update pivot table.
          DB::table('ligue_user')->where('user_id', $user->id)
                                  ->where('ligue_id', $ligue->id)
                                  ->update(['totalPoints' => $totalPoints]);
        }
      }
    }
}
