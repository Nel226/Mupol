<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Http\Request;

class ImageAdherent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }
    public $photo;

    public function mount(Request $request)
    {
        $this->photo = $request->old('photo');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.image-adherent');
    }
}
