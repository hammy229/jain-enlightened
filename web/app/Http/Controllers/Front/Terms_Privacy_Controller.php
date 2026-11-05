<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use App\Models\Admin\Privacypolicy;
use App\Models\Admin\Seo;
use App\Models\Admin\Termscondition;
use Illuminate\Http\Request;

class Terms_Privacy_Controller extends Controller
{
    public function terms()
    {
        $metadata = Seo::where('page', 'terms_conditions')->where('status', 'active')->first();
        $term = Termscondition::where('status', '=', 'active')->first();
        $banner = Banner::where('page', 'terms_conditions')->where('status', 'active')->first();

      //  dd($banner);

        return view('Front.terms-of-service',compact('term','banner','metadata'));
    }

    public function privacy()
    {
        $metadata = Seo::where('page', 'privacy_policy')->where('status', 'active')->first();
        $policy = Privacypolicy::where('status', '=', 'active')->first();
        $banner = Banner::where('page', 'privacy_policy')->where('status', 'active')->first();
        return view('Front.privacy-policy',compact('policy','banner','metadata'));
    }
}
