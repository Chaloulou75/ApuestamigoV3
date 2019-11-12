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
        echo 'je veux comparer les matchs';

        $J3adminMatchs = User::with(['matchs' => function ($query) {
                        $query->where('journee', 'like', '%3%');
                    }])->where('admin', '=', 1)->get();

        foreach ($J3adminMatchs as $J3adminMatch) {

            return $J3adminMatch->matchs;
        }

        //return $admin->matchs()-;
    }
}
