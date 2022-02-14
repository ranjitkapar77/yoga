<?php

namespace App\Http\Controllers;

use App\Models\PlanFeatures;
use App\Models\PlanType;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PricingController extends Controller
{
    public function index()
    {
        //
        $pricing = Pricing::with('planfeatures')->latest()->paginate(10);
        return view('backend.pricing.index', compact('pricing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function pricesearch(Request $request){
        $search = $request['search'];

        $pricing = Pricing::query()
                        ->where('title', 'LIKE', "%$search%")
                        ->orWhere('regular_price', 'LIKE', "%$search%")
                        ->orWhere('offer_price', 'LIKE', "%$search%")
                        ->latest()
                        ->paginate(10);
        return view('backend.pricing.searchindex', compact('pricing'));
    }

    public function create()
    {
        //
        $plantype = PlanType::latest()->get();
        return view('backend.pricing.create', compact('plantype'));
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
        $this->validate($request, [
            'title'=>'required',
            'plantype_id'=>'required',
            'regular_price' => 'required',
            'offer_price' => 'required',
            'features' => 'required',
            'active' => ''
        ]);

        $active = 0;
        if($request['active'] != null)
        {
            $active = 1;
        }
        $pricing = Pricing::create([
           'title' => $request['title'],
           'slug' => Str::slug($request->title),
           'plantype_id'=>$request['plantype_id'],
           'regular_price'=>$request['regular_price'],
           'offer_price'=>$request['offer_price'],
            'status' => $active
        ]);
        $count = count($request['features']);
        // dd($count);
        $feature = $request['features'];
        for($x = 0; $x < $count; $x++){
            $features = PlanFeatures::create([
                'price_id'=>$pricing['id'],
                'features'=>$feature[$x],
            ]);
        }

        $features->save();
        $pricing->save();

        return redirect()->route('pricing.index')->with('success', 'Plan Price is created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pricing  $pricing
     * @return \Illuminate\Http\Response
     */
    public function show(Pricing $pricing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $price = Pricing::findorfail($id);
        $features = PlanFeatures::where('price_id', $id)->get();
        $plantype = PlanType::latest()->get();
        return view('backend.pricing.edit', compact('price', 'plantype', 'features'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $price = Pricing::findorfail($id);
        $this->validate($request, [
            'title'=>'required',
            'plantype_id'=>'required',
            'regular_price'=>'required',
            'offer_price'=>'required',
            'features'=>'required',
            'active' => ''
        ]);

        $active = 0;
        if($request['active'] != null)
        {
            $active = 1;
        }

        $price->update([
            'title' => $request['title'],
            'slug' => Str::slug($request->title),
            'plantype_id' => $request['plantype_id'],
            'regular_price' => $request['regular_price'],
            'offer_price' => $request['offer_price'],
            'status' => $active
        ]);
        $count = count($request['features']);
        // dd($count);
        $feature = $request['features'];
        $planfeatures = PlanFeatures::where('price_id', $id)->get();
            foreach ($planfeatures as $key => $value) {
                $value->delete();
            }
        for($x = 0; $x < $count; $x++){
            $features = PlanFeatures::create([
                'price_id'=>$price['id'],
                'features'=>$feature[$x],
            ]);
        }

        $features->save();
        $price->save();

        return redirect()->route('pricing.index')->with('success', 'Price is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $existing_price = Pricing::findorFail($id);
        $existing_price->delete();

        return redirect()->route('pricing.index')->with('success', 'Team is deleted successfully.');
    }
}
