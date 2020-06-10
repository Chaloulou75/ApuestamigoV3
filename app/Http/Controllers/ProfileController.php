<?php

namespace App\Http\Controllers;

use App\Equipe;
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
        //user connecté
        $user= Auth::user();

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
        if (Auth::user()) {
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
        $user = Auth::user(); 

        $user->delete();

        return redirect()->route('ligues.index')->with('message.level', 'success')->with('message.content', __( 'all.your profile has been deleted'));
    }
}
