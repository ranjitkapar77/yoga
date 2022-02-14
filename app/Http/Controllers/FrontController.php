<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumImages;
use App\Models\Downloads;
use App\Models\Menu;
use App\Models\MissionMessages;
use App\Models\News;
use App\Models\Partners;
use App\Models\Pricing;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Services;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Extra;
use App\Models\Country;
use App\Models\Course;
use App\Models\Destination;
use App\Models\Learn;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\ChooseUs;
use App\Models\CourseCategory;
use App\Models\Subscribers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function index()
    {
        // $first_slider = Slider::latest()->where('is_active', 1)->first();
        $sliders = Slider::where('is_active', 1)->get();
        $company_mission = MissionMessages::first();
        $setting = Setting::first();
        $partners = Partners::latest()->take(8)->get();
        $services = Services::latest()->take(8)->get();
        $products = Product::latest()->take(6)->get();
        $courses = Course::latest()->take(6)->get();


        $about_part = strip_tags($setting->aboutus);
        $description = substr($about_part, 0 ,200). "..";
        $header_menus = Menu::where('header_footer', 1)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
        $footer_menus = Menu::where('header_footer', 2)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
        $testimonials = Testimonial::latest()->get();
        $pricings = Pricing::latest()->with('planfeatures')->where('status', 1)->take(4)->get();
        $clients = Partners::latest()->get();
        $clientcount = count($clients);
        $news = News::latest()->take(3)->get();
        $teams = Team::latest()->take(4)->get();

        $extras = Extra::get();
        $learns = Learn::latest()->get();
        $country_name = Country::with('getDestination')->get();
        $choose_us = ChooseUs::latest()->get();
        // dd($country_name);


        $meta = [
            'meta_title' => $setting->meta_title ? $setting->meta_title : $setting->company_name,
            'meta_keyword' => $setting->meta_keywords ? $setting->meta_keywords : $setting->company_name,
            'meta_description' => $setting->meta_description ? $setting->meta_description : $description,
            'meta_keyphrase' => $setting->meta_title ? $setting->meta_title : $setting->company_name,
            'og_image' => $setting->og_image ? Storage::disk('uploads')->url($setting->og_image) : Storage::disk('uploads')->url($setting->company_favicon),
            'og_url' => route('index'),
            'og_site_name' => $setting->company_name,
        ];

        return view('frontend.index', compact('choose_us','country_name','teams','learns', 'courses','extras','meta', 'header_menus', 'footer_menus', 'sliders', 'partners', 'setting', 'company_mission', 'services', 'products', 'testimonials', 'pricings','clients', 'clientcount', 'news'));
    }

    public function pageSlug($slug)
    {
        if ($slug == "home")
        {
            return redirect()->route('index');
        }
        else if($slug == "about")
        {
            $data = Menu::where('category_slug', $slug)->first();
            $setting = Setting::first();
            $banner_image = $data->banner_image;
            $mission_vision = MissionMessages::first();

            $about_part = strip_tags($setting->aboutus);
            $description = substr($about_part, 0 ,200). "..";

            $header_menus = Menu::where('header_footer', 1)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
            $footer_menus = Menu::where('header_footer', 2)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
            $meta = [
                'meta_title' => $data->meta_title ? $data->meta_title : $data->name,
                'meta_keyword' => $data->meta_keywords ? $data->meta_keywords : $data->name,
                'meta_description' => $data->meta_description ? $data->meta_description : $description,
                'meta_keyphrase' => $data->meta_keywords ? $data->meta_keywords : $data->name,
                'og_image' => Storage::disk('uploads')->url($data->og_image ? $data->og_image : $setting->company_favicon),
                'og_url' => route('pageSlug', $slug),
                'og_site_name' => $setting->company_name,
            ];
            return view('frontend.about', compact('meta', 'banner_image', 'header_menus', 'footer_menus', 'setting', 'mission_vision'));
        }
        else if($slug == "contact")
        {
            $data = Menu::where('category_slug', $slug)->first();
            $setting = Setting::first();
            $banner_image = $data->banner_image;
            $about_part = strip_tags($setting->aboutus);
            $description = substr($about_part, 0 ,200). "..";
            $header_menus = Menu::where('header_footer', 1)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
            $footer_menus = Menu::where('header_footer', 2)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
            $meta = [
                'meta_title' => $data->meta_title ? $data->meta_title : $data->name,
                'meta_keyword' => $data->meta_keywords ? $data->meta_keywords : $data->name,
                'meta_description' => $data->meta_description ? $data->meta_description : $description,
                'meta_keyphrase' => $data->meta_keywords ? $data->meta_keywords : $data->name,
                'og_image' => Storage::disk('uploads')->url($data->og_image ? $data->og_image : $setting->company_favicon),
                'og_url' => route('pageSlug', $slug),
                'og_site_name' => $setting->company_name,
            ];
            return view('frontend.contact', compact('setting','banner_image', 'header_menus', 'footer_menus', 'meta'));
        }

        else if($slug == "gallery")
        {
            $data = Menu::where('category_slug', $slug)->first();
            $setting = Setting::first();
            $banner_image = $data->banner_image;
            $about_part = strip_tags($setting->aboutus);
            $description = substr($about_part, 0 ,200). "..";
            $header_menus = Menu::where('header_footer', 1)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
            $footer_menus = Menu::where('header_footer', 2)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
            $meta = [
                'meta_title' => $data->meta_title ? $data->meta_title : $data->name,
                'meta_keyword' => $data->meta_keywords ? $data->meta_keywords : $data->name,
                'meta_description' => $data->meta_description ? $data->meta_description : $description,
                'meta_keyphrase' => $data->meta_keywords ? $data->meta_keywords : $data->name,
                'og_image' => Storage::disk('uploads')->url($data->og_image ? $data->og_image : $setting->company_favicon),
                'og_url' => route('pageSlug', $slug),
                'og_site_name' => $setting->company_name,
            ];
            $albums = Album::latest()->get();
            return view('frontend.gallery', compact('albums', 'banner_image', 'header_menus', 'footer_menus', 'meta'));
        }

        else if($slug == "team")
        {
            $data = Menu::where('category_slug', $slug)->first();
            $setting = Setting::first();
            $banner_image = $data->banner_image;
            $about_part = strip_tags($setting->aboutus);
            $description = substr($about_part, 0 ,200). "..";
            $header_menus = Menu::where('header_footer', 1)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
            $footer_menus = Menu::where('header_footer', 2)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
            $meta = [
                'meta_title' => $data->meta_title ? $data->meta_title : $data->name,
                'meta_keyword' => $data->meta_keywords ? $data->meta_keywords : $data->name,
                'meta_description' => $data->meta_description ? $data->meta_description : $description,
                'meta_keyphrase' => $data->meta_keywords ? $data->meta_keywords : $data->name,
                'og_image' => Storage::disk('uploads')->url($data->og_image ? $data->og_image : $setting->company_favicon),
                'og_url' => route('pageSlug', $slug),
                'og_site_name' => $setting->company_name,
            ];
            $teams = Team::orderBy('in_order', 'Asc')->get();

            return view('frontend.team', compact('meta', 'banner_image', 'header_menus', 'footer_menus', 'teams', 'setting'));
        }
        else if($slug == "pricing-and-plans")
        {
            $data = Menu::where('category_slug', $slug)->first();
            $setting = Setting::first();
            $banner_image = $data->banner_image;
            $about_part = strip_tags($setting->aboutus);
            $description = substr($about_part, 0 ,200). "..";
            $header_menus = Menu::where('header_footer', 1)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
            $footer_menus = Menu::where('header_footer', 2)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
            $meta = [
                'meta_title' => $data->meta_title ? $data->meta_title : $data->name,
                'meta_keyword' => $data->meta_keywords ? $data->meta_keywords : $data->name,
                'meta_description' => $data->meta_description ? $data->meta_description : $description,
                'meta_keyphrase' => $data->meta_keywords ? $data->meta_keywords : $data->name,
                'og_image' => Storage::disk('uploads')->url($data->og_image ? $data->og_image : $setting->company_favicon),
                'og_url' => route('pageSlug', $slug),
                'og_site_name' => $setting->company_name,
            ];
            $plans = Pricing::latest()->with('planfeatures')->get();

            return view('frontend.plans', compact('meta', 'banner_image', 'header_menus', 'footer_menus', 'plans', 'setting'));
        }
        else if($slug == "services")
        {
            $data = Menu::where('category_slug', $slug)->first();
            $setting = Setting::first();
            $banner_image = $data->banner_image;

            $about_part = strip_tags($setting->aboutus);
            $description = substr($about_part, 0 ,200). "..";
            $header_menus = Menu::where('header_footer', 1)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
            $footer_menus = Menu::where('header_footer', 2)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();

            $meta = [
                'meta_title' => $data->meta_title ? $data->meta_title : $data->name,
                'meta_keyword' => $data->meta_keywords ? $data->meta_keywords : $data->name,
                'meta_description' => $data->meta_description ? $data->meta_description : $description,
                'meta_keyphrase' => $data->meta_keywords ? $data->meta_keywords : $data->name,
                'og_image' => Storage::disk('uploads')->url($data->og_image ? $data->og_image : $setting->company_favicon),
                'og_url' => route('pageSlug', $slug),
                'og_site_name' => $setting->company_name,
            ];

            $services = Services::latest();
            return view('frontend.services', compact('services', 'banner_image', 'header_menus', 'footer_menus', 'meta'));
        }
        else if($slug == "blogs")
        {
            $data = Menu::where('category_slug', $slug)->first();
            $setting = Setting::first();
            $banner_image = $data->banner_image;

            $about_part = strip_tags($setting->aboutus);
            $description = substr($about_part, 0 ,200). "..";
            $header_menus = Menu::where('header_footer', 1)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
            $footer_menus = Menu::where('header_footer', 2)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();

            $meta = [
                'meta_title' => $data->meta_title ? $data->meta_title : $data->name,
                'meta_keyword' => $data->meta_keywords ? $data->meta_keywords : $data->name,
                'meta_description' => $data->meta_description ? $data->meta_description : $description,
                'meta_keyphrase' => $data->meta_keywords ? $data->meta_keywords : $data->name,
                'og_image' => Storage::disk('uploads')->url($data->og_image ? $data->og_image : $setting->company_favicon),
                'og_url' => route('pageSlug', $slug),
                'og_site_name' => $setting->company_name,
            ];

            $blogs = News::latest()->paginate(12);
            return view('frontend.blog', compact('blogs', 'banner_image', 'header_menus', 'footer_menus', 'meta', 'setting'));
        }
        else if($slug == "partners")
        {
            $data = Menu::where('category_slug', $slug)->first();
            $setting = Setting::first();
            $banner_image = $data->banner_image;
            $about_part = strip_tags($setting->aboutus);
            $description = substr($about_part, 0 ,200). "..";
            $header_menus = Menu::where('header_footer', 1)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
            $footer_menus = Menu::where('header_footer', 2)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();

            $meta = [
                'meta_title' => $data->meta_title ? $data->meta_title : $data->name,
                'meta_keyword' => $data->meta_keywords ? $data->meta_keywords : $data->name,
                'meta_description' => $data->meta_description ? $data->meta_description : $description,
                'meta_keyphrase' => $data->meta_keywords ? $data->meta_keywords : $data->name,
                'og_image' => Storage::disk('uploads')->url($data->og_image ? $data->og_image : $setting->company_favicon),
                'og_url' => route('pageSlug', $slug),
                'og_site_name' => $setting->company_name,
            ];

            $partners = Partners::latest()->paginate(12);
            return view('frontend.partner', compact('partners', 'banner_image', 'header_menus', 'footer_menus', 'meta', 'setting'));
        }
        else
        {
            $album = Album::where('title_slug', $slug)->first();
            $service = Services::where('slug', $slug)->first();
            $page = Content::where('content_url', $slug)->first();
            $product = Product::where('slug', $slug)->first();
            $blog = News::where('slug', $slug)->first();

            if ($album)
            {
                $setting = Setting::first();
                $about_part = strip_tags($setting->aboutus);
                $description = substr($about_part, 0 ,200). "..";
                $header_menus = Menu::where('header_footer', 1)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
                $footer_menus = Menu::where('header_footer', 2)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();

                $meta = [
                    'meta_title' => $album->meta_title ? $album->meta_title : $album->album_title,
                    'meta_keyword' => $album->meta_keywords ? $album->meta_keywords : $album->album_title,
                    'meta_description' => $album->meta_description ? $album->meta_description : $description,
                    'meta_keyphrase' => $album->meta_keywords ? $album->meta_keywords : $album->album_title,
                    'og_image' => Storage::disk('uploads')->url($album->og_image ? $album->og_image : $setting->company_favicon),
                    'og_url' => route('pageSlug', $slug),
                    'og_site_name' => $setting->company_name,
                ];

                $albums = Album::latest()->get();

                $album_images = AlbumImages::latest()->where('album_id', $album->id)->get();
                return view('frontend.gallery_details', compact('album', 'album_images','header_menus', 'footer_menus', 'meta'));
            }
            else if($service)
            {

                $setting = Setting::first();
                $about_part = strip_tags($setting->aboutus);
                $description = substr($about_part, 0 ,200). "..";
                $header_menus = Menu::where('header_footer', 1)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
                $footer_menus = Menu::where('header_footer', 2)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();

                $meta = [
                    'meta_title' => $service->meta_title ? $service->meta_title : $service->title,
                    'meta_keyword' => $service->meta_keywords ? $service->meta_keywords : $service->title,
                    'meta_description' => $service->meta_description ? $service->meta_description : $description,
                    'meta_keyphrase' => $service->meta_keywords ? $service->meta_keywords : $setting->company_name,
                    'og_image' => Storage::disk('uploads')->url($service->og_image ? $service->og_image : $setting->company_favicon),
                    'og_url' => route('pageSlug', $slug),
                    'og_site_name' => $setting->company_name,
                ];
                $all_services = Services::latest()->get();

                return view('frontend.details', compact('service', 'meta', 'all_services','header_menus', 'footer_menus', 'setting'));
            }
            else if($page)
            {

                $setting = Setting::first();
                $about_part = strip_tags($setting->aboutus);
                $description = substr($about_part, 0 ,200). "..";
                $header_menus = Menu::where('header_footer', 1)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
                $footer_menus = Menu::where('header_footer', 2)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();

                $meta = [
                    'meta_title' => $service->meta_title ? $service->meta_title : $service->title,
                    'meta_keyword' => $service->meta_keywords ? $service->meta_keywords : $service->title,
                    'meta_description' => $service->meta_description ? $service->meta_description : $description,
                    'meta_keyphrase' => $service->meta_keywords ? $service->meta_keywords : $setting->company_name,
                    'og_image' => Storage::disk('uploads')->url($service->og_image ? $service->og_image : $setting->company_favicon),
                    'og_url' => route('pageSlug', $slug),
                    'og_site_name' => $setting->company_name,
                ];
                $all_services = Services::latest()->get();

                return view('frontend.details', compact('service', 'meta', 'all_services','header_menus', 'footer_menus', 'setting'));
            }
            else if($blog)
            {

                $setting = Setting::first();
                $about_part = strip_tags($setting->aboutus);
                $description = substr($about_part, 0 ,200). "..";
                $header_menus = Menu::where('header_footer', 1)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
                $footer_menus = Menu::where('header_footer', 2)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();

                $meta = [
                    'meta_title' => $blog->meta_title ? $blog->meta_title : $blog->title,
                    'meta_keyword' => $blog->meta_keywords ? $blog->meta_keywords : $blog->title,
                    'meta_description' => $blog->meta_description ? $blog->meta_description : $description,
                    'meta_keyphrase' => $blog->meta_keywords ? $blog->meta_keywords : $setting->company_name,
                    'og_image' => Storage::disk('uploads')->url($blog->og_image ? $blog->og_image : $setting->company_favicon),
                    'og_url' => route('pageSlug', $slug),
                    'og_site_name' => $setting->company_name,
                ];
                $all_blogs = News::latest()->get();
                $all_services = Services::latest()->take(5)->get();
                $recent_blogs = News::latest()->take(5)->get();
                $related_blogs = News::where('slug', '!=', $blog->slug)->orderBy(DB::raw('RAND(3)'))->get();

                return view('frontend.singleblog', compact('blog', 'meta', 'all_blogs', 'all_services','recent_blogs','related_blogs','header_menus', 'footer_menus', 'setting'));
            }
            else if($product)
            {
                $setting = Setting::first();
                $about_part = strip_tags($setting->aboutus);
                $description = substr($about_part, 0 ,200). "..";
                $header_menus = Menu::where('header_footer', 1)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();
                $footer_menus = Menu::where('header_footer', 2)->orWhere('header_footer', 3)->orderBy('position', 'ASC')->get();

                $meta = [
                    'meta_title' => $product->meta_title ? $product->meta_title : $product->name,
                    'meta_keyword' => $product->meta_keywords ? $product->meta_keywords : $product->name,
                    'meta_description' => $product->meta_description ? $product->meta_description : $description,
                    'meta_keyphrase' => $product->meta_keywords ? $product->meta_keywords : $setting->company_name,
                    'og_image' => Storage::disk('uploads')->url($product->og_image ? $product->og_image : $setting->company_favicon),
                    'og_url' => route('pageSlug', $slug),
                    'og_site_name' => $setting->company_name,
                ];
                $product_images = ProductImages::where('product_id', $product->id)->get();
                $related_products = Product::latest()->where('brand_id', $product->brand_id)->where('id', '!=', $product->id)->take(5)->get();

                return view('frontend.productDetails', compact('product', 'meta', 'setting', 'product_images','header_menus', 'footer_menus', 'related_products'));
            }
            else
            {
                return redirect()->route('index');
            }
        }
    }

}
