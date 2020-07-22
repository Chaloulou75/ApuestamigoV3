<?php

namespace App\Http\Controllers;

use App\ {User, Equipe, Game, Ligue, Match, DateJournee};
use Auth;
use App\Repositories\DateRepository;
use App\Repositories\ResultAdminRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ApuestasController extends Controller
{
    private $DateRepository;
    private $ResultAdminRepository;

    public function __construct(DateRepository $DateRepository, ResultAdminRepository $ResultAdminRepository)
    {        
        $this->DateRepository = $DateRepository;
        $this->ResultAdminRepository = $ResultAdminRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ligue $ligue)
    {        
        $user = Auth::user(); // le user

        $journee = $this->DateRepository->dateJournee($ligue); //la journee

        $gamesIds = Game::where('championnat_id', $journee->championnat_id)
                        ->where('date_journees_id', $journee->id)
                        ->orderBy('id')
                        ->get('id'); //id des matchs concernés
        
        if (Auth::user()) 
        {
          $games = Game::with(['homeTeam', 'awayTeam', 'matchs' => function ($query) use($journee, $user, $ligue) {
                          $query->where('championnat_id', $journee->championnat_id)
                                ->where('date_journees_id', $journee->id)
                                ->where('user_id', $user->id)
                                ->where('ligue_id', $ligue->id);
                      }])
                      ->whereIn('id', $gamesIds)
                      ->orderBy('id')
                      ->get();// les matchs 

          //collection des resultats userAdmin pour la journee
          $resultAdmin = $this->ResultAdminRepository->resultAdmin($journee);

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
        $journee = $this->DateRepository->dateJournee($ligue); 
        
        $games = Game::where('championnat_id', $journee->championnat_id)->where('date_journees_id', $journee->id)->orderBy('id')->get();

        $tot= count($request->resultatEq1); 

        $wherePossible = ['championnat_id' => $journee->championnat_id, 'ligue_id'=> $ligue->id, 'user_id'=> $user->id, 'date_journees_id'=> $journee->id];
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
                                                                        
                            Match::create(
                            ['championnat_id' => $journee->championnat_id,
                             'date_journees_id' => $journee->id,
                             'game_id' => $game->id,                         
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

                        Match::updateOrCreate(
                        ['championnat_id' => $journee->championnat_id,
                         'date_journees_id' => $journee->id,
                         'game_id' => $game->id,                        
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
        $now = Carbon::now();

        $journee = DateJournee::where('id', $fecha)->first();
                        
        if (Auth::user()) 
        {                     
            //score inséré par le user/journée/ dans cette ligue
            $games = Game::with(['homeTeam', 'awayTeam', 'matchs' => function ($query) use($journee, $user, $ligue) {
                                $query->where('championnat_id', $journee->championnat_id)
                                      ->where('date_journees_id', $journee->id)
                                      ->where('user_id', $user->id)
                                      ->where('ligue_id', $ligue->id);
                            }])
                            ->where('date_journees_id', $journee->id)
                            ->orderBy('id')
                            ->get();// les matchs

            //collection des resultats userAdmin pour la journee
            $resultAdmin = $this->ResultAdminRepository->resultAdmin($journee);

            return view('/ligues/apuestas/show', [$ligue, $user], compact('ligue', 'user', 'games', 'journee','resultAdmin', 'now'));           
        }
        return redirect()->guest('login');
    }
    
}
