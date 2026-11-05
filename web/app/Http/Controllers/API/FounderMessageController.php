<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as Admin;
use Storage;

class FounderMessageController extends Controller
{
    public function index(){
        $founder_message = Admin\Home::where('status', 'active')->select('founders_heading', 'founders_description', 'founders_image_path', 'founders_image_name')->first();
        if(!empty($founder_message)){
            $founder_message->founders_image_path = !empty($founder_message->founders_image_path) && Storage::exists($founder_message->founders_image_path) ? url('/').Storage::url($founder_message->founders_image_path) : '';
        }

        $data = [
            'founder_message' => $founder_message,
        ];

        return response()->json(['status' => true, 'data' => $data], 200);
    }
}
