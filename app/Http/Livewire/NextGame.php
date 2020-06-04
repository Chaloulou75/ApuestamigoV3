<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Game;
use Carbon\Carbon;

class NextGame extends Component
{
    public $nextGameDate;

    public function diffWithNextGame()
    {
    	$now = Carbon::now();

    	$nextGame = Game::where('gamedate', '>', $now)->orderBy('gamedate', 'asc')->first();
        
        if(isset($nextGame))
        {    
            $nextGameDateValue = $nextGame->gamedate;        
            $nextGameDate = $now->diff($nextGameDateValue)->format('%m Months %d days %h h %i min %s sec');
            $this->nextGameDate = $nextGameDate; 
        }
        
        $nextGameDateValue = Carbon::create(2020, 9, 15, 21, 0, 0, 'Europe/Paris');
        $nextGameDate = $now->diff($nextGameDateValue)->format('%m Months %d days %h h %i min %s sec');
        $this->nextGameDate = $nextGameDate;  
        
    	
    }

    public function render()
    {
        return view('livewire.next-game',[
        	'nextGameDate' => $this->diffWithNextGame(),
        ]);
    }
}
