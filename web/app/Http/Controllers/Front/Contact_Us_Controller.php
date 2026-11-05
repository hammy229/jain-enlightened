<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use App\Models\Admin\Seo;
use App\Models\Front\Contact;
use Illuminate\Http\Request;

class Contact_Us_Controller extends Controller
{
    public function index(){
        $banner = Banner::where('page', 'contact_us')->where('status', 'active')->first();
        $metadata = Seo::where('page', 'contact_us')->where('status', 'active')->first();
        return view('Front.contact-us',compact('banner','metadata'));
    }

    public function store(Request $request){

     //   dd($request);

        $request->validate([
            'name'       => 'required',
            'email'      => 'required',
            'mobile_no'  => 'required',
            'message'    => 'required'
        ]);

        $input['name']  = $request->name;
        $input['email'] = $request->email;
        $input['mobile_no'] = $request->mobile_no;
        $input['message']   = $request->message;

        Contact::create($input);
        return redirect('contact-us')->with('success', ' Form Submitted Successfully!');

    }
}
