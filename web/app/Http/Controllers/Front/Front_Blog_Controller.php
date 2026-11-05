<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use App\Models\Admin\Blog;
use App\Models\Admin\Seo;
use Illuminate\Http\Request;

class Front_Blog_Controller extends Controller
{
    public function index()
    {
        $banner = Banner::where('page', 'blogs')->where('status', 'active')->first();
        $Blogs = Blog::where('status', 'active')->orderBy('created_at', 'desc')->paginate(6);
        $metadata = Seo::where('page', 'blogs')->where('status', 'active')->first();
    //    dd($banner);
     
        return view('Front.blogs', compact('banner','Blogs','metadata'));
    }
    
  
    public function blog_details(Request $request)
    { 

        //$metadata_blog = Rl_ourblog::where('status', 'active')->first();
        $banner = Banner::where('page', 'blogs')->where('status', 'active')->first();
     
        $blog_details = Blog::where('status','=','active')->where('slug_url',$request->url)->first();
        if(empty($blog_details)){
            return redirect('/404');
        }
        if(!empty($blog_details)){
            // dd($blog_details->id);
        $latest_blogs = Blog::where('status', 'active')->where('id','!=', $blog_details->id)->orderBy('created_at','desc')->limit(3)->get();
         ///   dd( $latest_blogs);
        }

        $blog_url = url('blog/' . $blog_details->slug_url); // Generate the blog URL

       // dd($blog_details);

        return view('Front.blog-details',compact('blog_details','latest_blogs','blog_url'));
    }
}
