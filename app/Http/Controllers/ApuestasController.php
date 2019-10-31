<?php

namespace App\Http\Controllers;

use App\Equipe;
use App\Game;
use App\Ligue;
use App\Match;
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
        // le user
        $user = Auth::user();

        if (Auth::user()) 
        {
            //$wherePossible = ['ligue_id'=> $ligue->id, 'user_id'=> $user->id, 'journee'=> '3'];

            $games = Game::with(['homeTeam', 'awayTeam', 'matchs' => function ($query) use($user, $ligue) {
                            $query->where('journee', 'like', '%3%')
                                  ->where('user_id', 'like', '%'. $user->id .'%')
                                  ->where('ligue_id', 'like', '%'. $ligue->id .'%');
                        }])
                        ->where('id', '>=', 17)
                        ->take(16)
                        ->get(); // les matchs  

            return view('/ligues/apuestas/index', $ligue, compact('ligue', 'user', 'games'));
            
        }
        return redirect()->guest('login');
           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $DateJournee2 = Carbon::create(2019, 10, 1, 18, 55, 00, 'Europe/Paris');
        $DateJournee3 = Carbon::create(2019, 10, 22, 18, 55, 00, 'Europe/Paris');
        $DateJournee4 = Carbon::create(2019, 11, 5, 18, 55, 00, 'Europe/Paris');

        $request->flash();

        if( $now->lessThanOrEqualTo($DateJournee3))
        {
            $games = Game::where('id', '>=', 17)->take(16)->get();

            $tot= count($request->resultatEq1); 

            $wherePossible = ['ligue_id'=> $ligue->id, 'user_id'=> $user->id, 'journee'=> '3'];
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
                            ['journee' => '3',
                             'game_id' => $game,                         
                             'user_id' => $user->id, 
                             'ligue_id' => $ligue->id,                     
                             'resultatEq1' => $result1, 
                             'resultatEq2' => $result2]
                            );
                        } 

                    }
                   
                }
                return back()->withInput()->with('message.level', 'success')->with('message.content', 'Yeah! Tes pronos sont enregistrés! ');

            }

            for ($i=0; $i < $tot; $i++) { 
            
                if (isset($request->resultatEq1[$i])){

                    foreach ($games as $i => $game) {
        
                        $result1 = $request->resultatEq1[$i];
                        $result2 = $request->resultatEq2[$i];
                        $game = $game->id;                                              

                        Match::updateOrCreate(
                        ['journee' => '3',
                         'game_id' => $game,                         
                         'user_id' => $user->id, 
                         'ligue_id' => $ligue->id],                     
                         ['resultatEq1' => $result1, 
                         'resultatEq2' => $result2]
                        );
                    }    
                }
            }
            return back()->withInput()->with('message.level', 'success')->with('message.content', 'Tes pronos sont enregistrés! ');                      
                        
        }
        return redirect()->back()->with('message.level', 'success')->with('message.content', 'Trop tard pour cette jounée! ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apuestas  $apuestas
     * @return \Illuminate\Http\Response
     */
    public function show(Apuestas $apuestas)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apuestas  $apuestas
     * @return \Illuminate\Http\Response
     */
    public function edit(Apuestas $apuestas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apuestas  $apuestas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apuestas $apuestas)
    {

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apuestas  $apuestas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apuestas $apuestas)
    {
        //
    }
}
