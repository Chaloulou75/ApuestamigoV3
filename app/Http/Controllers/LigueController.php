<?php

namespace App\Http\Controllers;

use App\Championnat;
use App\Ligue;
use App\Repositories\DateRepository;
use App\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LigueController extends Controller
{
    private $DateRepository;

    public function __construct( DateRepository $DateRepository)
    {
        $this->DateRepository = $DateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user())
        {
            //user connecté
            $user= Auth::user()->load(['equipe', 'ligues' => function ($query) {
                                $query->with(['championnat', 'creator'])
                                      ->orderBy('finished', 'asc')
                                      ->latest();
                            }]);

            return view('/ligues/index', compact('user'));
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
            $championnats = Championnat::where('finished', false)->get();
            return view('/ligues/create', compact('championnats'));
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
        if (Auth::user()) 
        {
            $name = $request->input('name');
            $token = Str::uuid('name')->toString();
            $creator_id = Auth::user()->id;
            $championnat = $request->input('championnat_id');

            $validator = Validator::make($request->all(), [
                'name' => 'required|min:2|max:100',
                'token' => 'unique',
                'championnat_id' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('ligues.create')
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $ligue = Ligue::create([
                'name' => $name,
                'token' => $token,
                'creator_id' => $creator_id,
                'championnat_id' => $championnat,       
            ]); 

            //lié le user avec la ligue créé
            $user = Auth::user();
            $user->ligues()->attach($ligue);

            //redirection avec message
            return redirect()->route('ligues.index')->with('message.level', 'success')->with('message.content',  __('all.the league')  . $name .   __('all.is now created, share it with this token') .' : ' . $token . ' ');
        }

        return redirect('login');
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

        if( $ligue->creator_id === Auth::user()->id || Auth::user()->admin === 1)
        {
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

            return redirect()->route('ligues.index')->with('message.level', 'success')->with('message.content', __('all.your league has been modified'));
        }
        else
        {
            return back()->with('message.level', 'success')->with('message.content', __('all.Sorry you have to be the owner to change the league'));

        }
        
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
        $ligue = Ligue::findOrFail($ligue->id);

        if( $ligue->creator_id === Auth::user()->id || Auth::user()->admin === 1)
        {
            $ligue->delete();
        
            return redirect()->route('ligues.index')->with('message.level', 'success')->with('message.content', __('all.your league has been deleted'));   
        } 

        else
        {
            return back()->with('message.level', 'success')->with('message.content', __('all.Sorry you have to be the owner to delete the league'));

        }   
             
    } 
}
