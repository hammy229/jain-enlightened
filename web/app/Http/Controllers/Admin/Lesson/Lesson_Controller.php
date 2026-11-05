<?php

namespace App\Http\Controllers\Admin\Lesson;

use App\Http\Controllers\Controller;
use App\Models\Admin\Language;
use App\Models\Admin\Lesson;
use Illuminate\Http\Request;
use App\Traits\MediaTrait;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class Lesson_Controller extends Controller
{
    use MediaTrait;
    public function index(){

        $languages = Language::where('status', 'active')->get(); 
        return view('Admin.Lessons.add-lessons',compact('languages'));
    }
    public function store(Request $request)
    {
        $id = $request->id;
       
   //  dd($request);

        if ($request->has('lesson_section')){

            $request->validate([
            
                'heading'=>'required',
                'slug_url'=>'required',
                'language_id'=>'required',
                'lesson_description'=>'required',
                'additional_description'=>'required',
                'youtube_link'=>['required', 'regex:/^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/'], // YouTube link validation
            ],[
                'youtube_link.regex' => 'Please enter a valid YouTube URL.',
            ]);

            $input['heading'] = $request->heading;
            $input['slug_url'] = $request->slug_url;
            $input['language_id'] = $request->language_id;
            $input['lesson_description'] = $request->lesson_description;
            $input['additional_description'] = $request->additional_description;
            $input['youtube_link'] = $request->youtube_link;


            $input['meta_title'] = $request->meta_title;
            $input['meta_keyword'] = $request->meta_keyword;
            $input['meta_description'] = $request->meta_description;

            if ($request->has('lesson_img_path')) {
                if ($request->file('lesson_img_path')) {
                    $input['lesson_img_path'] = $this->verifyAndUpload($request, 'lesson_img_path', 'lesson_img_path');
                    $original_name = $request->file('lesson_img_path')->getClientOriginalName();
                    $input['lesson_img_name'] = $original_name;
                }
            }

       
            if (!empty($id)) {
              
                    if(Lesson::where('id', '!=', $request->id)
                    ->where('status', '!=', 'delete')
                    ->where('slug_url', $request->slug_url)
                    ->exists()){
                        return redirect()->back()->with('error', 'Sorry, This slug URL has already been taken !');
                    }
                    $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Lesson::find($id)->update($input);
                    return redirect('admin/lessons')->with('success', 'Lesson Updated Successfully!');
            } else {
                    if(  Lesson::where('status', '!=', 'delete')
                    ->where('slug_url', $request->slug_url)
                    ->exists()){
                        return redirect()->back()->with('error', 'Sorry, This slug URL has already been taken !');
                    }
                    Lesson::where('status', '!=', 'delete')
                    ->where('slug_url', $request->slug_url)
                    ->exists();
                    $input['created_by'] = auth()->guard('master_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Lesson::create($input);
    
                    return redirect('admin/lessons')->with('success', 'Lesson Added Successfully!');
                }
        }

        if ($request->has('seo_section')){

            $input['meta_title'] = $request->meta_title;
            $input['meta_keyword'] = $request->meta_keyword;
            $input['meta_description'] = $request->meta_description;
    
            if (!empty($id)) {
              
                    $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Lesson::find($id)->update($input);
                    return redirect('admin/lessons')->with('success', 'SEO Section Updated Successfully!');
            } else {
                 
                    $input['created_by'] = auth()->guard('master_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Lesson::create($input);
    
                    return redirect('admin/lessons')->with('success', 'SEO Section Added Successfully!');
                }
        }

    }



    public function view($id){

        $lesson = Lesson::with('language')->whereIn('status', ['active', 'inactive'])->findOrFail($id); 
        return view('Admin.Lessons.view-lesson',compact('lesson'));
    }


    public function data_table(Request $request){
        $lesson_banner = Lesson::with('language')->where('status', '!=', 'delete')->orderBy('id', 'DESC')->get();
     //   dd($cms_banner);
    
        if ($request->ajax()) {
            return DataTables::of($lesson_banner)
                ->addIndexColumn()
                ->addColumn('heading', function ($row) {
                    return !empty($row->heading) ? $row->heading : '';
                })
                ->addColumn('language', function ($row) {
                    return !empty($row->language) ? $row->language->heading : '-';
                })
                ->addColumn('image', function ($row) {
                    $image_path = '';
                    $image_name = '';
                    if (!empty($row->lesson_img_path)) {
                        $image_path = Storage::exists($row->lesson_img_path) ? url('/').Storage::url($row->lesson_img_path) : '';
                        $image_name = $row->lesson_img_name;
                    }
                    return '<img src="' . $image_path . '" alt="' . $image_name . '" width="50" class="review-image" >';
                })
               
                ->addColumn('action', function ($row) {

                    $actionBtn = '';

                    $actionBtn .= '<a href="' . url('admin/lessons/edit/' . $row->id) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></button></a>';
                    $actionBtn .= ' <a href="' . url('admin/lessons/view/' . $row->id ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-view" title="View"><i class="fa-regular fa-eye"></i></button></a>';
                    $actionBtn .= ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="lessons" data-flash="Data Deleted Successfully!" class="btn btn-delete delete btn-xs" title="Delete"><i class="fa-solid fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="lessons" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title=""></i></a>';
                    } else {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="lessons" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-off tgle-off status_button" aria-hidden="true" title=""></i></a>';
                    }
                })
                ->rawColumns(['image','status','action'])
                ->make(true);
        }
    }
    public function edit($id){
    
          $lessons = Lesson::find($id);
          $languages = Language::where('status', 'active')->get(); 
          return view('Admin.Lessons.add-lessons', compact('lessons','languages'));
    }
    public function check_url_exist(Request $request) {
        if (!empty($request->id)) {
            $exists = Lesson::where('id', '!=', $request->id)
                ->where('status', '!=', 'delete')
                ->where('slug_url', $request->slug_url)
                ->exists();
            
            if ($exists) {
                return "true";
            } else {
                return "false";
            }
        } else {
            $exists = Lesson::where('status', '!=', 'delete')
                ->where('slug_url', $request->slug_url)
                ->exists();
            
            if ($exists) {
                return "true";
            } else {
                return "false";
            }
        }
    }
}
