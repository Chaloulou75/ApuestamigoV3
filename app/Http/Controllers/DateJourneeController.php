<?php

namespace App\Http\Controllers;

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
        $datejournees = DateJournee::all();

        return view('/pages/datejournees/index', compact('datejournees', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();        

        return view('/pages/datejournees/create', compact('user'));
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
                'numerojournee' => 'required',
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
            'numerojournee'=> $request->numerojournee,
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

        return view('/pages/datejournees/edit', $datejournee, compact('datejournee', 'user'));
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
                'numerojournee' => 'required',
                'namejournee' => 'required',
                'timejournee' => 'required',
            ]);

        if ($validator->fails()) {
            return redirect('/datejournees/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $datejournee->numerojournee= $request->input('numerojournee');
        $datejournee->namejournee = $request->input('namejournee');
        $datejournee->timejournee = Carbon::parse($request->input('timejournee'), 'Europe/Paris');

        $datejournee->save();

        return redirect()->back()->with('message.level', 'success')->with('message.content', __( ' journée mise à jour'));
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
        return redirect()->back()->with('message.level', 'success')->with('message.content', __( ' journée supprimée'));
    }
}
