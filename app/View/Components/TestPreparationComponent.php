<?php

namespace App\View\Components;

use App\Models\Learn;
use Illuminate\View\Component;

class TestPreparationComponent extends Component
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
        return view('components.test-preparation-component')
        ->with('test', Learn::latest()->where('publish_status', '1')->where('delete_status', '0')->take('5')->get());
    }
}
