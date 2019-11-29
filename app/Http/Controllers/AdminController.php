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
        $this->middleware('admin');

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
                return back()->withInput()->with('message.level', 'success')->with('message.content', 'Good! Les scores sont à jour.');
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
            return back()->withInput()->with('message.level', 'success')->with('message.content', 'Good! Les scores sont de nouveaux à jour.');                      
        }
        return back()->withInput()->with('message.level', 'success')->with('message.content', 'Désolé mais tu n\'es pas un admin ou tu n\'es pas connecté...');

    }

    public function compare()
    {
        //for J3:
        $this->getUsersApuestasJ3();
        // $this->getUsersApuestasJ4();
        // $this->getUsersApuestasJ5();
        // $this->getUsersApuestasJ6();

        return redirect()->back()->with('message.level', 'success')->with('message.content', 'Les points sont mis à jours pour la journée 3');          
     }

    public function getUsersApuestasJ3()
    {    
        $journee = 3;
        $resultsUser = $this->getUsersApuestas($journee);
        
        return $resultsUser;
            
    }

    public function getUsersApuestasJ4()
    {    
        $journee = 4;
        $resultsUser = $this->getUsersApuestas($journee);
        
        return $resultsUser;
            
    }

    public function getUsersApuestasJ5()
    {    
        $journee = 5;
        $resultsUser = $this->getUsersApuestas($journee);
        
        return $resultsUser;
            
    }

    public function getUsersApuestasJ6()
    {    
        $journee = 6;
        $resultsUser = $this->getUsersApuestas($journee);
        
        return $resultsUser;
            
    }

    public function getUsersApuestas($journee)
    {
        $resultsAdmin = Auth::user()->matchs()->where('journee', $journee)->get(); 

        $users = User::with(['ligues', 'matchs' => function ($query) use($journee) {
                     $query->where('journee', 'like', '%'. $journee .'%');
             }])->where('admin', '=', 0)->get(); //

        foreach ($users as $user) 
        {

            foreach ($user->ligues as $key => $ligue) 
            {

            $apuestas = $user->matchs()->where('journee', $journee)->where('ligue_id', $ligue->id)->get();

                for($i = 0; $i < count($resultsAdmin); $i++)
                {
                    if(isset($apuestas[$i])){

                        if($resultsAdmin[$i]['resultatEq1'] === $apuestas[$i]['resultatEq1'] && $resultsAdmin[$i]['resultatEq2'] === $apuestas[$i]['resultatEq2'])
                        {
                            echo "le score est : " . $resultsAdmin[$i]['resultatEq1'] .'-'. $resultsAdmin[$i]['resultatEq2'] .' et '. $user->name .' dans la ligue '. $apuestas[$i]['ligue_id'] .' a mis '. $apuestas[$i]['resultatEq1'] .'-'. $apuestas[$i]['resultatEq2'] . " pour le match n° ".$apuestas[$i]['game_id'] ." ce qui fait 3 points" ."<br>";

                            Match::where('journee', $journee)
                                          ->where('game_id', $apuestas[$i]['game_id'])
                                          ->where('user_id', $user->id)
                                          ->where('ligue_id', $apuestas[$i]['ligue_id'])
                                          ->update(['pointMatch' => 3]);
                        } 

                        elseif($resultsAdmin[$i]['resultatEq1'] > $resultsAdmin[$i]['resultatEq2'] && $apuestas[$i]['resultatEq1'] > $apuestas[$i]['resultatEq2']) 
                        {
                            echo "le score est : " . $resultsAdmin[$i]['resultatEq1'] .'-'. $resultsAdmin[$i]['resultatEq2'] .' et '. $user->name .' dans la ligue '. $apuestas[$i]['ligue_id'] .'  a mis '. $apuestas[$i]['resultatEq1'] .'-'. $apuestas[$i]['resultatEq2'] .  " pour le match n° ".$apuestas[$i]['game_id'] ." ça fait 1 point!"."<br>";
                            Match::where('journee', $journee)
                                          ->where('game_id', $apuestas[$i]['game_id'])
                                          ->where('user_id', $user->id)
                                          ->where('ligue_id', $apuestas[$i]['ligue_id'])
                                          ->update(['pointMatch' => 1]);
                        }

                        elseif($resultsAdmin[$i]['resultatEq1'] < $resultsAdmin[$i]['resultatEq2'] && $apuestas[$i]['resultatEq1'] < $apuestas[$i]['resultatEq2']) 
                        {
                            echo "le score est : " . $resultsAdmin[$i]['resultatEq1'] .'-'. $resultsAdmin[$i]['resultatEq2'] .' et '. $user->name .' dans la ligue '. $apuestas[$i]['ligue_id'] .'  a mis '. $apuestas[$i]['resultatEq1'] .'-'. $apuestas[$i]['resultatEq2'] .  " pour le match n° ".$apuestas[$i]['game_id'] ." ça fait 1 point!"."<br>";
                            Match::where('journee', $journee)
                                          ->where('game_id', $apuestas[$i]['game_id'])
                                          ->where('user_id', $user->id)
                                          ->where('ligue_id', $apuestas[$i]['ligue_id'])
                                          ->update(['pointMatch' => 1]);
                        }

                        elseif($resultsAdmin[$i]['resultatEq1'] === $resultsAdmin[$i]['resultatEq2'] && $apuestas[$i]['resultatEq1'] === $apuestas[$i]['resultatEq2']) 
                        {
                            echo "le score est : " . $resultsAdmin[$i]['resultatEq1'] .'-'. $resultsAdmin[$i]['resultatEq2'] .' et '. $user->name .' dans la ligue '. $apuestas[$i]['ligue_id'] .'  a mis '. $apuestas[$i]['resultatEq1'] .'-'. $apuestas[$i]['resultatEq2'] .  " pour le match n° ".$apuestas[$i]['game_id'] ." ça fait 1 point!"."<br>";
                            Match::where('journee', $journee)
                                          ->where('game_id', $apuestas[$i]['game_id'])
                                          ->where('user_id', $user->id)
                                          ->where('ligue_id', $apuestas[$i]['ligue_id'])
                                          ->update(['pointMatch' => 1]);
                        }
                        else 
                        {
                            echo "le score est : " . $resultsAdmin[$i]['resultatEq1'] .'-'. $resultsAdmin[$i]['resultatEq2'] .' et '. $user->name .' dans la ligue '. $apuestas[$i]['ligue_id'] .'  a mis '. $apuestas[$i]['resultatEq1'] .'-'. $apuestas[$i]['resultatEq2'] .  " pour le match n° ".$apuestas[$i]['game_id'] ." Désolé mais 0 point!"."<br>";

                            Match::where('journee', $journee)
                                          ->where('game_id', $apuestas[$i]['game_id'])
                                          ->where('user_id', $user->id)
                                          ->where('ligue_id', $apuestas[$i]['ligue_id'])
                                          ->update(['pointMatch' => 0]);
                        }
                    }                    
                } 
            }     
        }        
    }

    public function countPoints()
    {
        $journee = 3;

        $users = User::with(['ligues', 'matchs' => function ($query) use($journee) {
                     $query->where('journee', 'like', '%'. $journee .'%');
             }])->where('admin', '=', 0)->get(); //

        foreach ($users as $user) 
        {

            foreach ($user->ligues as $key => $ligue) 
            {

                $pointJournee = $user->matchs()->where('journee', $journee)->where('ligue_id', $ligue->id)->get();

                $tot = $pointJournee->sum('pointMatch');

                echo $tot."<br>";
            }
        }
    }

}                                      
