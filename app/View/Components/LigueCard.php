<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LigueCard extends Component
{
    public $ligue;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ligue)
    {
        $this->ligue = $ligue;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.ligue-card');
    }
}
