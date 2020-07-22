<?php

namespace App\Http\Controllers;

use App\ {DateJournee, Game, Ligue, Match, Championnat};
use Auth;
use Illuminate\Http\Request;

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
} 
