<?php

namespace App\View\Components;

use App\Models\Team;
use Illuminate\View\Component;

class TeamComponent extends Component
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
        return view('components.team-component')
            ->with('teams', $this->getTeam());
    }


    private function getTeam()
    {
        return Team::get();
    }
}
