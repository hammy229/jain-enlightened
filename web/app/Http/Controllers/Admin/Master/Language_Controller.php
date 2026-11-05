<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Admin\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\MediaTrait;

class Language_Controller extends Controller
{
    use MediaTrait;
    public function index(){

        return view('Admin.Master.language');
    }

    public function store(Request $request){
        $id = $request->id;
        $request->validate([
            'heading'=> 'required',
    ]);
    
       $input['heading'] = $request->heading;

        if($id){
            if(Language::where('id', '!=', $request->id)
            ->where('status', '!=', 'delete')
            ->where('heading', $request->heading)
            ->exists()){
                return redirect()->back()->with('error', 'Sorry, This Language has already been taken !');
            }
            Language::find($id)->update($input);
            return redirect('admin/master/language')->with('success', ' Language Data Updated Successfully!');
        }else{

            if(  Language::where('status', '!=', 'delete')
            ->where('heading', $request->heading)
            ->exists()){
                return redirect()->back()->with('error', 'Sorry, This Language has already been taken !');
            }

            $input['created_by'] = auth()->guard('master_admins')->user()->id;
            $input['created_ip_address'] = $request->ip();
            Language::create($input);
            return redirect('admin/master/language')->with('success', ' Language Data Added Successfully!');
        }
    }

    public function data_table(Request $request){
     //   $language = Language::where('status', '!=', 'delete')->orderBy('id', 'DESC')->get();
    
     $language = Language::where('status', '!=', 'delete')
     ->orderBy('heading', 'ASC') // Change 'ASC' to 'DESC' for descending order
     ->get();

        if ($request->ajax()) {
            return DataTables::of($language)
                ->addIndexColumn()
                ->addColumn('heading', function ($row) {
                    return !empty($row->heading) ? $row->heading : '';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/master/language/edit/' . $row->id) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></i></button></a>';
                    $actionBtn .= ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="languages" data-flash="Data Deleted Successfully!" class="btn btn-delete delete btn-xs" title="Delete"><i class="fa-solid fa-trash"></a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="languages" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title=""></i></a>';
                    } else {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="languages" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-off tgle-off status_button" aria-hidden="true" title=""></i></a>';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }
    
    public function edit($id){
          $languages = Language::find($id);
          return view('Admin.Master.language', compact('languages'));
    }


    public function check_url_exist(Request $request) {
        if (!empty($request->id)) {
            $exists = Language::where('id', '!=', $request->id)
                ->where('status', '!=', 'delete')
                ->where('heading', $request->heading)
                ->exists();
            
            if ($exists) {
                return "true";
            } else {
                return "false";
            }
        } else {
            $exists = Language::where('status', '!=', 'delete')
                ->where('heading', $request->heading)
                ->exists();
            
            if ($exists) {
                return "true";
            } else {
                return "false";
            }
        }
    }

}
