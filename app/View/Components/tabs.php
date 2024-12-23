<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class tabs extends Component
{
    public array $tabs;

    /**
     * Create a new component instance.
     */
    public function __construct(array $tabs)
    {
        $this->tabs = $tabs;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tabs');
    }
}
