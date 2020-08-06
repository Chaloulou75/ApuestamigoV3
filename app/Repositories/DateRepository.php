<?php

namespace App\Repositories;

use App\DateJournee;
use Carbon\Carbon;

class DateRepository
{
    public function dateJournee($ligue)
    {
        $now = Carbon::now();

        $journee = DateJournee::where('championnat_id', $ligue->championnat->id)->whereDate('timejournee', '>=', $now)->orderBy('timejournee', 'asc')->first();
        //dd($journee);
        return $journee;    
    }  
}
