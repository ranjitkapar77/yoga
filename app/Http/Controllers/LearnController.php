<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Models\Learn;
use App\Models\TestPreprationBooking;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LearnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $learns = Learn::latest()->paginate();
        return view('backend.learn_home_page.index', compact('learns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.learn_home_page.create');
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
            'icon'=>'mimes:png,jpg,jpeg,svg',
            // 'title'=>'required',
        ]);

        $icon = '';
        if($request->hasfile('icon'))
        {
            $icon = $request->file('icon');
            $icon = $icon->store('learn_logo', 'uploads');
        }
        $publish_status = '0';
        if($request['publish_status'] != null)
        {
            $publish_status = '1';
        }


        // $slug = Str::slug($data['title']);
        $learns = Learn::create([
            'icon'=>$icon,
            'title'=>$request->title,
            'slug' =>Str::slug($request->title),
            'page_title'=>$request->page_title,
            'description'=>$request->description,
            'fee'=>$request->fee,
            'total_mark'=>$request->total_mark,
            'required_mark'=>$request->required_mark,
            'publish_status'=>$publish_status,
            'delete_status' => '0',
            'show_in_menu' => $request->show_in_menu

        ]);
        $learns->save();
        return redirect()->route('learns.index')->with('success', 'Learns Successfully Created');
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
        $learns = Learn::findorfail($id);
        return view('backend.learn_home_page.edit', compact('learns'));
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
        $learns = Learn::findorfail($id);
        $data = $this->validate($request, [
            'icon'=>'image|mimes:png,jpg,jpeg,svg',
            // 'title'=>'required',
            // 'sub_title'=>'required',
            // 'content'=>'required',
            // 'description'=>'required',
        ]);

        $icon = '';
        if($request->hasfile('icon'))
        {
            Storage::disk('uploads')->delete($learns->icon);
            $icon = $request->file('icon');
            $icon = $icon->store('learn_logo', 'uploads');
        }else{
            $icon = $learns->icon;
        }
        $publish_status = '0';
        if($request['publish_status'] != null)
        {
            $publish_status = '1';
        }

        $learns->update([
            'icon'=>$icon,
            'title'=>$request->title,
            'slug' =>Str::slug($request->title),
            'page_title'=>$request->page_title,
            'description'=>$request->description,
            'fee'=>$request->fee,
            'total_mark'=>$request->total_mark,
            'required_mark'=>$request->required_mark,
            'publish_status'=>$publish_status,
            'delete_status' => '0',
            'show_in_menu' => $request->show_in_menu
        ]);
        $learns->save();
        return redirect()->route('learns.index')->with('success', 'Looking For Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $learns = Learn::findorfail($id);
        Storage::disk('uploads')->delete($learns->logo);
        $learns->delete();
        return redirect()->route('learns.index')->with('success', 'Test Prepration Successfully deleted');
    }

    public function getBookedtestPreparation()
    {
        $data = TestPreprationBooking::latest()->paginate(10);
        $destinations = Destination::get();

        return view('backend.learn_home_page.booking', compact('data', 'destinations'));
    }
}
