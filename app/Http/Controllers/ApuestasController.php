<?php

namespace App\Http\Controllers;

use App\ {User, Equipe, Game, Ligue, Match};
use Auth;
use App\Repositories\DateRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ApuestasController extends Controller
{
    private $DateRepository;

    public function __construct(DateRepository $DateRepository)
    {
        $this->DateRepository = $DateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ligue $ligue)
    {        
        $user = Auth::user(); // le user
        $journee = $this->DateRepository->dateJournee(); //la journee
        $gamesIds = Game::where('journee', $journee)->get('id'); //les matchs concernés
        
        if (Auth::user()) 
        {
            $games = Game::with(['homeTeam', 'awayTeam', 'matchs' => function ($query) use($journee, $user, $ligue) {
                            $query->where('journee', 'like', '%'. $journee .'%')
                                  ->where('user_id', 'like', '%'. $user->id .'%')
                                  ->where('ligue_id', 'like', '%'. $ligue->id .'%');
                        }])
                        ->whereIn('id', $gamesIds)
                        ->orderBy('id')
                        ->get();// les matchs 

            $resultsAdmin = User::with(['matchs' => function ($query) use($journee){
                                    $query->where('journee', 'like', '%'. $journee .'%')
                                          ->orderBy('game_id');
                                }])
                                    ->where('admin', 1)
                                    ->get(); //collection des userAdmin et de leurs resultats pour la journee
            
            foreach ($resultsAdmin as $k => $resultAdmin) 
            {}
            
            return view('/ligues/apuestas/index', $ligue, compact('ligue', 'user', 'games', 'journee','resultAdmin'));  
            
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
        $journee = $this->DateRepository->dateJournee(); 
    
        $games = Game::where('journee', $journee)->get();

        $tot= count($request->resultatEq1); 

        $wherePossible = ['ligue_id'=> $ligue->id, 'user_id'=> $user->id, 'journee'=> $journee];
        $matchs = Match::where($wherePossible)->get();

        if( $matchs->count() === 0)
        {
            for ($i=0; $i < $tot; $i++) { 
        
                if (isset($request->resultatEq1[$i])){

                    foreach ($games as $i => $game) {

                        $dateMatch =  $game->gamedate;

                        if( $now->lessThanOrEqualTo($dateMatch))
                        {

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
               
            }
            return back()->withInput()->with('message.level', 'success')->with('message.content',  __('all.Yeah! your bets are registered! Good luck!') );

        }

        for ($i=0; $i < $tot; $i++) { 
        
            if (isset($request->resultatEq1[$i])){

                foreach ($games as $i => $game) {

                    $dateMatch =  $game->gamedate;

                    if($now->lessThanOrEqualTo($dateMatch))
                    {
                        $resultup1 = $request->resultatEq1[$i];
                        $resultup2 = $request->resultatEq2[$i];
                        $game = $game->id;

                        Match::updateOrCreate(
                        ['journee' => $journee,
                         'game_id' => $game,                         
                         'user_id' => $user->id, 
                         'ligue_id' => $ligue->id],                     
                         ['resultatEq1' => $resultup1, 
                         'resultatEq2' => $resultup2]
                        ); 
                    }                        
                    
                }    
            }
        }
        return back()->withInput()->with('message.level', 'success')->with('message.content', __('all.Yeah! your bets are registered and updated! Good luck!') );                      
                        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apuestas  $apuestas
     * @return \Illuminate\Http\Response
     */
    public function show(Ligue $ligue, User $user, $fecha)
    {

        //Auth::user(); // user
        $now = Carbon::now();
        $journee = $fecha; //la journee
        if (Auth::user()) 
        {                     
            //score inséré par le user/journée/ dans cette ligue
            $games = Game::with(['homeTeam', 'awayTeam', 'matchs' => function ($query) use($journee, $user, $ligue) {
                                $query->where('journee', 'like', '%'. $journee .'%')
                                      ->where('user_id', 'like', '%'. $user->id .'%')
                                      ->where('ligue_id', 'like', '%'. $ligue->id .'%');
                            }])
                            ->where('journee', $journee)
                            ->orderBy('id')
                            ->get();// les matchs


            $resultsAdmin = User::with(['matchs' => function ($query) use($journee){
                                    $query->where('journee', 'like', '%'. $journee .'%')
                                          ->orderBy('game_id');
                                }])
                                    ->where('admin', 1)
                                    ->get(); //collection des userAdmin et de leurs resultats pour la journee
            

            foreach ($resultsAdmin as $k => $resultAdmin) 
            {

            }                  
            return view('/ligues/apuestas/show', [$ligue, $user], compact('ligue', 'user', 'games', 'journee','resultAdmin', 'now')) ;           
        }
        return redirect()->guest('login');
    }
    
}
