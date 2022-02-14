<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Services::latest()->paginate(10);
        return view('backend.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'cover_image' => 'mimes:png,jpg,jpeg',
            'icon' => 'image|mimes:png,jpg,jpeg,svg',
            'banner_image' => 'image|mimes:png,jpg,jpeg',
            'title'    => 'required',
            'content'    => 'required',
            'meta_title'  => '',
            'meta_keywords'  => '',
            'meta_description'  => '',
            'og_image' => 'mimes:png,jpg,jpeg',
        ]);

        $cover_image = '';
        if($request->hasfile('cover_image'))
        {
            $image = $request->file('cover_image');
            $cover_image = $image->store('cover_image', 'uploads');
        }

        $icon = '';
        if($request->hasfile('icon'))
        {
            $image = $request->file('icon');
            $icon = $image->store('services_icon', 'uploads');
        }

        $banner_image = '';
        if($request->hasfile('banner_image'))
        {
            $image = $request->file('banner_image');
            $banner_image = $image->store('services_banner_image', 'uploads');
        }

        $og_image = '';
        if($request->hasfile('og_image'))
        {
            $image = $request->file('og_image');
            $og_image = $image->store('og_image', 'uploads');
        }

        $services = Services::create([
            'cover_image' => $cover_image,
            'title' => $request['title'],
            'slug' => Str::slug($request->title),
            'content' => $request['content'],
            'icon' => $icon,
            'banner_image' => $banner_image,

            'meta_title' => $request['meta_title'],
            'meta_keywords' => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
            'og_image' => $og_image,
        ]);

        $services->save();

        return redirect()->route('services.index')->with('success', 'Service information is created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Services::findorFail($id);
        return view('backend.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existing_service = Services::findorFail($id);
        $this->validate($request, [
            'cover_image' => 'mimes:png,jpg,jpeg',
            'icon' => 'image|mimes:png,svg',
            'banner_image' => 'image|mimes:png,jpg,jpeg',
            'title'    => 'required',
            'content'    => 'required',
            'meta_title'  => '',
            'meta_keywords'  => '',
            'meta_description'  => '',
            'og_image' => 'mimes:png,jpg,jpeg',
        ]);

        $cover_image = '';
        if($request->hasfile('cover_image'))
        {
            $image = $request->file('cover_image');
            $cover_image = $image->store('cover_image', 'uploads');
        }
        else
        {
            $cover_image = $existing_service->cover_image;
        }

        $icon = '';
        if($request->hasfile('icon'))
        {
            $image = $request->file('icon');
            $icon = $image->store('services_icon', 'uploads');
        }else{
            $icon = $existing_service->icon;
        }

        $banner_image = '';
        if($request->hasfile('banner_image'))
        {
            $image = $request->file('banner_image');
            $banner_image = $image->store('services_banner_image', 'uploads');
        }else{
            $banner_image = $existing_service->banner_image;
        }

        $og_image = '';
        if($request->hasfile('og_image'))
        {
            $image = $request->file('og_image');
            $og_image = $image->store('og_image', 'uploads');
        }
        else
        {
            $og_image = $existing_service->og_image;
        }

        $existing_service->update([
            'cover_image' => $cover_image,
            'title' => $request['title'],
            'slug' => Str::slug($request->title),
            'content' => $request['content'],
            'icon' => $icon,
            'banner_image' => $banner_image,

            'meta_title' => $request['meta_title'],
            'meta_keywords' => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
            'og_image' => $og_image,
        ]);

        return redirect()->route('services.index')->with('success', 'Service information is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existing_service = Services::findorFail($id);
        Storage::disk('uploads')->delete($existing_service->cover_image);
        Storage::disk('uploads')->delete($existing_service->icon);
        Storage::disk('uploads')->delete($existing_service->banner_image);

        $existing_service->delete();

        return redirect()->route('services.index')->with('success', 'Service information deleted successfully.');
    }
}
