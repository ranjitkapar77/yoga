<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\MissionMessages;
use App\Models\Province;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        $provinces = Province::all();
        $districts = District::where('province_id', $setting->province_no)->get();
        return view('backend.setting.company_setting', compact('setting', 'provinces', 'districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    public function socialMedia()
    {
        $setting = Setting::first();
        return view('backend.setting.socialmedia', compact('setting'));
    }

    public function aboutUs()
    {
        $setting = Setting::first();
        $mission = MissionMessages::first();
        return view('backend.setting.aboutus', compact('setting', 'mission'));
    }

    public function updateMissionVision(Request $request, $id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $setting = Setting::findorFail($id);
        $mission_messages = MissionMessages::first();

        if(isset($_POST['companySetting']))
        {
            $this->validate($request, [
                'company_name'    => 'required',
                'email' => 'required|email',
                'contact_no'    => 'required',
                'pan_vat' => 'required',
                'province' => 'required',
                'district' => 'required',
                'local_address'    => 'required',
                'company_logo' => 'mimes:jpg,png,jpeg',
                'footer_logo' => 'mimes:jpg,png,jpeg',
                'company_favicon' => 'mimes:jpg,png,jpeg',
                'projects_completed'    => 'required',
                'total_employees'    => 'required',
                'happy_clients'    => 'required',
                'map_url' => 'required',

                'meta_title'  => '',
                'meta_keywords'  => '',
                'meta_description'  => '',
                'og_image' => 'mimes:png,jpg,jpeg',
            ]);

            $company_logo = '';
            if($request->hasfile('company_logo'))
            {
                $image = $request->file('company_logo');
                $company_logo = $image->store('company_logo', 'uploads');
            }else {
                $company_logo = $setting->company_logo;
            }

            $footer_logo = '';
            if($request->hasfile('footer_logo'))
            {
                $image = $request->file('footer_logo');
                $footer_logo = $image->store('footer_logo', 'uploads');
            }else {
                $footer_logo = $setting->footer_logo;
            }

            $og_image = '';
            if($request->hasfile('og_image'))
            {
                $image = $request->file('og_image');
                $og_image = $image->store('og_image', 'uploads');
            }else {
                $og_image = $setting->og_image;
            }

            $company_favicon = '';
            if($request->hasfile('company_favicon'))
            {
                $image = $request->file('company_favicon');
                $company_favicon = $image->store('company_favicon', 'uploads');
            }else {
                $company_favicon = $setting->company_favicon;
            }

            $setting->update([
                'company_name' => $request['company_name'],
                'email' => $request['email'],
                'contact_no' => $request['contact_no'],
                'pan_vat' => $request['pan_vat'],
                'province_no' => $request['province'],
                'district_no' => $request['district'],
                'local_address' => $request['local_address'],
                'company_logo' => $company_logo,
                'footer_logo' => $footer_logo,
                'company_favicon' => $company_favicon,
                'projects_completed' => $request['projects_completed'],
                'total_employees' => $request['total_employees'],
                'happy_clients' => $request['happy_clients'],
                'map_url' => $request['map_url'],

                'meta_title' => $request['meta_title'],
                'meta_keywords' => $request['meta_keywords'],
                'meta_description' => $request['meta_description'],
                'og_image' => $og_image,
            ]);
        }
        elseif (isset($_POST['socialMedia']))
        {
            $this->validate($request, [
                'facebook' => '',
                'instagram' => '',
                'whatsapp' => '',
                'youtube' => '',
                'twitter' => '',
            ]);

            $setting->update([
                'facebook' => $request['facebook'],
                'instagram' => $request['instagram'],
                'whatsapp' => $request['whatsapp'],
                'youtube' => $request['youtube'],
                'twitter' => $request['twitter'],
            ]);
        }

        elseif (isset($_POST['about_us']))
        {
            $this->validate($request, [
                'aboutUs' => 'required',
                'mission' => 'required',
                'vision' => 'required',
                'company_values' => 'required',
                'welcome_title' => 'required',
                'welcome_sub_title' => 'required',
                'welcome_message' => 'required',
                'youtube_link' => 'required',
            ]);

            $setting->update([
                'aboutus' => $request['aboutUs']
            ]);

            $mission_messages->update([
                'mission' => $request['mission'],
                'vision' => $request['vision'],
                'company_values' => $request['company_values'],
                'welcome_title' => $request['welcome_title'],
                'welcome_sub_title' => $request['welcome_sub_title'],
                'welcome_message' => $request['welcome_message'],
                'youtube_link' => $request['youtube_link'],
            ]);

            return redirect()->back()->with('success', 'About Us information successfully updated.');
        }

        return redirect()->back()->with('success', 'Setting information successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }

    public function getdistricts($id)
    {
        $districts = District::where('province_id', $id)->get();
        return response()->json($districts);
    }
}
