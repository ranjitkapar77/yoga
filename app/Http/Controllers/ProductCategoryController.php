<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = ProductCategory::latest()->paginate(10);
        return view('backend.product-category.index',compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product-category.create');
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
        $this->validate($request,
        [
            'title'=>'required|max:255',
            'description'=>'nullable|max:500'
        ]);


        $input = $request->all();
        $input['publish_status'] = $request->publish_status ?? 0;
        $input['slug'] = str_replace(' ','-' ,(strtolower($request->title)));
        ProductCategory::create($input);

        return redirect(route('product-category.index'))->with('success','Category has been added');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = ProductCategory::findOrFail($id);
        return view('backend.product-category.create',compact('cat'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
        [
            'title'=>'required|max:255',
            'description'=>'nullable|max:500'
        ]);

        $input = $request->all();
        $input['publish_status'] = $request->publish_status ?? 0;
        $input['slug'] = str_replace(' ','-' ,(strtolower($request->title)));
        ProductCategory::findOrFail($id)->update($input);
        return redirect(route('product-category.index'))->with('success','Category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductCategory::findOrFail($id)->delete();
        return redirect()->back()->with('success','Category has beenp deleted');
    }
}
