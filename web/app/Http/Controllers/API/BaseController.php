<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as Admin;

class BaseController extends Controller
{
    public function index(){
        $base_url = config('constant.base_url');
        $base_url['live'] = url('/');
        $data = [
            'base_url' => $base_url
        ];
        return response()->json(['status' => true, 'data' => $data], 200);
    }

    public function app_update(){
        $android_app_version = Admin\AppConfiguration::where('status', 'active')->where('config_type', 'android')->value('config_version');
        $ios_app_version = Admin\AppConfiguration::where('status', 'active')->where('config_type', 'ios')->value('config_version');
        
        $app_latest_version = [
            "latest_version_android" => !empty($android_app_version) ? $android_app_version : '',
            "latest_version_ios" => !empty($ios_app_version) ? $ios_app_version : ''
        ];
        $data = [
            'app_latest_version' => $app_latest_version
        ];
        
        return response()->json(['status' => true, 'data' => $data], 200);
    }

    public function store_link(){
        $store_link = Admin\Home::where('status', 'active')->select('play_link', 'app_link')->first();
        $data = [
            'store_link' => $store_link
        ];
        return response()->json(['status' => true, 'data' => $data], 200);
    }
}
