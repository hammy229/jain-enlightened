<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as Admin;
use Storage;

class GalleryController extends Controller
{
    public function index(Request $request){
        if(!empty($request->gallery_type) && !array_key_exists($request->gallery_type, config('constant.gallery_type'))){
            return response()->json(['status' => false, 'data' => 'Incorrect request'], 404);
        }
        $gallery_type = !empty($request->gallery_type) ? $request->gallery_type : 'image';
        $galleries = Admin\Gallery::where('status', 'active')->where('type', $gallery_type)->select('id', 'description', 'gallery_img_path', 'gallery_img_name', 'gallery_video_link', 'type')->orderBy('id', 'desc')->get();
        $galleries->map(function($gallery){
            $gallery->gallery_img_path = !empty($gallery->gallery_img_path) && Storage::exists($gallery->gallery_img_path) ? url('/').Storage::url($gallery->gallery_img_path) : '';
        });
        $data = [
            'galleries' => $galleries
        ];
        return response()->json(['status' => true, 'data' => $data], 200);
    }
}
