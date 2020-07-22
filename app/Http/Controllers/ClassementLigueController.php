<?php

namespace App\Http\Controllers;

use App\Ligue;
use App\Repositories\DateRepository;
use Illuminate\Http\Request;

class ClassementLigueController extends Controller
{
    private $DateRepository;

    public function __construct( DateRepository $DateRepository)
    {
        $this->DateRepository = $DateRepository;
    }

    public function show(Ligue $ligue)
    {  
        $journee = $this->DateRepository->dateJournee($ligue); 
  
        return view('/ligues/classement/show', $ligue, compact('ligue', 'journee'));        
    }
}
