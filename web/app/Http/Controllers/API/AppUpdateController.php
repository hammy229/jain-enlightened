<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppUpdateController extends Controller
{
    public function index(){
        $app_latest_version = config('constant.app_latest_version');
        $data = [
            'app_latest_version' => $app_latest_version
        ];
        return response()->json(['status' => true, 'data' => $data], 200);
    }
}
