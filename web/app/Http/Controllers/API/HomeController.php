<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as Admin;
use Storage;

class HomeController extends Controller
{
    public function index(Request $request){
        $banners = Admin\Appbanner::where('status', 'active')->select('id', 'heading', 'app_banner_img_path', 'app_banner_img_name')->orderBy('id', 'desc')->get();
        $banners->map(function($banner){
            $banner->app_banner_img_path = !empty($banner->app_banner_img_path) && Storage::exists($banner->app_banner_img_path) ? url('/').Storage::url($banner->app_banner_img_path) : '';
        });

        $announcement_cards = Admin\Home::where('status', 'active')->select('id', 'card_heading_1', 'card_heading_2', 'card_heading_3', 'card_description_1', 'card_description_2', 'card_description_3', 'card_icon_1_path', 'card_icon_1_name', 'card_icon_2_path', 'card_icon_2_name', 'card_icon_3_path', 'card_icon_3_name', 'card_image_1_path', 'card_image_1_name', 'card_image_2_path', 'card_image_2_name', 'card_image_3_path', 'card_image_3_name')->first();
        if(!empty($announcement_cards)){
            $announcement_cards->card_icon_1_path = !empty($announcement_cards->card_icon_1_path) && Storage::exists($announcement_cards->card_icon_1_path) ? url('/').Storage::url($announcement_cards->card_icon_1_path) : '';
            $announcement_cards->card_icon_2_path = !empty($announcement_cards->card_icon_2_path) && Storage::exists($announcement_cards->card_icon_2_path) ? url('/').Storage::url($announcement_cards->card_icon_2_path) : '';
            $announcement_cards->card_icon_3_path = !empty($announcement_cards->card_icon_3_path) && Storage::exists($announcement_cards->card_icon_3_path) ? url('/').Storage::url($announcement_cards->card_icon_3_path) : '';
        }

        $headings = Admin\Home::where('status', 'active')->select('heading', 'about_heading', 'lessons_heading', 'founders_heading', 'podcasts_heading', 'jain_edu_heading', 'jain_acd_heading', 'testimonials_heading', 'blog_heading', 'gallery_heading')->first();

        $lessons = Admin\Lesson::where('status', 'active')->select('id', 'heading', 'lesson_img_path', 'lesson_img_name')->orderBy('id', 'desc')->limit(5)->get();
        $lessons->map(function($lesson){
            $lesson->lesson_img_path = !empty($lesson->lesson_img_path) && Storage::exists($lesson->lesson_img_path) ? url('/').Storage::url($lesson->lesson_img_path) : '';
        });

        $mission = Admin\Home::where('status', 'active')->select('about_heading', 'about_description', 'about_image_path', 'about_image_name')->first();
        if(!empty($mission)){
            $mission->short_description = !empty($mission->about_description) ? substr(strip_tags($mission->about_description), 0, 150). '...' : '';
            $mission->about_image_path = !empty($mission->about_image_path) && Storage::exists($mission->about_image_path) ? url('/').Storage::url($mission->about_image_path) : '';
        }

        $podcasts = Admin\Podcast::where('status', 'active')->select('heading', 'youtube_url', 'podcast_img_path', 'podcast_img_name')->orderBy('id', 'desc')->limit(5)->get();
        $podcasts->map(function($podcast){
            $podcast->podcast_img_path = !empty($podcast->podcast_img_path) && Storage::exists($podcast->podcast_img_path) ? url('/').Storage::url($podcast->podcast_img_path) : '';
        });

        $founder_message = Admin\Home::where('status', 'active')->select('founders_heading', 'founders_description', 'founders_image_path', 'founders_image_name')->first();
        if(!empty($founder_message)){
            $founder_message->founders_short_description = !empty($founder_message->founders_description) ? substr(strip_tags($founder_message->founders_description), 0, 150). '...' : '';
            $founder_message->founders_image_path = !empty($founder_message->founders_image_path) && Storage::exists($founder_message->founders_image_path) ? url('/').Storage::url($founder_message->founders_image_path) : '';
        }

        $educational_researches = Admin\Research::where('status', 'active')->where('resources', 'educational_resources_board')->select('id', 'heading', 'resources', 'description', 'research_url', 'research_img_path', 'research_img_name')->orderBy('id', 'desc')->limit(5)->get();
        $educational_researches->map(function($educational_research){
            $educational_research->research_img_path = !empty($educational_research->research_img_path) && Storage::exists($educational_research->research_img_path) ? url('/').Storage::url($educational_research->research_img_path) : '';
        });
        
        $academic_researches = Admin\Research::where('status', 'active')->where('resources', 'academic_resources')->select('id', 'heading', 'resources', 'description', 'research_url', 'research_img_path', 'research_img_name')->orderBy('id', 'desc')->limit(5)->get();
        $academic_researches->map(function($academic_research){
            $academic_research->research_img_path = !empty($academic_research->research_img_path) && Storage::exists($academic_research->research_img_path) ? url('/').Storage::url($academic_research->research_img_path) : '';
        });

        $blogs = Admin\Blog::where('status', 'active')->select('id', 'heading', 'slug_url', 'blog_by', 'date', 'short_description', 'description', 'blog_img_path', 'blog_img_name')->orderBy('id', 'desc')->limit(5)->get();
        $blogs->map(function($blog){
            $blog->blog_img_path = !empty($blog->blog_img_path) && Storage::exists($blog->blog_img_path) ? url('/').Storage::url($blog->blog_img_path) : '';
        });

        $galleries = Admin\Gallery::where('status', 'active')->where('type', 'image')->select('id', 'gallery_img_path', 'gallery_img_name', 'type')->orderBy('id', 'desc')->limit(5)->get();
        $galleries->map(function($gallery){
            $gallery->gallery_img_path = !empty($gallery->gallery_img_path) && Storage::exists($gallery->gallery_img_path) ? url('/').Storage::url($gallery->gallery_img_path) : '';
        });

        $testimonials = Admin\Teastimonial::where('status', 'active')->select('id', 'name', 'location', 'description', 'teastimonial_img_path', 'teastimonial_img_name')->orderBy('id', 'desc')->get();
        $testimonials->map(function($testimonial){
            $testimonial->teastimonial_img_path = !empty($testimonial->teastimonial_img_path) && Storage::exists($testimonial->teastimonial_img_path) ? url('/').Storage::url($testimonial->teastimonial_img_path) : '';
        });

        $internship = Admin\Internship::where('status', 'active')->select('id', 'heading', 'sub_heading', 'description')->orderBy('id', 'desc')->first();

        $data = [
            'banners' => $banners,
            'announcement_cards' => $announcement_cards,
            'headings' => $headings,
            'lessons' => $lessons,
            'mission' => $mission,
            'podcasts' => $podcasts,
            'founder_message' => $founder_message,
            'educational_researches' => $educational_researches,
            'academic_researches' => $academic_researches,
            'blogs' => $blogs,
            'galleries' => $galleries,
            'testimonials' => $testimonials,
            'internship' => $internship,
        ];

        return response()->json(['status' => true, 'data' => $data], 200);
    }
}
