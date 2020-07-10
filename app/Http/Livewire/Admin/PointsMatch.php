<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class PointsMatch extends Component
{
    public $datejournees;

    public function mount($datejournees)
    {
        $this->datejournees = $datejournees;
    }

    public function render()
    {
        return view('livewire.admin.points-match');
    }
}
