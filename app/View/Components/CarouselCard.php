<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Equipe;

class CarouselCard extends Component
{
    
    public $equipes;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($equipes)
    {
        $this->equipes = Equipe::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.carousel-card');
    }
}
