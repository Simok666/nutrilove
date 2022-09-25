<?php

namespace App\View\Components\User;

use Illuminate\View\Component;
use App\Models\ArticleCategory;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $category = ArticleCategory::where("is_show_navbar", true)->get();
        return view('components.user.header', compact("category"));
    }
}
