<?php

namespace App\Http\Controllers;

use App\Championnat;
use App\DateJournee;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DateJourneeController extends Controller
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
        $championnats = Championnat::with('journees')->orderByDesc('id')->get();
        //$datejournees = DateJournee::orderByDesc('championnat_id')->orderByDesc('timejournee')->get();

        return view('/pages/datejournees/index', compact('championnats', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $championnats = Championnat::where('finished', false)->get();        

        return view('/pages/datejournees/create', compact('user', 'championnats'));
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
                'namejournee' => 'required',
                'timejournee' => 'required',
            ]);

        if ($validator->fails()) {
            return redirect('/datejournees/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $timejournee = Carbon::parse($request->input('timejournee'), 'Europe/Paris');

        $data = array(
            'championnat_id'=> $request->championnat_id,
            'namejournee' => $request->namejournee,
            'timejournee' => $timejournee,          
        );
        
        DateJournee::create($data);

        return redirect()->back()->with('message.level', 'success')->with('message.content', __('Nouvelle journée créée.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DateJournee  $dateJournee
     * @return \Illuminate\Http\Response
     */
    public function show(DateJournee $datejournee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DateJournee  $dateJournee
     * @return \Illuminate\Http\Response
     */
    public function edit(DateJournee $datejournee)
    {
        $user = Auth::user(); 
        $championnats = Championnat::where('finished', false)->get();        
        
        return view('/pages/datejournees/edit', $datejournee, compact('datejournee', 'user', 'championnats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DateJournee  $dateJournee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DateJournee $datejournee)
    {
        $datejournee = DateJournee::where('id', $datejournee->id)->firstOrFail();

        $validator = Validator::make($request->all(),[
                'championnat_id' => 'required',
                'namejournee' => 'required',
                'timejournee' => 'required',
            ]);

        if ($validator->fails()) {
            return redirect('/datejournees/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $datejournee->championnat_id= $request->input('championnat_id');
        $datejournee->namejournee = $request->input('namejournee');
        $datejournee->timejournee = Carbon::parse($request->input('timejournee'), 'Europe/Paris');

        $datejournee->save();

        return redirect()->back()->with('message.level', 'success')->with('message.content', __( 'Journée mise à jour'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DateJournee  $dateJournee
     * @return \Illuminate\Http\Response
     */
    public function destroy(DateJournee $datejournee)
    {
        $datejournee->delete();
        return redirect()->back()->with('message.level', 'success')->with('message.content', __( 'Journée supprimée'));
    }
}
