<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master as Master;
use App\Models\Front as Front;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    public function index(){
        $contacts = Master\General_setting::where('status', 'active')->select('id', 'heading', 'description', 'email', 'mobile', 'address', 'map_link', 'facebook_url', 'linkedin_url', 'instagram_url', 'twitter_url', 'youtube_url')->orderBy('id', 'desc')->first();
        $data = [
            'contacts' => $contacts
        ];
        return response()->json(['status' => true, 'data' => $data], 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|numeric|digits:10',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['mobile_no'] = $request->mobile;
        $input['message'] = $request->message;
        $input['created_by'] = '123';
        $input['created_ip_address'] = $request->ip();

        if($response = Front\Contact::create($input)){
            $data = [
                'contact' => $response
            ];
            return response()->json(['status' => true, 'data' => $data]);
        }
    }
}
