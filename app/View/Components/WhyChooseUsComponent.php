<?php

namespace App\View\Components;

use App\Models\Content;
use Illuminate\View\Component;

class WhyChooseUsComponent extends Component
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
        return view('components.why-choose-us-component')
        ->with('why', Content::where('content_type', 'Why')->where('publish_status', '1')->where('delete_status', '0')->latest()->take('1')->get())
        ->with('faqs', Content::where('content_type', 'Faq')->where('publish_status', '1')->where('delete_status', '0')->latest()->take('4')->get());
    }
}
