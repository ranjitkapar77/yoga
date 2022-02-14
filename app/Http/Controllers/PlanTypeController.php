<?php

namespace App\Http\Controllers;

use App\Models\PlanType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlanTypeController extends Controller
{
    public function index()
    {
        //
        $plantypes = PlanType::latest()->paginate(10);
        return view('backend.plantype.index', compact('plantypes'));
    }

    public function teamsearch(Request $request){
        $search = $request['search'];

        $plantypes = PlanType::query()
                        ->where('title', 'LIKE', "%$search%")
                        ->latest()
                        ->paginate(10);
        return view('backend.PlanType.searchindex', compact('plantypes'));
    }

    public function create()
    {
        //
        return view('backend.plantype.create');
    }

    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title'=>'required',
            'active' => ''
        ]);


        $active = 0;
        if($request['active'] != null)
        {
            $active = 1;
        }

        $plantype = PlanType::create([
            'title' => $request['title'],
            'slug' => Str::slug($request->title),
            'status' => $active
        ]);
        // dd($plantype);
        $plantype->save();

        return redirect()->route('plantype.index')->with('success', 'Plan type is created successfully.');
    }

    public function edit($id)
    {
        //
        $plantype = PlanType::findorfail($id);
        return view('backend.plantype.edit', compact('plantype'));
    }

    public function update(Request $request, $id)
    {
        //
        $plantype = PlanType::findorfail($id);
        $this->validate($request, [
            'title'=>'required',
            'active' => ''
        ]);

        $active = 0;
        if($request['active'] != null)
        {
            $active = 1;
        }

        $plantype->update([
            'title' => $request['title'],
            'slug' => Str::slug($request->title),
            'status' => $active
        ]);
        $plantype->save();

        return redirect()->route('plantype.index')->with('success', 'Plan type is updated successfully.');
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
        $existing_plantype = PlanType::findorFail($id);
        $existing_plantype->delete();

        return redirect()->route('plantype.index')->with('success', 'Plan type is deleted successfully.');
    }

}
