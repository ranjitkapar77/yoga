<?php

namespace App\View\Components;

use App\Models\Content;
use Illuminate\View\Component;

class about extends Component
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
        return view('components.about')
        ->with('about', Content::where('content_type', 'About')->where('publish_status', '1')->where('delete_status', '0')->latest()->take('1')->get());
    }
}
