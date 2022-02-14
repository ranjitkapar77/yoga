<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\AdminSubscriberMail;
use App\Mail\TestPreprationBookingMail;
use App\Mail\UserSubmissionMail;
use App\Mail\UserSubscriberMail;
use App\Mail\UserTestPreprationBookingMail;
use App\Models\Content;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLevel;
use App\Models\Destination;
use App\Models\Learn;
use App\Models\News;
use App\Models\Setting;
use App\Models\Subscribers;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\MailMessages;
use App\Models\Services;
use App\Models\TestPreprationBooking;
use Illuminate\Support\Facades\Storage;

class FrontDetailsController extends Controller
{
    public function AllCourse(){

        $setting = Setting::first();
        $courses = Course::latest()->paginate(9);
        $destinations = Destination::get();

        $meta = [
            'meta_title' => 'Courses-' .$setting->company_name,
            'meta_keyword' => $setting->meta_keywords ? $setting->meta_keywords : $setting->company_name,
            'meta_description' => $setting->meta_description ? $setting->meta_description : 'Courses',
            'meta_keyphrase' => $setting->meta_title ? $setting->meta_title : $setting->company_name,
            'og_image' => $setting->og_image ? Storage::disk('uploads')->url($setting->og_image) : Storage::disk('uploads')->url($setting->company_favicon),
            'og_url' => route('index'),
            'og_site_name' => $setting->company_name,
        ];

        return view('frontend.course.list', compact('courses', 'destinations', 'meta'));
    }
    public function courseDetails($slug)
    {
        $setting = Setting::first();
        $details = Course::where('slug',$slug)->firstorfail();
        $banner_image = $details->banner_image;
        $recentCourse = Course::where('id', '!=', $details->id)->where('publish_status', '1')->where('delete_status', '0')->take(3)->get();
        $destination = Destination::whereIn('id',$details->destination)->get();
        $destinations = Destination::get();
        // dd($destination);
        // dd($recentCourse);
        $meta = [
            'meta_title' => $details->meta_title ? $details->meta_title : $details->title,
            'meta_keyword' => $details->meta_keywords ? $details->meta_keywords : $details->title,
            'meta_description' => $details->meta_description ? $details->meta_description  : $setting->mata_description,
            'meta_keyphrase' => $details->title ? $details->title : $setting->company_name,
            'og_image' => $details->image ? Storage::disk('uploads')->url($details->image) : Storage::disk('uploads')->url($setting->company_favicon),
            'og_url' => route('index', $details->slug),
            'og_site_name' => $setting->company_name,
        ];
        return view('frontend.course.detail', compact('details', 'banner_image', 'recentCourse', 'destination', 'destinations', 'meta'));

    }

    public function getDestination()
    {

        $setting = Setting::first();
        $allDestination = Destination::where('publish_status', '1')->where('delete_status', '0')->latest()->get();
        $title = "All Destinations";
        $meta = [
            'meta_title' => 'Destinations-' .$setting->company_name,
            'meta_keyword' => $setting->meta_keywords ? $setting->meta_keywords : $setting->company_name,
            'meta_description' => $setting->meta_description ? $setting->meta_description : 'Destinations',
            'meta_keyphrase' => $setting->meta_title ? $setting->meta_title : $setting->company_name,
            'og_image' => $setting->og_image ? Storage::disk('uploads')->url($setting->og_image) : Storage::disk('uploads')->url($setting->company_favicon),
            'og_url' => route('index'),
            'og_site_name' => $setting->company_name,
        ];
        // dd($allDestination);
        return view('frontend.destinations', compact('allDestination', 'title'));
    }

