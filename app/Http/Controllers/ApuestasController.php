<?php

namespace App\Http\Controllers;

use App\Equipe;
use App\Ligue;
use App\Match;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        //la ligue du user en cours
        $ligue = Ligue::findOrFail($ligue->id);

        // en fonction des dates/ heures afficher journee 1/2/3...

        if (Auth::user()) 
        {
            $wherePossible = ['ligue_id' => $ligue->id, 'user_id' => $user->id, 'journee'=> '1'];
            $matchs = Match::where($wherePossible)->get();

            return view('/ligues/apuestas', $ligue, compact('ligue', 'user', 'matchs'));
        }
        return redirect()->guest('login');

        // exemple d'utilisation dans la view
        // foreach($matchs as $match){
        //     $home = $match->homeTeam; 
        //     $away = $match->awayTeam->logo;    
        // }    
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

        $wherePossible = ['ligue_id'=> $ligue->id, 'user_id'=> $user->id, 'journee'=> '1'];

        $matchs = Match::all();
        $tot= count($request->resultatEq1);

        
    	for ($i=0; $i < $tot; $i++) { 
    	
	    	if (isset($request->resultatEq1[$i])){

	    		foreach ($matchs as $i => $match) {
	
	        		$result1 = $request->resultatEq1[$i];
	        		$result2 = $request->resultatEq2[$i];

		        	$journee = $match->journee;
		            $home = $match->homeTeam->id;
		            $away = $match->awayTeam->id;
	        		
	        		DB::table('matches')->updateOrInsert(
	                ['journee' => $journee,
	                 'equipe1_id' => $home, 
	                 'equipe2_id' => $away,
	                 'user_id' => $user->id, 
	                 'ligue_id' => $ligue->id],                     
	                 ['resultatEq1' => $result1, 
	                 'resultatEq2' => $result2]
	        		);
        		}
        	}
    	}

        return redirect()->back()->withInput()->with('message.level', 'success')->with('message.content', 'Go Go Go! ');
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
