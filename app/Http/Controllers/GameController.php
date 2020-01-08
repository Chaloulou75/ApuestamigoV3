<?php

namespace App\Http\Controllers;

use App\ {User, Equipe, Game};
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
        //
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'journee' => 'required|min:1|max:2',
            'equipe1_id' => 'required',
            'equipe2_id' => 'required',
        ]);

        $journee = $request->input('journee');
        $equipe1 = $request->input('equipe1_id');
        $equipe2 = $request->input('equipe2_id');
        $dategame = Carbon::parse($request->input('gamedate'), 'Europe/Paris');

        $game = Game::updateOrCreate(
                    ['journee' => $journee, 'equipe1_id' => $equipe1],
                    ['equipe2_id' => $equipe2,
                    'gamedate' => $dategame]
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
