<?php

namespace App\Http\Controllers;

use App\Ligue;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LigueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //montrer la page avec toutes les ligues de l'user
        // + bouton pour creer une nouvelle ligue
        // + bouton rejoindre une ligue
        if (Auth::user())
        {
            //user connecté
            $user= Auth::user();

            //les ligues du user connecté
            $ligues = $user->ligues()->get();

            return view('/ligues', compact('ligues', 'user'));
        }

        return view('/index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // formulaire de creation d'une ligue, doit générer un token aléatoire pour inviter ses potes
        if (Auth::user())
        {

            return view('/ligues/create');
        }

        return redirect()->guest('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if (Auth::user()) {

            $name = $request->input('name');
            $token = Str::uuid('name')->toString();
            $user_name = Auth::user()->name;
            $user_club = Auth::user()->club;

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'token' => 'unique',
            ]);

            if ($validator->fails()) {
                return redirect('ligues/create')
                            ->withErrors($validator)
                            ->withInput();
            }

            $ligue = Ligue::create([
                'name' => $name,
                'token' => $token,
                'user_name' => $user_name,
                'user_club' => $user_club          
            ]); 

            //lié le user avec la ligue créé
            $user = Auth::user();
            $user->ligues()->attach($ligue);

            //redirection avec message
            return redirect('/ligues')->with('message.level', 'success')->with('message.content', 'La ligue " ' . $name . ' " est maintenant créée, partage la avec ce token: ' . $token . ' ');
        }

        return redirect('login');

        //renvoie mail de confirmation creation nom de ligue + code

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ligue  $ligue
     * @return \Illuminate\Http\Response
     */
    public function show(Ligue $ligue)
    {
        // qd on va ds une ligue dejà créer, submenu avec classement / apuestas
        $users = User::with('ligues')->get();

        return view('/ligues/show', $ligue, compact('ligue','users'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ligue  $ligue
     * @return \Illuminate\Http\Response
     */
    public function edit(Ligue $ligue)
    {
        // formulaire pour changer le nom d'une ligue / ou un joueur
        return view('/ligues/{$ligue}/edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ligue  $ligue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ligue $ligue)
    {
        //changer le nom d'une ligue / ou un joueur
        $ligue = ligue::findOrFail($ligue->id);

        $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
            ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $name = $request->input('name');

        $ligue->update([
            'name' => $name,           
            ]);

        return redirect('/ligues')->with('message.level', 'success')->with('message.content', 'ta ligue est bien modifiée!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ligue  $ligue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ligue $ligue)
    {
        //delete une ligue
        $ligue = ligue::findOrFail($ligue->id);
        $ligue->delete();
        
        return redirect('/ligues')->with('message.level', 'success')->with('message.content', 'Votre ligue est bien supprimée!');       
    }

    public function joinLiguesIndex()
    {
        if (Auth::user())
        {
        	return view('/ligues/joinLigues');
        }
        return redirect('login');
    }

    public function joinLigues(Request $request, Ligue $ligue)
    {
        if (Auth::user())
        {

            $token = $request->input('token');
            $ligue = ligue::where('token', '=',  $token)->firstOrFail();            
            
            //lié le user avec la ligue créé
            $user = Auth::user();
            $user->ligues()->attach($ligue);
          
            return redirect()->route('ligues.show', $ligue)->with('message.level', 'success')->with('message.content', 'Vous avez rejoints cette ligue!');
        }

        return redirect('login');

    }

    public function classement(Ligue $ligue)
    {
        // $top = Ligue::with(['users' => function ($q) {
        //             $q->orderBy('pivot_totalPoints', 'Desc');
        //         }])->get();
        
        return view('/ligues/classement', $ligue, compact('ligue'));        
    }

    public function settings(Ligue $ligue)
    {
        return view('/layouts/partials/settings', $ligue, compact('ligue'));
    }
}
