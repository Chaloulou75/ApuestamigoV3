<?php

namespace App\Http\Controllers;

use App\ {User, Equipe, Game, Ligue, Match, Championnat};
use App\DateJournee;
use App\Repositories\DateRepository;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin'); // if user is admin
    }

    public function index()
    {
        $championnats = Championnat::with('journees')->orderByDesc('id')->get();
        
        return view('pages.admin.adminPage', compact('championnats')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Ligue $ligue, $journee)
    {
        if(Auth::user()->admin == 1)
        {    
            $user = Auth::user();

            $journee = DateJournee::where('id', $journee)->first();

            $games = Game::where('championnat_id', $journee->championnat_id)->where('date_journees_id', $journee->id)->orderBy('id')->get();

            $tot= count($request->resultatEq1); 

            $wherePossible = ['championnat_id' => $journee->championnat_id, 'ligue_id'=> $ligue->id, 'user_id'=> $user->id, 'date_journees_id'=> $journee->id];
            $matchs = Match::where($wherePossible)->get();

            if( $matchs->count() === 0)
            {
                for ($i=0; $i < $tot; $i++) { 
            
                    if (isset($request->resultatEq1[$i]))
                    {
                        foreach ($games as $i => $game) 
                        {                          
                          $dateMatch =  $game->gamedate;
            
                          $result1 = $request->resultatEq1[$i];
                          $result2 = $request->resultatEq2[$i];
                                                                        
                          $gameid = $game->id;
                          Match::create(
                          ['championnat_id' => $journee->championnat_id,
                           'date_journees_id' => $journee->id,
                           'game_id' => $gameid,                         
                           'user_id' => $user->id, 
                           'ligue_id' => $ligue->id,                     
                           'resultatEq1' => $result1, 
                           'resultatEq2' => $result2]
                          );
                        } 
                    }                   
                }
                return back()->withInput()->with('message.level', 'success')->with('message.content', __('all.scores updated'));
            }

            for ($i=0; $i < $tot; $i++) { 
            
                if (isset($request->resultatEq1[$i])){

                    foreach ($games as $i => $game) 
                    {
                      $dateMatch =  $game->gamedate;
        
                      $result1 = $request->resultatEq1[$i];
                      $result2 = $request->resultatEq2[$i];
                      $gameid = $game->id;                                              

                      Match::updateOrCreate(
                      ['championnat_id' => $journee->championnat_id,
                       'date_journees_id' => $journee->id,
                       'game_id' => $gameid,
                       'user_id' => $user->id, 
                       'ligue_id' => $ligue->id],                     
                       ['resultatEq1' => $result1, 
                       'resultatEq2' => $result2]
                      );
                    }    
                }
            }
            return back()->withInput()->with('message.level', 'success')->with('message.content', __('all.scores updated'));                      
        }
        return back()->withInput()->with('message.level', 'success')->with('message.content', 'Désolé mais tu n\'es pas un admin ou tu n\'es pas connecté...');

    }

    public function compare($journee)
    {
        return $this->compareApuestas($journee);        
    }

    public function compareApuestas($journee)
    {        
      $journee = DateJournee::with(['championnat', 'games'])->where('id', $journee)->first();
      
      // les resultats de l'admin 
      $resultsAdmin = User::with(['matchs' => function ($query) use($journee){
                                  $query->where('championnat_id', $journee->championnat_id)
                                        ->where('date_journees_id', $journee->id)
                                        ->whereNotNull(['resultatEq1', 'resultatEq2'])
                                        ->orderBy('game_id');
                              }])->where('admin', 1)
                                 ->first();
      //les users
      $users = User::with(['ligues'=> function ($query) use($journee) {
                            $query->with(['matchs' => function ($query) use($journee){
                                           $query->where('championnat_id', $journee->championnat_id)
                                                 ->where('date_journees_id', $journee->id);
                                  }])->where('championnat_id', $journee->championnat_id);
                          }])->get();

      foreach ($resultsAdmin->matchs as $key => $resultAdmin) 
      {
        $gameId = $resultAdmin->game_id;
        $scoreOff1 = $resultAdmin->resultatEq1;
        $scoreOff2 = $resultAdmin->resultatEq2;

        foreach ($users as $user) 
        {
          foreach ($user->ligues as $k => $ligue) 
          {            
            // on récupere les matchs ds chaque ligue/journee pour chaque user //
            $apuestas = $user->matchs()->where('championnat_id', $journee->championnat_id)
                                       ->where('date_journees_id', $journee->id)
                                       ->where('ligue_id', $ligue->id)
                                       ->where('game_id', $gameId)
                                       ->whereNotNull(['resultatEq1', 'resultatEq2'])
                                       ->get();

            foreach ($apuestas as $key => $apuesta) 
            {              
              $apuestaGameId = $apuesta->game_id;
              $scoreapuesta1 = $apuesta->resultatEq1;
              $scoreapuesta2 = $apuesta->resultatEq2;

              if ($apuestaGameId !== $gameId) 
              {
                echo "il y a surement un bug pour ". $user->name .' - ' . $gameId . " - " . $apuestaGameId . "<br>";
              }                                   
                
              elseif($scoreOff1 === $scoreapuesta1 && $scoreOff2 === $scoreapuesta2)
              {
                echo "le score pour le match n° ".$gameId ." est : " . $scoreOff1 .'-'. $scoreOff2 .' et '. $user->name .' dans la ligue '. $ligue->id .'  a mis '. $scoreapuesta1 .'-'. $scoreapuesta2 .  " pour le match n° ".$apuestaGameId ." ça fait 3 point!"."<br>";
                Match::where('date_journees_id','=', $journee->id)
                      ->where('championnat_id', $journee->championnat_id)
                      ->where('user_id', $user->id)
                      ->where('ligue_id', $ligue->id)
                      ->where('game_id', $apuestaGameId)
                      ->update(['pointMatch' => 3]);
              } 

              elseif($scoreOff1 > $scoreOff2 && $scoreapuesta1 > $scoreapuesta2 && $scoreapuesta1 !== $scoreOff1) 
              {
                echo "le score pour le match n° ".$gameId ." est : " . $scoreOff1 .'-'. $scoreOff2 .' et '. $user->name .' dans la ligue '. $ligue->id .'  a mis '. $scoreapuesta1 .'-'. $scoreapuesta2 .  " pour le match n° ".$apuestaGameId ." ça fait 1 point!"."<br>";
                Match::where('date_journees_id','=', $journee->id)
                      ->where('championnat_id', $journee->championnat_id)
                      ->where('user_id', $user->id)
                      ->where('ligue_id', $ligue->id)
                      ->where('game_id', $apuestaGameId)
                      ->update(['pointMatch' => 1]);
              }

              elseif($scoreOff1 < $scoreOff2 && $scoreapuesta1 < $scoreapuesta2 && $scoreapuesta1 !== $scoreOff1) 
              {
                echo "le score pour le match n° ".$gameId ." est : " . $scoreOff1 .'-'. $scoreOff2 .' et '. $user->name .' dans la ligue '. $ligue->id .'  a mis '. $scoreapuesta1 .'-'. $scoreapuesta2 .  " pour le match n° ".$apuestaGameId ." ça fait 1 point!"."<br>";
                Match::where('date_journees_id', $journee->id)
                      ->where('championnat_id', $journee->championnat_id)
                      ->where('user_id', $user->id)
                      ->where('ligue_id', $ligue->id)
                      ->where('game_id', $apuestaGameId)
                      ->update(['pointMatch' => 1]);
              }

              elseif($scoreOff1 === $scoreOff2 && $scoreapuesta1 === $scoreapuesta2 && $scoreapuesta1 !== $scoreOff1) 
              {
                echo "le score pour le match n° ".$gameId ." est : " . $scoreOff1 .'-'. $scoreOff2 .' et '. $user->name .' dans la ligue '. $ligue->id .'  a mis '. $scoreapuesta1 .'-'. $scoreapuesta2 .  " pour le match n° ".$apuestaGameId ." ça fait 1 point!"."<br>";
                Match::where('date_journees_id', $journee->id)
                      ->where('championnat_id', $journee->championnat_id)
                      ->where('user_id', $user->id)
                      ->where('ligue_id', $ligue->id)
                      ->where('game_id', $apuestaGameId)
                      ->update(['pointMatch' => 1]);
              }

              else 
              {
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

    public function countPoints($journee)
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

    public function apuestasorphelines()
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

    public function orphansdestroy($orphan)
    {
      $orphanmatch = Match::where('id', $orphan)->first();
      $orphanmatch->delete();

      return back()->with('message.level', 'success')->with('message.content', __('Match supprimé'));

    }

    public function seasonfinished(Championnat $championnat)
    {
      if($championnat->finished == '0')
      {
        $championnat = Championnat::find($championnat->id);
        $championnat->finished = '1';
        $championnat->save();

        //uptade all leagues where $championnat_id = $championnat to finished = true
        $liguesterminees = Ligue::where('championnat_id', $championnat->id)
                                  ->update(['finished' => '1']);
        
        return back()->with('message.level', 'success')->with('message.content', __('Saison ' . $championnat->name . ' et Ligues terminées'));
      }

      return back()->with('message.level', 'success')->with('message.content', __('Saison ' . $championnat->name . ' déjà terminée'));
    } 

} 
