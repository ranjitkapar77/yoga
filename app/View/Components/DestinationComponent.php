<?php

namespace App\View\Components;

use App\Models\Course;
use App\Models\Destination;
use Illuminate\View\Component;

class DestinationComponent extends Component
{
    public $destinationId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.destination-component')
            ->with('destinations', $this->getDestination())
            ->with('courses', $this->getCourses());
    }

    private function getDestination()
    {
        $destinations =  Destination::get();

        $this->destinationId = $destinations->modelKeys();

        return $destinations;
    }

    private function getCourses()
    {
        return Course::latest()->limit(15)->get();
    }
}
