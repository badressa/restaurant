<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Recipe extends Component
{
    public $recette;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($recette)
    {
        $this->recette = $recette;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.recipe');
    }
}
