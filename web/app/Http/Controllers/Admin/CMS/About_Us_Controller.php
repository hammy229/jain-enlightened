<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Models\Admin\About;
use Illuminate\Http\Request;
use App\Traits\MediaTrait;

class About_Us_Controller extends Controller
{
    use MediaTrait;
        public function index(){

            $about = About::where('status','active')->first();
            return view('Admin.CMS.about-us',compact('about'));
        }

        public function store(Request $request){

            $id = $request->id;
            if($request->has('about_us_section')){

                $request->validate([
                    'about_heading'=>  'required',
                    'about_description'=>  'required',
                    'about_img_1_path'=>  'image|max:5120',
                    'about_img_2_path'=>  'image|max:5120',
                ],[
                    'about_img_1_path.max' => 'Please upload an image smaller than 5 MB.',
                    'about_img_2_path.max' => 'Please upload an image smaller than 5 MB.',
                ]);
        
                $input['about_heading'] = $request->about_heading;
                $input['about_description'] = $request->about_description;
               
    
                if ($request->has('about_img_1_path')) {
                    if ($request->file('about_img_1_path')) {
                        $input['about_img_1_path'] = $this->verifyAndUpload($request, 'about_img_1_path', 'about_img_1_path');
                        $original_name = $request->file('about_img_1_path')->getClientOriginalName();
                        $input['about_img_1_name'] = $original_name;
                    }
                }

                if ($request->has('about_img_2_path')) {
                    if ($request->file('about_img_2_path')) {
                        $input['about_img_2_path'] = $this->verifyAndUpload($request, 'about_img_2_path', 'about_img_2_path');
                        $original_name = $request->file('about_img_2_path')->getClientOriginalName();
                        $input['about_img_2_name'] = $original_name;
                    }
                }
        
                if ($id){
                    About::find($id)->update($input);
                    return redirect('admin/cms/about-us')->with('success', 'About Us Section Data Updated Successfully!');
                } else {
                    $input['created_by']  = auth()->guard('master_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    About::create($input);
                    return redirect('admin/cms/about-us')->with('success', 'About Us Section Data Added Successfully!');
                }

            }



            if($request->has('vision_mission_section')){

                $request->validate([
                    'vision_heading'=>  'required',
                    'vision_description'=>  'required',
                    'vision_icon_path'=>  'image|max:5120',
                    'mission_heading'=>  'required',
                    'mission_description'=>  'required',
                    'mission_icon_path'=>  'image|max:5120',
                ],[
                    'vision_icon_path.max' => 'Please upload an image smaller than 5 MB.',
                    'mission_icon_path.max' => 'Please upload an image smaller than 5 MB.',
                ]);
        
                $input['vision_heading'] = $request->vision_heading;
                $input['vision_description'] = $request->vision_description;
                $input['mission_heading'] = $request->mission_heading;
                $input['mission_description'] = $request->mission_description;
    
                if ($request->has('vision_icon_path')) {
                    if ($request->file('vision_icon_path')) {
                        $input['vision_icon_path'] = $this->verifyAndUpload($request, 'vision_icon_path', 'vision_icon_path');
                        $original_name = $request->file('vision_icon_path')->getClientOriginalName();
                        $input['vision_icon_name'] = $original_name;
                    }
                }

                if ($request->has('mission_icon_path')) {
                    if ($request->file('mission_icon_path')) {
                        $input['mission_icon_path'] = $this->verifyAndUpload($request, 'mission_icon_path', 'mission_icon_path');
                        $original_name = $request->file('mission_icon_path')->getClientOriginalName();
                        $input['mission_icon_name'] = $original_name;
                    }
                }
        
        
                if ($id){
                    About::find($id)->update($input);
                    return redirect('admin/cms/about-us')->with('success', 'Vision & Mission Section Data Updated Successfully!');
                } else {
                    $input['created_by']  = auth()->guard('master_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    About::create($input);
                    return redirect('admin/cms/about-us')->with('success', 'Vision & Mission Section Data Added Successfully!');
                }
        
            }


            if($request->has('personal_journey_section')){

                $request->validate([
                    'journey_heading'=>  'required',
                    'journey_description'=>  'required',
                    'journey_img_path'=>  'image|max:5120',
                    'linkedin_url'=>  'required',
                ],[
                    'journey_img_path.max' => 'Please upload an image smaller than 5 MB.',
                ]);
        
                $input['journey_heading'] = $request->journey_heading;
                $input['journey_description'] = $request->journey_description;
                $input['linkedin_url'] = $request->linkedin_url;
               
    
                if ($request->has('journey_img_path')) {
                    if ($request->file('journey_img_path')) {
                        $input['journey_img_path'] = $this->verifyAndUpload($request, 'journey_img_path', 'journey_img_path');
                        $original_name = $request->file('journey_img_path')->getClientOriginalName();
                        $input['journey_img_name'] = $original_name;
                    }
                }

                if ($request->has('about_img_2_path')) {
                    if ($request->file('about_img_2_path')) {
                        $input['about_img_2_path'] = $this->verifyAndUpload($request, 'about_img_2_path', 'about_img_2_path');
                        $original_name = $request->file('about_img_2_path')->getClientOriginalName();
                        $input['about_img_2_name'] = $original_name;
                    }
                }
        
        
                if ($id){
                    About::find($id)->update($input);
                    return redirect('admin/cms/about-us')->with('success', 'Personal Journey Section Data Updated Successfully!');
                } else {
                    $input['created_by']  = auth()->guard('master_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    About::create($input);
                    return redirect('admin/cms/about-us')->with('success', 'Personal Journey Section Data Added Successfully!');
                }
        
            }


            if($request->has('guidance_section')){

                $request->validate([
                    'guidance_heading'=>  'required',
                    'guidance_description'=>  'required',
                    'guidance_img_path'=>  'image|max:5120',
                ],[
                    'guidance_img_path.max' => 'Please upload an image smaller than 5 MB.',
                ]);
        
                $input['guidance_heading'] = $request->guidance_heading;
                $input['guidance_description'] = $request->guidance_description;
               
    
                if ($request->has('guidance_img_path')) {
                    if ($request->file('guidance_img_path')) {
                        $input['guidance_img_path'] = $this->verifyAndUpload($request, 'guidance_img_path', 'guidance_img_path');
                        $original_name = $request->file('guidance_img_path')->getClientOriginalName();
                        $input['guidance_img_name'] = $original_name;
                    }
                }

           
                if ($id){
                    About::find($id)->update($input);
                    return redirect('admin/cms/about-us')->with('success', 'Guidance Section Data Updated Successfully!');
                } else {
                    $input['created_by']  = auth()->guard('master_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    About::create($input);
                    return redirect('admin/cms/about-us')->with('success', 'Guidance Section Data Added Successfully!');
                }
        
            }


            if($request->has('acknowledgment_section')){

                $request->validate([
                    'acknow_heading'=>  'required',
                    'acknow_description'=>  'required',
                ]);
        
                $input['acknow_heading'] = $request->acknow_heading;
                $input['acknow_description'] = $request->acknow_description;
               
                if ($request->has('about_img_2_path')) {
                    if ($request->file('about_img_2_path')) {
                        $input['about_img_2_path'] = $this->verifyAndUpload($request, 'about_img_2_path', 'about_img_2_path');
                        $original_name = $request->file('about_img_2_path')->getClientOriginalName();
                        $input['about_img_2_name'] = $original_name;
                    }
                }
        
                if ($id){
                    About::find($id)->update($input);
                    return redirect('admin/cms/about-us')->with('success', 'Acknowledgment Section Data Updated Successfully!');
                } else {
                    $input['created_by']  = auth()->guard('master_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    About::create($input);
                    return redirect('admin/cms/about-us')->with('success', 'Acknowledgment Section Data Added Successfully!');
                }
        
            }

            if($request->has('strategic_goals_section')){

                $request->validate([
                    'strategic_heading'=>  'required',
                ]);
        
                $input['strategic_heading'] = $request->strategic_heading;
        
                if ($id){
                    About::find($id)->update($input);
                    return redirect('admin/cms/about-us')->with('success', 'Strategic Goals Section Data Updated Successfully!');
                } else {
                    $input['created_by']  = auth()->guard('master_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    About::create($input);
                    return redirect('admin/cms/about-us')->with('success', 'Strategic Goals Section Data Added Successfully!');
                }
        
            }
    
        }

 }