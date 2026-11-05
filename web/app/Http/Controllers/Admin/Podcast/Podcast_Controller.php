<?php

namespace App\Http\Controllers\Admin\Podcast;

use App\Http\Controllers\Controller;
use App\Models\Admin\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\MediaTrait;

class Podcast_Controller extends Controller
{
    use MediaTrait;
    public function index(){
        return view('Admin.Podcasts.index');
    }

    public function store(Request $request){
        
        $id = $request->id;
        $request->validate([
            'heading'=> 'required',
            'youtube_url'=>['required', 'regex:/^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/'], // YouTube link validation
            'podcast_img_path'=>  'image|max:5120',
        ],[
            'podcast_img_path.max' => 'Please upload an image smaller than 5 MB.',
            'youtube_url.regex' => 'Please enter a valid YouTube URL.',
       ]);
    
       $input['heading'] = $request->heading;
       $input['youtube_url'] = $request->youtube_url;

        if ($request->has('podcast_img_path')) {
            if ($request->file('podcast_img_path')) {
                $input['podcast_img_path'] = $this->verifyAndUpload($request, 'podcast_img_path', 'podcast_img_path');
                $original_name = $request->file('podcast_img_path')->getClientOriginalName();
                $input['podcast_img_name'] = $original_name;
            }
        }
        if($id){
            Podcast::find($id)->update($input);
            return redirect('admin/podcast')->with('success', ' Podcast Data Updated Successfully!');
        }else{
            $input['created_by'] = auth()->guard('master_admins')->user()->id;
            $input['created_ip_address'] = $request->ip();
            Podcast::create($input);
            return redirect('admin/podcast')->with('success', ' Podcast Data Added Successfully!');
        }
    }

    public function data_table(Request $request){
        $podcast = Podcast::where('status', '!=', 'delete')->orderBy('id', 'DESC')->get();

        if ($request->ajax()) {
            return DataTables::of($podcast)
                ->addIndexColumn()
                ->addColumn('heading', function ($row) {
                    return !empty($row->heading) ? $row->heading : '';
                })
                ->addColumn('image', function ($row) {
                    $image_path = '';
                    $image_name = '';
                    if (!empty($row->podcast_img_path)) {
                        $image_path = Storage::exists($row->podcast_img_path) ? url('/').Storage::url($row->podcast_img_path) : '';
                        $image_name = $row->podcast_img_name;
                    }
                    return '<img src="' . $image_path . '" alt="' . $image_name . '" width="50" class="review-image" >';
                })
              
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/podcast/edit/' . $row->id) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></i></button></a>';
                    $actionBtn .= ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="podcasts" data-flash="Data Deleted Successfully!" class="btn btn-delete delete btn-xs" title="Delete"><i class="fa-solid fa-trash"></a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="podcasts" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title=""></i></a>';
                    } else {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="podcasts" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-off tgle-off status_button" aria-hidden="true" title=""></i></a>';
                    }
                })
                ->rawColumns(['action', 'status', 'image'])
                ->make(true);
        }
    }
    
    public function edit($id){
    
          $podcast = Podcast::find($id);
          return view('Admin.Podcasts.index', compact('podcast'));
     
    }
}
