<?php

namespace App\Http\Controllers;

use App\ {User, Equipe, Game};
use App\Championnat;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Validator;

class EquipeController extends Controller
{
    

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
        $equipes = Equipe::orderBy('championnat_id', 'desc')->get();
        $championnats = Championnat::where('finished', false)->orderByDesc('id')->get(); 

        return view('/pages/equipes/index', compact('championnats', 'equipes', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $championnats = Championnat::where('finished', false)->get(); 
        return view('/pages/equipes/create', compact('championnats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(),[
                'championnat_id' => 'required',
                'name' => 'required|min:2',
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'groupe' => 'max:1',
            ]);

        if ($validator->fails()) {
            return redirect('/equipes/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request->hasfile('logo'))
        {
            //$filename = $request->avatar->getClientOriginalName();
            $path = $request->file('logo')->store('img/equipes/logo', 's3');

            Storage::disk('s3')->setVisibility($path, 'public');

            $url = Storage::disk('s3')->url($path);

        }

        $data = array(
            'championnat_id'=> $request->championnat_id,
            'name'=> $request->name,
            'logo' => basename($path),
            'logourl' => $url, 
            'groupe'=> $request->groupe,            
        );
        
        Equipe::create($data);

        return redirect()->back()->with('message.level', 'success')->with('message.content', __('Nouvelle équipe créée.'));
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
    public function edit(Equipe $equipe)
    {
        //$equipe = Equipe::where('id', $id)->get();
        $championnats = Championnat::where('finished', false)->get(); 
        return view('/pages/equipes/edit', compact('equipe', 'championnats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipe $equipe)
    {
        //dd($request);

        $validator = Validator::make($request->all(),[
                'championnat_id' => 'required',
                'name' => 'required|min:2',
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'groupe' => 'max:1',
            ]);

        if ($validator->fails()) {
            return redirect('/equipes/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request->hasfile('logo'))
        {
            if($equipe->logo){

                Storage::disk('s3')->delete('/img/equipes/logo'.$equipe->logo);
            }
            //$filename = $request->avatar->getClientOriginalName();
            $path = $request->file('logo')->store('img/equipes/logo', 's3');

            Storage::disk('s3')->setVisibility($path, 'public');

            $url = Storage::disk('s3')->url($path);

            $equipe->update([ 'logo' => basename($path),
                              'logourl' => $url 
            ]);

        }
        $equipe->update([
            'championnat_id'=> $request->championnat_id,
            'name'=> $request->name,
            'groupe' => $request->groupe,             
        ]);

        return redirect()->back()->with('message.level', 'success')->with('message.content', __('Equipe '.$equipe->name.' mise à jour.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipe $equipe)
    {
        $gamesWithThisEquipe = Game::where('equipe1_id', $equipe->id)
                                    ->orWhere('equipe2_id', $equipe->id)
                                    ->delete();

        Storage::disk('s3')->delete('img/equipes/logo'.$equipe->logo);

        $equipe->delete();

        return back()->with('message.level', 'success')->with('message.content', 'l\'equipe a été supprimé');
    }
}
