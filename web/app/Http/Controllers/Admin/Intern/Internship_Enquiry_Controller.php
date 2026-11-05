<?php

namespace App\Http\Controllers\Admin\Intern;

use App\Exports\InternshipExport;
use App\Http\Controllers\Controller;
use App\Models\Front\InternshipEnquiry;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class Internship_Enquiry_Controller extends Controller
{
    public function index(){

        return view('Admin.Internship.index');
    }
    public function view($id){

        $intern = InternshipEnquiry::where('status','active')->findOrFail($id); 
        return view('Admin.Internship.view-enquiry',compact('intern'));
    }

    public function data_table(Request $request){
        $contact_details = InternshipEnquiry::where('status', '!=', 'delete')->orderBy('id','DESC')->select('*')->get();
        if ($request->ajax()) {
            return DataTables::of($contact_details)
                ->addIndexColumn()  
                ->addColumn('select', function ($row) {
                    return '<input type="checkbox" class="user_checkbox" name="user_checkbox" value="' . $row->id . '   " data-id="' . $row->id . '">';
                })
                // ->addColumn('created_at', function ($row) {
                //     return !empty($row->created_at) ? date('d-M-Y h:i:s a', strtotime($row->created_at)) : '';
                // })
                ->addColumn('created_at', function ($row) {
                    return !empty($row->created_at) ? date('d-M-Y h:i:s ', strtotime($row->created_at)) . strtoupper(date('a', strtotime($row->created_at))) : '';
                })
                ->addColumn('name', function ($row) {
                    return !empty($row->name) ? $row->name : '' ;
                })
                ->addColumn('email', function ($row) {
                    return !empty($row->email) ? $row->email : '' ;
                })
                ->addColumn('mobile_no', function ($row) {
                    return !empty($row->mobile_no) ? $row->mobile_no : '' ;
                })
                // ->addColumn('position', function ($row) {
                //     return !empty($row->position) ? $row->position : '' ;
                // })
                ->addColumn('position', function ($row) {
                    return !empty($row->position) ? ucwords(str_replace('_', ' ', $row->position)) : '' ;
                })
                
               
                ->addColumn('action', function ($row) {

                    $actionBtn = '';

                    $actionBtn .= ' <a href="' . url('/admin/internship-enquiry/view/' . $row->id ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-view" title="View"><i class="fa-regular fa-eye"></i></button></a>';

                    $actionBtn .= '<a href="javascript:void(0);" data-id="' . $row->id . '" data-table="internship_enquiries" data-flash="Data Deleted Successfully!" class="btn btn-delete delete btn-xs" title="Delete"><i class="fa-solid fa-trash"></a>';
                      return $actionBtn;
                  })
    
                   ->rawColumns(['action','select'])
                ->make(true);
        }
    }


    public function deleteSelected(Request $request)
    {
        $deleted = InternshipEnquiry::whereIn('id', $request->ids)->update(['status' => 'delete']);
        if ($deleted) {
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 400);
        }
    }

    public function exportcontacts(){
        {
            return Excel::download(new InternshipExport, 'interns.xlsx');
        }
    }
}
