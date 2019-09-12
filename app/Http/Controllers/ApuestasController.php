<?php

namespace App\Http\Controllers;

use App\Equipe;
use App\Ligue;
use App\Match;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
                    
        $wherePossible = ['ligue_id'=> $ligue->id, 'user_id'=> $user->id, 'journee'=> '1'];
        $otherWherePossible = ['journee'=> '1', 'ligue_id'=> 0];
        $matchs = Match::where($wherePossible)->orWhere('journee', 1)->get();                

        if (Auth::user()) 
        {
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
        $matchs = Match::where($wherePossible)->get();

        $tot= count($request->resultatEq1);

        // foreach ($matchs as $match)           
        // {
            
        //     if (isset($request->resultatEq1[$match->id]))
        //     {
        //         $journee = $match->journee;
        //         $home = $match->homeTeam->id;
        //         $away = $match->awayTeam->id;

        //         DB::table('matches')->updateOrInsert(
        //             ['journee' => $journee,
        //              'equipe1_id' => $home, 
        //              'equipe2_id' => $away],
        //              ['user_id' => $user->id, 
        //              'ligue_id' => $ligue->id,                     
        //              'resultatEq1' => $request->resultatEq1[$match->id], 
        //              'resultatEq2' => $request->resultatEq2[$match->id]]
        //         );
        //     }                                      
        // }    
        
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
