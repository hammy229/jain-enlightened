<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as Admin;
use Storage;

class BlogController extends Controller
{
    public function index(){
        $blogs = Admin\Blog::where('status', 'active')->select('id', 'heading', 'slug_url', 'blog_by', 'date', 'short_description', 'description', 'blog_img_path', 'blog_img_name')->orderBy('id', 'desc')->get();
        $blogs->map(function($blog){
            $blog->blog_img_path = !empty($blog->blog_img_path) && Storage::exists($blog->blog_img_path) ? url('/').Storage::url($blog->blog_img_path) : '';
        });
        $data = [
            'blogs' => $blogs
        ];
        return response()->json(['status' => true, 'data' => $data], 200);
    }
    
    public function view(Request $request){
        $blog = Admin\Blog::where('status', 'active')->where('id', $request->id)->select('id', 'heading', 'slug_url', 'blog_by', 'date', 'short_description', 'description', 'blog_img_path', 'blog_img_name')->first();
        $blog->blog_img_path = !empty($blog->blog_img_path) && Storage::exists($blog->blog_img_path) ? url('/').Storage::url($blog->blog_img_path) : '';
        
        $latest_blogs = Admin\Blog::where('status', 'active')->where('id', '!=', $request->id)->select('id', 'heading', 'slug_url', 'blog_by', 'date', 'short_description', 'description', 'blog_img_path', 'blog_img_name')->orderBy('id', 'desc')->limit(5)->get();
        $latest_blogs->map(function($latest_blog){
            $latest_blog->blog_img_path = !empty($latest_blog->blog_img_path) && Storage::exists($latest_blog->blog_img_path) ? url('/').Storage::url($latest_blog->blog_img_path) : '';
        });

        $data = [
            'blog' => $blog,
            'latest_blogs' => $latest_blogs
        ];
        return response()->json(['status' => true, 'data' => $data], 200);
    }
}
