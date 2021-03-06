<?php

namespace App\Http\Livewire;

use App\DateJournee;
use Livewire\Component;

class LinksJournees extends Component
{
    public $ligue;
    public $user;

    public function mount($ligue, $user)
    {
        $this->ligue = $ligue;
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.links-journees', [
            'todasjornadas' => DateJournee::where('championnat_id', $this->ligue->championnat->id)->orderBy('timejournee', 'asc')->get(),
        ]);
    }
}
