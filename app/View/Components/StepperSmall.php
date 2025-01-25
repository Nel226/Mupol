<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StepperSmall extends Component
{
    /**
     * Create a new component instance.
     */

     public $totalSteps;
    public $steps;

    public function __construct($totalSteps, $steps = [])
    {
        $this->totalSteps = $totalSteps;
        $this->steps = $steps;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.stepper-small');
    }
}
