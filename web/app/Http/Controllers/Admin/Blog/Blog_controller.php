<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use Illuminate\Http\Request;
use App\Traits\MediaTrait;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class Blog_controller extends Controller
{
    use MediaTrait;
        public function index(){

            return view('Admin.Blogs.add-blogs');
        }

        public function store(Request $request)
        {
            $id = $request->id;
           
       //  dd($request);
    
            if ($request->has('blog_section')){
    
                $request->validate([
                    'heading'=>'required',
                    'blog_by'=>'required',
                    // 'date'=>'required',
                    'slug_url' =>'required',
                    'short_description'=>'required',
                    'description'=>'required',
                ]);
             //   dd($request);
            
                $input['heading'] = $request->heading;
                $input['blog_by'] = $request->blog_by;
                $input['slug_url'] = $request->slug_url;
                $input['date'] = $request->date;
                $input['teacher_id'] = $request->teacher_id;
                $input['short_description'] = $request->short_description;
                $input['description'] = $request->description;
                $input['language'] = $request->language;
    
                $input['meta_title'] = $request->meta_title;
                $input['meta_keyword'] = $request->meta_keyword;
                $input['meta_description'] = $request->meta_description;
    
                if ($request->has('blog_img_path')) {
                    if ($request->file('blog_img_path')) {
                        $input['blog_img_path'] = $this->verifyAndUpload($request, 'blog_img_path', 'blog_img_path');
                        $original_name = $request->file('blog_img_path')->getClientOriginalName();
                        $input['blog_img_name'] = $original_name;
                    }
                }
    
                if (!empty($id)) {
                  
                        if(Blog::where('id', '!=', $request->id)
                        ->where('status', '!=', 'delete')
                        ->where('slug_url', $request->slug_url)
                        ->exists()){
                            return redirect()->back()->with('error', 'Sorry, This slug URL has already been taken !');
                        }
                        $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                        $input['modified_ip_address'] = $request->ip();
                        Blog::find($id)->update($input);
                        return redirect('admin/blogs')->with('success', 'Blog Updated Successfully!');
                } else {
                        if(  Blog::where('status', '!=', 'delete')
                        ->where('slug_url', $request->slug_url)
                        ->exists()){
                            return redirect()->back()->with('error', 'Sorry, This slug URL has already been taken !');
                        }
                        Blog::where('status', '!=', 'delete')
                        ->where('slug_url', $request->slug_url)
                        ->exists();
                        $input['created_by'] = auth()->guard('master_admins')->user()->id;
                        $input['created_ip_address'] = $request->ip();
                        Blog::create($input);
        
                        return redirect('admin/blogs')->with('success', 'Blog Added Successfully!');
                    }
            }

            if ($request->has('seo_section')){
    
                $input['meta_title'] = $request->meta_title;
                $input['meta_keyword'] = $request->meta_keyword;
                $input['meta_description'] = $request->meta_description;
        
                if (!empty($id)) {
                  
                        $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                        $input['modified_ip_address'] = $request->ip();
                        Blog::find($id)->update($input);
                        return redirect('admin/blogs')->with('success', 'SEO Section Updated Successfully!');
                } else {
                     
                        $input['created_by'] = auth()->guard('master_admins')->user()->id;
                        $input['created_ip_address'] = $request->ip();
                        Blog::create($input);
        
                        return redirect('admin/blogs')->with('success', 'SEO Section Added Successfully!');
                    }
            }
        }


        public function view($id){

            $blog = Blog::whereIn('status', ['active', 'inactive'])->findOrFail($id); 
            return view('Admin.Blogs.view-blog',compact('blog'));
        }

        public function data_table(Request $request){
            $blog = Blog::where('status', '!=', 'delete')->orderBy('id', 'DESC')->get();
        
            if ($request->ajax()) {
                return DataTables::of($blog)
                    ->addIndexColumn()
                    ->addColumn('image', function ($row) {
                        $image_path = '';
                        $image_name = '';
                        if (!empty($row->blog_img_path)) {
                            $image_path = Storage::exists($row->blog_img_path) ? url('/').Storage::url($row->blog_img_path) : '';
                            $image_name = $row->blog_img_name;
                        }
                        return '<img src="' . $image_path . '" alt="' . $image_name . '" width="50" class="review-image" >';
                    })
                    ->addColumn('heading', function ($row) {
                        return !empty($row->heading) ? $row->heading : '';
                    })
                    ->addColumn('short_description', function ($row) {
                        $short_description = '';
                        if (!empty($row->short_description)) {
                            $short_description = strip_tags($row->short_description);
                            $words = explode(' ', $short_description);
                            if (count($words) > 10) {
                                $short_description = implode(' ', array_slice($words, 0, 10)) . '...';
                            }
                        }
                        return $short_description;
                    })
                    ->addColumn('action', function ($row) {
                        $actionBtn = '';
                        $actionBtn .= '<a href="' . url('admin/blogs/edit/' . $row->id) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></button></a>';
                        $actionBtn .= ' <a href="' . url('admin/blogs/view/' . $row->id ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-view" title="View"><i class="fa-regular fa-eye"></i></button></a>';
                        $actionBtn .= ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="blogs" data-flash="Blog Data Deleted Successfully!" class="btn btn-delete delete btn-xs" title="Delete"><i class="fa-solid fa-trash"></i></a>';
                        return $actionBtn;
                    })
                    ->addColumn('status', function ($row) {
                        if ($row->status == 'active') {
                            return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="blogs" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title=""></i></a>';
                        } else {
                            return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="blogs" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-off tgle-off status_button" aria-hidden="true" title=""></i></a>';
                        }
                    })
                    ->rawColumns(['action', 'status', 'image'])
                    ->make(true);
            }
        }

        public function edit($id){
              $blog = Blog::find($id);
              return view('Admin.Blogs.add-blogs', compact('blog'));
        }

        public function check_url_exist(Request $request) {
            if (!empty($request->id)) {
                $exists = Blog::where('id', '!=', $request->id)
                    ->where('status', '!=', 'delete')
                    ->where('slug_url', $request->slug_url)
                    ->exists();
                
                if ($exists) {
                    return "true";
                } else {
                    return "false";
                }
            } else {
                $exists = Blog::where('status', '!=', 'delete')
                    ->where('slug_url', $request->slug_url)
                    ->exists();
                
                if ($exists) {
                    return "true";
                } else {
                    return "false";
                }
            }
        }
}
