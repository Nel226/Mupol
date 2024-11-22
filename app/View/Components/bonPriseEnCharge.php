<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class bonPriseEnCharge extends Component
{
    public $adherent;

    /**
     * Create a new component instance.
     */
    public function __construct($adherent)
    {
        $this->adherent = $adherent;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bon-prise-en-charge');
    }
}
