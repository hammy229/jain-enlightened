<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use App\Models\Admin\Internship;
use App\Models\Admin\Lesson;
use App\Models\Admin\Podcast;
use App\Models\Front\Contact;
use App\Models\Front\InternshipEnquiry;
use App\Models\Front\Visitor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){


        $lesson_count=Lesson::where('status','active')
        ->count();

        $podcast_count=Podcast::where('status','active')
        ->count();

        $blog_count=Blog::where('status','active')
        ->count();

        $contact_count=Contact::where('status','active')
        ->count();

        $internship_count=InternshipEnquiry::where('status','active')
        ->count();

        $visit_count=Visitor::where('status','active')->first();
    
        return view('Admin.Dashboard.index',compact('lesson_count','podcast_count','blog_count','contact_count','internship_count','visit_count'));
    }
}
