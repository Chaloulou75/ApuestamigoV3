<?php

namespace App\Http\Controllers;

use App\ {User, Equipe, Game};
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

        $games = Game::with(['homeTeam', 'awayTeam'])->orderByDesc('gamedate')->get();

        return view('/pages/games/index', compact('games', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        $equipes = Equipe::all();        

        return view('/pages/games/create', compact('equipes', 'user'));
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

        $journee = $request->input('journee');
        $equipe1 = $request->input('equipe1_id');
        $equipe2 = $request->input('equipe2_id');
        $dategame = Carbon::parse($request->input('gamedate'), 'Europe/Paris');
        $year = $request->input('year');

        $game = Game::updateOrCreate(
                    ['journee' => $journee, 'equipe1_id' => $equipe1],
                    ['equipe2_id' => $equipe2,
                    'gamedate' => $dategame,
                    'year' => $year]
                );

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

        $game = Game::with(['homeTeam', 'awayTeam'])->where('id', $id)->firstOrFail();

        $equipes = Equipe::all();        

        return view('/pages/games/edit', compact('equipes', 'game', 'user'));
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

        $journee = $request->input('journee');
        $equipe1 = $request->input('equipe1_id');
        $equipe2 = $request->input('equipe2_id');
        $dategame = Carbon::parse($request->input('gamedate'), 'Europe/Paris');
        $year = $request->input('year');

        $game->update([
                    'journee' => $journee, 
                    'equipe1_id' => $equipe1,
                    'equipe2_id' => $equipe2,
                    'gamedate' => $dategame,
                    'year' => $year
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
        $game->delete();

        return back()->withInput()->with('message.level', 'success')->with('message.content', 'le match a été supprimé');
    }
}
