<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use Illuminate\Http\Request;
use App\Traits\MediaTrait;
use Illuminate\Support\Facades\Storage;

class Banner_controller extends Controller
{
    use MediaTrait;
    public function index() {

        return view ('Admin.CMS.banner');
    }
    public function store(Request $request)
    {
        $id = $request->id;

        if ($request->has('banner_section')){

          //  dd($request);
            $request->validate([
                'page' => 'required',
                'heading' => 'required',
                'ban_image_path' => 'image|max:5120', 
            ],[
                'ban_image_path.max' => 'Please upload an image smaller than 5 MB.',
            ]);
        
          $input['page'] = $request->page;
            $input['heading'] = $request->heading;

            if ($request->has('ban_image_path')) {
                            if ($request->file('ban_image_path')) {
                                $input['ban_image_path'] = $this->verifyAndUpload($request, 'ban_image_path', 'ban_image_path');
                                $original_name = $request->file('ban_image_path')->getClientOriginalName();
                                $input['ban_image_name'] = $original_name;
                            }
                        }
            $input['modified_by'] = auth()->guard('master_admins')->user()->id;
            $input['modified_ip_address'] = $request->ip();
    
            // Check if SEO data for the selected page already exists
            $seoData = Banner::where('page', $request->page)->first();

            // Capitalize the first letter and replace underscores with spaces
             $page = ucwords(str_replace('_', ' ', $request->page));

            if (!empty($seoData)) {
                    $seoData->update($input);
                    return redirect('admin/cms/banner')->with('success',  $page .' Data Updated Successfully!');
            } else {
                    $input['created_by'] = auth()->guard('master_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Banner::create($input);
                    return redirect('admin/cms/banner')->with('success', $page .' Data Added Successfully!');
            }
        }
    }


    public function fetchBannerData($page)
    {
        $Banner_Data = Banner::where('page', $page)->first(['id','heading','ban_image_path']);

        if (!empty($Banner_Data)) {
            $banner_path = !empty($Banner_Data->ban_image_path) && Storage::exists($Banner_Data->ban_image_path) ? url('/').Storage::url($Banner_Data->ban_image_path) : '';
        
            return response()->json(['Banner_Data'=>$Banner_Data,'banner_path'=>$banner_path]);
        } else {
            return response()->json([
                'Banner_Data' => [
                    'id' => '',
                    'heading' => '',
                    'ban_image_path' => ''
                ],
                'banner_path' => ''
            ]);
        }
    }

}
