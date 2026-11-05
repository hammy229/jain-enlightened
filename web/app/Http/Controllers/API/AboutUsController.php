<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as Admin;
use Storage;

class AboutUsController extends Controller
{
    public function index(){
        $about_us = Admin\About::where('status', 'active')->select('id', 'about_heading', 'about_description', 'about_img_1_path', 'about_img_1_name', 'vision_heading', 'vision_description', 'vision_icon_path', 'vision_icon_name', 'mission_heading', 'mission_description', 'mission_icon_path', 'mission_icon_name', 'journey_heading', 'journey_description', 'journey_img_path', 'journey_img_name', 'linkedin_url', 'guidance_heading', 'guidance_description', 'guidance_img_path', 'guidance_img_name', 'acknow_heading', 'acknow_description', 'strategic_heading')->orderBy('id', 'desc')->first();
        if(!empty($about_us)){
            $about_us->about_img_1_path = !empty($about_us->about_img_1_path) && Storage::exists($about_us->about_img_1_path) ? url('/').Storage::url($about_us->about_img_1_path) : '';
            $about_us->vision_icon_path = !empty($about_us->vision_icon_path) && Storage::exists($about_us->vision_icon_path) ? url('/').Storage::url($about_us->vision_icon_path) : '';
            $about_us->mission_icon_path = !empty($about_us->mission_icon_path) && Storage::exists($about_us->mission_icon_path) ? url('/').Storage::url($about_us->mission_icon_path) : '';
            $about_us->journey_img_path = !empty($about_us->journey_img_path) && Storage::exists($about_us->journey_img_path) ? url('/').Storage::url($about_us->journey_img_path) : '';
            $about_us->guidance_img_path = !empty($about_us->guidance_img_path) && Storage::exists($about_us->guidance_img_path) ? url('/').Storage::url($about_us->guidance_img_path) : '';
            $about_us->guidance_short_description = !empty($about_us->guidance_description) ? substr(strip_tags($about_us->guidance_description), 0, 200). '...' : '';
            $about_us->acknow_short_description = !empty($about_us->acknow_description) ? substr(strip_tags($about_us->acknow_description), 0, 200). '...' : '';
        }
        
        $our_teams = Admin\Team::where('status', 'active')->where('team', 'our_team')->select('id', 'name', 'designation', 'team', 'linkedin_url', 'description', 'team_img_path', 'team_img_name')->orderBy('id', 'desc')->get();
        $our_teams->map(function($our_team){
            $our_team->team_img_path = !empty($our_team->team_img_path) && Storage::exists($our_team->team_img_path) ? url('/').Storage::url($our_team->team_img_path) : '';
        });

        $advisory_boards = Admin\Team::where('status', 'active')->where('team', 'advisory_board')->select('id', 'name', 'designation', 'team', 'linkedin_url', 'description', 'team_img_path', 'team_img_name')->orderBy('id', 'desc')->get();
        $advisory_boards->map(function($advisory_board){
            $advisory_board->team_img_path = !empty($advisory_board->team_img_path) && Storage::exists($advisory_board->team_img_path) ? url('/').Storage::url($advisory_board->team_img_path) : '';
        });
       
        $Strategicgoals = Admin\Strategicgoals::where('status', 'active')->select('id', 'heading', 'description', 'strategic_img_path', 'strategic_img_name')->orderBy('id', 'desc')->get();
        $Strategicgoals->map(function($Strategicgoal){
            $Strategicgoal->strategic_img_path = !empty($Strategicgoal->strategic_img_path) && Storage::exists($Strategicgoal->strategic_img_path) ? url('/').Storage::url($Strategicgoal->strategic_img_path) : '';
        });

        $data = [
            'about_us' => $about_us,
            'advisory_boards' => $advisory_boards,
            'our_teams' => $our_teams,
            'Strategicgoals' => $Strategicgoals
        ];
        return response()->json(['status' => true, 'data' => $data], 200);
    }
}
