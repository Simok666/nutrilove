<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class layout extends Component
{
    public $title;
    public $styles = null;
    public $scripts = null;
    public function __construct($title = null)
    {
        $this->title = $title ;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.layout');
    }
}
