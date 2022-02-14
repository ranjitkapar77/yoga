<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLevel;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = Course::latest()->paginate();
        $destination = Destination::get();
        return view('backend.course.index', compact('course','destination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course_categories = CourseCategory::latest()->where('publish_status', '1')->where('delete_status', '0')->get();
        $course_destination = Destination::latest()->where('publish_status', '1')->where('delete_status', '0')->get();
        $level = CourseLevel::latest()->where('publish_status', '1')->where('delete_status', '0')->get();
        return view('backend.course.create', compact('course_categories', 'course_destination', 'level'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'image' => 'mimes:png,jpg,jpeg',
            'banner_image' => 'mimes:png,jpg,jpeg',
            'course_category' => 'required',
            'title' => 'required',
            // 'content'=>'required',
            // 'description'=>'required',
        ]);

        $course_image = '';
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $course_image = $image->store('course_image', 'uploads');
        }

        $banner_image = '';
        if ($request->hasfile('banner_image')) {
            $image = $request->file('banner_image');
            $banner_image = $image->store('course_image', 'uploads');
        }

        $publish_status = '0';
        if ($request['publish_status'] != null) {
            $publish_status = '1';
        }



        $courses = Course::create([
            'image' => $course_image,
            'banner_image' => $banner_image,
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'course_category' => $request->course_category,
            'destination' => $request->destination,
            'course_level' => $request->course_level,
            'slug' => Str::slug($request['title']),
            'description' => $request->description,
            'content' => $request->content,
            'publish_status' => $publish_status,
            'month_intake' => $request->month_intake,
            'course_duration' => $request->course_duration,
            'qualification' => $request->qualification,
            'visa_duration' => $request->visa_duration,
            'course_fee' => $request->course_fee,
            'requirements' => $request->requirements,
            'youtube_link' => $request->youtube_link,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'delete_status' => '0',
            'show_in_menu' => $request->show_in_menu

        ]);
        // dd($courses);
        $courses->save();
        return redirect()->route('courses.index')->with('success', 'Course Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courses = Course::findorfail($id);
        $dselected = $courses->destination;
        $cselected = $courses->course_category;
        $level = CourseLevel::latest()->where('publish_status', '1')->where('delete_status', '0')->get();
        // dd($cselected);
        $course_categories = CourseCategory::latest()->where('publish_status', '1')->where('delete_status', '0')->get();
        $course_destination = Destination::latest()->where('publish_status', '1')->where('delete_status', '0')->get();
        return view('backend.course.edit', compact('courses', 'level', 'course_categories', 'course_destination','dselected', 'cselected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $courses = Course::findorfail($id);
        $data = $this->validate($request, [
            'image' => 'image|mimes:png,jpg,jpeg',
            'banner_image' => 'image|mimes:png,jpg,jpeg',
            'course_category' => 'required',
            'title' => 'required',
            // 'content'=>'required',
            // 'description'=>'required',
        ]);

        $image = '';
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $image = $image->store('course_image', 'uploads');
        } else {
            $image = $courses->image;
        }

        $banner_image = '';
        if ($request->hasfile('banner_image')) {
            $image = $request->file('banner_image');
            $banner_image = $image->store('course_image', 'uploads');
        } else {
            $banner_image = $courses->banner_image;
        }

        $publish_status = '0';
        if ($request['publish_status'] != null) {
            $publish_status = '1';
        }

        $slug = Str::slug($data['title']);

        $courses->update([
            'image' => $image,
            'banner_image' => $banner_image,
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'course_category' => $request->course_category,
            'destination' => $request->destination,
            'course_level' => $request->course_level,
            'slug' => $slug,
            'description' => $request->description,
            'content' => $request->content,
            'month_intake' => $request->month_intake,
            'course_duration' => $request->course_duration,
            'qualification' => $request->qualification,
            'visa_duration' => $request->visa_duration,
            'course_fee' => $request->course_fee,
            'requirements' => $request->requirements,
            'youtube_link' => $request->youtube_link,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'publish_status' => $publish_status,
            'delete_status' => '0',
            'show_in_menu' => $request->show_in_menu
        ]);
        // dd($courses);
        $courses->save();
        return redirect()->route('courses.index')->with('success', 'Courses Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $courses = Course::findorfail($id);
        Storage::disk('uploads')->delete($courses->image);
        Storage::disk('uploads')->delete($courses->banner_image);
        $courses->delete();
        return redirect()->route('courses.index')->with('success', 'Couses Successfully deleted');
    }
}
