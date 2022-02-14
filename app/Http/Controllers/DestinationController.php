<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class DestinationController extends Controller
{
    public function index() {
        $destinations = Destination::latest()->paginate();
        return view('backend.destination.index', compact('destinations'));
    }

    public function create() {
        return view('backend.destination.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'image'=>'mimes:png,jpg,jpeg',
            'title'=>'required',
            // 'sub_title'=>'required',
            // 'content'=>'required',
            // 'description'=>'required',
        ]);

        $image = '';
        if($request->hasfile('image'))
        {
            $image = $request->file('image');
            $image = $image->store('country_image', 'uploads');
        }
        $publish_status = '0';
        if($request['publish_status'] != null)
        {
            $publish_status = '1';
        }


        $slug = Str::slug($data['title']);
        $country = Destination::create([
            'image'=>$image,
            'title'=>$request->title,
            'sub_title'=>$request->sub_title,
            'slug'=>$slug,
            'description'=>$request->description,
            'publish_status' => $publish_status,
            'delete_status' => '0',
            'show_in_menu' => $request->show_in_menu

        ]);
        $country->save();
        return redirect()->route('destination.index')->with('success', 'Destination Successfully Created');
    }

    public function edit($id)
    {
        $country = Country::all();
        $destinations = Destination::findorfail($id);
        return view('backend.destination.edit', compact('destinations','country'));
    }

    public function update(Request $request,$id) {
        $destinations = Destination::findorfail($id);
        $data = $this->validate($request, [
            'image'=>'image|mimes:png,jpg,jpeg',
            'title'=>'required',
            // 'title'=>'required',
            // 'sub_title'=>'required',
            // 'content'=>'required',
            // 'description'=>'required',
        ]);

        $image = '';
        if($request->hasfile('image'))
        {
            $image = $request->file('image');
            $image = $image->store('country_image', 'uploads');
        }else{
            $image = $destinations->image;
        }
        $publish_status = '0';
        if($request['publish_status'] != null)
        {
            $publish_status = '1';
        }

        $slug = Str::slug($data['title']);
        $destinations->update([
            'image'=>$image,
            'title'=>$request->title,
            'description'=>$request->description,
            'slug' => $slug,
            'publish_status' => $publish_status,
            'delete_status' => '0',
            'show_in_menu' => $request->show_in_menu
        ]);
        // dd($destinations);
        $destinations->save();
        return redirect()->route('destination.index')->with('success', 'Destination Successfully Updated');
    }

    public function delete($id)
    {
        $destinations = Destination::findorfail($id);
        Storage::disk('uploads')->delete($destinations->image);
        $destinations->delete();
        return redirect()->route('destination.index')->with('success', 'Destination Successfully deleted');
    }
}
