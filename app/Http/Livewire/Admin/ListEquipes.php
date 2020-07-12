<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ListEquipes extends Component
{
    public $championnats;

    public function mount($championnats)
    {
        $this->championnats = $championnats;
    }

    public function render()
    {
        return view('livewire.admin.list-equipes');
    }
}
