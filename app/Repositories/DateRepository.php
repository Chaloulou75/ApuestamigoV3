<?php

namespace App\Repositories;

use Carbon\Carbon;

class DateRepository
{
	public function dateJournee()
    {
        $now = Carbon::now();
        $dateJournee1 = Carbon::create(2019, 9, 14, 18, 55, 00, 'Europe/Paris');
        $dateJournee2 = Carbon::create(2019, 10, 1, 18, 55, 00, 'Europe/Paris');
        $dateJournee3 = Carbon::create(2019, 10, 22, 18, 55, 00, 'Europe/Paris');
        $dateJournee4 = Carbon::create(2019, 11, 5, 18, 55, 00, 'Europe/Paris');
        $dateJournee5 = Carbon::create(2019, 11, 26, 18, 55, 00, 'Europe/Paris');
        $dateJournee6 = Carbon::create(2019, 12, 10, 18, 55, 00, 'Europe/Paris');
        $dateJournee7 = Carbon::create(2020, 2, 26, 21, 00, 00, 'Europe/Paris');
        $dateJournee8 = Carbon::create(2020, 8, 12, 21, 00, 00, 'Europe/Paris');
        $dateJournee9 = Carbon::create(2020, 8, 16, 21, 00, 00, 'Europe/Paris');
        $dateJournee10 = Carbon::create(2020, 8, 20, 21, 00, 00, 'Europe/Paris');
        $dateJournee11 = Carbon::create(2020, 8, 23, 21, 00, 00, 'Europe/Paris');
        $dateJournee12 = Carbon::create(2020, 8, 27, 21, 00, 00, 'Europe/Paris');
        $dateJournee13 = Carbon::create(2020, 8, 30, 21, 00, 00, 'Europe/Paris');

        if($now->lessThanOrEqualTo($dateJournee1))        
        {
            $journee = 1;
            return $journee;
        }
        if($now->between($dateJournee1, $dateJournee2))        
        {
            $journee = 2;
            return $journee;
        }
        if($now->between($dateJournee2, $dateJournee3))        
        {
            $journee = 3;
            return $journee;
        }
        if($now->between($dateJournee3, $dateJournee4))        
        {
            $journee = 4;
            return $journee;
        }
        if($now->between($dateJournee4, $dateJournee5))        
        {
            $journee = 5;
            return $journee;
        }
        if($now->between($dateJournee5, $dateJournee6))        
        {
            $journee = 6;
            return $journee;
        }
        if($now->between($dateJournee6, $dateJournee7))        
        {
            $journee = 7;
            return $journee;
        }
        if($now->between($dateJournee7, $dateJournee8))        
        {
            $journee = 8;
            return $journee;
        }
        if($now->between($dateJournee8, $dateJournee9))        
        {
            $journee = 9;
            return $journee;
        }
        if($now->between($dateJournee9, $dateJournee10))        
        {
            $journee = 10;
            return $journee;
        }
        if($now->between($dateJournee10, $dateJournee11))        
        {
            $journee = 11;
            return $journee;
        }
        if($now->between($dateJournee11, $dateJournee12))        
        {
            $journee = 12;
            return $journee;
        }
        if($now->between($dateJournee12, $dateJournee13))        
        {
            $journee = 13;
            return $journee;
        }
        else{
            $journee = 0;
            return $journee;
        }
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
