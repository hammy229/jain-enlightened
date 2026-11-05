<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as Admin;

class PrivacyPolicyController extends Controller
{
    public function index(Request $request){
        $privacy_policy = Admin\Privacypolicy::where('status', 'active')->select('id', 'description')->orderBy('id', 'desc')->get();
        $data = [
            'privacy_policy' => $privacy_policy
        ];
        return response()->json(['status' => true, 'data' => $data], 200);
    }
}
