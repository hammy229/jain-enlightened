<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\About;
use App\Models\Admin\Banner;
use App\Models\Admin\Blog;
use App\Models\Admin\Donate;
use App\Models\Admin\Gallery;
use App\Models\Admin\Home;
use App\Models\Admin\Impact;
use App\Models\Admin\Podcast;
use App\Models\Admin\Lesson;
use App\Models\Admin\Research;
use App\Models\Admin\Seo;
use App\Models\Admin\Strategicgoals;
use App\Models\Admin\Team;
use App\Models\Admin\Teastimonial;
use App\Models\Front\Pagevisitor;
use App\Models\Front\Visitor;
use Illuminate\Http\Request;

class Home_Controller_Front extends Controller
{
    public function index(Request $request)
    {
        $ip = $request->ip();
        $today = date('Y-m-d'); // Get today's date
    
        // Fetch the single record from the `visitors` table
        $visitor = Visitor::first(); // Assuming there's only one record in this table
        
        if (!$visitor) {
            // If no record exists in `visitors`, create one
            $visitor = Visitor::create([
                'visit_count' => 0,
                'total_count' => 0
            ]);
        }
    
        // Check if this IP has visited today in the `pagevisitors` table
        $pageVisitor = PageVisitor::where('ip_address', $ip)
                                  ->whereDate('visited_at', $today)
                                  ->first();
    
        if (!$pageVisitor) {
            // If the IP is unique for today, create a new record in `pagevisitors` table
            PageVisitor::create([
                'ip_address' => $ip,
                'visited_at' => $today // Record today's date
            ]);
    
            // Increment visit_count only for unique IPs each day
            $visitor->visit_count += 1;
        }
    
        // Increment total_count for every visit (whether the IP is unique for today or not)
        $visitor->total_count += 1;
    
        // Save the updated visit_count and total_count in the `visitors` table
        $visitor->save();
    
        // Fetch data for the homepage
        $Home = Home::where('status', '=', 'active')->first();
        $metadata = Seo::where('page', 'home')->where('status', 'active')->first();
        $latest_blogs = Blog::where('status', 'active')->orderBy('created_at', 'desc')->limit(3)->get();
        $latest_lesson = Lesson::where('status', 'active')->orderBy('created_at', 'desc')->limit(3)->get();
        $latest_podcasts = Podcast::where('status', 'active')->orderBy('created_at', 'desc')->limit(3)->get();

        $academics = Research::where('resources', 'academic_resources')->where('status', 'active')->orderBy('created_at', 'desc')->limit(3)->get();
        $educational = Research::where('resources', 'educational_resources_board')->where('status', 'active')->orderBy('created_at', 'desc')->limit(3)->get();;
        $teastimonials = Teastimonial::where('status', 'active')->orderBy('created_at', 'desc')->limit(3)->get();;
        $gallery_img = Gallery::where('type', 'image')->where('status', 'active')->orderBy('created_at', 'desc')->limit(4)->get();

        return view('Front.index', compact('Home', 'latest_blogs','metadata', 'latest_lesson','latest_podcasts','educational','academics','teastimonials','gallery_img'));
    }

    public function about()
    {
        $about = About::where('status', '=', 'active')->first();
        $teams = Team::where('team', 'our_team')->where('status', 'active')->get();
        $team_bords = Team::where('team', 'advisory_board')->where('status', 'active')->get();
        $strategics = Strategicgoals::where('status', 'active')->orderBy('created_at', 'asc')->get();

        // dd($teams);

        $metadata = Seo::where('page', 'about')->where('status', 'active')->first();
        $banner = Banner::where('page', 'about_us')->where('status', 'active')->first();
        return view('Front.about-us', compact('about','banner','metadata','teams','team_bords','strategics'));
    }

    public function podcast(){
        $podcasts = Podcast::where('status', '=', 'active')->orderBy('created_at', 'desc')->paginate(6);
        $metadata = Seo::where('page', 'podcasts')->where('status', 'active')->first();
        $banner = Banner::where('page', 'podcasts')->where('status', 'active')->first();
        return view('Front.podcasts', compact('podcasts', 'banner', 'metadata'));
    }


    public function impact(){
        $impacts = Impact::where('status', '=', 'active')->orderBy('created_at', 'desc')->paginate(6);
        $metadata = Seo::where('page', 'impact')->where('status', 'active')->first();
        $banner = Banner::where('page', 'impact')->where('status', 'active')->first();
        return view('Front.impact', compact('impacts', 'banner', 'metadata'));
    }
    public function donate(){

        $donate = Donate::where('status', '=', 'active')->first();
        $metadata = Seo::where('page', 'donate')->where('status', 'active')->first();
        $banner = Banner::where('page', 'donate')->where('status', 'active')->first();
        return view('Front.donate', compact('donate','banner','metadata'));
    }

    


}
