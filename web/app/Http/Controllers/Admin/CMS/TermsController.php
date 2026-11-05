<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Models\Admin\Termscondition;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index (){

        $term = Termscondition::where('status','active')->first();
        return view('Admin.CMS.terms-conditions',compact('term'));
    }

    public function store(Request $request){
        $id = $request->id;

        $request->validate([
            'description' => 'required'
        ]);

        $input['description'] = $request->description;
        if($id){
          //  $id->update($input);
            Termscondition::find($id)->update($input);
            return redirect('admin/cms/terms-conditions')->with('success', ' Data Updated Successfully!');
        }else{
            $input['created_by'] = auth()->guard('master_admins')->user()->id;
            $input['created_ip_address'] = $request->ip();
            Termscondition::create($input);
            return redirect('admin/cms/terms-conditions')->with('success', ' Data Added Successfully!');
        }

    }
}
