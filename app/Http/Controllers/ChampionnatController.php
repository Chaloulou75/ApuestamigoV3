<?php

namespace App\Http\Controllers;

use App\Championnat;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ChampionnatController extends Controller
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
        $championnats = Championnat::all();

        return view('/pages/championnats/index', compact('championnats', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/pages/championnats/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
                'name' => 'required|min:3',
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

        if ($validator->fails()) {
            return redirect('/championnats/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request->hasfile('logo'))
        {
            //$filename = $request->avatar->getClientOriginalName();
            $path = $request->file('logo')->store('img/championnats/logo', 's3');

            Storage::disk('s3')->setVisibility($path, 'public');

            $url = Storage::disk('s3')->url($path);

        }

        $data = array(
            'name'=> $request->name,
            'logo' => basename($path),
            'logourl' => $url,             
        );
        
        Championnat::create($data);

        return redirect()->back()->with('message.level', 'success')->with('message.content', __('Nouveau championnat créé.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Championnat  $championnat
     * @return \Illuminate\Http\Response
     */
    public function show(Championnat $championnat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Championnat  $championnat
     * @return \Illuminate\Http\Response
     */
    public function edit(Championnat $championnat)
    {
        return view('/pages/championnats/edit', compact('championnat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Championnat  $championnat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Championnat $championnat)
    {
        //dd($request);

        $validator = Validator::make($request->all(),[
                'name' => 'required|min:3',
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);

        if ($validator->fails()) {
            return redirect('/championnats/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request->hasfile('logo'))
        {
            if($championnat->logo){

                Storage::disk('s3')->delete('/img/championnats/logo'.$championnat->logo);
            }
            //$filename = $request->avatar->getClientOriginalName();
            $path = $request->file('logo')->store('img/championnats/logo', 's3');

            Storage::disk('s3')->setVisibility($path, 'public');

            $url = Storage::disk('s3')->url($path);

            $championnat->update(['logo' => basename($path),
                                  'logourl' => $url 
            ]);

        }
        $championnat->update([
            'name'=> $request->name,            
        ]);

        return redirect()->back()->with('message.level', 'success')->with('message.content', __('Championnat '.$championnat->name.' mise à jour.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Championnat  $championnat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Championnat $championnat)
    {
        //$gamesWithThisChampionnat = Game::where('championnat_id', $championnat->id)->delete();

        Storage::disk('s3')->delete('img/championnats/logo'.$championnat->logo);

        $championnat->delete();

        return back()->with('message.level', 'success')->with('message.content', 'le championnat a été supprimé');
    }
}
