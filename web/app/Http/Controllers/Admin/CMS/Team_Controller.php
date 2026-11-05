<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Models\Admin\Team;
use Illuminate\Http\Request;
use App\Traits\MediaTrait;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class Team_Controller extends Controller
{
    use MediaTrait;
    public function index(){
        return view('Admin.CMS.Team.add-team');
    }

    public function store(Request $request){
        
        $id = $request->id;

        $request->validate([
            'name'=> 'required',
            'designation'=> 'required',
            'team'=> 'required',
            'linkedin_url'=> 'required',
            'description'=> 'required',
            'team_img_path'=>  'image|max:5120',
        ],[
            'team_img_path.max' => 'Please upload an image smaller than 5 MB.',
       ]);
    //   dd($request);
    
       $input['name'] = $request->name;
       $input['designation'] = $request->designation;
       $input['team'] = $request->team;
       $input['linkedin_url'] = $request->linkedin_url;
       $input['description'] = $request->description;

        if ($request->has('team_img_path')) {
            if ($request->file('team_img_path')) {
                $input['team_img_path'] = $this->verifyAndUpload($request, 'team_img_path', 'team_img_path');
                $original_name = $request->file('team_img_path')->getClientOriginalName();
                $input['team_img_name'] = $original_name;
            }
        }

        if($id){
            Team::find($id)->update($input);
            return redirect('admin/cms/team/index')->with('success', ' Team Data Updated Successfully!');
        }else{
            $input['created_by'] = auth()->guard('master_admins')->user()->id;
            $input['created_ip_address'] = $request->ip();
            Team::create($input);
            return redirect('admin/cms/team/index')->with('success', ' Team Data Added Successfully!');
        }

    }
    public function data_table(Request $request){
        $team = Team::where('status', '!=', 'delete')->orderBy('id', 'DESC')->get();
     //   dd($cms_banner);
    
        if ($request->ajax()) {
            return DataTables::of($team)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return !empty($row->name) ? $row->name : '';
                })
                ->addColumn('image', function ($row) {
                    $image_path = '';
                    $image_name = '';
                    if (!empty($row->team_img_path)) {
                        $image_path = Storage::exists($row->team_img_path) ? url('/').Storage::url($row->team_img_path) : '';
                        $image_name = $row->team_img_name;
                    }
                    return '<img src="' . $image_path . '" alt="' . $image_name . '" width="50" class="review-image">';
                })
              
              
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/cms/team/edit/' . $row->id) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></button></a>';
                    $actionBtn .= ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="teams" data-flash="Data Deleted Successfully!" class="btn btn-delete delete btn-xs" title="Delete"><i class="fa-solid fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="teams" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title=""></i></a>';
                    } else {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="teams" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-off tgle-off status_button" aria-hidden="true" title=""></i></a>';
                    }
                })
                ->rawColumns(['action', 'status', 'image'])
                ->make(true);
        }
    }
    
    public function edit($id){
    
          $team = Team::find($id);
          return view('Admin.CMS.Team.add-team', compact('team'));
    }


}


