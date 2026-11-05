<?php

namespace App\Http\Controllers\Admin\AppConfig;

use App\Http\Controllers\Controller;
use App\Models\Admin\AppConfiguration;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class App_Config_Controller extends Controller
{
    public function index(){

        return view('Admin.App-Configuration.index');
    }
    public function store(Request $request)
    {
        $id = $request->id;
    
        // Apply the unique rule for config_type
        $request->validate([
            'config_type' => [
                'required',
                // Ensure config_type is unique, ignoring the current record if updating
                Rule::unique('app_configurations')->ignore($id),
            ],
            'config_version' => 'required',
        ]);
    
        $input['config_type'] = $request->config_type;
        $input['config_version'] = $request->config_version;
    
        if ($id) {
            // Updating an existing record
            AppConfiguration::find($id)->update($input);
            return redirect('admin/app-configuration')->with('success', 'App Configuration Data Updated Successfully!');
        } else {
            // Creating a new record
            $input['created_by'] = auth()->guard('master_admins')->user()->id;
            $input['created_ip_address'] = $request->ip();
            AppConfiguration::create($input);
            return redirect('admin/app-configuration')->with('success', 'App Configuration Data Added Successfully!');
        }
    }
    

    public function data_table(Request $request){
        $cms_banner = AppConfiguration::where('status', '!=', 'delete')->orderBy('id', 'DESC')->get();
     //   dd($cms_banner);
    
        if ($request->ajax()) {
            return DataTables::of($cms_banner)
                ->addIndexColumn()
                ->addColumn('config_type', function ($row) {
                    return !empty($row->config_type) ? ucfirst($row->config_type) : '';
                })
                ->addColumn('config_version', function ($row) {
                    return !empty($row->config_version) ? ucfirst($row->config_version) : '';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/app-configuration/edit/' . $row->id) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></button></a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="app_configurations" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title=""></i></a>';
                    } else {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="app_configurations" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-off tgle-off status_button" aria-hidden="true" title=""></i></a>';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }
    
    public function edit($id){

          $app_config = AppConfiguration::find($id);
          return view('Admin.App-Configuration.index', compact('app_config'));
     
    }

}
