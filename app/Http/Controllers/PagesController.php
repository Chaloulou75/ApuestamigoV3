<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    
    public function welcome()
    {    	
    	return view('/index');
    }
}
