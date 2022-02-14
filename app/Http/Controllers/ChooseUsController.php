<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChooseUs;
use App\Http\Requests\ChooseUsRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ChooseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $choose = ChooseUs::latest()->paginate();
        return view('backend.choose_us.index', compact('choose'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.choose_us.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChooseUsRequest $request)
    {
        // dd($request->all());
        $this->validate($request, [
                'choose_icon_1'=>'image|mimes:png,jpg,jpeg,svg',
                'choose_icon_2'=>'image|mimes:png,jpg,jpeg,svg',
                'image_title_4'=>'image|mimes:png,jpg,jpeg,svg',
                'image'=>'image|mimes:png,jpg,jpeg,svg',
                
        ]);
      

        $image = '';
        if($request->hasfile('image'))
        {
            $image = $request->file('image');
            $image = $image->store('choose_us_image', 'uploads');
        }

        $choose_icon_1 = '';
        if($request->hasfile('choose_icon_1'))
        {
            $choose_icon_1 = $request->file('choose_icon_1');
            $choose_icon_1 = $choose_icon_1->store('choose_us_image', 'uploads');
        }

        $choose_icon_2 = '';
        if($request->hasfile('choose_icon_2'))
        {
            $choose_icon_2 = $request->file('choose_icon_2');
            $choose_icon_2 = $choose_icon_2->store('choose_us_image', 'uploads');
        }


        $image_title_4 = '';
        if($request->hasfile('image_title_4'))
        {
            $image_title_4 = $request->file('image_title_4');
            $image_title_4 = $image_title_4->store('choose_us_image', 'uploads');
        }

        $choose = ChooseUs::create([
            'choose_title_1'=> $request->choose_title_1,
            'choose_title_2'=>$request->choose_title_2,
            'choose_title_3'=>$request->choose_title_3,
            'choose_title_4'=>$request->choose_title_4,
            'title'=>$request->title,
            'sub_title'=>$request->sub_title,
            'description'=>$request->description,
            'vedio_link'=>$request->vedio_link,
            'btn_title'=>$request->btn_title,
            'image'=> $image,
            'choose_icon_1'=> $choose_icon_1,
            'choose_icon_2'=> $choose_icon_2,
            'image_title_4'=> $image_title_4,
        ]);
        $choose->save();
        return redirect()->route('choose.index')->with('success', 'Choose Us Successfully Created');
        
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
        $choose = ChooseUs::findorfail($id);
        return view('backend.choose_us.edit', compact('choose'));
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
        $choose = ChooseUs::findorfail($id);
        $this->validate($request, [
            'choose_icon_1'=>'image|mimes:png,jpg,jpeg,svg',
            'choose_icon_2'=>'image|mimes:png,jpg,jpeg,svg',
            'image_title_4'=>'image|mimes:png,jpg,jpeg,svg',
            'image'=>'image|mimes:png,jpg,jpeg,svg',
            
    ]);
  

    $image = '';
    if($request->hasfile('image'))
    {
        $image = $request->file('image');
        $image = $image->store('choose_us_image', 'uploads');
        Storage::disk('uploads')->delete($choose->image);
    }else{
        $image = $choose->image;
    }

    $choose_icon_1 = '';
    if($request->hasfile('choose_icon_1'))
    {
        $choose_icon_1 = $request->file('choose_icon_1');
        $choose_icon_1 = $choose_icon_1->store('choose_us_image', 'uploads');
        Storage::disk('uploads')->delete($choose->choose_icon_1);
    }else{
        $choose_icon_1 = $choose->choose_icon_1;
    }

    $choose_icon_2 = '';
    if($request->hasfile('choose_icon_2'))
    {
        $choose_icon_2 = $request->file('choose_icon_2');
        $choose_icon_2 = $choose_icon_2->store('choose_us_image', 'uploads');
        Storage::disk('uploads')->delete($choose->choose_icon_2);
    }else{
        $choose_icon_2 = $choose->choose_icon_2;
    }


    $image_title_4 = '';
    if($request->hasfile('image_title_4'))
    {
        $image_title_4 = $request->file('image_title_4');
        $image_title_4 = $image_title_4->store('choose_us_image', 'uploads');
        Storage::disk('uploads')->delete($choose->image_title_4);
    }else{
        $image_title_4 = $choose->image_title_4;
    }

    $choose->update([
        'choose_title_1'=> $request->choose_title_1,
        'choose_title_2'=>$request->choose_title_2,
        'choose_title_3'=>$request->choose_title_3,
        'choose_title_4'=>$request->choose_title_4,
        'title'=>$request->title,
        'sub_title'=>$request->sub_title,
        'description'=>$request->description,
        'vedio_link'=>$request->vedio_link,
        'btn_title'=>$request->btn_title,
        'image'=> $image,
        'choose_icon_1'=> $choose_icon_1,
        'choose_icon_2'=> $choose_icon_2,
        'image_title_4'=> $image_title_4,
    ]);
    $choose->save();
    return redirect()->route('choose.index')->with('success', 'Choose Us Successfully Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $choose = ChooseUs::findorfail($id);
        Storage::disk('uploads')->delete($choose->image);
        Storage::disk('uploads')->delete($choose->choose_icon_1);
        Storage::disk('uploads')->delete($choose->choose_icon_2);
        Storage::disk('uploads')->delete($choose->image_title_4);
        $choose->delete();
        return redirect()->route('choose.index')->with('success', 'Choose Successfully deleted');
    }
}
