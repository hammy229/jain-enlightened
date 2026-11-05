<?php

namespace App\Http\Controllers\Admin\Donate;

use App\Http\Controllers\Controller;
use App\Models\Admin\Donate;
use Illuminate\Http\Request;
use App\Traits\MediaTrait;
class Donate_Controller extends Controller
{
    use MediaTrait;
    public function index(){

        $donate = Donate::where('status','active')->first();
        return view('Admin.Donate.index',compact('donate'));
    }

    public function store(Request $request){

        $id = $request->id;
        if($request->has('donate_section')){

            $request->validate([
                'bank_name'=>  'required',
                'account_holder_name'=>  'required',
                'account_number'=>  'required',
                'ifsc_code'=>  'required',
                'scanner_heading_1'=>  'required',
                'scanner_heading_2'=>  'required',
                'scanner_img_path_1'=>  'image|max:5120',
                'scanner_img_path_2'=>  'image|max:5120',
            ],[
                'scanner_img_path_1.max' => 'Please upload an image smaller than 5 MB.',
                'scanner_img_path_2.max' => 'Please upload an image smaller than 5 MB.',
            ]);
    
            $input['bank_name'] = $request->bank_name;
            $input['account_holder_name'] = $request->account_holder_name;
            $input['account_number'] = $request->account_number;
            $input['ifsc_code'] = $request->ifsc_code;
            $input['scanner_heading_1'] = $request->scanner_heading_1;
            $input['scanner_heading_2'] = $request->scanner_heading_2;
           

            if ($request->has('scanner_img_path_1')) {
                if ($request->file('scanner_img_path_1')) {
                    $input['scanner_img_path_1'] = $this->verifyAndUpload($request, 'scanner_img_path_1', 'scanner_img_path_1');
                    $original_name = $request->file('scanner_img_path_1')->getClientOriginalName();
                    $input['scanner_img_name_1'] = $original_name;
                }
            }

            if ($request->has('scanner_img_path_2')) {
                if ($request->file('scanner_img_path_2')) {
                    $input['scanner_img_path_2'] = $this->verifyAndUpload($request, 'scanner_img_path_2', 'scanner_img_path_2');
                    $original_name = $request->file('scanner_img_path_2')->getClientOriginalName();
                    $input['scanner_img_name_2'] = $original_name;
                }
            }
    
            if ($id){
                Donate::find($id)->update($input);
                return redirect('admin/donate')->with('success', 'Donate Data Updated Successfully!');
            } else {
                $input['created_by']  = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Donate::create($input);
                return redirect('admin/donate')->with('success', 'Donate Data Added Successfully!');
            }

        }
    }
}
