<?php

namespace App\Http\Controllers;

use App\Equipe;
use App\Ligue;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::user()->admin === 1)
        {
            $users = User::with('ligues')->latest()->get();
            return view('pages/profile/index', compact('users'));
        }
        return view('index');

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if( Auth::user()->admin === 1) //si admin, on peut voir n'importe quel profil
        {
            $user = User::with(['ligues' => function ($query) {
                                $query->with('championnat')
                                      ->orderBy('finished', 'asc')
                                      ->latest();
                            }])->findOrFail($id);
        }
        else //sinon seulement l'user connecté
        {
            $user= Auth::user()->load(['ligues' => function ($query) {
                                $query->with('championnat')
                                      ->orderBy('finished', 'asc')
                                      ->latest();
                            }]);
        }   
        $equipes = Equipe::all();

        return view('pages/profile/show', compact('user', 'equipes'));
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
        if (Auth::user() || Auth::user()->admin === 1) 
        {
            $user = User::find($id);

            $data = array_filter($request->all());
            $validate = $request->validate([
                'name' => ['string', 'max:255'],
                'email' => ['string', 'email', 'max:255', 'exists:users'],
                'equipe_id' => ['string'],
            ]);

            $user->fill($data);
            $user->save();

            return redirect()->route('ligues.index')->with('message.level', 'success')->with('message.content', __( 'all.your profile has been updated'));
        }

        return redirect()->route('login');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( Auth::user()->admin === 1) //si admin, on peut delete n'importe quel profil
        {
            $user = User::findOrFail($id);
        }
        else //sinon seulement l'user connecté
        {
            //user connecté
            $user= Auth::user();
        } 

        //$userMatch = Match::where('user_id', $user->id)->delete();

        $liguecreatedbyUser = Ligue::where('creator_id', $user->id)->update(['creator_id' => NULL]);

        $user->ligues()->detach();
        $user->delete();

        return redirect()->route('ligues.index')->with('message.level', 'success')->with('message.content', __( 'all.your profile has been deleted'));
    }
}
