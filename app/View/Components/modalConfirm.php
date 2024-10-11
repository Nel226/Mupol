<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modalConfirm extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $icon;

    public function __construct($title = 'Confirmation', $icon = 'fa-regular fa-times-circle')
    {
        $this->title = $title;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-confirm');
    }
}
