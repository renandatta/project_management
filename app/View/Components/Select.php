<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public $class, $prefix, $name, $caption, $value, $options;
    public function __construct(
        $class = null,
        $prefix = null,
        $name = null,
        $caption = '-Pilih-',
        $value = '',
        $options = []
    )
    {
        $this->class = $class;
        $this->prefix = $prefix;
        $this->name = $name;
        $this->caption = $caption;
        $this->value = $value;
        $this->options = $options;
    }

    public function render()
    {
        return view('components.select');
    }
}
