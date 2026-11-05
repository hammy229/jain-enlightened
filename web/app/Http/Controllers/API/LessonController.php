<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as Admin;
use Storage;

class LessonController extends Controller
{
    public function index(){
        $languages = Admin\Language::where('status', 'active')->select('id', 'heading')->orderBy('id', 'desc')->get();
        $languages->prepend([
            'id' => 0,
            'heading' => 'All',
        ]);
        $lessons = Admin\Lesson::where('status', 'active');
        if(!empty($request->language_id)){
            $lessons = $lessons->where('language_id', $request->language_id);
        }
        $lessons = $lessons->select('id', 'heading', 'slug_url', 'language_id', 'lesson_description', 'additional_description', 'lesson_img_path', 'lesson_img_name', 'youtube_link')->orderBy('id', 'desc')->get();
        $lessons->map(function($lesson){
            $lesson->lesson_description = !empty($lesson->lesson_description) ? mb_convert_encoding(substr(strip_tags($lesson->lesson_description), 0, 150). '...', 'UTF-8', 'UTF-8') : '';
            $lesson->additional_description = !empty($lesson->additional_description) ? mb_convert_encoding($lesson->additional_description, 'UTF-8', 'UTF-8') : '';
            $lesson->lesson_img_path = !empty($lesson->lesson_img_path) && Storage::exists($lesson->lesson_img_path) ? url('/').Storage::url($lesson->lesson_img_path) : '';
        });

        $data = [
            'languages' => $languages,
            'lessons' => $lessons
        ];
        return response()->json(['status' => true, 'data' => $data], 200);
    }
    
    public function view(Request $request){
        $lesson = Admin\Lesson::where('status', 'active')->where('id', $request->id)->select('id', 'heading', 'slug_url', 'language_id', 'lesson_description', 'additional_description', 'lesson_img_path', 'lesson_img_name', 'youtube_link')->orderBy('id', 'desc')->first();
        $lesson->lesson_img_path = !empty($lesson->lesson_img_path) && Storage::exists($lesson->lesson_img_path) ? url('/').Storage::url($lesson->lesson_img_path) : '';
        
        $related_lessons = Admin\Lesson::where('status', 'active')->where('id', '!=', $request->id)->where('language_id', $lesson->language_id)->select('id', 'heading', 'slug_url', 'language_id', 'lesson_description', 'additional_description', 'lesson_img_path', 'lesson_img_name', 'youtube_link')->orderBy('id', 'desc')->limit(5)->get();
        $related_lessons->map(function($related_lesson){
            $related_lesson->lesson_description = !empty($related_lesson->lesson_description) ? mb_convert_encoding(substr(strip_tags($related_lesson->lesson_description), 0, 150). '...', 'UTF-8', 'UTF-8') : '';
            $related_lesson->additional_description = !empty($related_lesson->additional_description) ? mb_convert_encoding($related_lesson->additional_description, 'UTF-8', 'UTF-8') : '';
            $related_lesson->lesson_img_path = !empty($related_lesson->lesson_img_path) && Storage::exists($related_lesson->lesson_img_path) ? url('/').Storage::url($related_lesson->lesson_img_path) : '';
        });
        $data = [
            'lesson' => $lesson,
            'related_lessons' => $related_lessons
        ];
        return response()->json(['status' => true, 'data' => $data], 200);
    }
}
