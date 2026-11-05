<?php

namespace App\Http\Controllers\Admin\Research;

use App\Http\Controllers\Controller;
use App\Models\Admin\Research;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\MediaTrait;

class Research_Controller extends Controller
{
    use MediaTrait;
    public function index(){
        return view('Admin.Research.add-research');
    }

    public function store(Request $request){
        
        $id = $request->id;
        $request->validate([
            'heading'=> 'required',
            'resources'=> 'required',
            'description'=> 'required',
            'research_url'=> 'required',
            'research_img_path'=>  'image|max:5120',
        ],[
            'research_img_path.max' => 'Please upload an image smaller than 5 MB.',
       ]);
    
        $input['heading'] = $request->heading;
        $input['resources'] = $request->resources;
        $input['description'] = $request->description;
        $input['research_url'] = $request->research_url;

        if ($request->has('research_img_path')) {
            if ($request->file('research_img_path')) {
                $input['research_img_path'] = $this->verifyAndUpload($request, 'research_img_path', 'research_img_path');
                $original_name = $request->file('research_img_path')->getClientOriginalName();
                $input['research_img_name'] = $original_name;
            }
        }

        if($id){
            Research::find($id)->update($input);
            return redirect('admin/research')->with('success', ' Research Data Updated Successfully!');
        }else{
            $input['created_by'] = auth()->guard('master_admins')->user()->id;
            $input['created_ip_address'] = $request->ip();
            Research::create($input);
            return redirect('admin/research')->with('success', ' Research Data Added Successfully!');
        }
    }

    public function view($id){

        $research = Research::whereIn('status', ['active', 'inactive'])->findOrFail($id); 
        return view('Admin.Research.view-research',compact('research'));
    }

    public function data_table(Request $request){
        $research = Research::where('status', '!=', 'delete')->orderBy('id', 'DESC')->get();

      //  dd($Research);
    
        if ($request->ajax()) {
            return DataTables::of($research)
                ->addIndexColumn()

                // ->addColumn('latest_checked', function ($row) {
                //     return '<input type="checkbox" class="latest_checked" name="latest_checked" value="' . $row->id . '" data-id="' . $row->id . '" ' . ($row->latest_checked ? 'checked' : '') . ' onclick="updateLatestChecked(this)">';
                // })

                ->addColumn('latest_checked', function ($row) {
                    // Check if the resource is of type 'books_publishing'
                    if ($row->resources === 'books_publishing') {
                        return '<input type="checkbox" class="latest_checked" name="latest_checked" value="' . $row->id . '" data-id="' . $row->id . '" ' . ($row->latest_checked ? 'checked' : '') . ' onclick="updateLatestChecked(this)">';
                    }
                    // If not, return an empty string or placeholder
                    return ''; // Or you could return '<span>N/A</span>' if you prefer to show a message
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
                ->addColumn('image', function ($row) {
                    $image_path = '';
                    $image_name = '';
                    if (!empty($row->research_img_path)) {
                        $image_path = Storage::exists($row->research_img_path) ? url('/').Storage::url($row->research_img_path) : '';
                        $image_name = $row->research_img_name;
                    }
                    return '<img src="' . $image_path . '" alt="' . $image_name . '" width="50" class="review-image" >';
                })
              
                ->addColumn('action', function ($row) {

                    $actionBtn = '';

                    $actionBtn .= '<a href="' . url('admin/research/edit/' . $row->id) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></button></a>';
                    $actionBtn .= ' <a href="' . url('admin/research/view/' . $row->id ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-view" title="View"><i class="fa-regular fa-eye"></i></button></a>';
                    $actionBtn .= ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="research" data-flash="Data Deleted Successfully!" class="btn btn-delete delete btn-xs" title="Delete"><i class="fa-solid fa-trash"></a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="research" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title=""></i></a>';
                    } else {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="research" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-off tgle-off status_button" aria-hidden="true" title=""></i></a>';
                    }
                })
                ->rawColumns(['latest_checked','action', 'status', 'image'])
                ->make(true);
        }
    }
    

    public function edit($id){
    
          $research = Research::find($id);
          return view('Admin.Research.add-research', compact('research'));
     
    }

    public function updateLatestChecked(Request $request)
    {
        // Check if the request is trying to mark it as checked
        if ($request->latest_checked == 1) {
            // Count how many records are currently checked
            $checkedCount = Research::where('latest_checked', 1)->count();
    
            // If already 4 are checked, prevent checking another one
            if ($checkedCount >= 3) {
                return response()->json([
                    'success' => false, 
                    'message' => 'You can only check up to  records as latest.'
                ], 400);
            }
        }
        // Find the research record by ID
        $research_checked = Research::find($request->id);
        if ($research_checked) {
            // Update the latest_checked field
            $research_checked->latest_checked = $request->latest_checked;
            $research_checked->save();
    
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Record not found.']);
        }
    }
    
}
