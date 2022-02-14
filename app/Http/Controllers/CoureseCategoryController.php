<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class CoureseCategoryController extends Controller
{
    public function index()
    {
        $course = CourseCategory::latest()->where('delete_status', '0')->paginate();
        return view('backend.coursecategory.index', compact('course'));
    }

    public function create()
    {
        return view('backend.coursecategory.create');
    }

    public function store(Request $request){

        $this->validate($request, [
            'title'=>'required',
            'image' => 'mimes:png,jpg,jpeg,svg',
            'front_image' => 'mimes:png,jpg,jpeg,svg',
            'publish_status' => ''
        ]);
        // dd($request);
        $image = '';
        if($request->hasfile('image'))
        {
            $image = $request->file('image');
            $image = $image->store('image', 'uploads');
        }
        $front_image = '';
        if($request->hasfile('front_image'))
        {
            $front_image = $request->file('front_image');
            $front_image = $front_image->store('front_image', 'uploads');
        }

        $publish_status = '0';
        if($request['publish_status'] != null)
        {
            $publish_status = '1';
        }

        $category = CourseCategory::create([
            'title' => $request['title'],
            'slug' => Str::slug($request['title']),
            'description' => $request['description'],
            'image' => $image,
            'front_image' => $front_image,
            'publish_status' => $publish_status,
            'delete_status' => '0'
        ]);
        // dd($category);
        $category->save();

        return redirect()->route('coursecategory.index')->with('success', 'category is created successfully.');

    }

    public function edit($id)
    {
        $category = CourseCategory::findorFail($id);
        return view('backend.coursecategory.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $existing_category = CourseCategory::findorFail($id);

        $this->validate($request, [
            'title'=>'required',
            'image' => 'mimes:png,jpg,jpeg,svg',
            'front_image' => 'mimes:png,jpg,jpeg,svg',
            'publish_status' => ''
        ]);

        $image = '';
        if($request->hasfile('image'))
        {
            Storage::disk('uploads')->delete($existing_category->image);
            $image = $request->file('image');
            $image = $image->store('image', 'uploads');
        }
        else
        {
            $image = $existing_category->image;
        }

        $front_image = '';
        if($request->hasfile('front_image'))
        {
            Storage::disk('uploads')->delete($existing_category->front_image);
            $front_image = $request->file('front_image');
            $front_image = $front_image->store('front_image', 'uploads');
        }
        else
        {
            $front_image = $existing_category->front_image;
        }

        $publish_status = '0';
        if($request['publish_status'] != null)
        {
            $publish_status = '1';
        }

        $existing_category->update([
            'title' => $request['title'],
            'sub_title' => $request['sub_title'],
            'image' => $image,
            'front_image' => $front_image,
            'publish_status' => $publish_status,
            'delete_status' => '0'
        ]);

        return redirect()->route('coursecategory.index')->with('success', 'Category is updated successfully.');
    }

    public function destroy($id)
    {
        $existing_category = CourseCategory::findorFail($id);
        $existing_category->update([
            'delete_status' => '1'
        ]);

        return redirect()->route('coursecategory.index')->with('success', 'category is deleted successfully.');
    }




}
