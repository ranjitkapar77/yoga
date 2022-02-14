<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $news = News::latest()->paginate();
        return view('backend.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.news.create');
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
        // dd($request);
        $data = $this->validate($request, [
            'cover_image'=>'required|image|mimes:png,jpg,jpeg',
            'banner_image'=>'image|mimes:png,jpg,jpeg',
            'title'=>'required',
            'descriptive_title'=>'required',
            'content'=>'required',
            'written_on'=>'required',
            'author'=>'required',
            'meta_title'=>'',
            'meta_keywords'=>'',
            'meta_description'=>'',
            'og_image'=>'mimes:png,jpg,jpeg'
        ]);

        $news_image = '';
        if($request->hasfile('cover_image'))
        {
            $image = $request->file('cover_image');
            $news_image = $image->store('news_image', 'uploads');
        }

        $banner_image = '';
        if($request->hasfile('banner_image'))
        {
            $image = $request->file('banner_image');
            $banner_image = $image->store('news_banner', 'uploads');
        }


        $og_image = '';
        if($request->hasfile('og_image'))
        {
            $ogimage = $request->file('og_image');
            $og_image = $ogimage->store('og_image', 'uploads');
        }
        $slug = Str::slug($data['title']);
        $news = News::create([
            'cover_image'=>$news_image,
            'banner_image'=>$banner_image,
            'title'=>$data['title'],
            'slug'=>$slug,
            'descriptive_title'=>$data['descriptive_title'],
            'content'=>$data['content'],
            'written_on'=>$data['written_on'],
            'author'=>$data['author'],
            'view_count'=>0,
            'news_blogs'=>0,
            'meta_title'=>$data['meta_title'],
            'meta_keywords'=>$data['meta_keywords'],
            'meta_description'=>$data['meta_description'],
            'og_image'=>$og_image
        ]);
        $news->save();
        return redirect()->route('news.index')->with('success', 'News Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $news = News::findorfail($id);
        return view('backend.news.edit', compact('news'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $news = News::findorfail($id);
        $data = $this->validate($request, [
            'cover_image'=>'image|mimes:png,jpg,jpeg',
            'banner_image'=>'image|mimes:png,jpg,jpeg',
            'title'=>'required',
            'descriptive_title'=>'required',
            'content'=>'required',
            'written_on'=>'required',
            'author'=>'required',
            'meta_title'=>'',
            'meta_keywords'=>'',
            'meta_description'=>'',
            'og_image'=>'image|mimes:png,jpg,jpeg'
        ]);

        $news_image = '';
        if($request->hasfile('cover_image'))
        {
            $image = $request->file('cover_image');
            $news_image = $image->store('news_image', 'uploads');
        }else{
            $news_image = $news->cover_image;
        }

        $banner_image = '';
        if($request->hasfile('banner_image'))
        {
            $image = $request->file('banner_image');
            $banner_image = $image->store('news_banner', 'uploads');
        }else{
            $banner_image = $news->banner_image;
        }

        $og_image = '';
        if($request->hasfile('og_image'))
        {
            $ogimage = $request->file('og_image');
            $og_image = $ogimage->store('og_image', 'uploads');
        }else{
            $og_image = $news->og_image;
        }

        $slug = Str::slug($data['title']);
        $views = $news->view_count;
        $blog = $news->news_blogs;
        $news->update([
            'cover_image'=>$news_image,
            'banner_image'=>$banner_image,
            'title'=>$data['title'],
            'slug'=>$slug,
            'descriptive_title'=>$data['descriptive_title'],
            'content'=>$data['content'],
            'written_on'=>$data['written_on'],
            'author'=>$data['author'],
            'view_count'=>$views,
            'news_blogs'=>$blog,
            'meta_title'=>$data['meta_title'],
            'meta_keywords'=>$data['meta_keywords'],
            'meta_description'=>$data['meta_description'],
            'og_image'=>$og_image
        ]);
        $news->save();
        return redirect()->route('news.index')->with('success', 'News Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $news = News::findorfail($id);
        Storage::disk('uploads')->delete($news->cover_image);
        Storage::disk('uploads')->delete($news->banner_image);
        $news->delete();
        return redirect()->route('news.index')->with('success', 'News Successfully deleted');
    }
}
