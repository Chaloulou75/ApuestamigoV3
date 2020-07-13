<?php

namespace App\Http\Controllers;

use App\ {User, Equipe, Game};
use App\Championnat;
use App\DateJournee;
use App\Http\Requests\StoreGame;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $championnats = Championnat::with(['journees'=> function ($query) {
                         $query->with(['games'=> function ($query) {
                            $query->with(['homeTeam', 'awayTeam']);
                            }]);
                        }])->where('finished', false)->orderByDesc('id')->get();
        //
        return view('/pages/games/index', compact('championnats', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $journees = DateJournee::orderBy('timejournee')->get();
        $equipes = Equipe::all();
        $championnats = Championnat::where('finished', false)->get();          

        return view('/pages/games/create', compact('championnats', 'equipes', 'journees', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGame $request)
    {
        $validatedData = $request->validated();

        $championnat = $request->input('championnat_id');
        $journee = $request->input('journee');
        $equipe1 = $request->input('equipe1_id');
        $equipe2 = $request->input('equipe2_id');
        $dategame = Carbon::parse($request->input('gamedate'), 'Europe/Paris');

        $game = Game::create([
                    'championnat_id'=> $championnat, 
                    'date_journees_id' => $journee,
                    'equipe1_id' => $equipe1,
                    'equipe2_id' => $equipe2,
                    'gamedate' => $dategame
                ]);

        return back()->withInput()->with('message.level', 'success')->with('message.content', 'le match est inséré.');                      
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        $journees = DateJournee::orderBy('timejournee')->get();

        $game = Game::with(['homeTeam', 'awayTeam', 'journee'])->where('id', $id)->firstOrFail();

        $equipes = Equipe::all();
        $championnats = Championnat::where('finished', false)->get();        

        return view('/pages/games/edit', compact('championnats', 'equipes', 'journees', 'game', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGame $request, Game $game)
    {
        $validatedData = $request->validated();

        $game = Game::with(['homeTeam', 'awayTeam'])->where('id', $game->id)->firstOrFail();

        $championnat = $request->input('championnat_id');
        $journee = $request->input('journee');
        $equipe1 = $request->input('equipe1_id');
        $equipe2 = $request->input('equipe2_id');
        $dategame = Carbon::parse($request->input('gamedate'), 'Europe/Paris');

        $game->update([
                    'championnat_id'=> $championnat,
                    'date_journees_id' => $journee, 
                    'equipe1_id' => $equipe1,
                    'equipe2_id' => $equipe2,
                    'gamedate' => $dategame
                ]);

        return back()->withInput()->with('message.level', 'success')->with('message.content', 'le match est mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        $matchWithThisGame = Match::where('game_id', $game->id)->delete();
        
        $game->delete();

        return back()->withInput()->with('message.level', 'success')->with('message.content', 'le match a été supprimé');
    }
}
