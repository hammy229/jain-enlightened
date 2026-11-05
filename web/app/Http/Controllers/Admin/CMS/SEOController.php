<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use App\Models\Admin\Seo;
use Illuminate\Http\Request;

class SEOController extends Controller
{
    public function index()
    {
        $seo = Seo::where('status', '=', 'active')->first();
        return view('Admin.CMS.seo',compact('seo'));
    }
 
    public function store(Request $request)
    {
        $id = $request->id;
        if ($request->has('seo_section')){

            $request->validate([
                // 'page' => 'required',
                // 'meta_title' => 'required',
                // 'meta_keyword' => 'required',
                // 'meta_description' => 'required',
            ]);
        
            $input['page'] = $request->page;
            $input['meta_title'] = $request->meta_title;

            $input['meta_keyword'] = $request->meta_keyword;
            $input['meta_description'] = $request->meta_description;
           
            $input['modified_by'] = auth()->guard('master_admins')->user()->id;
            $input['modified_ip_address'] = $request->ip();
    
            // Check if SEO data for the selected page already exists
            $seoData = Seo::where('page', $request->page)->first();

            if (!empty($seoData)) {

                    $seoData->update($input);
                    return redirect('admin/cms/seo')->with('success', 'SEO Data Updated Successfully!');
              
            } else {
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Seo::create($input);
                return redirect('admin/cms/seo')->with('success', 'SEO Data Added Successfully!');
          
            }
          
        }
    }

        public function fetchSeoData($page)
        {
            $seoData = Seo::where('page', $page)->first(['id','meta_title', 'meta_keyword', 'meta_description']);
            if ($seoData) {
                return response()->json($seoData);
            } else {
                return response()->json([
                    'id' => '',
                    'meta_title' => '',
                    'meta_keyword' => '',
                    'meta_description' => ''
                ]);
            }
        }
}
