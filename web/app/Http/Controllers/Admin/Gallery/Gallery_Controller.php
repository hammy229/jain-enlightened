<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Admin\Gallery;
use Illuminate\Http\Request;
use App\Traits\MediaTrait;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class Gallery_Controller extends Controller
{
    use MediaTrait;

    public function index(){
      
        return view('Admin.Gallery.img');
    }


    public function index_video(){
      
        return view('Admin.Gallery.video');
    }

    public function store(Request $request){
        $id = $request->id;

        if($request->has('image_section')){
            $request->validate([
                'description'   => 'required',
                'gallery_img_path'=>  'image|max:5120',
            ],[
                 'gallery_img_path.max' => 'Please upload an image smaller than 5 MB.',
            ]);

            $input['description'] = $request->description;

            $input['type'] = 'image';

            if ($request->has('gallery_img_path')) {
                if ($request->file('gallery_img_path')) {
                    $input['gallery_img_path'] = $this->verifyAndUpload($request, 'gallery_img_path', 'gallery_img_path');
                    $original_name = $request->file('gallery_img_path')->getClientOriginalName();
                    $input['gallery_img_name'] = $original_name;
                }
            }


            if ($id){
                Gallery::find($id)->update($input);
                return redirect('admin/gallery/img')->with('success', 'Gallery Image Data Updated Successfully!');
            } else {
                $input['created_by']  = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Gallery::create($input);
                return redirect('admin/gallery/img')->with('success', 'Gallery Image Data Added Successfully!');
            }

        }

    }

    public function store_video(Request $request){
        $id = $request->id;

        if($request->has('link_section')){

            $request->validate([
                'gallery_video_link'=> ['required', 'regex:/^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/'], // YouTube link validation
            ],[
                'gallery_video_link.regex' => 'Please enter a valid YouTube URL.',
            ]);
            $input['gallery_video_link'] = $request->gallery_video_link;
            $input['type'] = 'video';


            if ($id){
                Gallery::find($id)->update($input);
                return redirect('admin/gallery/video')->with('success', 'Video Data Updated Successfully!');
            } else {
                $input['created_by']  = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Gallery::create($input);
                return redirect('admin/gallery/video')->with('success', 'Video Data Added Successfully!');
            }

          
        }
    }


    public function data_table(Request $request){
        $img = Gallery::where('type', 'image')->where('status', '!=', 'delete')->orderBy('id', 'DESC')->get();
    
        if ($request->ajax()) {
            return DataTables::of($img)
                ->addIndexColumn()
                ->addColumn('gallery_img_path', function ($row) {
                    $image_path = '';
                    $image_name = '';
                    if (!empty($row->gallery_img_path)) {
                        $image_path = Storage::exists($row->gallery_img_path) ? url('/').Storage::url($row->gallery_img_path) : '';
                        $image_name = $row->gallery_img_name;
                    }
                    return '<img src="' . $image_path . '" alt="' . $image_name . '" width="50" class="review-image" >';
                })
           
                ->addColumn('description', function ($row) {
                    $description = '';
                    if (!empty($row->description)) {
                        $description = strip_tags($row->description);
                        $words = explode(' ', $description);
                        if (count($words) > 10) {
                            $description = implode(' ', array_slice($words, 0, 10)) . '...';
                        }
                    }
                    return $description;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . url('admin/gallery/img/edit/' . $row->id) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></button></a>';
                    $actionBtn .= ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="galleries" data-flash="Data Deleted Successfully!" class="btn btn-delete delete btn-xs" title="Delete"><i class="fa-solid fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="galleries" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title=""></i></a>';
                    } else {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="galleries" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-off tgle-off status_button" aria-hidden="true" title=""></i></a>';
                    }
                })
                ->rawColumns(['action', 'status', 'gallery_img_path'])
                ->make(true);
        }
    }



    public function data_table_video(Request $request){
        $img = Gallery::where('type', 'video')->where('status', '!=', 'delete')->orderBy('id', 'DESC')->get();
    
        if ($request->ajax()) {
            return DataTables::of($img)
                ->addIndexColumn()
                ->addColumn('gallery_video_link', function ($row) {
                    return !empty($row->gallery_video_link) ? $row->gallery_video_link : '';
                })
           
               
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn .= '<a href="' . url('admin/gallery/video/edit/' . $row->id) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></button></a>';
                    $actionBtn .= ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="galleries" data-flash="Data Deleted Successfully!" class="btn btn-delete delete btn-xs" title="Delete"><i class="fa-solid fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="galleries" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title=""></i></a>';
                    } else {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="galleries" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-off tgle-off status_button" aria-hidden="true" title=""></i></a>';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }



    public function edit($id){
          $img = Gallery::find($id);
          return view('Admin.Gallery.img', compact('img'));
    }
    public function edit_video($id){
        $video = Gallery::find($id);
        return view('Admin.Gallery.video', compact('video'));
  }




        //     public function deleteImage($id)
        // {
        //     $image = Gallery::findOrFail($id);
        //     $image->status = 'delete';
        //     $image->save();

        //     return response()->json(['success' => 'Image Deleted Successfully!.']);
        // }

        //     public function deleteVideo($id)
        //     {
        //         $video = Gallery::findOrFail($id);
        //         $video->status = 'delete';
        //         $video->save();

        //         return response()->json(['success' => 'Video Deleted Successfully!.']);
        //     }









}
