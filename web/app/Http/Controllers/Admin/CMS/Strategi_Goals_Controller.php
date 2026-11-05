<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Models\Admin\Strategicgoals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\MediaTrait;

class Strategi_Goals_Controller extends Controller
{
    use MediaTrait;
    public function index(){
        return view('Admin.CMS.strategic-goals');
    }

    public function store(Request $request){
        
        $id = $request->id;

        $request->validate([
            'heading'=> 'required',
            'description'=> 'required',
            'strategic_img_path'=>  'image|max:5120',
        ],[
            'strategic_img_path.max' => 'Please upload an image smaller than 5 MB.',
       ]);
    //   dd($request);
    
       $input['heading'] = $request->heading;
       $input['description'] = $request->description;

        if ($request->has('strategic_img_path')) {
            if ($request->file('strategic_img_path')) {
                $input['strategic_img_path'] = $this->verifyAndUpload($request, 'strategic_img_path', 'strategic_img_path');
                $original_name = $request->file('strategic_img_path')->getClientOriginalName();
                $input['strategic_img_name'] = $original_name;
            }
        }

        if($id){
            Strategicgoals::find($id)->update($input);
            return redirect('admin/cms/strategic-goals')->with('success', ' Strategic Goal Updated Successfully!');
        }else{
            $input['created_by'] = auth()->guard('master_admins')->user()->id;
            $input['created_ip_address'] = $request->ip();
            Strategicgoals::create($input);
            return redirect('admin/cms/strategic-goals')->with('success', ' Strategic Goal Added Successfully!');
        }

    }


    public function view($id){

        $strategic = Strategicgoals::whereIn('status', ['active', 'inactive'])->findOrFail($id); 
        return view('Admin.CMS.Goals.view-strategic-goal',compact('strategic'));
    }

    public function data_table(Request $request){
        $strategic = Strategicgoals::where('status', '!=', 'delete')->orderBy('id', 'DESC')->get();
     //   dd($cms_banner);
    
        if ($request->ajax()) {
            return DataTables::of($strategic)
                ->addIndexColumn()
                ->addColumn('heading', function ($row) {
                    return !empty($row->heading) ? $row->heading : '';
                })
                ->addColumn('image', function ($row) {
                    $image_path = '';
                    $image_name = '';
                    if (!empty($row->strategic_img_path)) {
                        $image_path = Storage::exists($row->strategic_img_path) ? url('/').Storage::url($row->strategic_img_path) : '';
                        $image_name = $row->strategic_img_name;
                    }
                    return '<img src="' . $image_path . '" alt="' . $image_name . '" width="50" class="review-image">';
                })
              
                ->addColumn('action', function ($row) {

                    $actionBtn = '';

                    $actionBtn .= '<a href="' . url('admin/cms/strategic-goals/edit/' . $row->id) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></button></a>';
                   
                    $actionBtn .= ' <a href="' . url('admin/cms/strategic-goals/view/' . $row->id ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-view" title="View"><i class="fa-regular fa-eye"></i></button></a>';

                    $actionBtn .= ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="strategicgoals" data-flash="Data Deleted Successfully!" class="btn btn-delete delete btn-xs" title="Delete"><i class="fa-solid fa-trash"></a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="strategicgoals" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title=""></i></a>';
                    } else {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="strategicgoals" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-off tgle-off status_button" aria-hidden="true" title=""></i></a>';
                    }
                })
                ->rawColumns(['action', 'status', 'image'])
                ->make(true);
        }
    }
    
    public function edit($id){
    
          $strategic = Strategicgoals::find($id);
          return view('Admin.CMS.strategic-goals', compact('strategic'));
     
    }

}
