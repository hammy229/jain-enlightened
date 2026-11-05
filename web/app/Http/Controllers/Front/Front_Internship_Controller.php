<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Front\InternshipEnquiry;
use Illuminate\Http\Request;

class Front_Internship_Controller extends Controller
{
    public function store(Request $request){

           
   
           $request->validate([
               'name'       => 'required',
               'email'      => 'required',
               'mobile_no'  => 'required',
               'position' => 'required',
               'about' => 'required',
               'goals' => 'required',
               'message'    => 'required'
           ]);

          // dd($request);
   
           $input['name']  = $request->name;
           $input['email'] = $request->email;
           $input['mobile_no'] = $request->mobile_no;
           $input['position']  = $request->position;
           $input['about'] = $request->about;
           $input['goals'] = $request->goals;
           $input['message']   = $request->message;
   
           InternshipEnquiry::create($input);
        //    return redirect('')->with('success', ' Form Submitted Successfully!');

        return redirect()->back()->with('success', 'Form Submitted Successfully!');
   
       }
}
