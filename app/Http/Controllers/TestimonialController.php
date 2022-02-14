<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $testimonials = Testimonial::latest()->paginate(10);
        return view('backend.testimonial.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'company'=>'required',
            'staff_name'=>'required',
            'staff_position' => 'required',
            'title'=>'required',
            'message'=>'required',
            'active' => ''
        ]);

        $image = '';
        if($request->hasfile('image'))
        {
            $image = $request->file('image');
            $image = $image->store('image', 'uploads');
        }

        $active = 0;
        if($request['active'] != null)
        {
            $active = 1;
        }


        $testimonial = Testimonial::create([
            'company'=>$request['company'],
            'staff_name'=>$request['staff_name'],
            'staff_position'=>$request['staff_position'],
            'title'=>$request['title'],
            'image' => $image,
            'message'=>$request['message'],
            'status' => $active
        ]);
        $testimonial->save();

        return redirect()->route('testimonial.index')->with('success', 'Testimonial is created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $testimonial = Testimonial::findorfail($id);
        return view('backend.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $testimonial = Testimonial::findorfail($id);
        $this->validate($request, [
            'company'=>'required',
            'staff_name'=>'required',
            'staff_position' => 'required',
            'title'=>'required',
            'message'=>'required',
            'active' => ''
        ]);

        $image = '';
        if($request->hasfile('image'))
        {
            $image = $request->file('image');
            $image = $image->store('image', 'uploads');
        }else{
            $image = $testimonial->image;
        }

        $active = 0;
        if($request['active'] != null)
        {
            $active = 1;
        }

        $testimonial->update([
            'company'=>$request['company'],
            'staff_name'=>$request['staff_name'],
            'staff_position'=>$request['staff_position'],
            'title'=>$request['title'],
            'image' => $image,
            'message'=>$request['message'],
            'status' => $active
        ]);
        $testimonial->save();

        return redirect()->route('testimonial.index')->with('success', 'Testimonial is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $testimonial = Testimonial::findorfail($id);
        $testimonial->delete();
        return redirect()->route('testimonial.index')->with('success', 'Testimonial deleted successfully');
    }
}