    public function getNews()
    {
        $setting = Setting::first();
        $blogs = News::latest()->paginate('10');
        $title = 'All Blogs';
        $meta = [
            'meta_title' => 'Blogs-' .$setting->company_name,
            'meta_keyword' => $setting->meta_keywords ? $setting->meta_keywords : $setting->company_name,
            'meta_description' => $setting->meta_description ? $setting->meta_description : 'Blogs',
            'meta_keyphrase' => $setting->meta_title ? $setting->meta_title : $setting->company_name,
            'og_image' => $setting->og_image ? Storage::disk('uploads')->url($setting->og_image) : Storage::disk('uploads')->url($setting->company_favicon),
            'og_url' => route('index'),
            'og_site_name' => $setting->company_name,
        ];
        return view('frontend.blog', compact('blogs', 'title', 'meta'));
    }

    public function courseByDestination($slug)
    {
        $setting = Setting::first();
        $destination = Destination::where('slug', $slug)->firstorfail();
        $destinationId = "%\"".$destination->id."\"%";
        $courses = Course::where('publish_status', '1')->where('delete_status', '0')->where('destination', "like",$destinationId)->get();
        // dd($courses);

        $meta = [
            'meta_title' => $destination->title ? $destination->title : $setting->meta_title,
            'meta_keyword' => $destination->title ? $destination->title : $setting->meta_keyword,
            'meta_description' => $destination->meta_description ? $destination->meta_description  : $setting->mata_description,
            'meta_keyphrase' => $destination->title ? $destination->title : $setting->company_name,
            'og_image' => $destination->image ? Storage::disk('uploads')->url($destination->image) : Storage::disk('uploads')->url($setting->company_favicon),
            'og_url' => route('index', $destination->slug),
            'og_site_name' => $setting->company_name,
        ];

        return view('frontend.course.destination', compact('destination','courses', 'meta'));
    }

    public function newsDetails($slug)
    {
        $setting = Setting::first();
        $news = News::where('slug', $slug)->firstorfail();
        $news->incrementReadCount();
        $recentPost = News::latest()->where('id', '!=', $news->id)->take(6)->get();
        $popularPost = News::orderBy('view_count', 'DESC')->get();
        $meta = [
            'meta_title' => $news->meta_title ? $news->meta_title : $setting->meta_title,
            'meta_keyword' => $news->meta_keywords ? $news->meta_keywords : $setting->meta_keyword,
            'meta_description' => $news->meta_description ? $news->meta_description  : $setting->mata_description,
            'meta_keyphrase' => $news->title ? $news->title : $setting->company_name,
            'og_image' => $news->banner_image ? Storage::disk('uploads')->url($news->banner_image) : Storage::disk('uploads')->url($setting->company_favicon),
            'og_url' => route('index', $news->slug),
            'og_site_name' => $setting->company_name,
        ];

        return view('frontend.news.details', compact('setting', 'news', 'recentPost', 'popularPost', 'meta'));
    }

    public function serviceDetails($slug)
    {
        $setting = Setting::first();
        $services = Services::where('slug', $slug)->firstorfail();
        $meta = [
            'meta_title' => $services->meta_title ? $services->meta_title : $setting->meta_title,
            'meta_keyword' => $services->meta_keywords ? $services->meta_keywords : $setting->meta_keyword,
            'meta_description' => $services->meta_description ? $services->meta_description  : $setting->mata_description,
            'meta_keyphrase' => $services->title ? $services->title : $setting->company_name,
            'og_image' => $services->banner_image ? Storage::disk('uploads')->url($services->banner_image) : Storage::disk('uploads')->url($setting->company_favicon),
            'og_url' => route('index', $services->slug),
            'og_site_name' => $setting->company_name,
        ];

        return view('frontend.services.details', compact('setting', 'services', 'meta'));
    }

    public function contentDetails($slug)
    {
        $setting = Setting::first();
        $content = Content::where('content_url', $slug)->firstorfail();
        $faq = Content::latest()->where('content_type', 'Faq')->where('publish_status', '1')->where('delete_status', '0')->take(5)->get();
        $contenttype = $content->content_type;
        $meta = [
            'meta_title' => $content->meta_title ? $content->meta_title : $setting->meta_title,
            'meta_keyword' => $content->meta_keywords ? $content->meta_keywords : $setting->meta_keyword,
            'meta_description' => $content->meta_description ? $content->meta_description  : $setting->mata_description,
            'meta_keyphrase' => $content->title ? $content->title : $setting->company_name,
            'og_image' => $content->featured_img ? Storage::disk('uploads')->url($content->featured_img) : Storage::disk('uploads')->url($setting->company_favicon),
            'og_url' => route('index', $content->content_url),
            'og_site_name' => $setting->company_name,
        ];
        if($contenttype == 'Why'){
            return view('frontend.content.why', compact('content', 'faq', 'meta'));
        }else{
            return view('frontend.content.details', compact('content', 'meta'));
        }
    }

