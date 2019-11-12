<?php

namespace App\Http\Controllers;

use App\ {Equipe, Game, Ligue, Match};
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ApuestasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ligue $ligue)
    {        
        $user = Auth::user(); // le user
        $journee = $this->dateJournee(); //la journee
        $gamesIds = $this->gamesIds(); //les matchs concernés

        if (Auth::user()) 
        {
            $games = Game::with(['homeTeam', 'awayTeam', 'matchs' => function ($query) use($journee, $user, $ligue) {
                            $query->where('journee', 'like', '%'. $journee .'%')
                                  ->where('user_id', 'like', '%'. $user->id .'%')
                                  ->where('ligue_id', 'like', '%'. $ligue->id .'%');
                        }])
                        ->whereIn('id', $gamesIds)
                        ->get();// les matchs 
            
            return view('/ligues/apuestas/index', $ligue, compact('ligue', 'user', 'games', 'journee'));
        }
        return redirect()->guest('login');
           
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Ligue $ligue)
    {
        $user = Auth::user(); 
        $now = Carbon::now();
        $timeJournee = $this->timeJournee();
        $journee = $this->dateJournee();
        
        if( $now->lessThanOrEqualTo($timeJournee))
        {     
            $games = $this->gamesIds();

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
                return back()->withInput()->with('message.level', 'success')->with('message.content', 'Yeah! Tes pronos sont enregistrés! Bonne chance!');

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
            return back()->withInput()->with('message.level', 'success')->with('message.content', 'Tes pronos sont enregistrés! Good luck!');                      
                        
        }
        return redirect()->back()->with('message.level', 'success')->with('message.content', 'Trop tard pour cette jounée! ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apuestas  $apuestas
     * @return \Illuminate\Http\Response
     */
    public function show(Ligue $ligue, $fecha)
    {
        $user = Auth::user(); // user
        $journee = $fecha; //la journee

        if (Auth::user()) 
        {
            $games = Game::with(['homeTeam', 'awayTeam', 'matchs' => function ($query) use($journee, $user, $ligue) {
                            $query->where('journee', 'like', '%'. $journee .'%')
                                  ->where('user_id', 'like', '%'. $user->id .'%')
                                  ->where('ligue_id', 'like', '%'. $ligue->id .'%');
                        }])
                        ->where('journee', $journee)
                        ->get();
                        // les matchs  
            return view('/ligues/apuestas/show', $ligue, compact('ligue', 'user', 'games', 'journee'));
        }
        return redirect()->guest('login');
    }

    protected function dateJournee()
    {
        $now = Carbon::now();
        $dateJournee2 = Carbon::create(2019, 10, 1, 18, 55, 00, 'Europe/Paris');
        $dateJournee3 = Carbon::create(2019, 10, 22, 18, 55, 00, 'Europe/Paris');
        $dateJournee4 = Carbon::create(2019, 11, 5, 18, 55, 00, 'Europe/Paris');
        $dateJournee5 = Carbon::create(2019, 11, 26, 18, 55, 00, 'Europe/Paris');
        $dateJournee6 = Carbon::create(2019, 12, 10, 18, 55, 00, 'Europe/Paris');

        if($now->lessThanOrEqualTo($dateJournee2))        
        {
            $journee = 2;
            return $journee;
        }
        if($now->between($dateJournee2, $dateJournee3))        
        {
            $journee = 3;
            return $journee;
        }
        if($now->between($dateJournee3, $dateJournee5))        
        {
            $journee = 5;
            return $journee;
        }
        if($now->between($dateJournee5, $dateJournee6))        
        {
            $journee = 6;
            return $journee;
        }
        else{
            $journee = 6;
            return $journee;
        }
    }

    protected function gamesIds()
    {
        $now = Carbon::now();
        $dateJournee2 = Carbon::create(2019, 10, 1, 18, 55, 00, 'Europe/Paris');
        $dateJournee3 = Carbon::create(2019, 10, 22, 18, 55, 00, 'Europe/Paris');
        $dateJournee4 = Carbon::create(2019, 11, 5, 18, 55, 00, 'Europe/Paris');
        $dateJournee5 = Carbon::create(2019, 11, 26, 18, 55, 00, 'Europe/Paris');
        $dateJournee6 = Carbon::create(2019, 12, 10, 18, 55, 00, 'Europe/Paris');

        if($now->between($dateJournee2, $dateJournee3))        
        {
            $gamesIds = Game::where('journee', '=', 3)
                        ->get('id');
            return $gamesIds;
        }
        if($now->between($dateJournee3, $dateJournee5))        
        {
            $gamesIds = Game::where('journee', '=', 5)
                        ->get('id');
            return $gamesIds;
        }
        if($now->between($dateJournee5, $dateJournee6))        
        {
            $gamesIds = Game::where('journee', '=', 6)
                        ->get('id');
            return $gamesIds;
        }
    }

    protected function timeJournee()
    {
        $now = Carbon::now();
        $dateJournee2 = Carbon::create(2019, 10, 1, 18, 55, 00, 'Europe/Paris');
        $dateJournee3 = Carbon::create(2019, 10, 22, 18, 55, 00, 'Europe/Paris');
        $dateJournee4 = Carbon::create(2019, 11, 5, 18, 55, 00, 'Europe/Paris');
        $dateJournee5 = Carbon::create(2019, 11, 26, 18, 55, 00, 'Europe/Paris');
        $dateJournee6 = Carbon::create(2019, 12, 10, 18, 55, 00, 'Europe/Paris');

        if($now->between($dateJournee2, $dateJournee3))        
        {
            $timejournee = $dateJournee3;
            return $timejournee;
        }
        if($now->between($dateJournee3, $dateJournee5))        
        {
            $timejournee = $dateJournee5;
            return $timejournee;
        }
        if($now->between($dateJournee5, $dateJournee6))        
        {
            $timejournee = $dateJournee6;
            return $timejournee;
        }
    }
}
