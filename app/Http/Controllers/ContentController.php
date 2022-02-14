<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = Content::latest()->where('delete_status', '0')->paginate();
        return view('backend.content.index', compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.content.create');
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
            'featured_img' => 'mimes:png,jpg,jpeg',
            'freezone_img' => 'mimes:png,jpg,jpeg,svg',
            'content_body' => 'required',
            'content_title' => 'required',
            // 'content'=>'required',
            // 'description'=>'required',
        ]);

        $featured_img = '';
        if ($request->hasfile('featured_img')) {
            $featured_img = $request->file('featured_img');
            $featured_img = $featured_img->store('content_image', 'uploads');
        }

        $freezone_img = '';
        if ($request->hasfile('freezone_img')) {
            $image = $request->file('freezone_img');
            $freezone_img = $image->store('content_image', 'uploads');
        }

        $publish_status = '0';
        if ($request['publish_status'] != null) {
            $publish_status = '1';
        }
        $contents = Content::create([
            'featured_img' => $featured_img,
            'freezone_img' => $freezone_img,
            'content_title' => $request->content_title,
            'content_page_title' => $request->content_page_title,
            'content_type' => $request->content_type,
            'meta_description' => $request->meta_description,
            'content_url' => Str::slug($request['content_title']),
            'content_body' => $request->content_body,
            'meta_keywords' => $request->meta_keywords,
            'publish_status' => $publish_status,
            'show_on_menu' => $request->show_on_menu,
            'meta_title' => $request->meta_title,
            'external_link' => $request->external_link,
            'delete_status' => '0'

        ]);
        // dd($contents);
        $contents->save();
        return redirect()->route('content.index')->with('success', 'Content Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = Content::findorfail($id);
        return view('backend.content.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $contents = Content::findorfail($id);
        $data = $this->validate($request, [
            'featured_img' => 'mimes:png,jpg,jpeg,svg',
            'freezone_img' => 'mimes:png,jpg,jpeg',
            'content_body' => 'required',
            'content_title' => 'required',
            // 'content'=>'required',
            // 'description'=>'required',
        ]);

        $featured_img = '';
        if ($request->hasfile('featured_img')) {
            $featured_img = $request->file('featured_img');
            $featured_img = $featured_img->store('content_image', 'uploads');
        }else{
            $featured_img = $contents->featured_img;
        }

        $freezone_img = '';
        if ($request->hasfile('freezone_img')) {
            $image = $request->file('freezone_img');
            $freezone_img = $image->store('content_image', 'uploads');
        }else{
            $freezone_img = $contents->freezone_img;
        }

        $publish_status = '0';
        if ($request['publish_status'] != null) {
            $publish_status = '1';
        }
        $contents->update([
            'featured_img' => $featured_img,
            'freezone_img' => $freezone_img,
            'content_title' => $request->content_title,
            'content_page_title' => $request->content_page_title,
            'content_type' => $request->content_type,
            'meta_description' => $request->meta_description,
            'content_url' => Str::slug($request['content_title']),
            'content_body' => $request->content_body,
            'meta_keywords' => $request->meta_keywords,
            'publish_status' => $publish_status,
            'show_on_menu' => $request->show_on_menu,
            'meta_title' => $request->meta_title,
            'external_link' => $request->external_link,
            'delete_status' => '0'

        ]);
        // dd($contents);
        $contents->save();
        return redirect()->route('content.index')->with('success', 'Content Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existing_content = Content::findorFail($id);
        $existing_content->update([
            'delete_status' => '1'
        ]);

        return redirect()->route('content.index')->with('success', 'Content is deleted successfully.');
    }
}
