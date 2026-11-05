<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Front as Front;
use Illuminate\Support\Facades\Validator;

class InternshipOpportunityController extends Controller
{
    public function index(){
        $positions = config('constant.positions');
        $data = [
            'positions' => $positions
        ];
        return response()->json(['status' => true, 'data' => $data], 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|numeric|digits:10',
            'position' => 'required',
            'about' => 'required',
            'goals' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['mobile_no'] = $request->mobile;
        $input['position'] = $request->position;
        $input['about'] = $request->about;
        $input['goals'] = $request->goals;
        $input['message'] = $request->message;
        $input['created_by'] = '123';
        $input['created_ip_address'] = $request->ip();

        if($response = Front\InternshipEnquiry::create($input)){
            $data = [
                'internship_enquiry' => $response
            ];
            return response()->json(['status' => true, 'data' => $data], 200);
        }
    }
}
