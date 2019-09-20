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
            //la ligue du user en cours
            $ligue = Ligue::findOrFail($ligue->id); 

            $games = Game::all(); // les matchs

            $wherePossible = ['ligue_id'=> $ligue->id, 'user_id'=> $user->id, 'journee'=> '2'];
            $matchs = Match::where($wherePossible)->get();  

            // foreach ($matchs as $key => $match) {
            //    return $match->resultatEq1;
            // }

            return view('/ligues/apuestas', $ligue, compact('ligue', 'user', 'games', 'matchs'));
            
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
    public function store(Request $request,  Ligue $ligue)
    {
        $user = Auth::user();

        $ligue = Ligue::findOrFail($ligue->id);

        $games = Game::take(16)->get();
        
        $now = Carbon::now();
        $DateJournee2 = Carbon::create(2019, 10, 1, 18, 55, 00, 'Europe/Paris');

        $request->flash();

        if( $now->lessThanOrEqualTo($DateJournee2))
        {
            $tot= count($request->resultatEq1); 

            $wherePossible = ['ligue_id'=> $ligue->id, 'user_id'=> $user->id, 'journee'=> '2'];
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
                        ['journee' => '2',
                         'game_id' => $game,                         
                         'user_id' => $user->id, 
                         'ligue_id' => $ligue->id,                     
                         'resultatEq1' => $result1, 
                         'resultatEq2' => $result2]
                        );
                    }
                }

                return back()->withInput()->with('message.level', 'success')->with('message.content', 'Yeah! Tes pronos sont enregistrés! ');    
                }

            }                       
                                  
        	for ($i=0; $i < $tot; $i++) { 
        	
    	    	if (isset($request->resultatEq1[$i])){

    	    		foreach ($games as $i => $game) {
    	
    	        		$result1 = $request->resultatEq1[$i];
    	        		$result2 = $request->resultatEq2[$i];
    		            $game = $game->id;    		                	        		

    	        		Match::updateOrCreate(
    	                ['journee' => '2',
    	                 'game_id' => $game,     	                 
    	                 'user_id' => $user->id, 
    	                 'ligue_id' => $ligue->id],                     
    	                 ['resultatEq1' => $result1, 
    	                 'resultatEq2' => $result2]
    	        		);
            		}
            	}

            return back()->withInput()->with('message.level', 'success')->with('message.content', 'Tes pronos sont enregistrés! ');    
        	}
                        
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
        //
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
        //
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