    public function allteam()
    {

        $setting = Setting::first();
        $team = Team::latest()->where('status', '1')->get();
        $meta = [
            'meta_title' => 'Team-' .$setting->company_name,
            'meta_keyword' => $setting->meta_keywords ? $setting->meta_keywords : $setting->company_name,
            'meta_description' => $setting->meta_description ? $setting->meta_description : 'Team',
            'meta_keyphrase' => $setting->meta_title ? $setting->meta_title : $setting->company_name,
            'og_image' => $setting->og_image ? Storage::disk('uploads')->url($setting->og_image) : Storage::disk('uploads')->url($setting->company_favicon),
            'og_url' => route('index'),
            'og_site_name' => $setting->company_name,
        ];
        return view('frontend.team', compact('team', 'meta'));
    }

    public function teamDetails($slug)
    {
        $setting = Setting::first();
        $team = Team::where('slug', $slug)->firstorfail();

        $meta = [
            'meta_title' => $team->name ? $team->name : $setting->meta_title,
            'meta_keyword' => $team->name ? $team->name : $setting->meta_keyword,
            'meta_description' => $team->content ? $team->content  : $setting->mata_description,
            'meta_keyphrase' => $team->name ? $team->name : $setting->company_name,
            'og_image' => $team->image ? Storage::disk('uploads')->url($team->image) : Storage::disk('uploads')->url($setting->company_favicon),
            'og_url' => route('index', $team->slug),
            'og_site_name' => $setting->company_name,
        ];
        return view('frontend.teamdetails', compact('team', 'meta'));
    }

    public function courseBycategory($slug)
    {
        $setting = Setting::first();
        $category = CourseCategory::where('slug', $slug)->firstorfail();
        $categoryId = "%\"".$category->id."\"%";
        $courses = Course::where('publish_status', '1')->where('delete_status', '0')->where('course_category', "like",$categoryId)->get();
        // dd($courses);
        $meta = [
            'meta_title' => $category->title. '-' .$setting->company_name,
            'meta_keyword' => $category->title ? $category->title : $setting->company_name,
            'meta_description' => $category->description ? $category->description  : $setting->mata_description,
            'meta_keyphrase' => $category->title ? $category->title : $setting->company_name,
            'og_image' => $category->icon ? Storage::disk('uploads')->url($category->icon) : Storage::disk('uploads')->url($setting->company_favicon),
            'og_url' => route('index', $category->slug),
            'og_site_name' => $setting->company_name,
        ];

        return view('frontend.course.category', compact('category','courses', 'meta'));
    }

    public function courseByProgram($slug)
    {
        $setting = Setting::first();
        $level = CourseLevel::where('slug', $slug)->firstorfail();
        $courses = Course::latest()->where('course_level', $level->id)->where('publish_status', '1')->where('delete_status', '0')->paginate(9);

        $meta = [
            'meta_title' => $level->title. '-' .$setting->company_name,
            'meta_keyword' => $level->title ? $level->title : $setting->company_name,
            'meta_description' => $level->description ? $level->description  : $setting->mata_description,
            'meta_keyphrase' => $level->title ? $level->title : $setting->company_name,
            'og_image' => $level->icon ? Storage::disk('uploads')->url($level->icon) : Storage::disk('uploads')->url($setting->company_favicon),
            'og_url' => route('index', $level->slug),
            'og_site_name' => $setting->company_name,
        ];
        return view('frontend.course.level', compact('level','courses', 'meta'));
    }

