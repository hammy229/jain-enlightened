<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as Admin;

class TermAndConditionController extends Controller
{
    public function index(Request $request){
        $terms_and_condition = Admin\Termscondition::where('status', 'active')->select('id', 'description')->orderBy('id', 'desc')->get();
        $data = [
            'terms_and_condition' => $terms_and_condition
        ];
        return response()->json(['status' => true, 'data' => $data], 200);
    }
}
