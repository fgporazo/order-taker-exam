<?php

namespace App\View\Components\Commons;

use Illuminate\View\Component;

class Alert extends Component
{
    
 
    /**
     * Create the component instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.commons.alert');
    }
}
