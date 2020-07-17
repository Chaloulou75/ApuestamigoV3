<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ListChampionnats extends Component
{
    public $championnats;

    public function mount($championnats)
    {
        $this->championnats = $championnats;
    }

    public function render()
    {
        return view('livewire.admin.list-championnats');
    }
}