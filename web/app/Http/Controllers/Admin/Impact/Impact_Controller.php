<?php

namespace App\Http\Controllers\Admin\Impact;

use App\Http\Controllers\Controller;
use App\Models\Admin\Impact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\MediaTrait;

class Impact_Controller extends Controller
{
    use MediaTrait;
    public function index(){
        return view('Admin.Impact.index');
    }

    public function store(Request $request){
        $id = $request->id;
        $request->validate([
            'heading'=> 'required',
            'description'=> 'required',
            'imptact_img_path'=>  'image|max:5120',
        ],[
            'imptact_img_path.max' => 'Please upload an image smaller than 5 MB.',
    ]);

       $input['heading'] = $request->heading;
       $input['description'] = $request->description;

       if ($request->has('imptact_img_path')) {
        if ($request->file('imptact_img_path')) {
            $input['imptact_img_path'] = $this->verifyAndUpload($request, 'imptact_img_path', 'imptact_img_path');
            $original_name = $request->file('imptact_img_path')->getClientOriginalName();
            $input['imptact_img_name'] = $original_name;
        }
    }

        if($id){
            Impact::find($id)->update($input);
            return redirect('admin/impact')->with('success', ' Impact Data Updated Successfully!');
        }else{
            $input['created_by'] = auth()->guard('master_admins')->user()->id;
            $input['created_ip_address'] = $request->ip();
            Impact::create($input);
            return redirect('admin/impact')->with('success', ' Impact Data Added Successfully!');
        }

    }

    public function data_table(Request $request){
        $cms_banner = Impact::where('status', '!=', 'delete')->orderBy('id', 'DESC')->get();
     //   dd($cms_banner);
    
        if ($request->ajax()) {
            return DataTables::of($cms_banner)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $image_path = '';
                    $image_name = '';
                    if (!empty($row->imptact_img_path)) {
                        $image_path = Storage::exists($row->imptact_img_path) ? url('/').Storage::url($row->imptact_img_path) : '';
                        $image_name = $row->imptact_img_name;
                    }
                    return '<img src="' . $image_path . '" alt="' . $image_name . '" width="50" class="review-image" >';
                })
                ->addColumn('heading', function ($row) {
                    return !empty($row->heading) ? $row->heading : '';
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
                    $actionBtn = '<a href="' . url('admin/impact/edit/' . $row->id) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></button></a>';
                    $actionBtn .= ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="impacts" data-flash="Data Deleted Successfully!" class="btn btn-delete delete btn-xs" title="Delete"><i class="fa-solid fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="impacts" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title=""></i></a>';
                    } else {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="impacts" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-off tgle-off status_button" aria-hidden="true" title=""></i></a>';
                    }
                })
                ->rawColumns(['image','action', 'status'])
                ->make(true);
        }
    }
    
    public function edit($id){
          $impacts = Impact::find($id);
          return view('Admin.Impact.index', compact('impacts'));
     
    }
}
