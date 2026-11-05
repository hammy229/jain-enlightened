<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use App\Models\Admin\Language;
use App\Models\Admin\Lesson;
use App\Models\Admin\Seo;
use Illuminate\Http\Request;

class lessons_Controller extends Controller
{
    // public function index(Request $request){
     
    //     $lessons = Lesson::with('language')->where('status', 'active')->get();
    //     $metadata = Seo::where('page', 'lessons')->where('status', 'active')->first();
    //     $banner = Banner::where('page', 'lessons')->where('status', 'active')->first();
        
    //     return view('Front.lessons', compact('lessons', 'metadata', 'banner'));
    // }

    public function index(Request $request) {
        $languageFilter = $request->input('language', 'all_language');
    
        // Query to get active lessons, filter by language if not "all_language"
        $query = Lesson::with('language')->where('status', 'active');
        
        // Apply language filter if it's not 'all_language'
        if ($languageFilter != 'all_language') {
            $query->whereHas('language', function ($q) use ($languageFilter) {
                $q->where('heading', $languageFilter);
            });
        }
    
        // Sort lessons by 'created_at' field in descending order
      //  $lessons = $query->orderBy('created_at', 'DESC')->get();

         // Paginate lessons
         $lessons = $query->orderBy('created_at', 'DESC')->paginate(6);
    
        // Fetch metadata, banner, and languages
        $metadata = Seo::where('page', 'lessons')->where('status', 'active')->first();
        $banner = Banner::where('page', 'lessons')->where('status', 'active')->first();
        $languages = Language::where('status', 'active')->get();
    
        // Check if request is ajax for dynamic loading
        if ($request->ajax()) {
            return response()->json([
                'lessons' => view('Front.lesson-cards', compact('lessons'))->render(),
                'pagination' => (string) $lessons->links('pagination::bootstrap-4')
            ]);
        }
    
        return view('Front.lessons', compact('lessons', 'metadata', 'banner', 'languages'));
    }

    public function lesson_details(Request $request)
    { 

        $lesson_details = Lesson::where('status','=','active')->where('slug_url',$request->url)->first();

        if(empty($lesson_details)){
            return redirect('/404');
        }

        $lesson_url = url('lesson/' . $lesson_details->slug_url); // Generate the blog URL

         return view('Front.lessons-details',compact('lesson_details','lesson_url'));
      //  return view('Front.lessons-details');
    }


    public function filterByLanguage(Request $request)
    {
        $language = $request->language;
    
        if ($language == 'all_language') {
            $lessons = Lesson::with('language')->where('status', 'active')->get();
        } else {
            // Filter by specific language
            $lessons = Lesson::with('language')
                ->whereHas('language', function ($query) use ($language) {
                    $query->where('heading', $language); // Ensure this is matching the exact value in the database
                })
                ->where('status', 'active')
                ->get();
        }

       // dd($lessons);

    
        return response()->json(['lessons' => $lessons]);
    }
    
    

}
