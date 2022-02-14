<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StudentStory;
use Illuminate\Http\Request;

class StudentStoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student_story = StudentStory::latest()->paginate();
        return view('backend.student_story.index', compact('student_story'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.student_story.create');

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
            'image'=>'image|mimes:png,jpg,jpeg',
            'image_1'=>'image|mimes:png,jpg,jpeg',
            'title'=>'required',
            'sub_title'=>'required',
            'designation'=>'required',
            'description'=>'required',
            'name'=>'required',
            'btn_title'=>'required',
        ]);

        $image = '';
        if($request->hasfile('image'))
        {
            $image = $request->file('image');
            $image = $image->store('image', 'uploads');
        }

        $image_1 = '';
        if($request->hasfile('image_1'))
        {
            $image = $request->file('image_1');
            $image_1 = $image->store('course_image', 'uploads');
        }

        $student_story = StudentStory::create([
            'image'=>$image,
            'image_1'=>$image_1,
            'title'=>$data['title'],
            'sub_title'=>$data['sub_title'],
            'description'=>$data['description'],
            'designation'=>$data['designation'],
            'name'=>$data['name'],
            'btn_title'=>$data['btn_title'],
        ]);
        $student_story->save();
        return redirect()->route('student.index')->with('success', 'Student Successfully Created');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
