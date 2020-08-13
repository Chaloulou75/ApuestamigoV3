<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Equipe;

class Carousel extends Component
{
    public function render()
    {
        return view('livewire.carousel', [
            'equipes' => Equipe::inRandomOrder()->select(['logo', 'logourl'])->take(5)->get(),
        ]);
    }
}
