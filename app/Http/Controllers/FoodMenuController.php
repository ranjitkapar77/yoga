<?php

namespace App\Http\Controllers;

use App\Models\FoodMenu;
use App\Models\FoodMenuType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FoodMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fmenus = FoodMenu::latest()->paginate(12);
        return view('backend.food-menu.index',compact('fmenus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foodType = FoodMenuType::all();
        return view('backend.food-menu.create',compact('foodType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
            'menu_type' => 'required',
            'food_type' => 'nullable',
            'description' => 'nullable|max:1000',
            // 'multiple_files.*' => 'mimes:jpeg,jpg,png,svg',
            'image' => 'nullable|mimes:jpeg,jpg,png,svg',
        ]);

        $og_image = '';
        if($request->hasfile('image'))
        {
            $image = $request->file('image');
            $og_image = $image->store('food-menu', 'uploads');
            $input['featured_img'] = $og_image;
        }
        
        $input['publish_status'] =$request->publish_status ?? 0;
        $input['slug'] = Str::slug($request->name);

        FoodMenu::create($input);
        return redirect()->route('food-menu.index')->with('success', 'Food Menu is created successfully.');
    


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FoodMenu  $foodMenu
     * @return \Illuminate\Http\Response
     */
    public function show(FoodMenu $foodMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FoodMenu  $foodMenu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $foodType = FoodMenuType::all();
        $fmenu = FoodMenu::find($id);
        return view('backend.food-menu.create',compact('foodType','fmenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FoodMenu  $foodMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();
        // dd($input);
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
            'menu_type' => 'required',
            'food_type' => 'nullable',
            'description' => 'nullable|max:1000',
            // 'multiple_files.*' => 'mimes:jpeg,jpg,png,svg',
            'image' => 'nullable|mimes:jpeg,jpg,png,svg',
        ]);

        $og_image = '';
        if($request->hasfile('image'))
        {
            $image = $request->file('image');
            $og_image = $image->store('food-menu', 'uploads');
            $input['featured_img'] = $og_image;
        }
        
        $input['publish_status'] =$request->publish_status ?? 0;
        $input['slug'] = Str::slug($request->name);

        FoodMenu::findOrFail($id)->update($input);
        return redirect()->route('food-menu.index')->with('success', 'Food Menu is updated successfully.');
    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FoodMenu  $foodMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FoodMenu::findOrFail($id)->delete();
        return redirect()->back()->with('success','Food menu has been deleted');
    }
    public function foodMenuType(Request $request)
    {
        $food_menu = FoodMenuType::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        $food_menu->save();
    }
}
