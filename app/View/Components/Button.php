<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $class;
    public $href;

    public function __construct($type = 'button', $class = 'btn btn-primary', $href = null)
    {
        $this->type = $type;
        $this->class = $class;
        $this->href = $href;
    }

    public function render()
    {
        return view('components.button');
    }
}