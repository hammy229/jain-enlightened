<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\General_setting;
use App\Models\Master\Role_privilege;
use Auth;
use App\Traits\MediaTrait;

class GeneralSettings extends Controller

{
    use MediaTrait;
    public function index()
    {
        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'general_setting_view')){
            $general_settings = General_setting::where('status', '=', 'active')->first();
            return view('Admin.Settings.general-setting', compact('general_settings'));
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }

    
    public function store(Request $request)
    {
        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        $id = $request->id;
        if ($request->has('contact_settings')){
            $request->validate([
                'email' => 'required|email',
                'mobile' => 'required|digits:10',
            //    'address' => 'required',
                'heading' => 'required',
                'description' => 'required',
              //  'map_link' => 'required',
            ]);
            $input['email'] = $request->email;
            $input['mobile'] = $request->mobile;
            $input['address'] = $request->address;
            $input['heading'] = $request->heading;
            $input['description'] = $request->description;
            $input['map_link'] = $request->map_link;

            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'general_setting_edit')){
                    $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    General_setting::where('id', '=', $id)->update($input);
                    return redirect('admin/general-setting')->with('success', 'Contact Settings updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                } 
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'general_setting_add')){
                    $input['created_by'] = auth()->guard('master_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    General_setting::create($input);
                    return redirect('admin/general-setting')->with('success', 'Contact Settings added successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                } 
            }
        }

        if ($request->has('social_media_settings')) {
            $request->validate([
                
                'youtube_url' => ['regex:/^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/'], // YouTube link validation
                // 'facebook_url' => 'required|string',
                // 'instagram_url' => 'required|string',
                // 'linkedin_url' => 'required|string',
                // 'twitter_url' => 'required|string',
                // 'google_play_url' => 'required|string',
                // 'app_store_url' => 'required|string',
            ]);
            $input['facebook_url'] = $request->facebook_url;
            $input['instagram_url'] = $request->instagram_url;
            $input['linkedin_url'] = $request->linkedin_url;
            $input['twitter_url'] = $request->twitter_url;
            $input['youtube_url'] = $request->youtube_url;
         //   $input['google_play_url'] = $request->google_play_url;
         //   $input['app_store_url'] = $request->app_store_url;
            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'general_setting_edit')){
                    $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    General_setting::where('id', '=', $id)->update($input);
                    return redirect('/admin/general-setting')->with('success', 'Social Media Settings updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                } 
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'general_setting_add')){
                    $input['created_by'] = auth()->guard('master_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    General_setting::create($input);
                    return redirect('/admin/general-setting')->with('success', 'Social Media Settings added successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                } 
            }
        }


        if ($request->has('entrepreneurs')){

            
            $request->validate([
                'ent_heading' => 'required',
                'ent_description' => 'required',
                'ent_image_path'  => 'image|max:5120',
            ],[
                'ent_image_path.max' => 'Please upload an image smaller than 5 MB.',
            ]);
            $input['ent_heading'] = $request->ent_heading;
            $input['ent_description'] = $request->ent_description;

            if ($request->has('ent_image_path')) {
                if ($request->file('ent_image_path')) {
                    $input['ent_image_path'] = $this->verifyAndUpload($request, 'ent_image_path', 'ent_image_path');
                    $original_name = $request->file('ent_image_path')->getClientOriginalName();
                    $input['ent_image_name'] = $original_name;
                }
            }

          
            if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'general_setting_edit')){
                    $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    General_setting::where('id', '=', $id)->update($input);
                    return redirect('admin/general-setting')->with('success', 'Entrepreneurs updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                } 
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'general_setting_add')){
                    $input['created_by'] = auth()->guard('master_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    General_setting::create($input);
                    return redirect('admin/general-setting')->with('success', 'Entrepreneurs added successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                } 
            }
        }


    }
}