    public function testPrepration(){

        $setting = Setting::first();
        $test = Learn::latest()->where('publish_status', '1')->where('delete_status', '0')->get();

        $meta = [
            'meta_title' => 'Test Prepration-' .$setting->company_name,
            'meta_keyword' => $setting->meta_keywords ? $setting->meta_keywords : $setting->company_name,
            'meta_description' => $setting->meta_description ? $setting->meta_description : 'Test Prepration',
            'meta_keyphrase' => $setting->meta_title ? $setting->meta_title : $setting->company_name,
            'og_image' => $setting->og_image ? Storage::disk('uploads')->url($setting->og_image) : Storage::disk('uploads')->url($setting->company_favicon),
            'og_url' => route('index'),
            'og_site_name' => $setting->company_name,
        ];

        return view('frontend.testprepration.list', compact('test', 'meta'));
    }

    public function testPreprationsDetails($slug)
    {
        $setting = Setting::first();
        $details = Learn::where('slug', $slug)->firstorfail();
        $test = Learn::latest()->where('publish_status', '1')->where('delete_status', '0')->get();
        $destination = Destination::latest()->where('publish_status', '1')->where('delete_status', '0')->get();

        $meta = [
            'meta_title' => $details->title. '-' .$setting->company_name,
            'meta_keyword' => $details->title ? $details->title : $setting->company_name,
            'meta_description' => $details->title ? $details->description  : $setting->meta_description,
            'meta_keyphrase' => $details->title ? $details->title : $setting->company_name,
            'og_image' => $details->icon ? Storage::disk('uploads')->url($details->icon) : Storage::disk('uploads')->url($setting->company_favicon),
            'og_url' => route('index', $details->slug),
            'og_site_name' => $setting->company_name,
        ];

        return view('frontend.testprepration.details', compact('details', 'test', 'destination', 'meta'));
    }



    public function subscribe()
    {
        $setting = Setting::first();
        // dd($setting);
        $data = $this->validate(request(), [
            'email' => 'required|email',
        ]);


        $existing_subscriber = Subscribers::where('email',$data['email'])->first();
        if ($existing_subscriber) {
            return redirect()->back()->with('success', 'You have already subscribed.');
        }

        $receiverAddress = $setting->email;
        // dd($receiverAddress);
        $customerAddress =$data['email'];

        /////////////////Send mail////////////////////////

        Mail::to($receiverAddress)->send(new AdminSubscriberMail($data));

        Mail::to($customerAddress)->send(new UserSubscriberMail($data));

        $subscriber = new Subscribers();

        $subscriber->email = $data['email'];
        $subscriber->is_read = '0';

        $subscriber->save();

        return back()->with('success', 'Thank you for your subscription. We will get back to you soon.');
    }

    public function messagestore(Request $request)
    {
        $new_mail = MailMessages::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'contact_no' => $request['phone'],
            'subject' => $request['subject'],
            'message' => $request['message'],
            'is_read' => 0,
        ]);
        // dd($new_mail);

        $data['email'] = $request['email'];
        $data['name'] = $request['name'];

        $new_mail->save();

        Mail::to($request['email'])->send(new UserSubmissionMail());


        return redirect()->back()->with('success', 'Thank you for your mail. We will get back to you soon.');
    }

    public function testprePrationBooking(Request $request)
    {
        // dd($request);
        $setting = Setting::first();
        $new_booking = TestPreprationBooking::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'testprepration_id' => $request['testprepration_id'],
            'destination_id' => $request['destination_id'],
        ]);
        // dd($new_booking);
        $data['email'] = $request['email'];
        $data['name'] = $request['name'];
        $data['adminMail'] = $setting->email;

        $new_booking->save();
        Mail::to($data['adminMail'])->send(new TestPreprationBookingMail($new_booking));
        Mail::to($data['email'])->send(new UserTestPreprationBookingMail($new_booking));
        return redirect()->back()->with('success', 'Thank you for your Booking. We will get back to you soon.');
    }


}
