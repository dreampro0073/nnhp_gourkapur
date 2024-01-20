<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $label;
    public $required;
    public $name;
    public $type;
    public $ng;
    public $placeholder;
    public $rows;

    public function __construct($label="", $required = false, $name, $type = "text", $ng = true, $placeholder = "", $rows="2")
    {
        $this->label = $label;
        $this->required = $required;
        $this->name = $name;
        $this->type = $type;
        $this->ng = $ng;
        $this->placeholder = $placeholder;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
