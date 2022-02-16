<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class TeamController extends Controller
{
    protected $team;
    public function __construct(Team $team)
    {
        $this->team = $team;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::orderBy('in_order', 'asc')->get();
        return view('backend.team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function teamsearch(Request $request){
    //     $search = $request['search'];

    //     $teams = Team::query()
    //                     ->where('name', 'LIKE', "%$search%")
    //                     ->orWhere('post', 'LIKE', "%$search%")
    //                     ->latest()
    //                     ->paginate(10);
    //     return view('backend.team.searchindex', compact('teams'));
    // }

    public function create()
    {
        $teamType = TeamType::latest()->get();
        return view('backend.team.create',compact('teamType'));
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
        $member_count = Team::orderBy('in_order', 'desc')->first();
        if($member_count)
        {
            $member_order = $member_count->in_order + 1;
        }
        else
        {
            $member_order = 1;
        }
        $this->validate($request, [
            'name'=>'required',
            'post'=>'required',
            'team_image' => 'nullable|mimes:png,jpg,jpeg,svg',
            'active' => '',
            'team_type_id'=>'required|integer'    
        ]);

        $team_image = '';
        if($request->hasfile('team_image'))
        {
            $image = $request->file('team_image');
            $team_image = $image->store('team_image', 'uploads');
        }

        $active = 0;
        if($request['active'] != null)
        {
            $active = 1;
        }

        $team = Team::create([
            'name' => $request['name'],
            'slug' => Str::slug($request['name']),
            'post' => $request['post'],
            'team_type_id'=>$request->team_type_id,
            'image' => $team_image,
            'address' => $request['address'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'website' => $request['website'],
            'content' => $request['content'],
            'facebook' => $request['facebook'],
            'linkedin' => $request['linkedin'],
            'twitter' => $request['twitter'],
            'youtube' => $request['youtube'],
            'status' => $active,
            'in_order' => $member_order
        ]);
        $team->save();

        return redirect()->route('team.index')->with('success', 'Team is created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
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
        $teamType = TeamType::latest()->get();
        $team = Team::findorfail($id);
        return view('backend.team.edit', compact('team','teamType'));
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
        $team = Team::findorfail($id);
        $this->validate($request, [
            'name'=>'required',
            'post'=>'required',
            'team_image' => 'nullable|mimes:png,jpg,jpeg',
            'active' => '',
            'team_type_id'=>'required|integer'    

        ]);

        $team_image = '';
        if($request->hasfile('team_image'))
        {
            $image = $request->file('team_image');
            $team_image = $image->store('team_image', 'uploads');
        }else{
            $team_image = $team->image;
        }

        $active = 0;
        if($request['active'] != null)
        {
            $active = 1;
        }

        $team->update([
            'name' => $request['name'],
            'slug' => Str::slug($request['name']),
            'post' => $request['post'],
            'image' => $team_image,
            'team_type_id'=>$request->team_type_id,    
            'address' => $request['address'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'website' => $request['website'],
            'content' => $request['content'],
            'facebook' => $request['facebook'],
            'linkedin' => $request['linkedin'],
            'twitter' => $request['twitter'],
            'youtube' => $request['youtube'],
            'status' => $active
        ]);
        $team->save();

        return redirect()->route('team.index')->with('success', 'Team is updated successfully.');
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
        $existing_team = Team::findorFail($id);
        Storage::disk('uploads')->delete($existing_team->location);
        $existing_team->delete();

        return redirect()->route('team.index')->with('success', 'Team is deleted successfully.');
    }

    public function updateMemberOrder(Request $request)
    {
        parse_str($request->sort, $arr);
        $order = 1;
        if (isset($arr['menuItem'])) {
            foreach ($arr['menuItem'] as $key => $value) {  //id //parent_id
                $this->team->where('id', $key)
                    ->update([
                        'in_order' => $order,
                    ]);
                $order++;
            }
        }

        return true;
    }

    public function teamType(Request $request)
    {
        $teamType = TeamType::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        $teamType->save();
    }
}
