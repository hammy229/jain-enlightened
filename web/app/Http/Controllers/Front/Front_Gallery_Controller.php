<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use App\Models\Admin\Gallery;
use App\Models\Admin\Seo;
use Illuminate\Http\Request;

class Front_Gallery_Controller extends Controller
{
    public function index(Request $request){

        $metadata = Seo::where('page', 'gallery')->where('status', 'active')->first();
        $banner = Banner::where('page', 'gallery')->where('status', 'active')->first();
        $gallery_img = Gallery::where('type', 'image')->where('status', 'active')->orderBy('created_at', 'desc')->paginate(6);
        $gallery_video = Gallery::where('type', 'video')->where('status', 'active')->orderBy('created_at', 'desc')->paginate(6);
        
        return view('Front.gallery',compact('metadata','banner','gallery_img','gallery_video'));
    }
}
