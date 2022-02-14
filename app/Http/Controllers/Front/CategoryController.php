<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\News;
use App\Models\Services;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public $keyValue = [
        'category' => 'categoryDetails',
        'home' => 'home',
        'about' => 'about',
        'contact' => 'contact',
        'team' => 'team',
        'gallery' => 'gallery',
        'pricingAndPlans' => 'pricing-and-plans',
        'services' => 'services',
        'blogs' => 'blogs',
        'epaper' => 'epaper',
    ];

    public function category($category)
    {
        $category  = Menu::where('slug', $category)->firstOrFail();
        $requiredFunction =  $this->keyValue[$category->category_slug];
        try {
            return $this->$requiredFunction($category);
        } catch (\Throwable $th) {
            return  abort('404');
        }
    }

    private function home()
    {
        return redirect()->route('index');
    }

    private function categoryDetails($category)
    {
        $news = News::selectedField(true)
            ->join('news_categories', 'news.id', 'news_categories.newsId')
            ->when($category->id == 40, fn ($query) => $query->where('isSpecial', 1)
                ->orWhere('news_categories.categoryId', $category->id))
            ->when($category->id !== 40, fn ($query) => $query->where('news_categories.categoryId', $category->id))
            ->where('news.published_at', '<', now())
            ->distinct('news.id')
            ->orderBy('news.id', 'desc')
            ->paginate(15)
            ->appends(request()->all());
        return view('frontvue.categoryDetails', compact('category', 'news'))
            ->with('meta', $this->getMeta($category));
    }

    private function about($category)
    {
        return view('frontend.about', compact('category'))
            ->with('meta', $this->getMeta($category));;
    }

    private function contact($category)
    {
        return view('frontend.contact', compact('category'))
            ->with('meta', $this->getMeta($category));
    }

    private function advertise($category)
    {
        return view('frontvue.advertise', compact('category'))
            ->with('meta', $this->getMeta($category));
    }



    private function team($category)
    {
        $teams =  Team::select()
            ->leftJoin('designations', 'designations.id', 'teams.designation_id')
            ->orderBy('designations.position', 'ASC')
            ->where('teams.publish_status', '1')
            ->get()
            ->map(fn ($item, $index) => [
                'image' => $item->image,
                'full_name' => $item->full_name['np'] ??  $item->full_name['en'],
                'facebook' => $item->facebook,
                'twitter' => $item->twitter,
                'email' => $item->email,
                'designation' => json_decode($item->title)->np,
            ])
            ->groupBy('designation');

        return view('frontvue.team', compact('teams', 'category'))
            ->with('meta', $this->getMeta($category));
    }

    private function basicPage($category)
    {
        return view('frontvue.about', compact('category'))
            ->with('meta', $this->getMeta($category));
    }

    public function services($category){
        // dd('ranjit');
        $services = Services::latest()->paginate('10');
        // dd($services);
        return view('frontend.services', compact('category', 'services'))
            ->with('meta', $this->getMeta($category));
    }

    private function getMeta($meta = [])
    {
        return [
            'meta_title' => $meta['meta_title']  ?? $meta['title'] ?? config('settings.name'),
            'meta_keyword' => $meta['meta_keywords']  ?? config('settings.meta_keyword'),
            'meta_description' => $meta['meta_description']  ?? config('settings.meta_description'),
            'meta_keyphrase' =>  $meta['meta_keyphrase'] ?? config('settings.meta_description'),
            'og_image' => $meta['image'] ?? config('settings.og_image'),
            'og_url' => route('index'),
            'og_site_name' => config('settings.name'),
            'twitter' => config('settings.twitter'),
        ];
    }

    private function getSuitableMeta($data)
    {
        return Str::limit(strip_tags($data), 180, '...');
    }
}
