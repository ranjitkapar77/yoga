<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(10);
        return view('backend.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'brand_name' => 'required',
            'brand_image' => 'required|mimes:png,jpg,jpeg',
        ]);

        $brand_image = '';
        if($request->hasfile('brand_image'))
        {
            $image = $request->file('brand_image');
            $brand_image = $image->store('brand_image', 'uploads');
        }

        $brand = Brand::create([
            'brand_name' => $request['brand_name'],
            'brand_slug' => Str::slug($request->brand_name),
            'brand_image' => $brand_image,
        ]);

        $brand->save();
        return redirect()->route('brand.index')->with('success', 'Brand information is saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::findorFail($id);
        return view('backend.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $brand = Brand::findorFail($id);
        $this->validate($request, [
            'brand_name' => 'required',
            'brand_image' => 'mimes:png,jpg,jpeg',
        ]);

        $brand_image = '';
        if($request->hasfile('brand_image'))
        {
            $image = $request->file('brand_image');
            $brand_image = $image->store('brand_image', 'uploads');
        }
        else
        {
            $brand_image = $brand->brand_image;
        }

        $brand->update([
            'brand_name' => $request['brand_name'],
            'brand_slug' => Str::slug($request->brand_name),
            'brand_image' => $brand_image,
        ]);

        return redirect()->route('brand.index')->with('success', 'Brand information is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existing_brand = Brand::findorFail($id);
        Storage::disk('uploads')->delete($existing_brand->brand_image);
        $existing_brand->delete();

        return redirect()->route('brand.index')->with('success', 'Brand information is deleted successfully.');
    }

    public function getSeries($id)
    {
        $series = Series::where('brand_id', $id)->get();
        return response()->json($series);
    }
}
