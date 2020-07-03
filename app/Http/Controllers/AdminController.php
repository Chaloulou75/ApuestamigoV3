<?php

namespace App\Http\Controllers;

use App\ {User, Equipe, Game, Ligue, Match};
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
        $datejournees = DateJournee::orderBy('timejournee')->get();
        
        return view('ligues.admin.adminPage', compact('datejournees')); 
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
            $now = Carbon::now();
            $journee = DateJournee::where('id', $journee)->first();

            $games = Game::where('date_journees_id', '=', $journee->id)->orderBy('id')->get();

            $tot= count($request->resultatEq1); 

            $wherePossible = ['ligue_id'=> $ligue->id, 'user_id'=> $user->id, 'date_journees_id'=> $journee->id];
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
                                                                        
                          $game = $game->id;
                          Match::create(
                          ['date_journees_id' => $journee->id,
                           'game_id' => $game,                         
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
                      $game = $game->id;                                              

                      Match::updateOrCreate(
                      ['date_journees_id' => $journee->id,
                       'game_id' => $game,                         
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
        $this->getUsersApuestas($journee);        
    }
    public function countPoints($journee)
    {
        // comptage des points.
        $countPoints = $this->countPointsByDay($journee);

        return $countPoints;         
    }

    public function getUsersApuestas($journee)
    {    
        $resultsUser = $this->compareApuestas($journee);        
        return $resultsUser;
    }

    public function countPointsByDay($journee)
    {
        $journee = DateJournee::where('id', $journee)->first();

        $users = User::with(['ligues', 'matchs' => function ($query) use($journee) {
                     $query->where('date_journees_id', 'like', '%'. $journee->id .'%');
             }])->get(); // on récupère tous les joueurs

        foreach ($users as $user) 
        {
            foreach ($user->ligues as $key => $ligue) 
            {
                // points par journee
                $pointMatch = $user->matchs()->where('date_journees_id', $journee->id)->where('ligue_id', $ligue->id)->get();
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

    public function compareApuestas($journee)
    {
        
        $journee = DateJournee::where('id', $journee)->first();
        
        // les resultats de l'admin qui est l'user en cours
        $resultsAdmin = Auth::user()->matchs()->where('date_journees_id', $journee->id)->whereNotNull(['resultatEq1', 'resultatEq2'])->get();

        foreach ($resultsAdmin as $key => $resultAdmin) 
        {
          $gameId = $resultAdmin->game_id;
          $scoreOff1 = $resultAdmin->resultatEq1;
          $scoreOff2 = $resultAdmin->resultatEq2;

          $users = User::with(['ligues', 'matchs' => function ($query) use($journee, $gameId){
                     $query->where('date_journees_id', 'like', '%'. $journee->id .'%')
                           ->where('game_id', 'like', '%'. $gameId .'%');
                  }])->get();

          foreach ($users as $user) 
          {
            foreach ($user->ligues as $k => $ligue) 
            {
              // on récupere les matchs ds chaque ligue/journee pour chaque user
              $apuestas = $user->matchs()->where('date_journees_id', $journee->id)
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
                        ->where('user_id','=', $user->id)
                        ->where('ligue_id','=', $ligue->id)
                        ->where('game_id','=', $apuestaGameId)
                        ->update(['pointMatch' => 3]);
                } 

                elseif($scoreOff1 > $scoreOff2 && $scoreapuesta1 > $scoreapuesta2 && $scoreapuesta1 !== $scoreOff1) 
                {
                  echo "le score pour le match n° ".$gameId ." est : " . $scoreOff1 .'-'. $scoreOff2 .' et '. $user->name .' dans la ligue '. $ligue->id .'  a mis '. $scoreapuesta1 .'-'. $scoreapuesta2 .  " pour le match n° ".$apuestaGameId ." ça fait 1 point!"."<br>";
                  Match::where('date_journees_id','=', $journee->id)
                        ->where('user_id','=', $user->id)
                        ->where('ligue_id','=', $ligue->id)
                        ->where('game_id','=', $apuestaGameId)
                        ->update(['pointMatch' => 1]);
                }

                elseif($scoreOff1 < $scoreOff2 && $scoreapuesta1 < $scoreapuesta2 && $scoreapuesta1 !== $scoreOff1) 
                {
                  echo "le score pour le match n° ".$gameId ." est : " . $scoreOff1 .'-'. $scoreOff2 .' et '. $user->name .' dans la ligue '. $ligue->id .'  a mis '. $scoreapuesta1 .'-'. $scoreapuesta2 .  " pour le match n° ".$apuestaGameId ." ça fait 1 point!"."<br>";
                  Match::where('date_journees_id','=', $journee->id)
                        ->where('user_id','=', $user->id)
                        ->where('ligue_id','=', $ligue->id)
                        ->where('game_id','=', $apuestaGameId)
                        ->update(['pointMatch' => 1]);
                }

                elseif($scoreOff1 === $scoreOff2 && $scoreapuesta1 === $scoreapuesta2 && $scoreapuesta1 !== $scoreOff1) 
                {
                  echo "le score pour le match n° ".$gameId ." est : " . $scoreOff1 .'-'. $scoreOff2 .' et '. $user->name .' dans la ligue '. $ligue->id .'  a mis '. $scoreapuesta1 .'-'. $scoreapuesta2 .  " pour le match n° ".$apuestaGameId ." ça fait 1 point!"."<br>";
                  Match::where('date_journees_id','=', $journee->id)
                        ->where('user_id','=', $user->id)
                        ->where('ligue_id','=', $ligue->id)
                        ->where('game_id','=', $apuestaGameId)
                        ->update(['pointMatch' => 1]);
                }

                else 
                {
                  echo "le score pour le match n° ".$gameId ." est : " . $scoreOff1 .'-'. $scoreOff2 .' et '. $user->name .' dans la ligue '. $ligue->id .'  a mis '. $scoreapuesta1 .'-'. $scoreapuesta2 .  " pour le match n° ".$apuestaGameId ." Désolé mais 0 point!"."<br>";

                  Match::where('date_journees_id','=', $journee->id)
                        ->where('user_id','=', $user->id)
                        ->where('ligue_id','=', $ligue->id)
                        ->where('game_id','=', $apuestaGameId) 
                        ->update(['pointMatch' => 0]);
                }
              }
            }
          }
        }
    }

    public function apuestasorphelines()
    {

      //je veux tous les matches dont le game_id n'as pas de correspondance avec un game id
      $game_ids = Game::select('id')->pluck('id')->all();
      $orphans = Match::whereNotIn('game_id', $game_ids)->orWhereNull('game_id')->get();

      return view('/pages/apuestasorphelines', compact('orphans'));

    }

    public function orphansdestroy($orphan)
    {
      $orphanmatch = Match::where('id', $orphan)->first();
      //dd($orphanmatch);
      $orphanmatch->delete();

      return back()->with('message.level', 'success')->with('message.content', __('match supprimé'));

    }

} 
