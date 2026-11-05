<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use App\Models\Admin\Research;
use App\Models\Admin\Seo;
use Illuminate\Http\Request;

class Front_Resource_Controller extends Controller
{

    public function publishing(Request $request)
    {
        $metadata = Seo::where('page', 'research')->where('status', 'active')->first();
        $banner = Banner::where('page', 'research')->where('status', 'active')->first();

        // Fetch the first 3 records based on latest_checked and updated_at
        $firstThreeResearches = Research::where('resources', 'books_publishing')
            ->where('status', 'active')
            ->where('latest_checked', true)
            ->orderBy('updated_at', 'asc')
            ->take(3)
            ->get();

        // Fetch the remaining records excluding those from first query and apply pagination
        $remainingResearches = Research::where('resources', 'books_publishing')
            ->where('status', 'active')
            ->whereNotIn('id', $firstThreeResearches->pluck('id')) // Exclude the first 3
            ->orderBy('created_at', 'desc')
            ->paginate(6); // Change the number to your preferred page size

        return view('Front.Research.publishing-resources', compact('banner', 'metadata', 'firstThreeResearches', 'remainingResearches'));
    }

    public function academic(){
        $metadata = Seo::where('page', 'research')->where('status', 'active')->first();
        $banner = Banner::where('page', 'research')->where('status', 'active')->first();
        $researches = Research::where('resources', 'academic_resources')->where('status', 'active')->orderBy('created_at', 'desc')->paginate(6);
        return view('Front.Research.academic-resources',compact('banner','metadata','researches'));
    }

    public function educational(){
        $metadata = Seo::where('page', 'research')->where('status', 'active')->first();
        $banner = Banner::where('page', 'research')->where('status', 'active')->first();
        $researches = Research::where('resources', 'educational_resources_board')->where('status', 'active')->orderBy('created_at', 'desc')->paginate(6);
        return view('Front.Research.educational-resources',compact('banner','metadata','researches'));
    }
}
