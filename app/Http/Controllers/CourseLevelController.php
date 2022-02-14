<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CourseLevel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CourseLevelController extends Controller
{
    public function index()
    {
        $level = CourseLevel::latest()->where('delete_status', '0')->paginate('10');

        return view('backend.level.index', compact('level'));
    }
    public function create()
    {
        return view('backend.level.create');
    }
    public function store(Request $request)
    {
        // dd($request);
        $data = $this->validate($request, [
            'title'=>'required',
        ]);
        $publish_status = '0';
        if($request['publish_status'] != null)
        {
            $publish_status = '1';
        }
        $slug = Str::slug($data['title']);
        $level = CourseLevel::create([
            'title'=>$request->title,
            'slug'=>$slug,
            'publish_status' => $publish_status,
            'delete_status' => '0',
            'show_in_menu' => $request->show_in_menu
        ]);

        $level->save();
        return redirect(route('level.index'))->with('success', 'level Successfully Created');
    }

    public function edit($id)
    {
        $level = CourseLevel::findorfail($id);
        return view('backend.level.edit', compact('level'));

    }
    public function update(Request $request,$id)
    {
        $level = CourseLevel::findorfail($id);
        $data = $this->validate($request, [
            'title'=>'required',
        ]);
        $publish_status = '0';
        if($request['publish_status'] != null)
        {
            $publish_status = '1';
        }
        $slug = Str::slug($data['title']);
        $level->update([
            'title'=>$request->title,
            'slug'=>$slug,
            'publish_status' => $publish_status,
            'delete_status' => '0',
            'show_in_menu' => $request->show_in_menu
        ]);

        $level->save();
        return redirect(route('level.index'))->with('success', 'level Successfully Created');
    }

    public function delete($id)
    {
        $existing_level = CourseLevel::findorFail($id);
        $existing_level->update([
            'delete_status' => '1'
        ]);

        return redirect()->route('level.index')->with('success', 'Level is deleted successfully.');
    }
}
