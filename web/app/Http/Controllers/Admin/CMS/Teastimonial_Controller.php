<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Models\Admin\Teastimonial;
use Illuminate\Http\Request;
use App\Traits\MediaTrait;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class Teastimonial_Controller extends Controller
{
    use MediaTrait;
    public function index(){
        return view('Admin.CMS.Testimonials.add-testimonial');
    }

    public function store(Request $request){
        
        $id = $request->id;

        $request->validate([
            'name'=> 'required',
            'location'=> 'required',
            'description'=> 'required',
            'teastimonial_img_path'=>  'image|max:5120',
        ],[
            'teastimonial_img_path.max' => 'Please upload an image smaller than 5 MB.',
       ]);
    //    dd($request);
    
       $input['name'] = $request->name;
       $input['location'] = $request->location;
       $input['description'] = $request->description;

        if ($request->has('teastimonial_img_path')) {
            if ($request->file('teastimonial_img_path')) {
                $input['teastimonial_img_path'] = $this->verifyAndUpload($request, 'teastimonial_img_path', 'teastimonial_img_path');
                $original_name = $request->file('teastimonial_img_path')->getClientOriginalName();
                $input['teastimonial_img_name'] = $original_name;
            }
        }

        if($id){
            Teastimonial::find($id)->update($input);
            return redirect('admin/cms/testimonials/index')->with('success', ' Testimonial Data Updated Successfully!');
        }else{
            $input['created_by'] = auth()->guard('master_admins')->user()->id;
            $input['created_ip_address'] = $request->ip();
            Teastimonial::create($input);
            return redirect('admin/cms/testimonials/index')->with('success', ' Testimonial Data Added Successfully!');
        }

    }


    public function data_table(Request $request){
        $teastimonial = Teastimonial::where('status', '!=', 'delete')->orderBy('id', 'DESC')->get();

        if ($request->ajax()) {
            return DataTables::of($teastimonial)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return !empty($row->name) ? $row->name : '';
                })
                // ->addColumn('image', function ($row) {
                //     $image_path = '';
                //     $image_name = '';
                //     if (!empty($row->teastimonial_img_path)) {
                //         $image_path = Storage::exists($row->teastimonial_img_path) ? url('/').Storage::url($row->teastimonial_img_path) : '';
                //         $image_name = $row->teastimonial_img_name;
                //     }
                //     return '<img src="' . $image_path . '" alt="' . $image_name . '" width="50" class="review-image" style="cursor:pointer;">';
                // })
              
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/cms/testimonials/edit/' . $row->id) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></button></a>';
                    $actionBtn .= ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="teastimonials" data-flash="Data Deleted Successfully!" class="btn btn-delete delete btn-xs" title="Delete"><i class="fa-solid fa-trash"></a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="teastimonials" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title=""></i></a>';
                    } else {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="teastimonials" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-off tgle-off status_button" aria-hidden="true" title=""></i></a>';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }
    
    public function edit($id){
    
          $testimonials = Teastimonial::find($id);
          return view('Admin.CMS.Testimonials.add-testimonial', compact('testimonials'));
     
    }

}
