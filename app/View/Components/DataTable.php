<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataTable extends Component
{
    public $id;
    public $headers;
    /**
     * Create a new component instance.
     */

    public function __construct($id, $headers)
    {
        $this->id = $id;
        $this->headers = $headers;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.data-table');
    }
}
