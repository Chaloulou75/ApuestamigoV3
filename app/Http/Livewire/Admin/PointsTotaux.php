<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class PointsTotaux extends Component
{
    public $datejournees;

    public function mount($datejournees)
    {
        $this->datejournees = $datejournees;
    }

    public function render()
    {
        return view('livewire.admin.points-totaux');
    }
}
