<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Models\Admin\Appbanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\MediaTrait;

class App_Banner_Controller extends Controller
{
    use MediaTrait;
    public function index(){

        return view('Admin.CMS.app-banner');
    }

    public function store(Request $request){
        
        $id = $request->id;

        $request->validate([
            'heading'=> 'required',
            'app_banner_img_path'=>  'image|max:5120',
        ],[
            'app_banner_img_path.max' => 'Please upload an image smaller than 5 MB.',
       ]);
    //   dd($request);
    
       $input['heading'] = $request->heading;

        if ($request->has('app_banner_img_path')) {
            if ($request->file('app_banner_img_path')) {
                $input['app_banner_img_path'] = $this->verifyAndUpload($request, 'app_banner_img_path', 'app_banner_img_path');
                $original_name = $request->file('app_banner_img_path')->getClientOriginalName();
                $input['app_banner_img_name'] = $original_name;
            }
        }

        if($id){
            Appbanner::find($id)->update($input);
            return redirect('admin/cms/app-banner')->with('success', ' App Banner Data Updated Successfully!');
        }else{
            $input['created_by'] = auth()->guard('master_admins')->user()->id;
            $input['created_ip_address'] = $request->ip();
            Appbanner::create($input);
            return redirect('admin/cms/app-banner')->with('success', ' App Banner Data Added Successfully!');
        }

    }



    public function data_table(Request $request){
        $app_banner = Appbanner::where('status', '!=', 'delete')->orderBy('id', 'DESC')->get();

     //   dd($cms_banner);
    
        if ($request->ajax()) {
            return DataTables::of($app_banner)
                ->addIndexColumn()
                ->addColumn('heading', function ($row) {
                    return !empty($row->heading) ? $row->heading : '';
                })
                ->addColumn('image', function ($row) {
                    $image_path = '';
                    $image_name = '';
                    if (!empty($row->app_banner_img_path)) {
                        $image_path = Storage::exists($row->app_banner_img_path) ? url('/').Storage::url($row->app_banner_img_path) : '';
                        $image_name = $row->app_banner_img_name;
                    }
                    return '<img src="' . $image_path . '" alt="' . $image_name . '" width="50" class="review-image">';
                })
              
              
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/cms/app-banner/edit/' . $row->id) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></i></button></a>';
                    $actionBtn .= ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="appbanners" data-flash="Data Deleted Successfully!" class="btn btn-delete delete btn-xs delete btn-xs" title="Delete"><i class="fa-solid fa-trash"></a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="appbanners" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title=""></i></a>';
                    } else {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="appbanners" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-off tgle-off status_button" aria-hidden="true" title=""></i></a>';
                    }
                })
                ->rawColumns(['action', 'status', 'image'])
                ->make(true);
        }
    }
    

    public function edit($id){
    
          $app_banner = Appbanner::find($id);
          return view('Admin.CMS.app-banner', compact('app_banner'));
     
    }
}
