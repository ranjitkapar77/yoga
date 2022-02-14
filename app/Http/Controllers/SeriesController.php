<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = Series::latest()->paginate(10);
        return view('backend.series.index', compact('series'));
    }

    public function create()
    {
        $brands = Brand::latest()->get();
        return view('backend.series.create', compact('brands'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'model_name' => 'required',
            'brand' => 'required',
            'model_image' => 'required|mimes:png,jpg,jpeg',
        ]);

        $model_image = '';
        if($request->hasfile('model_image'))
        {
            $image = $request->file('model_image');
            $model_image = $image->store('model_image', 'uploads');
        }

        $series = Series::create([
            'model_name' => $request['model_name'],
            'brand_id' => $request['brand'],
            'slug' => Str::slug($request->model_name),
            'model_image' => $model_image,
        ]);

        $series->save();
        return redirect()->route('series.index')->with('success', 'Model information is saved successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $series = Series::findorFail($id);
        $brands = Brand::latest()->get();
        return view('backend.series.edit', compact('brands', 'series'));
    }

    public function update(Request $request, $id)
    {
        $series = Series::findorFail($id);

        $this->validate($request, [
            'model_name' => 'required',
            'brand' => 'required',
            'model_image' => 'mimes:png,jpg,jpeg',
        ]);

        $model_image = '';
        if($request->hasfile('model_image'))
        {
            $image = $request->file('model_image');
            $model_image = $image->store('model_image', 'uploads');
        }
        else{
            $model_image = $series->model_image;
        }

        $series->update([
            'model_name' => $request['model_name'],
            'brand_id' => $request['brand'],
            'slug' => Str::slug($request->model_name),
            'model_image' => $model_image,
        ]);

        return redirect()->route('series.index')->with('success', 'Model information is updated successfully.');
    }

    public function destroy($id)
    {
        $existing_series = Series::findorFail($id);
        Storage::disk('uploads')->delete($existing_series->model_image);
        $existing_series->delete();

        return redirect()->route('brand.index')->with('success', 'Model information is deleted successfully.');
    }
}
