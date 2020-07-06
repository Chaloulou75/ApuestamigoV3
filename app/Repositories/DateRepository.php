<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\DateJournee;

class DateRepository
{
	public function dateJournee()
    {
        $now = Carbon::now();

        $journee = DateJournee::whereDate('timejournee', '>=', $now)->orderBy('timejournee', 'asc')->first();
        return $journee;     
    }

    public function year()
    {
        $now = Carbon::now();
        $limite = Carbon::create(2020, 8, 31, 23, 59, 00, 'Europe/Paris');

        if($now->lessThan($limite))
        {
          $year = '2020'; 
        }
        else
        {
            $year = '2021';
        }
        return $year;        
    }   
}
