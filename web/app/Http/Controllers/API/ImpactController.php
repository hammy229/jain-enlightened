<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as Admin;
use Storage;

class ImpactController extends Controller
{
    public function index(){
        $impacts = Admin\Impact::where('status', 'active')->select('id', 'heading', 'description', 'imptact_img_path', 'imptact_img_name')->orderBy('id', 'desc')->get();
        $impacts->map(function($impact){
            $impact->imptact_img_path = !empty($impact->imptact_img_path) && Storage::exists($impact->imptact_img_path) ? url('/').Storage::url($impact->imptact_img_path) : '';
        });
        $data = [
            'impacts' => $impacts
        ];
        return response()->json(['status' => true, 'data' => $data], 200);
    }
}
