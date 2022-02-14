<?php

namespace App\View\Components;

use App\Models\Content;
use Illuminate\View\Component;

class WhatLooking extends Component
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
        return view('components.what-looking')->with('content', Content::where('publish_status', '1')->where('delete_status', '0')->where('content_type', 'Article')->get());
    }
}
