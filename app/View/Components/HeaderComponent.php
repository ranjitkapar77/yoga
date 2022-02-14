<?php

namespace App\View\Components;

use App\Models\Course;
use App\Models\CourseLevel;
use App\Models\Destination;
use App\Models\Learn;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class HeaderComponent extends Component
{
    public $headerMenu;
    public $footerMenu;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->getHeaders();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header-component')
            ->with('headerMenu', $this->headerMenu)
            ->with('footerMenu', $this->footerMenu)
            ->with('courses', Course::where('show_in_menu', '1')->get())
            ->with('destination', Destination::where('show_in_menu', '1')->get())
            ->with('testPreparation', Learn::where('show_in_menu', '1')->get())
            ->with('level', CourseLevel::where('show_in_menu', '1')->where('publish_status', '1')->where('delete_status', '0')->get());
    }

    private function getHeaders()
    {
        $menus = Menu::where('parent_id', null)
            ->select('id', 'name', 'slug', 'position', 'parent_id', 'header_footer', 'external_link','category_slug')
            ->with('children:id,name,slug,position,parent_id,header_footer,external_link')
            ->orderBy('position', 'ASC')
            ->get();

        $this->headerMenu = $menus->filter(fn ($item, $key) => in_array($item->header_footer, [Menu::SHOWON['header'], Menu::SHOWON['header_footer']]));
        $this->footerMenu = Cache::remember('footerMenu', now()->addMinute(40), function () use ($menus) {
            return $menus->filter(fn ($item, $key) => in_array($item->header_footer, [Menu::SHOWON['footer'], Menu::SHOWON['header_footer']]));
        });
    }
}
