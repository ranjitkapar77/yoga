<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::latest()->get();
        return view('backend.products.create', compact('brands'));
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
            'product_name' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'series' => 'required',
            'size' => 'required',
            'color' => 'required',
            'guarantee_time' => 'required',
            'brief_description' => 'required',
            'product_description' => 'required',
            'product_images' => 'required',
            'product_images.*' => 'mimes:jpeg,jpg,png',
            'meta_title'  => '',
            'meta_keywords'  => '',
            'meta_description'  => '',
            'og_image' => 'mimes:png,jpg,jpeg',
        ]);

        $og_image = '';
        if($request->hasfile('og_image'))
        {
            $image = $request->file('og_image');
            $og_image = $image->store('og_image', 'uploads');
        }

        $product = Product::create([
            'name' => $request['product_name'],
            'slug' => Str::slug($request->product_name),
            'price' => $request['price'],
            'guarantee_time' => $request['guarantee_time'],
            'color' => $request['color'],
            'size' => $request['size'],
            'brand_id' => $request['brand'],
            'series_id' => $request['series'],
            'brief_description' => $request['brief_description'],
            'main_description' => $request['product_description'],

            'meta_title' => $request['meta_title'],
            'meta_keywords' => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
            'og_image' => $og_image,
        ]);

        $imagename = '';
        if($request->hasfile('product_images'))
        {
            $images = $request->file('product_images');
            foreach($images as $image)
            {
                $imagename = $image->store('product_images', 'uploads');
                $product_images = ProductImages::create([
                    'product_id' => $product['id'],
                    'location' => $imagename,
                ]);
                $product_images->save();
            }
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product is created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findorFail($id);
        $brands = Brand::latest()->get();
        $related_series = Series::latest()->where('brand_id', $product->brand_id)->get();
        $product_images = ProductImages::where('product_id', $product->id)->get();
        return view('backend.products.edit', compact('product', 'brands', 'related_series', 'product_images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findorFail($id);

        if(isset($_POST['update']))
        {
            $this->validate($request, [
                'product_name' => 'required',
                'price' => 'required',
                'brand' => 'required',
                'series' => 'required',
                'size' => 'required',
                'color' => 'required',
                'guarantee_time' => 'required',
                'brief_description' => 'required',
                'product_description' => 'required',
                'meta_title'  => '',
                'meta_keywords'  => '',
                'meta_description'  => '',
                'og_image' => 'mimes:png,jpg,jpeg',
            ]);

            $og_image = '';
            if($request->hasfile('og_image'))
            {
                $image = $request->file('og_image');
                $og_image = $image->store('og_image', 'uploads');
            }
            else
            {
                $og_image = $product->og_image;
            }

            $product->update([
                'name' => $request['product_name'],
                'slug' => Str::slug($request->product_name),
                'price' => $request['price'],
                'guarantee_time' => $request['guarantee_time'],
                'color' => $request['color'],
                'size' => $request['size'],
                'brand_id' => $request['brand'],
                'series_id' => $request['series'],
                'brief_description' => $request['brief_description'],
                'main_description' => $request['product_description'],

                'meta_title' => $request['meta_title'],
                'meta_keywords' => $request['meta_keywords'],
                'meta_description' => $request['meta_description'],
                'og_image' => $og_image,
            ]);

            return redirect()->route('products.index')->with('success', 'Product is updated successfully.');
        }
        elseif(isset($_POST['update_images']))
        {
            $this->validate($request, [
                'product_images'=>'',
                'product_images.*' => 'mimes:png,jpg,jpeg',
            ]);

            $imagename = '';
            if($request->hasfile('product_images')) {

                $images = $request->file('product_images');
                foreach($images as $image){
                    $imagename = $image->store('item_images', 'uploads');
                    $product_images = ProductImages::create([
                        'product_id' => $product->id,
                        'location' => $imagename,
                    ]);
                    $product_images->save();
                }
            }

            return redirect()->back()->with('success', 'Images added successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findorFail($id);
        $product_images = ProductImages::where('product_id', $product->id)->get();
        dd($product_images);
        foreach ($product_images as $images) {
            Storage::disk('uploads')->delete($images->location);
            $images->delete();
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product is deleted Successfully');
    }

    public function deleteproductimage($id)
    {
        $product_image = ProductImages::findorfail($id);
        $images = ProductImages::where('product_id', $product_image->product_id)->get();
        if(count($images) < 2)
        {
            return redirect()->back()->with('error', 'Only one image cannot be deleted.');
        }
        $product_image->delete();
        return redirect()->back()->with('success', 'Image Removed Successfully');
    }
}
