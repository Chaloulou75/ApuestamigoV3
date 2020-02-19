<?php

namespace App\Http\Controllers;

use App\ {User, Equipe, Game, Ligue, Match};
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
        return view('ligues.admin.adminPage'); 
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

            $games = Game::where('journee', '=', $journee)->get('id');
            
            $tot= count($request->resultatEq1); 

            $wherePossible = ['ligue_id'=> $ligue->id, 'user_id'=> $user->id, 'journee'=> $journee];
            $matchs = Match::where($wherePossible)->get();

            if( $matchs->count() === 0)
            {
                for ($i=0; $i < $tot; $i++) { 
            
                    if (isset($request->resultatEq1[$i])){

                        foreach ($games as $i => $game) {
            
                            $result1 = $request->resultatEq1[$i];
                            $result2 = $request->resultatEq2[$i];
                            $game = $game->id;                                              

                            Match::create(
                            ['journee' => $journee,
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

                    foreach ($games as $i => $game) {
        
                        $result1 = $request->resultatEq1[$i];
                        $result2 = $request->resultatEq2[$i];
                        $game = $game->id;                                              

                        Match::updateOrCreate(
                        ['journee' => $journee,
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

        //return redirect()->back()->with('message.level', 'success')->with('message.content', "Les points sont mis à jours pour la journée ".$journee ." ");          
    }
    public function countPoints($journee)
    {
        // comptage des points.
        $countPoints = $this->countPointsByDay($journee);

        return $countPoints;
        //return redirect()->back()->with('message.level', 'success')->with('message.content', "Les points totaux sont calculés pour la journée ".$journee ." ");          
    }

    public function getUsersApuestas($journee)
    {    
        $resultsUser = $this->compareApuestas($journee);        
        return $resultsUser;
    }

    public function compareApuestas($journee)
    {
        // les resultats de l'admin qui est l'user en cours
        $resultsAdmin = Auth::user()->matchs()->where('journee', $journee)->get(); 

        //tous les utilisateurs
        $users = User::with(['ligues', 'matchs' => function ($query) use($journee) {
                     $query->where('journee', 'like', '%'. $journee .'%');
             }])->get(); //->where('admin', '=', 0)

        foreach ($users as $user) 
        {

            foreach ($user->ligues as $key => $ligue) 
            {
            // on récupere les matchs ds cqe ligue/journee pour chaque user
            $apuestas = $user->matchs()->where('journee', $journee)->where('ligue_id', $ligue->id)->get();
                
                for($i = 0; $i < count($resultsAdmin); $i++)
                {
                    if(isset($apuestas[$i])){
                        
                        if(is_null($resultsAdmin[$i]['resultatEq1']) || is_null($resultsAdmin[$i]['resultatEq2']) ) 
                        {
                            echo "le score est : " . $resultsAdmin[$i]['resultatEq1'] .'-'. $resultsAdmin[$i]['resultatEq2'] .' et '. $user->name .' dans la ligue '. $apuestas[$i]['ligue_id'] .'  a mis '. $apuestas[$i]['resultatEq1'] .'-'. $apuestas[$i]['resultatEq2'] .  " pour le match n° ".$apuestas[$i]['game_id'] ." Helas, le résultat du match n'est pas encore connu, ça fait Null point pour l'instant!"."<br>";
                            Match::where('journee','=', $journee)
                                        ->where('user_id','=', $user->id)
                                        ->where('ligue_id','=', $apuestas[$i]['ligue_id'])
                                        ->where('game_id','=', $resultsAdmin[$i]['game_id'])
                                        ->update(['pointMatch' => NULL]);
                        }

                        elseif(is_null($apuestas[$i]['resultatEq1']) || is_null($apuestas[$i]['resultatEq2']) ) 
                        {
                            echo "le score est : " . $resultsAdmin[$i]['resultatEq1'] .'-'. $resultsAdmin[$i]['resultatEq2'] .' et '. $user->name .' dans la ligue '. $apuestas[$i]['ligue_id'] .'  a mis '. $apuestas[$i]['resultatEq1'] .'-'. $apuestas[$i]['resultatEq2'] .  " pour le match n° ".$apuestas[$i]['game_id'] ." Helas, tu as oublié de faire tes pronos, ça fait Null point!"."<br>";
                            Match::where('journee','=', $journee)
                                        ->where('user_id','=', $user->id)
                                        ->where('ligue_id','=', $apuestas[$i]['ligue_id'])
                                        ->where('game_id','=', $resultsAdmin[$i]['game_id'])
                                        ->update(['pointMatch' => NULL]);
                        }

                        elseif($resultsAdmin[$i]['resultatEq1'] === $apuestas[$i]['resultatEq1'] && $resultsAdmin[$i]['resultatEq2'] === $apuestas[$i]['resultatEq2'])
                        {
                            echo "le score est : " . $resultsAdmin[$i]['resultatEq1'] .'-'. $resultsAdmin[$i]['resultatEq2'] .' et '. $user->name .' dans la ligue '. $apuestas[$i]['ligue_id'] .' a mis '. $apuestas[$i]['resultatEq1'] .'-'. $apuestas[$i]['resultatEq2'] . " pour le match n° ".$apuestas[$i]['game_id'] ." ce qui fait 3 points" ."<br>";

                            Match::where('journee','=', $journee)
                                        ->where('user_id','=', $user->id)
                                        ->where('ligue_id','=', $apuestas[$i]['ligue_id'])
                                        ->where('game_id','=', $resultsAdmin[$i]['game_id'])
                                        ->update(['pointMatch' => 3]);
                        } 

                        elseif($resultsAdmin[$i]['resultatEq1'] > $resultsAdmin[$i]['resultatEq2'] && $apuestas[$i]['resultatEq1'] > $apuestas[$i]['resultatEq2'] && $apuestas[$i]['resultatEq1'] !== $resultsAdmin[$i]['resultatEq1']) 
                        {
                            echo "le score est : " . $resultsAdmin[$i]['resultatEq1'] .'-'. $resultsAdmin[$i]['resultatEq2'] .' et '. $user->name .' dans la ligue '. $apuestas[$i]['ligue_id'] .'  a mis '. $apuestas[$i]['resultatEq1'] .'-'. $apuestas[$i]['resultatEq2'] .  " pour le match n° ".$apuestas[$i]['game_id'] ." ça fait 1 point!"."<br>";
                            Match::where('journee','=', $journee)
                                        ->where('user_id','=', $user->id)
                                        ->where('ligue_id','=', $apuestas[$i]['ligue_id'])
                                        ->where('game_id','=', $resultsAdmin[$i]['game_id'])
                                        ->update(['pointMatch' => 1]);
                        }

                        elseif($resultsAdmin[$i]['resultatEq1'] < $resultsAdmin[$i]['resultatEq2'] && $apuestas[$i]['resultatEq1'] < $apuestas[$i]['resultatEq2'] && $apuestas[$i]['resultatEq1'] !== $resultsAdmin[$i]['resultatEq1']) 
                        {
                            echo "le score est : " . $resultsAdmin[$i]['resultatEq1'] .'-'. $resultsAdmin[$i]['resultatEq2'] .' et '. $user->name .' dans la ligue '. $apuestas[$i]['ligue_id'] .'  a mis '. $apuestas[$i]['resultatEq1'] .'-'. $apuestas[$i]['resultatEq2'] .  " pour le match n° ".$apuestas[$i]['game_id'] ." ça fait 1 point!"."<br>";
                            Match::where('journee','=', $journee)
                                        ->where('user_id','=', $user->id)
                                        ->where('ligue_id','=', $apuestas[$i]['ligue_id'])
                                        ->where('game_id','=', $resultsAdmin[$i]['game_id'])
                                        ->update(['pointMatch' => 1]);
                        }

                        elseif($resultsAdmin[$i]['resultatEq1'] === $resultsAdmin[$i]['resultatEq2'] && $apuestas[$i]['resultatEq1'] === $apuestas[$i]['resultatEq2'] && $apuestas[$i]['resultatEq1'] !== $resultsAdmin[$i]['resultatEq1']) 
                        {
                            echo "le score est : " . $resultsAdmin[$i]['resultatEq1'] .'-'. $resultsAdmin[$i]['resultatEq2'] .' et '. $user->name .' dans la ligue '. $apuestas[$i]['ligue_id'] .'  a mis '. $apuestas[$i]['resultatEq1'] .'-'. $apuestas[$i]['resultatEq2'] .  " pour le match n° ".$apuestas[$i]['game_id'] ." ça fait 1 point!"."<br>";
                            Match::where('journee','=', $journee)
                                        ->where('user_id','=', $user->id)
                                        ->where('ligue_id','=', $apuestas[$i]['ligue_id'])
                                        ->where('game_id','=', $resultsAdmin[$i]['game_id'])
                                        ->update(['pointMatch' => 1]);
                        }

                        else 
                        {
                            echo "le score est : " . $resultsAdmin[$i]['resultatEq1'] .'-'. $resultsAdmin[$i]['resultatEq2'] .' et '. $user->name .' dans la ligue '. $apuestas[$i]['ligue_id'] .'  a mis '. $apuestas[$i]['resultatEq1'] .'-'. $apuestas[$i]['resultatEq2'] .  " pour le match n° ".$apuestas[$i]['game_id'] ." Désolé mais 0 point!"."<br>";

                            Match::where('journee','=', $journee)
                                        ->where('user_id','=', $user->id)
                                        ->where('ligue_id','=', $apuestas[$i]['ligue_id'])
                                        ->where('game_id','=', $resultsAdmin[$i]['game_id']) 
                                        ->update(['pointMatch' => 0]);
                        }
                    }                    
                } 
            }     
        }        
    }

    public function countPointsByDay($journee)
    {
        $users = User::with(['ligues', 'matchs' => function ($query) use($journee) {
                     $query->where('journee', 'like', '%'. $journee .'%');
             }])->get(); // on récupère tous les joueurs

        foreach ($users as $user) 
        {

            foreach ($user->ligues as $key => $ligue) 
            {
                // points par journee
                $pointMatch = $user->matchs()->where('journee', $journee)->where('ligue_id', $ligue->id)->get();
                $totJournee = $pointMatch->sum('pointMatch');

                echo "Pour la journée n° ". $journee .', '. $user->name .' a eu '. $totJournee .' points dans la ligue '. $ligue->name . "<br>";
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
