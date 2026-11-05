<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Models\Admin\Privacypolicy;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index (){
        $privacy = Privacypolicy::where('status','active')->first();
        return view('Admin.CMS.privacy-policy',compact('privacy'));
    }
    public function store(Request $request){

        $id = $request->id;

        $request->validate([
            'description' =>  'required',
        ]);

        $input['description'] = $request->description;

        if ($id){

            Privacypolicy::find($id)->update($input);
            return redirect('admin/cms/privacy-policy')->with('success', ' Data Updated Successfully!');
        } else {
            $input['created_by']  = auth()->guard('master_admins')->user()->id;
            $input['created_ip_address'] = $request->ip();
            Privacypolicy::create($input);
            return redirect('admin/cms/privacy-policy')->with('success', ' Data Added Successfully!');
        }

    }
}
