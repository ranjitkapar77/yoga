<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
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
        // $brands = Brand::latest()->get();
        $cats = ProductCategory::all();
        return view('backend.products.create', compact('cats'));
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
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'brief_description' => 'required',
            'main_description' => 'required',
            'category_id' => 'required',
            'multiple_files.*' => 'mimes:jpeg,jpg,png,svg',
            'featured_photo' => 'mimes:jpeg,jpg,png,svg',
            'meta_title'  => 'nullable',
            'meta_keywords'  => 'nullable',
            'meta_description'  => 'nullable',
            'og_image' => 'mimes:png,jpg,jpeg',
        ]);

        $og_image = '';
        if($request->hasfile('og_image'))
        {
            $image = $request->file('og_image');
            $og_image = $image->store('og_image', 'uploads');
            $input['og_image'] = $og_image;
        }
        if($request->hasfile('featured_photo'))
        {
            $image = $request->file('featured_photo');
            $photo = $image->store('products', 'uploads');
            $input['featured_img'] = $photo;
        }
        $input['publish_status'] =$request->publish_status ?? 0;
        $input['slug'] = str_replace(' ','-' ,(strtolower($request->title)));

        $product = Product::create($input);

        if($product && !empty($request->multiple_files))
        foreach($request->multiple_files as $data){
			$image = $data;
			$image = $image->store('products', 'uploads');
			ProductImage::create([
				'product_id'=>$product->id,
				'image'=>$image,
			]);
		}
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
        $cats = ProductCategory::all();
        $product = Product::findOrFail($id);
        return view('backend.products.create', compact('product','cats'));
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
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'brief_description' => 'required',
            'main_description' => 'required',
            'category_id' => 'required',
            'multiple_files.*' => 'mimes:jpeg,jpg,png,svg',
            'featured_photo' => 'mimes:jpeg,jpg,png,svg',
            'meta_title'  => 'nullable',
            'meta_keywords'  => 'nullable',
            'meta_description'  => 'nullable',
            'og_image' => 'mimes:png,jpg,jpeg',
        ]);

            
    // $product = 
    $input = $request->all();
    $og_image = '';
        if($request->hasfile('og_image'))
        {
            $image = $request->file('og_image');
            $og_image = $image->store('og_image', 'uploads');
            $input['og_image'] = $og_image;
        }

        if($request->hasfile('featured_photo'))
        {
            $image = $request->file('featured_photo');
            $photo = $image->store('products', 'uploads');
            $input['featured_img'] = $photo;
        }
        $input['publish_status'] =$request->publish_status ?? 0;
        $input['slug'] = str_replace(' ','-' ,(strtolower($request->title)));

        $product = Product::findorFail($id);
        $success =  $product->update($input);

        if($success && !empty($request->multiple_files))
    {
                foreach($product->images as $del){
                    $del->delete();
                }
            foreach($request->multiple_files as $data){
                $image = $data;
                $image = $image->store('products', 'uploads');
                ProductImage::create([
                    'product_id'=>$id,
                    'image'=>$image,
                ]);
            }
        }

            return redirect()->back()->with('success', 'Product updated successfully.');
    
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
        $product_images = ProductImage::where('product_id', $id)->get();
        foreach ($product_images as $images) {
            Storage::disk('uploads')->delete($images->image);
            $images->delete();
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product is deleted Successfully');
    }

    public function deleteproductimage($id)
    {
        dd($id);
        $image = ProductImage::findorfail($id)->delete();

        // $images = ProductImages::where('product_id', $product_image->product_id)->get();
        // if(count($images) < 2)
        // {
        //     return redirect()->back()->with('error', 'Only one image cannot be deleted.');
        // }
        // $product_image->delete();
        return redirect()->back()->with('success', 'Image Removed Successfully');
    }
}
