<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $class;

    public function __construct($title = null, $class = 'card')
    {
        $this->title = $title;
        $this->class = $class;
    }

    public function render()
    {
        return view('components.card');
    }
}