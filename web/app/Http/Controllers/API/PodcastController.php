<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as Admin;
use Storage;

class PodcastController extends Controller
{
    public function index(){
        $podcasts = Admin\Podcast::where('status', 'active')->select('id', 'heading', 'youtube_url', 'podcast_img_path', 'podcast_img_name')->orderBy('id', 'desc')->get();
        $podcasts->map(function($podcast){
            $podcast->podcast_img_path = !empty($podcast->podcast_img_path) && Storage::exists($podcast->podcast_img_path) ? url('/').Storage::url($podcast->podcast_img_path) : '';
        });
        $data = [
            'podcasts' => $podcasts
        ];
        return response()->json(['status' => true, 'data' => $data], 200);
    }
}
