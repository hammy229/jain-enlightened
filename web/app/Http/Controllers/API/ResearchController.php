<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as Admin;
use Storage;

class ResearchController extends Controller
{
    // public function index(Request $request){
    //     if(!empty($request->resource_type) && !array_key_exists($request->resource_type, config('constant.resources_type'))){
    //         return response()->json(['status' => false, 'data' => 'Incorrect request'], 404);
    //     }
    //     $resource_type = !empty($request->resource_type) ? $request->resource_type : 'books_publishing';
    //     $researches = Admin\Research::where('status', 'active')->where('resources', $resource_type)->select('id', 'heading', 'resources', 'description', 'research_url', 'research_img_path', 'research_img_name')->orderBy('id', 'desc')->get();
    //     $researches->map(function($research){
    //         $research->research_img_path = !empty($research->research_img_path) && Storage::exists($research->research_img_path) ? url('/').Storage::url($research->research_img_path) : '';
    //     });
    //     $data = [
    //         'researches' => $researches
    //     ];
    //     return response()->json(['status' => true, 'data' => $data], 200);
    // }
    public function index(Request $request)
    {
        if (!empty($request->resource_type) && !array_key_exists($request->resource_type, config('constant.resources_type'))) {
            return response()->json(['status' => false, 'data' => 'Incorrect request'], 404);
        }
    
        $resource_type = !empty($request->resource_type) ? $request->resource_type : 'books_publishing';
    
        // First 3 records based on latest_checked and updated_at
        $firstThreeResearches = Admin\Research::where('status', 'active')
            ->where('resources', $resource_type)
            ->where('latest_checked', true)
            ->orderBy('updated_at', 'asc')
            ->take(3)
            ->get();
    
        // Remaining records excluding those from the first query
        $remainingResearches = Admin\Research::where('status', 'active')
            ->where('resources', $resource_type)
            ->whereNotIn('id', $firstThreeResearches->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->get();
    
        // Format the images for both sets of researches
        $firstThreeResearches->map(function ($research) {
            $research->research_img_path = !empty($research->research_img_path) && Storage::exists($research->research_img_path)
                ? url('/') . Storage::url($research->research_img_path)
                : '';
        });
    
        $remainingResearches->map(function ($research) {
            $research->research_img_path = !empty($research->research_img_path) && Storage::exists($research->research_img_path)
                ? url('/') . Storage::url($research->research_img_path)
                : '';
        });
    
        // Combine 
        $allResearches = $firstThreeResearches->merge($remainingResearches);
    
        $data = [
            'researches' => $allResearches
        ];
    
        return response()->json(['status' => true, 'data' => $data], 200);
    }
    



}
