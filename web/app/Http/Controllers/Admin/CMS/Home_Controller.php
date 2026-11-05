<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Models\Admin\Home;
use Illuminate\Http\Request;
use App\Traits\MediaTrait;

class Home_Controller extends Controller
{
    use MediaTrait;
    public function index(){

        $home = Home::where('status','active')->first();
            return view('Admin.CMS.home', compact('home'));
    }

    public function store(Request $request){

        $id = $request->id;

        $isUpdate = !empty($id);

        if($request->has('home_banner_section')){

            $request->validate([
                'heading' => 'required',
                'sub_heading' => 'required',
                'play_link' => 'required',
                'app_link' => 'required',
                'banner_video_path' => 'mimes:mp4,avi,mov,wmv|max:51200', 
                'you_tube_link' => ['required', 'regex:/^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/'], // YouTube link validation
            ], [
                'banner_video_path.mimes' => 'Please upload a valid video file (mp4, avi, mov, wmv).',
                'banner_video_path.max' => 'Please upload a video smaller than 50 MB.',
                'you_tube_link.regex' => 'Please enter a valid YouTube URL.',
            ]);
    
            $input['heading'] = $request->heading;
            $input['sub_heading'] = $request->sub_heading;
            $input['play_link'] = $request->play_link;
            $input['app_link'] = $request->app_link;
            $input['you_tube_link'] = $request->you_tube_link;

            if ($request->has('banner_video_path')) {
                if ($request->file('banner_video_path')) {
                    $input['banner_video_path'] = $this->verifyAndUpload($request, 'banner_video_path', 'banner_video_path');
                    $original_name = $request->file('banner_video_path')->getClientOriginalName();
                    $input['banner_video_name'] = $original_name;
                }
            }
    
    
            if ($id){
                Home::find($id)->update($input);
                return redirect('admin/cms/home')->with('success', 'Home Banner Section Data Updated Successfully!');
            } else {
                $input['created_by']  = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Home::create($input);
                return redirect('admin/cms/home')->with('success', 'Home Banner Section Data Added Successfully!');
            }
    
        }

        if($request->has('banner_cards_section')){

            $request->validate([
                'card_heading_1'=>  'required',
                'card_heading_2'=>  'required',
                'card_heading_3'=>  'required',
                'card_description_1'=>  'required',
                'card_description_2'=>  'required',
                'card_description_3'=>  'required',
        
                // 'card_icon_1_path'=>  'required|image|max:5120',
                // 'card_icon_2_path'=>  'required|image|max:5120',
                // 'card_icon_3_path'=>  'required|image|max:5120',

                'card_icon_1_path' => $isUpdate ? 'nullable|image|max:5120' : 'required|image|max:5120',
                'card_icon_2_path' => $isUpdate ? 'nullable|image|max:5120' : 'required|image|max:5120',
                'card_icon_3_path' => $isUpdate ? 'nullable|image|max:5120' : 'required|image|max:5120',
             
                'card_image_1_path'=>  'image|max:5120',
                'card_image_2_path'=>  'image|max:5120',
                'card_image_3_path'=>  'image|max:5120',
            ],[
                 'card_icon_1_path.max' => 'Please upload an icon smaller than 5 MB.',
                 'card_icon_2_path.max' => 'Please upload an icon smaller than 5 MB.',
                 'card_icon_3_path.max' => 'Please upload an icon smaller than 5 MB.',
                 'card_image_1_path.max' => 'Please upload an image smaller than 5 MB.',
                 'card_image_2_path.max' => 'Please upload an image smaller than 5 MB.',
                 'card_image_3_path.max' => 'Please upload an image smaller than 5 MB.',
            ]);
    
            $input['card_heading_1'] = $request->card_heading_1;
            $input['card_heading_2'] = $request->card_heading_2;
            $input['card_heading_3'] = $request->card_heading_3;
            $input['card_description_1'] = $request->card_description_1;
            $input['card_description_2'] = $request->card_description_2;
            $input['card_description_3'] = $request->card_description_3;
          

            if ($request->has('card_icon_1_path')) {
                if ($request->file('card_icon_1_path')) {
                    $input['card_icon_1_path'] = $this->verifyAndUpload($request, 'card_icon_1_path', 'card_icon_1_path');
                    $original_name = $request->file('card_icon_1_path')->getClientOriginalName();
                    $input['card_icon_1_name'] = $original_name;
                }
            }

            if ($request->has('card_icon_2_path')) {
                if ($request->file('card_icon_2_path')) {
                    $input['card_icon_2_path'] = $this->verifyAndUpload($request, 'card_icon_2_path', 'card_icon_2_path');
                    $original_name = $request->file('card_icon_2_path')->getClientOriginalName();
                    $input['card_icon_2_name'] = $original_name;
                }
            }

            if ($request->has('card_icon_3_path')) {
                if ($request->file('card_icon_3_path')) {
                    $input['card_icon_3_path'] = $this->verifyAndUpload($request, 'card_icon_3_path', 'card_icon_3_path');
                    $original_name = $request->file('card_icon_3_path')->getClientOriginalName();
                    $input['card_icon_3_name'] = $original_name;
                }
            }


            if ($request->has('card_image_1_path')) {
                if ($request->file('card_image_1_path')) {
                    $input['card_image_1_path'] = $this->verifyAndUpload($request, 'card_image_1_path', 'card_image_1_path');
                    $original_name = $request->file('card_image_1_path')->getClientOriginalName();
                    $input['card_image_1_name'] = $original_name;
                }
            }

            if ($request->has('card_image_2_path')) {
                if ($request->file('card_image_2_path')) {
                    $input['card_image_2_path'] = $this->verifyAndUpload($request, 'card_image_2_path', 'card_image_2_path');
                    $original_name = $request->file('card_image_2_path')->getClientOriginalName();
                    $input['card_image_2_name'] = $original_name;
                }
            }

            if ($request->has('card_image_3_path')) {
                if ($request->file('card_image_3_path')) {
                    $input['card_image_3_path'] = $this->verifyAndUpload($request, 'card_image_3_path', 'card_image_3_path');
                    $original_name = $request->file('card_image_3_path')->getClientOriginalName();
                    $input['card_image_3_name'] = $original_name;
                }
            }
    

            if ($id){
                Home::find($id)->update($input);
                return redirect('admin/cms/home')->with('success', 'Banner Cards Section Data Updated Successfully!');
            } else {
                $input['created_by']  = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Home::create($input);
                return redirect('admin/cms/home')->with('success', 'Banner Cards Section Data Added Successfully!');
            }
    
        }
    //    dd($request);

        if($request->has('about_us_section')){

            $request->validate([
                'about_heading'=>  'required',
                'about_description'=>  'required',

                'about_image_path'=>  'image|max:5120',
               'about_video_path'=>  'mimes:mp4,avi,mov,wmv|max:25600',
            ],[
                 'about_image_path.max' => 'Please upload an image smaller than 5 MB.',
                 'about_video_path.max' => 'Please upload an image smaller than 25 MB.',
                 'about_video_path.mimes' => 'Please upload a valid video file (mp4, avi, mov, wmv).',
            ]);

         //   dd($request);
    
            $input['about_heading'] = $request->about_heading;
            $input['about_description'] = $request->about_description;

            if ($request->has('about_image_path')) {
                if ($request->file('about_image_path')) {
                    $input['about_image_path'] = $this->verifyAndUpload($request, 'about_image_path', 'about_image_path');
                    $original_name = $request->file('about_image_path')->getClientOriginalName();
                    $input['about_image_name'] = $original_name;
                }
            }

            if ($request->has('about_video_path')) {
                if ($request->file('about_video_path')) {
                    $input['about_video_path'] = $this->verifyAndUpload($request, 'about_video_path', 'about_video_path');
                    $original_name = $request->file('about_video_path')->getClientOriginalName();
                    $input['about_video_name'] = $original_name;
                }
            }

            if ($id){
                Home::find($id)->update($input);
                return redirect('admin/cms/home')->with('success', 'About Us Section Updated Successfully!');
            } else {
                $input['created_by']  = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Home::create($input);
                return redirect('admin/cms/home')->with('success', 'About Us Section Added Successfully!');
            }
        }

        if($request->has('lessons_section')){

            $request->validate([
                'lessons_heading'=>  'required',
                'lessons_sub_heading'=>  'required',
            ]);
    
            $input['lessons_heading'] = $request->lessons_heading;
            $input['lessons_sub_heading'] = $request->lessons_sub_heading;

            if ($id){
                Home::find($id)->update($input);
                return redirect('admin/cms/home')->with('success', 'Lessons Section Updated Successfully!');
            } else {
                $input['created_by']  = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Home::create($input);
                return redirect('admin/cms/home')->with('success', 'Lessons Section Added Successfully!');
            }
        }

        if($request->has('founders_message_section')){

            $request->validate([
                'founders_heading'=>  'required',
                'founders_description'=>  'required',
            ]);
    
            $input['founders_heading'] = $request->founders_heading;
            $input['founders_description'] = $request->founders_description;

            if ($request->has('founders_image_path')) {
                if ($request->file('founders_image_path')) {
                    $input['founders_image_path'] = $this->verifyAndUpload($request, 'founders_image_path', 'founders_image_path');
                    $original_name = $request->file('founders_image_path')->getClientOriginalName();
                    $input['founders_image_name'] = $original_name;
                }
            }

            if ($id){
                Home::find($id)->update($input);
                return redirect('admin/cms/home')->with('success', 'Founders Message Section Data Updated Successfully!');
            } else {
                $input['created_by']  = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Home::create($input);
                return redirect('admin/cms/home')->with('success', 'Founders Message Section Data Added Successfully!');
            }
        }


        if($request->has('podcasts_section')){

            $request->validate([
                'podcasts_heading'=>  'required',
                'podcasts_sub_heading'=>  'required',
            ]);
    
            $input['podcasts_heading'] = $request->podcasts_heading;
            $input['podcasts_sub_heading'] = $request->podcasts_sub_heading;


            if ($id){
                Home::find($id)->update($input);
                return redirect('admin/cms/home')->with('success', 'Podcasts Section Data Updated Successfully!');
            } else {
                $input['created_by']  = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Home::create($input);
                return redirect('admin/cms/home')->with('success', 'Podcasts Section Data Added Successfully!');
            }
        }


        if($request->has('jainism_additional_educational_resources_section')){

            $request->validate([
                'jain_edu_heading'=>  'required',
            ]);
    
            $input['jain_edu_heading'] = $request->jain_edu_heading;

            if ($id){
                Home::find($id)->update($input);
                return redirect('admin/cms/home')->with('success', 'Jainism Additional Educational Resources Section Updated Successfully!');
            } else {
                $input['created_by']  = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Home::create($input);
                return redirect('admin/cms/home')->with('success', 'Jainism Additional Educational Resources Section Added Successfully!');
            }
    
        }

        if($request->has('jainism_research_and_academic_resources_section')){

            $request->validate([
                'jain_acd_heading'=>  'required',
            ]);
    
            $input['jain_acd_heading'] = $request->jain_acd_heading;

            if ($id){
                Home::find($id)->update($input);
                return redirect('admin/cms/home')->with('success', 'Jainism Research and Academic Resources Section Updated Successfully!');
            } else {
                $input['created_by']  = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Home::create($input);
                return redirect('admin/cms/home')->with('success', 'Jainism Research and Academic Resources Section Added Successfully!');
            }
    
        }

        if($request->has('testimonials_section')){

            $request->validate([
                'testimonials_heading'=>  'required',
            ]);
    
            $input['testimonials_heading'] = $request->testimonials_heading;

            if ($id){
                Home::find($id)->update($input);
                return redirect('admin/cms/home')->with('success', 'Testimonials Section Updated Successfully!');
            } else {
                $input['created_by']  = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Home::create($input);
                return redirect('admin/cms/home')->with('success', 'Testimonials Section Added Successfully!');
            }
    
        }

        if($request->has('blogs_section')){

            $request->validate([
                'blog_heading'=>  'required',
                'blog_sub_heading'=>  'required',
            ]);
    
            $input['blog_heading'] = $request->blog_heading;
            $input['blog_sub_heading'] = $request->blog_sub_heading;

            if ($id){
                Home::find($id)->update($input);
                return redirect('admin/cms/home')->with('success', 'Blogs Section Updated Successfully!');
            } else {
                $input['created_by']  = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Home::create($input);
                return redirect('admin/cms/home')->with('success', 'Blogs Section Added Successfully!');
            }
    
        }

        if($request->has('gallery_section')){

            $request->validate([
                'gallery_heading'=>  'required',
            ]);
    
            $input['gallery_heading'] = $request->gallery_heading;

            if ($id){
                Home::find($id)->update($input);
                return redirect('admin/cms/home')->with('success', 'Gallery Section Updated Successfully!');
            } else {
                $input['created_by']  = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Home::create($input);
                return redirect('admin/cms/home')->with('success', 'Gallery Section Added Successfully!');
            }
    
        }
}

}
