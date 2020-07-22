<?php

namespace App\Http\Controllers;

use App\Ligue;
use Auth;
use Illuminate\Http\Request;

class LigueUserController extends Controller
{
    public function create()
    {
        if (Auth::user())
        {
            $baseligue = Ligue::firstWhere('name', 'The Champions League');

            if(isset($baseligue))
            {
              return view('/ligues/joinLigues/create', compact('baseligue'));  
            }
            else{
               return view('/ligues/joinLigues/create'); 
            }
        	
        }
        return redirect('login');
    }

    public function store(Request $request, Ligue $ligue)
    {
        if (Auth::user())
        {
            $token = $request->input('token');
            $ligue = Ligue::where('token', '=',  $token)->firstOrFail();            
            
            //lié le user avec la ligue créé
            $user = Auth::user();

            $userLigueExist = $user->ligues()->wherePivot('ligue_id', $ligue->id)->exists();
            //dd($userLigueExist);

            if($userLigueExist === true)
            {
                return redirect()->route('ligues.show', $ligue)->with('message.level', 'success')->with('message.content', __('all.You already have joined this league!'));
            }

            $user->ligues()->attach($ligue);
          
            return redirect()->route('ligues.show', $ligue)->with('message.level', 'success')->with('message.content', __('all.You have joined this league!'));
        }

        return redirect('login');
    }

    public function destroy(Ligue $ligue)
    {                  
        //le user 
        $user = Auth::user();

        $user->ligues()->detach($ligue);

        return redirect()->route('ligues.index')->with('message.level', 'success')->with('message.content', __('all.Ok, you are not anymore in this league!'));

    }
}
