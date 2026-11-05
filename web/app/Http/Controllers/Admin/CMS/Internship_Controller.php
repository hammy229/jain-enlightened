<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Models\Admin\Internship;
use Illuminate\Http\Request;
use App\Traits\MediaTrait;

class Internship_Controller extends Controller
{
    use MediaTrait;
    public function index (){

        $intern = Internship::where('status','active')->first();
        return view('Admin.CMS.internship',compact('intern'));
    }

    public function store(Request $request){
        
        $id = $request->id;

        $request->validate([
            'heading'=> 'required',
            'sub_heading'=> 'required',
            'description' => 'required',
            'intern_img_path'=>  'image|max:5120',
        ],[
            'intern_img_path.max' => 'Please upload an image smaller than 5 MB.',
       ]);

        $input['heading'] = $request->heading;
        $input['sub_heading'] = $request->sub_heading;
        $input['description'] = $request->description;

        if ($request->has('intern_img_path')) {
            if ($request->file('intern_img_path')) {
                $input['intern_img_path'] = $this->verifyAndUpload($request, 'intern_img_path', 'intern_img_path');
                $original_name = $request->file('intern_img_path')->getClientOriginalName();
                $input['intern_img_name'] = $original_name;
            }
        }

        if($id){
          Internship::find($id)->update($input);
            return redirect('admin/cms/internship')->with('success', ' Internship Opportunities Data Updated Successfully!');
        }else{
            $input['created_by'] = auth()->guard('master_admins')->user()->id;
            $input['created_ip_address'] = $request->ip();
            Internship::create($input);
            return redirect('admin/cms/internship')->with('success', ' Internship Opportunities Data Added Successfully!');
        }
    }
}
