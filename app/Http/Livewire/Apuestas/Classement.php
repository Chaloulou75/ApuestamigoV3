<?php

namespace App\Http\Livewire\Apuestas;

use Livewire\Component;

class Classement extends Component
{
    public $ligue;
    public $journee;

    public function mount($ligue, $journee)
    {
        $this->ligue = $ligue;
        $this->journee = $journee;
    }

    public function render()
    {
        return view('livewire.apuestas.classement');
    }
}
