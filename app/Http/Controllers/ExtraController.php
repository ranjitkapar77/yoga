<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Extra;

class ExtraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $extra = Extra::latest()->paginate();
        return view('backend.extralist', compact('extra'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'key' => 'required',
            'value' => 'required',
            'description' => 'required',
            'value_1' => 'required',

        ]);

        $extra = Extra::create([
            'key' => $data['key'],
            'description' => $data['description'],
            'value' => $data['value'],
            'value_1' => $data['value_1'],

        ]);
        $extra->save();
        return redirect()->route('extra.index')->with('success', 'Extra Successfully Created');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $extra = Extra::findorfail($id);
        return view('backend.extra', compact('extra'));
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
        $extra = Extra::findorfail($id);
        $data = $this->validate($request, [
            'key' => 'required',
            'value' => 'required',
            'description' => 'required',
            'value_1' => 'required',

        ]);

        try {
            $extra->update([
                'key' => $data['key'],
                'description' => $data['description'],
                'value' => $data['value'],
                'value_1' => $data['value_1'],
            ]);
            return redirect()->route('extra.index')->with('success', 'Extra Successfully Created');
        } catch (\Throwable $th) {
            request()->session()->flash('error', $extra->key . "cannot be updated at the moment , please try again later");
            return redirect()->back()->withInput();
        }
    }
}
